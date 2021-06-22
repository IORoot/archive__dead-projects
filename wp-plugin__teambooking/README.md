# How the stripe functionality works.

## Observations

### The webhooks
   
Teambooking will register a URL to stripe.com as a webhook page. That page is:
`https://londonparkour.com/wp-admin/admin-ajax.php?action=teambooking`

The event that stripe.com will send to this URL is: `checkout.session.completed`

### Creating webhooks in stripe.com
   
The webhooks are created every time the teambooking page is saved or updated. When the return URL is changed, a new webhook is registered with stripe.com

### The return URL

Is NOT the webhook address.

### The PAGE CACHE

This WILL interfere with the sessions. Make sure cache is cleared.

### Workflow Steps

1. User fills in fields on booking form.
2. Stripe payment button will appear.
3. Redirected to stripe payment page.
4. Stripe new payment is created. `payment_intent.created`
5. Stripe new customer is created. `customer.created`
6. Stripe payment details & method is attached to new customer `payment_method.attached`
7. Stripe charges payment method. `charge.succeeded`
8. Stripe payment status changed to succeeded. `payment_intent.succeeded`
9. Stripe sends a `checkout.session.completed` event to the registered webhook address.
10. User will be redirected to the 'Registered' webpage.

### The JSON sent to the webhook address

```
{
  "id": "evt_1G5W1uGtEGgLrOjaPEgGQlRn",
  "object": "event",
  "api_version": "2018-02-28",
  "created": 1580125522,
  "data": {
    "object": {
      "id": "cs_test_IDGOESHEREANDISLONGSTRINGOFCHARACTERS",
      "object": "checkout.session",
      "billing_address_collection": null,
      "cancel_url": "https://londonparkour.com",
      "client_reference_id": null,
      "customer": "cus_GclZEtgrwKGqYT",
      "customer_email": null,
      "display_items": [
        {
          "amount": 1000,
          "currency": "gbp",
          "custom": {
            "description": "Beginner Indoor | #1425",
            "images": null,
            "name": "A9j9KVMGbJu7Pz1Ifn0TjDeD2X9izvPt"
          },
          "quantity": 1,
          "type": "custom"
        }
      ],
      "livemode": false,
      "locale": null,
      "metadata": {
      },
      "mode": "payment",
      "payment_intent": "pi_1G5W1YGtEGgLrOjaqniXhz5K",
      "payment_method_types": [
        "card"
      ],
      "setup_intent": null,
      "submit_type": null,
      "subscription": null,
      "success_url": "https://londonparkour.com/registered/"
    }
  },
  "livemode": false,
  "pending_webhooks": 2,
  "request": {
    "id": null,
    "idempotency_key": null
  },
  "type": "checkout.session.completed"
}
```

### Not Working Checks

1. Clear ALL Caches
2. Remove All webhook addresses in stripe. Re-register them by changing the return URL and saving the 'Payment Gateways' page again.
3.  Check the stripe webhooks to see if they are registered. 



# Change 2 - Schema

So the problem is that for event schema to work, you need a different URL for each event. This is per google's word... 
https://developers.google.com/search/docs/data-types/event?hl=en#integrate

However, TeamBooking doesn't have pages for classes because it uses AJAX to load the content dynamically. Which means
this becomes complicated. So, the solution is:

1. Use query parameters on the URL to specify an individual slot for the calendar widget. However, the issue with THAT is 
   there isn't a query parameter for individual slots, just specific days. So problem 1 is solved by adding in a new parameter
   called `tbk_service` that once combined with `tbk_date` allows mee to individually specify a single slot on a speecific day.
   That in turn give a unique URL for google to parse.
2. Next, the problem of getting schema on that slot page.
3. Also, we need to create a new sitemap for the next months worth of URL combinations for google to pick up.
# Stripe Payments plugin --> Teambooking coupon

NOTE - The 'output_coupon' shortcode has been depreciated. It uses transients instead of sessions.

This plugin will bridge the gap between the stripe payments plugin (https://s-plugins.com/) and TeamBooking plugin. (https://stroheimdesign.com/)

When someone purchases a gift-card, through the stripe payments plugin, the returning action
will run this plugin and generate a coupon code for TeamBooking to be used by the buyer.
 
## Workflow of Plugin
 
1. The asp_stripe_payment_completed ACTION is run after the stripe payment is made.

2. My hook taps into this action and runs the create_coupon() function with all stripe data
    passed to it.

3. The create_coupon() will determine which payment has been made and create a TeamBooking
    Coupon Object and set its values.

4. The create_coupon() function will pass the new coupon object to the TBGenerateCoupon class
    constructor which runs the database insert with the data.


## This is the workflow of the standard TeamBooking Coupon creation.

1.   /js/admin.js : 360
    This file will use the private API to send a POST to call the action 'tbk_add_coupon'.
    Uses the Wordpress AJAX API (https://codex.wordpress.org/AJAX_in_Plugins) to send the request.

2.   /src/TeamBooking/Admin.php : 97-100
    Declares that when the 'admin_post_tbk_add_coupon' action is encountered (from the JS file above),
    run the 'insertPromotionCoupon' function. This is basically creating an API for the Javascript.

3.   /src/TeamBooking/Admin.php : 2085
    The 'insertPromotionCoupon' function creates the coupon. This is the function to tap into.

<?php

namespace TeamBooking\PaymentGateways\Stripe;
defined('ABSPATH') or die('No script kiddies please!');

/**
 * Class Gateway
 *
 * @author VonStroheim
 */
class Gateway implements \TeamBooking\PaymentGateways\Gateway
{
    private $api_key;
    private $token;
    private $currency;
    private $receipt_email;
    private $items = array();
    private $order = '';
    private $redirect;

    public function __construct()
    {
    }

    /**
     * @param $key
     */
    public function setApiKey($key)
    {
        $this->api_key = $key;
    }

    /**
     * @param $url
     */
    public function setRedirect($url)
    {
        $this->redirect = $url;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $code
     */
    public function setCurrency($code)
    {
        $this->currency = $code;
    }

    /**
     * @param string $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order = $order_id;
    }

    /**
     * @param string $email
     */
    public function setReceiptEmail($email)
    {
        $this->receipt_email = $email;
    }

    /**
     * @param string $name
     * @param        $unit_price
     * @param int    $quantity
     */
    public function addItem($name, $unit_price, $quantity = 1)
    {
        $this->items[] = array('name' => $name, 'amount' => $unit_price, 'quantity' => $quantity);
    }

    /**
     * @return string|\TeamBooking_Error
     */
    public function processPayment()
    {
        global $tbk_stripe_calling;

        $tbk_stripe_calling = TRUE;

        try {

            \Stripe\Stripe::setApiKey($this->api_key);

            $payment_intent_data = array(
                'metadata' => array(
                    'tbk_order_id' => $this->token // it can be the reservation ID or the order ID
                )
            );
            if (NULL !== $this->receipt_email) {
                $payment_intent_data['receipt_email'] = $this->receipt_email;
            }

            $description = '';
            if (!empty($this->order)) {
                $description = sprintf(esc_html__('Order %s', 'team-booking'), $this->order);
            } else {
                foreach ($this->items as $item) {
                    $description .= $item['name'] . ', ';
                }
            }

            $parameters = array(
                'name'        => $this->token,
                'amount'      => $this->generateAmount(),
                'currency'    => $this->currency,
                'description' => rtrim($description, ', '),
                'quantity'    => 1,
            );

            $session = \Stripe\Checkout\Session::create(array(
                'payment_method_types' => array('card'),
                'payment_intent_data'  => $payment_intent_data,
                'line_items'           => array(
                    $parameters
                ),
                'success_url'          => $this->redirect,
                'cancel_url'           => get_site_url(),
            ));

            return $session->id;

        } catch (\Stripe\Error\Card $e) {
            // The card has been declined
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user
            $body    = $e->getJsonBody();
            $code    = $body['error']['code'];
            $message = $body['error']['message'];
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $code    = $e->getCode();
            $message = $e->getMessage();
        }

        $error = new \TeamBooking_Error(60);
        $error->setExternalCode($code);
        $error->setMessage($message);

        return $error;
    }

    /**
     * @return mixed
     */
    public function generateAmount()
    {
        $zero_decimal_currencies = array(
            'BIF' => 'Burundian Franc',
            'CLP' => 'Chilean Peso',
            'DJF' => 'Djiboutian Franc',
            'GNF' => 'Guinean Franc',
            'JPY' => 'Japanese Yen',
            'KMF' => 'Comorian Franc',
            'KRW' => 'South Korean Won',
            'MGA' => 'Malagasy Ariary',
            'PYG' => 'Paraguayan Guaraní',
            'RWF' => 'Rwandan Franc',
            'VND' => 'Vietnamese Đồng',
            'VUV' => 'Vanuatu Vatu',
            'XAF' => 'Central African Cfa Franc',
            'XOF' => 'West African Cfa Franc',
            'XPF' => 'Cfp Franc',
        );

        $amount = 0;
        if (array_key_exists($this->currency, $zero_decimal_currencies)) {
            foreach ($this->items as $item) {
                $amount += $item['amount'] * $item['quantity'];
            }
        } else {
            foreach ($this->items as $item) {
                $amount += $item['amount'] * $item['quantity'] * 100;
            }
        }

        return $amount;
    }

}

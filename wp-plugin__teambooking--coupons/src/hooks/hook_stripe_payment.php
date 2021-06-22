<?php

/*
 * STRIPE Hook
 *
 * When the STRIPE Payment is completed, run create_coupon function.
 * This Hook is associated with the Stripe Payments Plugin (https://wordpress.org/plugins/stripe-payments/)
 * Action documentation is https://stripe-plugins.com/stripe-payments-plugin-action-hooks-reference/
 *
 * This plugin will do the action 'asp_stripe_payment_completed'
 * 
 * 
 * 
 */
add_action ('asp_stripe_payment_completed', 'create_coupon', 10, 2);

/*
 * Create Coupon Object
 *
 * This Coupon is created using the TeamBooking_Promotions_Coupon Object
 * See TeamBooking/src/Promotions/Coupon.php
 * 
 * This function will build up the correct object to be passed to TeamBooking.
 *
 */
function create_coupon($post_data, $charge) {

    $discount_type = 'percentage';                                           // 'percentage' or 'direct'
    $description = $post_data['item_name'];                                  // item_name   : "Gift Card 11" 
    $transaction_code = $post_data['txn_id'];                                // tsn_id      : ""ch_1FrMNLGtEGgLrOjagybIjibT"
    $email = $post_data['stripeEmail'];                                      // stripeEmail : "andy@londonparkour.com"
    
    $options_list = get_options_panel('coupons', $post_data['product_id']);  // Get coupon list

    $services_array = get_list_of_posts('tbk_service');                      // Get list of all teambooking services.

    // Create Coupon Code.
    $trans_id = substr(strtoupper($transaction_code), -6);                   // Last 6 digits of transaction code UPPERCASE.
    $name =  'LDNPK-'. $trans_id;                                            // ldnpk-ABCDEF or ldnpk-EFGHIJ
    $today = date('m/d/Y');
    $start_date = \DateTime::createFromFormat('m/d/Y|', $today);             // Today
    $one_year = date('m/d/Y', strtotime('+1 year'));
    $end_date = \DateTime::createFromFormat('m/d/Y|', $one_year);            // One year from now.


    //  ┌─────────────────────────────────────────────────────────────────────────┐ 
    //  │                                                                         │░
    //  │        WARNING! REQUIRES THE TEAMBOOKING PLUGIN TO CREATE OBJECT        │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░              
    if (!class_exists('TeamBooking_Promotions_Coupon'))   { return;  }       

    $new_coupon = new TeamBooking_Promotions_Coupon;                         // Create new TB Object

    $new_coupon->addServices($services_array);
    $new_coupon->setName($name);
    $new_coupon->setDiscount($options_list['discount']);
    $new_coupon->setLimit($options_list['limit']);
    $new_coupon->setDiscountType($discount_type);
    $new_coupon->setStartTime($start_date->getTimestamp());
    $new_coupon->setEndTime($end_date->getTimestamp());
    $new_coupon->setStartBound(null);
    $new_coupon->setEndBound(null);
    $new_coupon->setStatus(TRUE);

    // Generate Coupon ONLY if it is a gift card.
    $createCoupon = new TBGenerateCoupon($new_coupon); 

    return;
}

//  ┌─────────────────────────────────────────────────────────────────────────┐ 
//  │                                                                         │░
//  │             Creates array of post_name of type $posttype                │░
//  │                                                                         │░
//  └─────────────────────────────────────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
function get_list_of_posts($posttype){

    $services_array = []; 
    $service_query = new WP_Query(array('post_type' => $posttype));

    if ( $service_query->have_posts() ) {
        $posts = $service_query->posts;
        foreach($posts as $post) {
            array_push($services_array, $post->post_name);
        }
    }

    return $services_array;

}


//  ┌─────────────────────────────────────────────────────────────────────────┐ 
//  │                                                                         │░
//  │                      Get options from admin panel                       │░
//  │                      using name of repeater field                       │░
//  │                                                                         │░
//  └─────────────────────────────────────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░                                                                         
function get_options_panel($repeater_fieldname, $item_id){

    // defaults
    $result['limit'] = 1;
    $result['discount'] = 0;
    
    // Get values from admin panel
    $admin_options = new get_admin_options(); 
    $options_list = $admin_options->get_repeater_options($repeater_fieldname);

    // Go through all coupons.
    foreach($options_list as $coupon){
        
        // Check If the bought item is in the list of coupons, set values.
        if ($item_id == $coupon['stripe_product_id']){
            $result['limit']    = $coupon['coupon_class_limit'];
            $result['discount'] = $coupon['coupon_percentage'];
        }

    }

    return $result;

}
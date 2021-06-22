<?php

/*
 * Add Shortcode for coupon checker
 *
 * This allows us to output the coupon code onto the Thanks-you page.
 *
 * Uses the SESSION Variables passed to the page to build up the code.
 */
function output_coupon_checker(){

    $search = $_GET['coupon_code'];

    $form = '<form method="GET" class="coupon_checker">';
        $form .= '<input class="coupon_checker_input" type="text" id="coupon_code" name="coupon_code"></input><br/>';
        $form .= '<input class="coupon_checker_button" type="submit">';
    $form .= '</form>';

    global $wpdb;

    $table_name = $wpdb->prefix . 'teambooking_promotions';
    $results = $wpdb->get_results("SELECT id, data_object FROM wp_teambooking_promotions");

    foreach ($results as $result){

        $good_result = unserialize($result->data_object);
        $result_name = $good_result->getName();

        if ( $result_name == $search){
            echo '<div class="coupon_check_result">Remaining Uses = '. $good_result->getLimit() .'</div>' ;
            break;
        }
    }

    echo $form;

    return;

}

add_filter('init', 'add_coupon_checker');

function add_coupon_checker() {
    add_shortcode( 'coupon_checker', 'output_coupon_checker' );
}
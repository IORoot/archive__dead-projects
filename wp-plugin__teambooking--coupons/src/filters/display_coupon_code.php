<?php

/*
 * Run filter for coupon checker
 *
 * This allows us to output the coupon code onto the Thank-you page.
 */
function display_coupon_code($output, $aspData){

    if ($aspData){
        $trans_id = substr(strtoupper($aspData['txn_id']), -6);

        $coupon_style = "
        <style>
            .coupon_code {
                font-size: 76px;
                line-height: 87px;
                font-family: courier;
                text-align: center;
                background: #242424;
                color: #FAFAFA;
                padding: 29px;
                margin: 0px 0px 29px;
            }
        </style>";
    
        $coupon_output = '<div class="coupon_code">';
        $coupon_output .= 'LDNPK-'. $trans_id;
        $coupon_output .= '</div>';

        $output = $coupon_style.$coupon_output.$output;
    }

    return $output;

}

add_filter('asp_stripe_payments_checkout_page_result', 'display_coupon_code', 10, 2);
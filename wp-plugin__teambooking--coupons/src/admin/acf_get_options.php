<?php

class get_admin_options {

    //  ┌──────────────────────────────────────────────────────────┐
    //  │               Get Options from Admin Page                │
    //  └──────────────────────────────────────────────────────────┘
    
    public function get_repeater_options($fieldname){

        $result = []; 
        $options = []; 

        // If field exists as an option
        if( have_rows( $fieldname, 'option') ) {

            // Go through all rows of 'repeater'
            while( have_rows($fieldname, 'option') ): the_row();

                // Fields to retrieve from repeater
                $result = array ( 
                    'stripe_product_id'     => get_sub_field('stripe_product_id'),
                    'coupon_percentage'     => get_sub_field('coupon_discount_percentage'),
                    'coupon_code_prefix'    => get_sub_field('coupon_code_prefix'),
                    'coupon_class_limit'    => get_sub_field('coupon_class_limit'),        
                );
                
                // push onto result array.
                array_push($options, $result);
                
            endwhile;
        }

        return $options;

    }


}
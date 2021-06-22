<?php


/* ========================================================================================
 *
 * Run Revolution Slider with specific post id.
 *
 * Uses the ID of the series to show the graphics about that one.
 *
 * [revslider_purchase_series]
 *
 * @param   string  id              series ID must be supplied.
 * @return  object  [revslider]     Returns the output for Revolution Slider.
 *
 * ======================================================================================= */

function shortcode_purchase_series($attr = null){

    $args = shortcode_atts( array(
        'id' => null
    ), $attr );

    echo do_shortcode( '[rev_slider alias="purchase-series-header" settings="{\'posts_list\': \''. $args['id'] .'\'}"]' );

    return;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'revslider_purchase_series', 'shortcode_purchase_series' );
});



/* ========================================================================================
 *
 * 3. ADD DOCUMENTATION FOR SHORTCODE
 *
 * Add documentation for this shortcode to the custom shortcode admin page.
 *
 * @param cataegory
 * @param slug
 * @param code
 * @param description
 * @param inputs
 * @param outputs
 * @param filters
 * @param actions
 * @param example
 *
 * ======================================================================================== */

register_custom_shortcode_docs(
    array(
        'category'      => 'purchase',
        'slug'          => 'revslider_purchase_series',
        'code'          => '[revslider_purchase_series]',
        'description'   => 'Display the purchase series revolution slider with the correct graphics</br>
                            for the correct series being bought.',
        'inputs'        => 'id @int ID of specific series to display.',
        'outputs'       => '@string revslider',
    )
);


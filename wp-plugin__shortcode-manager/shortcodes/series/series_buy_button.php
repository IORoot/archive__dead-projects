<?php

/* ========================================================================================
 *
 * Return a BUY button  for the series using the Ultimate Visual Composer Shortcode.
 *
 * ======================================================================================= */
function shortcode_series_buy_button($attr = null){

    $buy_button = '
        [ult_buttons
            btn_title="Purchase Course"
            btn_link="url:http%3A%2F%2Fwww.movementdb.com%2Fpurchase-single-series%2F|||"
            btn_align="ubtn-center"
            btn_size="ubtn-block"
            btn_title_color="#ffffff"
            btn_bg_color="#f9be32"
            btn_hover="ubtn-center-dg-bg"
            btn_anim_effect="ulta-pulse"
            btn_bg_color_hover="#242424"
            btn_title_color_hover="#ffffff"
            icon="Defaults-shopping-cart"
            icon_size="32"
            icon_color="#ffffff"
            btn_icon_pos="ubtn-sep-icon-right-push"
            btn_font_size="desktop:24px;"
            btn_line_height="desktop:30px;"
            css_adv_btn=".vc_custom_1513070143026{margin-top: 0px !important;}"
        ]
    ';

    return $buy_button;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_buy_button', 'shortcode_series_buy_button' );
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
        'category'      => 'series',
        'slug'          => 'series_buy_button',
        'code'          => '[series_buy_button]',
        'description'   => 'Return a Ultimate Visual Composer shortcode Buy button.',
        'outputs'       => '@string Shortcode Advanced button',
        'example'       => '[series_buy_button]',
    )
);

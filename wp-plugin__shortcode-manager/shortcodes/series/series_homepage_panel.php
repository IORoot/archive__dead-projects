<?php

/* ========================================================================================
 *
 * Return a coloured panel
 *
 * Used on the homepage
 *
 * Location:    Home Page
 *
 * [series_episode_listbox]
 *
 * @param   string
 *
 * ======================================================================================= */
function shortcode_series_homepage_panel($attr = null){

    $panel = '
        <div class="mvdb-homepage-panel-back"></div>
        <div class="mvdb-homepage-panel-colour"></div>';

    return $panel;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_panel', 'shortcode_series_homepage_panel' );
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
        'slug'          => 'series_panel',
        'code'          => '[series_panel]',
        'description'   => 'Return a coloured panel',
        'outputs'       => '@string DIV boxes with specific classes.',
        'example'       => '[series_panel]',
    )
);

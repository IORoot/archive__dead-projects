<?php


/* ========================================================================================
 *
 * Run Essential Grid with Specific Post ID's
 *
 * Gets the series ID (Either as a supplied parameter or the current page ID)
 * and then checks the CPT-onomy for all the Posts in that particular series.
 *
 * Location: Series > Series Post > Bottom of Post Essential Grid.
 *
 * [series_essgrid_episodes]
 *
 * @param   string  series_id       Optional series ID can be supplied.
 * @return  object  [ess_grid]      Returns the output for series_episodes essential grid.
 *
 * ======================================================================================= */
function shortcode_series_essgrid_episodes($attr = null){

    global $cpt_onomy;

    // Optional Series_ID : Default is current post.
    $args = shortcode_atts( array(
        'series_id' => get_the_id(),
        'grid_alias' => "series_episodes_v2",
    ), $attr );

    $series = $cpt_onomy->get_objects_in_term( $args['series_id'], 'series' );

    if ($series[0] != null){
        echo do_shortcode( '[ess_grid alias="' . $args['grid_alias'] . '" posts='.implode(',', $series).']' );
    }

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
    add_shortcode( 'series_essgrid_episodes', 'shortcode_series_essgrid_episodes' );
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
        'slug'          => 'series_essgrid_episodes',
        'code'          => '[series_essgrid_episodes]',
        'description'   => 'Display an essential grid of all episodes in particular series',
        'inputs'        => '<ul><li>series_id @string ID of specific series to use.</li>
                                <li>grid_alias @string name of grid to use to display.</li></ul>',
        'outputs'       => '@string essential grid',
        'example'       => '[series_essgrid_episodes]',
    )
);
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

function shortcode_essgrid_all_series_episodes($attr = null){

    global $cpt_onomy;

    // Optional Series_ID : Default is current post.
    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'grid_alias' => "all_episodes_in_series",
    ), $attr );

    /* Find Series ID from Episode Post_id */
    $current_series = wp_get_object_terms( $args['id'], 'series' );
    $series = $cpt_onomy->get_objects_in_term( $current_series[0]->term_id, 'series' );

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
    add_shortcode( 'post_all_episodes_in_series', 'shortcode_essgrid_all_series_episodes' );
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
        'category'      => 'posts',
        'slug'          => 'mvdb_post_all_episodes_in_series',
        'code'          => '[post_all_episodes_in_series]',
        'description'   => 'Gets the series ID (Either as a supplied parameter or calculated from the current episode post ID)<br/>
                            and then checks the CPT-onomy for all the Posts in that particular series. (Getting all sibling posts of current one) <br/>
                            Will then output an essential grid (with default or specified alias name) with all of those posts.',

        'inputs'        => '<ul><li>@string optional Post_id.</li>
                            <li>@string optional grid_alias</li></ul>',
        'outputs'       => '@string Output a style tag.',
        'example'       => '[post_all_episodes_in_series]',
    )
);
<?php

/* ========================================================================================
 *
 * Return the number of sibling posts in current series
 *
 * This will look at the current post, determine it's series and return the count of
 * posts in that series.
 * Location:    Page > Post > Under Title
 *              Grid > MVDB Videos
 *
 * [post_series_count]
 *
 * @param   string  id          Optional Post ID to retrieve data from.
 * @return  int     count       Returns episodes count.
 *
 * ======================================================================================= */
function shortcode_video_series_count($attr){

    // Optional Post ID : Default is current post.
    $args = shortcode_atts( array(
        'id' => get_the_id()
    ), $attr );

    $series = get_the_terms($args['id'], 'series');

    return $series[0]->count;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */
add_filter('init', 'add_shortcode_video_series_count');

function add_shortcode_video_series_count() {
    add_shortcode( 'post_series_count', 'shortcode_video_series_count' );
}



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
        'slug'          => 'mvdb_post_series_count',
        'code'          => '[post_series_count]',
        'description'   => 'Return the number of sibling posts in current post.',
        'inputs'        => '@int Post ID of episode to get data from.',
        'outputs'       => '@int Output number of episodes in series that current post is part of.',
        'example'       => '[post_series_count id="2144"]',
    )
);
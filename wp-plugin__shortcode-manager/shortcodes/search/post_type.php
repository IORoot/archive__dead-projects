<?php


/* ========================================================================================
 *
 * Display a graph of video watching by user.
 * Uses chart.js to render graph.
 *
 * ======================================================================================= */
function shortcode_post_type(){
    get_post_type();
    return $post->post_type;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'post_type', 'shortcode_post_type' );
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
        'category'      => 'search',
        'slug'          => 'post_type',
        'code'          => '[post_type]',
        'description'   => 'Output the particular post type. Used on search.',
        'outputs'       => '@string the post type.',
        'example'       => '[post_type]',
    )
);
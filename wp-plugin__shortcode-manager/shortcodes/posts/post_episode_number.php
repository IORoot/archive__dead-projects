<?php


/* ========================================================================================
 *
 * Return the post duration ACF field
 *
 * Takes the current or supplied post and determines it's specified ACF field Duration. Returns a tring
 * Location:    Page > Post > Post duration
 *
 * [post_duration]
 *
 * @param   string  $id                 Optional Post ID
 *
 * ======================================================================================= */
function shortcode_post_episode_number($attr){

    $args = shortcode_atts( array(
        'id' => get_the_id()
    ), $attr );

    $post_episode_number = get_field('video_series_order_number', $args['id']);

    return $post_episode_number;
}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'post_episode_number', 'shortcode_post_episode_number' );
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
        'slug'          => 'mvdb_post_episode_number',
        'code'          => '[post_episode_number]',
        'description'   => 'Takes the current or supplied post and determines it\'s specified episode number.',
        'inputs'        => '@string Optional Post id.',
        'outputs'       => '@string Output text string of the current episode number.',
        'example'       => '[post_episode_number id="2144"]',
    )
);
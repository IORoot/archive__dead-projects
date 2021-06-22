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
function shortcode_post_duration($attr){

    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'class' => '',
        'prefix' => '',
    ), $attr );

    $post_duration = '<div class="'. $args['class'] .'"> ' . $args['prefix'] . get_field('video_duration', $args['id']) . '</div>';

    return $post_duration;
}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'post_duration', 'shortcode_post_duration' );
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
        'slug'          => 'mvdb_post_duration',
        'code'          => '[post_duration]',
        'description'   => 'Takes the current or supplied post and determines it\'s specified ACF field Duration text.',
        'inputs'        => '@string Optional Post id.',
        'outputs'       => '@string Output text string of duration.',
        'example'       => '[post_duration id="2144"]',
    )
);
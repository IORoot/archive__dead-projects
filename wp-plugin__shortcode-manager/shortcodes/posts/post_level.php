<?php


/* ========================================================================================
 *
 * Return the post skill level
 *
 * Takes the current or supplied post and determines it's specified skill level. Returns a
 * styled <div> with that level.
 * Location:    Page > Post > Post Level
 *              Grid > MVDB Videos
 *              Grid > MVDB Library Posts
 *
 * [post_level]
 *
 * @param   string  $id                 Optional Post ID
 * @return  string  $relatedvideos      Styled skill level.
 *
 * ======================================================================================= */
function shortcode_post_level($attr){

    $args = shortcode_atts( array(
        'id' => get_the_id()
    ), $attr );

    $post_level = get_the_terms( $args['id'], 'skill');

    $post_level_name = strtolower($post_level[0]->name);

    return '<div class="mvdb-post-level mvdb-post-level-' . $post_level_name . '">' . $post_level_name . '</div>';
}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'post_level', 'shortcode_post_level' );
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
        'slug'          => 'mvdb_post_level',
        'code'          => '[post_level]',
        'description'   => 'Takes the current or supplied post and determines it\'s specified skill level. Returns a styled <div> with that level.',
        'inputs'        => '@string Optional Post id.',
        'outputs'       => '@string Output styled skill level of post.',
        'example'       => '[post_level id="2144"]',
    )
);
<?php

/* ========================================================================================
 *
 * Return a tag list
 *
 * Wraps a div class around the tag list to be targeted.
 * Location:    Page > Post > Tag List
 *
 * [post_tag_list]
 *
 * @return  string  $taglist      Returns a wrapped taglist
 *
 * ======================================================================================= */
function shortcode_tag_list($attr){

    // Optional Post ID : Default is current post.
    $args = shortcode_atts( array(
        'id' => get_the_id()
    ), $attr );

    if(get_the_tag_list(null,null,null,$args['id'])) {
        return get_the_tag_list('<div class="entry-footer mvdb-tag-list">', '', '</div>', $args['id']);
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
add_filter('init', 'add_shortcode_tag_list');

function add_shortcode_tag_list() {
    add_shortcode( 'post_tag_list', 'shortcode_tag_list' );
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
        'slug'          => 'mvdb_post_tag_list',
        'code'          => '[post_tag_list]',
        'description'   => 'Wraps a div class around the tag list to be targeted. Returns a list of tags for the episode post.',
        'outputs'       => '@int Output formatted string of tags.',
        'example'       => '[post_tag_list id="2144"]',
    )
);
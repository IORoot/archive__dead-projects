<?php

/* ========================================================================================
 *
 * Output formatted current post title
 *
 * Using the post ACF Fields for custom background and font colours, add a CSS <style> tag
 * to alter the look of a specific post title.
 * Location:    Grid > MVDB Videos
 *
 * [post_coloured_title_by_id]
 *
 * @param   string  id          Optional Post ID to retrieve data from.
 * @return  string  $title      Returns the title and style.
 *
 * ======================================================================================= */
function shortcode_coloured_post_title_by_id($attr = null){

    // Optional Post ID : Default is current post.
    $args = shortcode_atts( array(
        'id' => get_the_id()
    ), $attr );

    $post_background_hex_colour = get_field('video_custom_background_colour', $args['id'], false);
    $post_font_hex_colour = get_field('video_custom_font_colour', $args['id'], false);

    $output = '
        <style>
            .mvdb-library-title-'.$args['id'].' {
                background-color:'.$post_background_hex_colour.';
                color:'. $post_font_hex_colour .';
            }
            .mvdb-library-title-'.$args['id'].':hover {
                color:'.$post_background_hex_colour.';
                background-color:'. $post_font_hex_colour .';
            }
            .mainul li#eg-2-post-id-'.$args['id'].':hover .mvdb-library-title {
                color:'.$post_background_hex_colour.';
                background-color:'. $post_font_hex_colour .';
            }
        </style>';

    $output .= '<div class="mvdb-library-title mvdb-library-title-'.$args['id'].'">';
    $output .= get_the_title($args['id']);
    $output .= '<span id="checkmark"></span>';
    $output .= '</div>';

    return $output;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */
add_filter('init', 'add_shortcode_coloured_post_title_by_id');

function add_shortcode_coloured_post_title_by_id() {
    add_shortcode( 'post_coloured_title_by_id', 'shortcode_coloured_post_title_by_id' );
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
        'slug'          => 'mvdb_post_coloured_title',
        'code'          => '[post_coloured_title_by_id]',
        'description'   => 'Displays the current posts title but coloured from ACF fields.',
        'inputs'        => '@int Post ID of post to get title of.',
        'outputs'       => '@string Output style tags and title.',
        'example'       => '[post_coloured_title_by_id id="2630"]',
    )
);
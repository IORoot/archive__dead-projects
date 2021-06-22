<?php

/* ========================================================================================
 *
 * Output formatted current post date
 *
 * Displays the post date with a <span> and prefix on it to allow it to have a target.
 * Location:    Page > Post > Post Date
 *
 * [post_date]
 *
 * @return  string  $date      Returns a formatted post date.
 *
 * ======================================================================================= */
function shortcode_post_date(){
    return '<span id="post_date">'. strtoupper('PUBLISHED ON '. esc_html( get_the_date() )) .'</span>';
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */
add_filter('init', 'add_shortcode_post_date');

function add_shortcode_post_date() {
    add_shortcode( 'post_date', 'shortcode_post_date' );
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
        'category'     => 'posts',
        'slug'         => 'mvdb_post_date',
        'code'         => '[post_date]',
        'description'  => 'Displays the current posts date of publishing.',
        'outputs'      => '@string',
        'example'      => '[post_date]',
    )
);
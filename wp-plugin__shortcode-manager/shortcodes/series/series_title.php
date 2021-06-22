<?php

/* ========================================================================================
 *
 * Return the Series title
 *
 * Used on the essential grid series listing at the bottom of each item.
 * Location:   Grid > MVDB Purchase Series
 *
 * [series_title]
 *
 * @param   string  $id             REQUIRED series ID
 * @param   string  $membership_id  Optional Membership ID
 *
 * @return  string  $title          Returns a styled DIV of the series Title
 *
 * ======================================================================================= */
function shortcode_series_title_by_id($attr = null){

    // Grab the post_id or use the current page.
    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'membership_id' => null,
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    return get_the_title($args['id']);
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_title', 'shortcode_series_title_by_id' );
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
        'slug'          => 'series_title',
        'code'          => '[series_title]',
        'description'   => 'Returns a string of the series title. Based on Series ID or Membership_ID',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                </ul>',
        'outputs'       => '@string Title of series.',
        'example'       => '[series_title id="1424"]',
    )
);

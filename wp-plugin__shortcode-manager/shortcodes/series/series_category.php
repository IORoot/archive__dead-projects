<?php

/* ========================================================================================
 *
 * Return the Series Category
 *
 * Used on the essential grid PURCHASE series listing at the bottom of each item.
 * Location:   Grid > MVDB Purchase Series
 *
 * [series_category]
 *
 * @param   string  $id             REQUIRED series ID
 * @param   string  $membership_id  Optional Membership ID
 *
 * @return  string  $title          Returns a series Category
 *
 * ======================================================================================= */
function shortcode_series_category_by_id($attr = null){

    // Grab the post_id or use the current page.
    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'membership_id' => null,
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    $category = wp_get_object_terms($args['id'], 'category');

    return $category[0]->name;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_category', 'shortcode_series_category_by_id' );
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
        'slug'          => 'series_category',
        'code'          => '[series_category]',
        'description'   => 'Returns a string of the series category. Based on Series ID or Membership_ID',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                </ul>',
        'outputs'       => '@string Category of series.',
        'example'       => '[series_category id="1424"]',
    )
);

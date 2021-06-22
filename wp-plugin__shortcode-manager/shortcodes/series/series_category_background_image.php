<?php

/* ========================================================================================
 *
 * Return the category 'word' image URL or <img> tag
 *
 * Used to look at the current series, determine which category it is a part of and grab
 * the associated 'word' image for that category.
 * Location:   Slider > Homepage slider
 *             Slider > Header - Series Page
 *
 * [series_category_background_image]
 *
 * @param   string  $id             Optional series ID can be supplied
 * @param   string  $class          Optional class to give returned image. Also determines
 *                                  if an image <img> tag is returned instead.
 *
 * @return  string  $image          Returns URL/<img> of the category 'word' image.
 *
 * ======================================================================================= */
function shortcode_series_category_background_image($attr = null){

    // Grab the post_id
    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'membership_id' => null,
        'class' => null
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    // Get the Category Term Object from current post.
    $category_term = wp_get_object_terms($args['id'], 'category');

    // Get the ACF 'category_image' from the category term object.
    $image = get_field('category_image', $category_term[0]);

    if ($args['class']){
        return '<img src="'.$image['url'].'" class="'.$image['class'].'">';
    } else {
        return $image['url'];
    }

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_category_background_image', 'shortcode_series_category_background_image' );
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
        'slug'          => 'series_category_background_image',
        'code'          => '[series_category_background_image]',
        'description'   => 'Returns the category image via the Series ID or Membership ID.',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                <li>class @string</li>
                                </ul>',
        'outputs'       => '@string IMG with a class.',
        'example'       => '[series_category_background_image]',
    )
);

<?php

/* ========================================================================================
 *
 * Return the ACF Subtitle Field
 *
 * Used to return the Subtitle of a series. Either use current series page or specify a
 * series ID.
 * Location:   Slider > Homepage slider
 *             Slider > Header - Series Page
 *
 * [series_subtitle]
 *
 * @param   string  $id             Optional series ID can be supplied
 *
 * @return  string  $subtitle       Returns the subtitle field.
 *
 * ======================================================================================= */
function shortcode_series_subtitle($attr = null)
{

    $args = shortcode_atts(array(
        'id' => get_the_id(),
        'membership_id' => null,
    ), $attr);

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    return get_field('series_subtitle', $args['id']);

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_subtitle', 'shortcode_series_subtitle' );
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
        'slug'          => 'series_subtitle',
        'code'          => '[series_subtitle]',
        'description'   => 'Returns a string of the series subtitle. Based on Series ID or Membership_ID',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                </ul>',
        'outputs'       => '@string Subtitle of series.',
        'example'       => '[series_subtitle id="1424"]',
    )
);

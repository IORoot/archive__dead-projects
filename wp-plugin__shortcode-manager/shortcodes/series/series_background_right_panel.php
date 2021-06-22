<?php



/* ========================================================================================
 *
 * Return the ACF Field 'Custom RIGHT Background Colour' HEX Value for Series.
 *
 * Used to retrieve the right panel colour (or CSS Override code) for a specific series.
 *
 * Location: Series > Series Post > Header Slider
 *
 * [series_background_right_panel_colour]
 *
 * @param   string  $id             Optional series ID can be supplied.
 * @param   string  $class          Optional class name for style tag.
 * @param   string  $return         Optional return value.
 *                                  Either 'style' to return a <style> tag, or
 *                                  'raw' to return the raw result.
 *
 * @return  string  $return_value   Returns a string of either a style or raw colour value.
 *
 * ======================================================================================= */
function shortcode_series_background_right_panel_colour($attr = null){


    $args = shortcode_atts( array(
        'id'    => get_the_id(),
        'membership_id' => null,
        'class' => '.mvdb-series-right-panel',
        'return' => 'style'
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    $background_hex = get_field('series_background_right_panel_colour', $args['id']);
    $background_css = get_field('series_background_right_panel_css_override', $args['id']);

    if ($args['return'] == 'style'){ $return_value = '<style>' . $args['class'] . '{ '; }

    $return_value .= ($background_css ?: ' background-color: '. $background_hex);

    if ($args['return'] == 'style'){ $return_value .= ' !important; } </style>'; }

    // If RAW output requested instead
    if ($args['return'] == 'raw') {
        $return_value .= ($background_css ?: $background_hex);
    }

    return $return_value;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_background_right_panel_colour', 'shortcode_series_background_right_panel_colour' );
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
        'slug'          => 'series_background_right_panel_colour',
        'code'          => '[series_background_right_panel_colour]',
        'description'   => 'Returns a style with a CSS selector set to the colour of the ACF background right panel.',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                <li>class @string</li>
                                </ul>',
        'outputs'       => '@string Return the colour of specified ACF colour',
        'example'       => '[series_background_right_panel_colour]',
    )
);

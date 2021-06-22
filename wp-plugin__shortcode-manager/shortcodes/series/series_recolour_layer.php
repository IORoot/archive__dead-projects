<?php


/* ========================================================================================
 *
 * Recolour Essential Grid Layer
 *
 * Used to recolour a layer with one of the series colours.
 *
 * Location:   Essential Grid - Purchase Series Page
 *
 * [series_recolour_layer]
 *
 * @param   string  $id             Optional series ID can be supplied
 *
 * @return  string  $subtitle       Returns the subtitle field.
 *
 * ======================================================================================= */
function shortcode_series_recolour_layer($attr = null)
{
    $args = shortcode_atts(array(
        'id'                => get_the_id(),
        'membership_id'     => null,
        'tag'               => '',
        'background_ref'    => null,
        'font_ref'          => 'series_slider_title_font_colour'
    ), $attr);

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    // Check the background ref for either colour reference (CSS Override or simple colour)
    if ($args['background_ref'] == null){
        // try all variations if nothing given.
        if (get_field('series_background_left_panel_colour', $args['id'], false)){
            $colour = 'background-color:' . get_field('series_background_left_panel_colour', $args['id'], false);
        } elseif (get_field('series_background_left_panel_css_override', $args['id'], false)) {
            $colour = get_field('series_background_left_panel_css_override', $args['id'], false);
        } elseif (get_field('series_background_right_panel_colour', $args['id'], false)) {
            $colour = 'background-color:' . get_field('series_background_right_panel_colour', $args['id'], false);
        } elseif (get_field('series_background_right_panel_css_override', $args['id'], false)) {
            $colour = get_field('series_background_right_panel_css_override', $args['id'], false);
        }
    } elseif ($args['background_ref'] == 'series_background_left_panel_css_override' || $args['background_ref'] == 'series_background_right_panel_css_override') {
        $colour = get_field($args['background_ref'], $args['id'], false);
    } else {
        $colour = 'background-color:' . get_field($args['background_ref'], $args['id'], false);
    }

    // Style tag
    $style_output = '<style>';
    $style_output .= $args['tag'] . '{';

    $style_output .= $colour . ' !important ;';
    $style_output .= 'color:'. get_field($args['font_ref'], $args['id'], false) . ' !important ;';

    $style_output .= '} ';

    $style_output .= '</style>';

    echo $style_output;

    return;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_recolour_layer', 'shortcode_series_recolour_layer' );
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
        'slug'          => 'series_recolour_layer',
        'code'          => '[series_recolour_layer]',
        'description'   => 'Used to recolour a layer with one of the series colours.',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                <li>tag @string</li>
                                <li>background_ref @string</li>
                                <li>font_ref @string</li>
                                </ul>',
        'outputs'       => '@string Stylesheet to recolour an essential grid layer.',
        'example'       => '[series_recolour_layer id="1424"]',
    )
);

<?php

/* ========================================================================================
 *
 * Return the Series title which has a styled background
 *
 * Used on the essential grid series listing at the bottom of each item. This will style
 * The title of each item based on it's left panel background CSS/HEX colour.
 * Location:   Grid > MVDB Series
 *
 * [series_styled_title]
 *
 * @param   string  $id             REQUIRED series ID
 *
 * @return  string  $title          Returns a styled DIV of the series Title
 *
 * ======================================================================================= */
function shortcode_coloured_series_title_by_id($attr = null){

    // Grab the post_id or use the current page.
    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'membership_id' => null,
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    $series_panel_colour = get_field('series_background_left_panel_colour', $args['id'], false);
    $series_panel_css = get_field('series_background_left_panel_css_override', $args['id'], false);
    $series_font_colour = get_field('series_slider_title_font_colour', $args['id'], false);

    if($series_panel_css != ""){
        $background = $series_panel_css;
    } else {
        $background = 'background-color:'. $series_panel_colour;
    }

    return '<div class="mvdb-series-listing-title" 
                 style="'.$background.'; 
                 color:'. $series_font_colour .';" >'
        .get_the_title($args['id']).
        '</div>';
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_styled_title', 'shortcode_coloured_series_title_by_id' );
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
        'slug'          => 'series_styled_title',
        'code'          => '[series_styled_title]',
        'description'   => 'Returns the title that is styled based on the Left Panel background colour.',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                </ul>',
        'outputs'       => '@string Styled Title',
        'example'       => '[series_styled_title]',
    )
);

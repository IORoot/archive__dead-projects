<?php

/* ========================================================================================
 *
 * Overrides the background colour of each series grid item
 *
 * This will recolour the background of each series grid list item with the series LEFT
 * HEX / CSS Value to make it unique. This is placed on the actual series page to override
 * the grid specified.
 * Location:   Page > Series Listing Page
 *
 * [series_item_backgrounds]
 *
 * @param   string  $id             Essential Grid ID of which item backgrounds to override.
 *
 * @return  string  $style          Style tag to override each item in the grid.
 *
 * ======================================================================================= */
function shortcode_recolour_series_item_backgrounds($attr = null){

    // Grab the post_id or use the default of 4 (which is the original series listing grid)
    $args = shortcode_atts( array(
        'id' => '4'
    ), $attr );

    $posts = get_posts([ 'post_type' => 'series', 'posts_per_page'=>-1, ]);

    $style_output = '<style>';
    foreach ($posts as $item){

        $series_panel_colour = get_field('series_background_left_panel_colour', $item->ID, false);
        $series_panel_css = get_field('series_background_left_panel_css_override', $item->ID, false);
        $series_font_colour = get_field('series_slider_title_font_colour', $item->ID, false);

        $style_output .= '#eg-'. $args['id'] .'-post-id-' . $item->ID . '{';

        $style_output .= 'background-color:' . $series_panel_colour . ';';
        if ($series_panel_css) {
            $style_output .= $series_panel_css . ';';
        }
        $style_output .= 'color: ' . $series_font_colour . ';';

        $style_output .= '} ';

    }
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
    add_shortcode( 'series_item_backgrounds', 'shortcode_recolour_series_item_backgrounds' );
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
        'slug'          => 'series_item_backgrounds',
        'code'          => '[series_item_backgrounds]',
        'description'   => 'Recolours the background of the Essential Grid series item. This is to the Left Panel colour.',
        'inputs'        => '<ul><li>id @string</li>
                                </ul>',
        'outputs'       => '@string Stylesheet.',
        'example'       => '[series_item_backgrounds]',
    )
);

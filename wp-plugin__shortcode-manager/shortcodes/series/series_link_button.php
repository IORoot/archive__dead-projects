<?php


/* ========================================================================================
 *
 * Return the button.
 *
 * ======================================================================================= */
function shortcode_series_coloured_link_button($attr = null){

    // Optional ID : Default is current post.
    $args = shortcode_atts( array(
        'id'                            => get_the_id(),
        'class'                         => 'series_link_button',
        'title'                         => 'Button',
        'icon'                          => 'fa-icon-chevron-right',
        'style'                         => null,
        'idle_background_colour_ref'    => 'series_background_right_panel_colour',
        'idle_font_colour_ref'          => 'category_glyph_colour',
        'hover_background_colour_ref'   => 'series_background_left_panel_colour',
        'hover_font_colour_ref'         => 'series_slider_title_font_colour',
        'url'                           => 'http://www.movementdb.com'
    ), $attr );


    if ($args['title'] == 'episode-count'){

        global $cpt_onomy;

        // Get the list of ALL episodes in series ( Drafts / Published / Deleted / etc )
        $series = $cpt_onomy->get_objects_in_term( $args['id'], 'series' );

        // Check for 'publish' status only.
        $published_list = array();
        foreach ($series as $episode){
            if ( get_post_status($episode) == 'publish') { array_push($published_list, $episode); }
        }

        $args['title'] = count( $published_list ) . ' Episodes';
    }

    // Get the glyph colour from the SERIES post meta using ID.
    // Override with different colour if set.
    $idle_background_colour     = get_field($args['idle_background_colour_ref'], $args['id']);
    $idle_font_colour           = get_field($args['idle_font_colour_ref'], $args['id']);
    $hover_background_colour    = get_field($args['hover_background_colour_ref'], $args['id']);
    $hover_font_colour          = get_field($args['hover_font_colour_ref'], $args['id']);

    if ($args['style'] != 'off'){
        $styled_button = '<style>';
        $styled_button .= '.' . $args['class'].'-'. $args['id'] . ' { background: '.$idle_background_colour.'; color: '.$idle_font_colour.'; }';
        $styled_button .= '.' . $args['class'].'-'. $args['id'] . ':hover { background: '.$hover_background_colour.'; color: '.$hover_font_colour.'; }';
        $styled_button .= '</style>';
    }
    $styled_button .= '<a   href="'.$args['url'].'"
                            class="'.$args['class'].' '. $args['class'] .'-'. $args['id'] .'">';
    $styled_button .= $args['title'] . ' <i class="fa '. $args['icon'] .'"></i>';
    $styled_button .= '</a>';

    return $styled_button;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_link_button', 'shortcode_series_coloured_link_button' );
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
        'slug'          => 'series_link_button',
        'code'          => '[series_link_button]',
        'description'   => 'Used to create a coloured button.',
        'inputs'        => '<ul><li>id @string</li>
                                <li>class @string</li>
                                <li>title @string</li>
                                <li>icon @string</li>
                                <li>style @string</li>
                                <li>idle_background_colour_ref @string</li>
                                <li>idle_font_colour_ref @string</li>
                                <li>hover_background_colour_ref @string</li>
                                <li>hover_font_colour_ref @string</li>
                                <li>url @string</li>
                                </ul>',
        'outputs'       => '@string a styled button for the series.',
        'example'       => '[series_link_button id="1424"]',
    )
);

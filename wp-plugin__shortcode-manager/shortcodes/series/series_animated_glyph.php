<?php


/* ========================================================================================
 *
 * Return the Glyph on the Series Grid Page.
 *
 * Used to retrieve the series glyph image and style it with an attached CSS Fill.
 *
 * Location:    Essential Grid Skin > MVDB Series
 *              Slider Revolution   > Header - Series Page
 *              Slider Revolution   > Homepage Slider
 *
 * [series_glyph]
 *
 * @param   string  $id             Optional series ID can be supplied.
 * @param   string  $membership_id  Optional Membership ID can be supplied to find the
 *                                  associated Series ID.
 * @param   string  $class          Optional class to give surrounding DIV. This will allow
 *                                  Targeting of specific glyph if multiple on the page.
 * @param   string  $tag            Optional CSS ID or CLASS to target CSS Style Code.
 * @param   string  $width          Optional Width dimension.
 * @param   string  $height         Optional Height dimension.
 * @param   string  $colour_field   Optional Colour Field to use from the ACF Fields on the
 *                                  Series post.  Uses the current Series ID to grab colour
 * @param   string  $colour         Optional Colour to override everything else.
 * @param   string  $animate        Optional ID of the slider to animate the SVG of.
 *
 * @return  string  $styled_svg     Returns the Glyph SVG and CSS Style code.
 *
 * ======================================================================================= */
function shortcode_series_glyph($attr = null){


    // Optional ID : Default is current post.
    $args = shortcode_atts( array(
        'id'            => get_the_id(),
        'membership_id' => null,
        'class'         => 'glyph',
        'tag'           => '.mvdb-category-glyph',
        'width'         => 'auto',
        'height'        => 'auto',
        'colour_field'  => 'category_glyph_colour',
        'colour'        => null,
        'animate'       => false,
    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['id'] = get_field('associated_series', $args['membership_id'])[0]; }

    // Get the current category for the series post.
    $category_term = wp_get_object_terms($args['id'], 'category');

    // Find the glyph image from the CATEGORY meta.
    $image = get_field('category_glyph_image', $category_term[0]);

    // Get the glyph colour from the SERIES post meta using ID.
    // Override with different colour if set.
    $glyph_colour = ($args['colour'] ?: get_field($args['colour_field'], $args['id']));

    $styled_svg = '<div class="'. $args['class'].'"><style> '. $args['tag'] .' .'. $args['class'].' > svg { 
                        fill:   '.  $glyph_colour  .';
                        width:  '.  $args['width']  .';
                        height: '.  $args['height']  .';
                   }
                   </style>';

    if ($args['colour_field']){

        $styled_svg .= "<style>";

        $styled_svg .=  ".active-revslide .". $args['class'] . " svg { fill-opacity: 0; }";
        $styled_svg .=  ".active-revslide .". $args['class'] . " svg {
                            fill-opacity: 0;
                            stroke: #000000;
                            stroke-width: 1;
                            stroke-dasharray: 1500px;
                            stroke-dashoffset: 1500px;
                            animation-name: draw, fillit;
                            animation-duration: 4s, 2s;
                            animation-delay: 0s, 2s;
                            animation-fill-mode: forwards;
                            animation-iteration-count: 1;
                            animation-timing-function: linear;
                        }";
        $styled_svg .=  "@keyframes draw { to { stroke-dashoffset: 0; } }";
        $styled_svg .=  "@keyframes fillit { to { fill-opacity: 1; stroke-opacity: 0; } }";

        $styled_svg .= "</style>";

    }

    /* For some reason the file_get_contents won't get the SVG from a NON-WWW domain? */
    $svg_www_url = str_replace('http://movementdb', 'http://www.movementdb', $image['url']);
    $styled_svg .= file_get_contents($svg_www_url);
    $styled_svg .= '</div>';

    return $styled_svg;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_glyph', 'shortcode_series_glyph' );
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
        'slug'          => 'series_glyph',
        'code'          => '[series_glyph]',
        'description'   => 'Display an essential grid of all episodes in particular series',
        'inputs'        => '<ul><li>id @string</li>
                                <li>membership_id @string</li>
                                <li>class @string</li>
                                <li>tag @string</li>
                                <li>width @string</li>
                                <li>height @string</li>
                                <li>colour_field @string</li>
                                <li>colour @string</li>
                                <li>animate @string</li></ul>',
        'outputs'       => '@string SVG Animated Glyph',
        'example'       => '[series_glyph]',
    )
);

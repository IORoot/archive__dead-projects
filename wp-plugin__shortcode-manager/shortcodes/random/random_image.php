<?php

// Extra help here:
// https://www.wp-hasty.com/

// 1. Random Image For Login Page
// =============================================================================

function shortcode_random_image($attributes){

    $args = shortcode_atts(array(
        'width' => 'width',
        'height' => 'height'
    ), $attributes);

    // List of Image ID's to possibly choose from.
    $image_list = array(1412,1413,1414,1415);

    // Random Image number.
    $image_pick = $image_list[array_rand($image_list)];

    // Size
    if (! $attributes){
        $size = 'original';
    } else {
        $size = array((int) $args['width'],(int) $args['height']);
    }

    // Get Image.
    return wp_get_attachment_image($image_pick, $size, false);

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'random_image', 'shortcode_random_image' );
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
        'category'      => 'random',
        'slug'          => 'random_image',
        'code'          => '[random_image]',
        'description'   => 'Display random image from array list.',
        'inputs'        => '<ul><li>width @string width of image.</li>
                                <li>height @string height of image.</li></ul>',
        'outputs'       => '@string string image',
        'example'       => '[random_image]',
    )
);
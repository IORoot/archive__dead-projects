<?php


// 1. Random Image SRC For Slider revolution
// =============================================================================
function shortcode_random_image_src($attributes){

    $args = shortcode_atts(array(
        'width' => 100,
        'height' => 100
    ), $attributes);

    // List of Image ID's to possibly choose from.
    $image_list = array(756,13,539);

    // Random Image number.
    $image_pick = $image_list[array_rand($image_list)];

    // Get Image.
    $image_src = wp_get_attachment_image_src($image_pick, array((int) $args['width'],(int) $args['height']), false);

    return $image_src[0];
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'random_image_src', 'shortcode_random_image_src' );
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
        'slug'          => 'random_image_src',
        'code'          => '[random_image_src]',
        'description'   => 'Display random image SRC from array list.',
        'inputs'        => '<ul><li>width @string width of image.</li>
                                <li>height @string height of image.</li></ul>',
        'outputs'       => '@string string image',
        'example'       => '[random_image_src]',
    )
);
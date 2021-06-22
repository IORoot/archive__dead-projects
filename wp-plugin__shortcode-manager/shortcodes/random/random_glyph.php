<?php


// 1. Random glyph image
// =============================================================================

function shortcode_random_glyph(){

    // List of Image ID's to possibly choose from.
    $glyph_list = array(618,619,620,621,622,623,624,625,626,627,628,629);

    // Random Image number.
    $glyph_pick = $glyph_list[array_rand($glyph_list)];

    // Get Image.
    $glyph_src = wp_get_attachment_image_src($glyph_pick, 'original', false, $attr);

    $glyph = file_get_contents($glyph_src[0]);
    return $glyph;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'random_glyph', 'shortcode_random_glyph' );
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
        'slug'          => 'random_glyph',
        'code'          => '[random_glyph]',
        'description'   => 'Display random glyph from array list.',
        'outputs'       => '@string random SVG image of glyphs',
        'example'       => '[random_glyph]',
    )
);
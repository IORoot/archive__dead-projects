<?php


// 1. Random Category Image For Login Page
// =============================================================================

function shortcode_random_category(){

    // List of Image ID's to possibly choose from.
    $image_list = array(587,586,585,584,583,582,581,580,579,578,577,576);

    // Random Image number.
    $image_pick = $image_list[array_rand($image_list)];

    // Image Attr
    $attr = array(
        'class' => 'mvdb-login-category'
    );
    // Get Image.
    return wp_get_attachment_image($image_pick, 'original', false, $attr);
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'random_category', 'shortcode_random_category' );
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
        'slug'          => 'random_category',
        'code'          => '[random_category]',
        'description'   => 'Display random category image (the large word of the category - Vaulting, Jumping, etc...)</br>
                            from array list.',
        'outputs'       => '@string random category',
        'example'       => '[random_category]',
    )
);
<?php


// 2. Random Gradient
// =============================================================================

function shortcode_random_gradient($tag){

    // Grab the post_id
    extract(shortcode_atts(array(
        'tag' => 'tag'
    ), $tag));

    // List of GRADIENTS
    $gradient_list = array(
        'background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%)',
        'background-image: linear-gradient(90deg, #FEE140 0%, #FA709A 100%)',
        'background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%)',
        'background-image: linear-gradient(0deg, #08AEEA 0%, #2AF598 100%)',
        'background-image: linear-gradient(90deg, #FEE140 0%, #FA709A 100%)',
        'background-image: linear-gradient(90deg, #00DBDE 0%, #FC00FF 100%)',
        'background-image: linear-gradient(132deg, #F4D03F 0%, #16A085 100%)',
        'background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%)',
        'background-image: linear-gradient(270deg, #FAD961 0%, #F76B1C 100%)',
        'background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%)',
        'background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%)',
        'background-image: linear-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%)'
    );

    // Random Gradient number.
    $gradient_pick = $gradient_list[array_rand($gradient_list)];

    // Get Gradient.
    if ($tag){
        $style = '<style> '. $tag .' {' . $gradient_pick . '!important; }</style>';
    } else {
        $style = $gradient_pick;
    }

    return $style;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'random_gradient', 'shortcode_random_gradient' );
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
        'slug'          => 'random_gradient',
        'code'          => '[random_gradient]',
        'description'   => 'Display random gradient style tag to apply to a particular CSS selector.',
        'inputs'        => 'tag @string of which CSS selector to apply style to.',
        'outputs'       => '@string style',
        'example'       => '[random_gradient tag=".this-selector"]',
    )
);
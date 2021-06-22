<?php


/* ========================================================================================
 *
 * Uses the MyCred function as a shortcode to show total number of user points.
 *
 * ======================================================================================= */
function profile_point_count(){
    return user_total_points();
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'profile-point-count', 'profile_point_count' );
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
        'category'      => 'charts',
        'slug'          => 'profile_point_count',
        'code'          => '[profile-point-count]',
        'description'   => 'Show total number of MyCred points for current user.',
        'outputs'       => '@int number of points.',
        'example'       => '[profile-point-count]',
    )
);
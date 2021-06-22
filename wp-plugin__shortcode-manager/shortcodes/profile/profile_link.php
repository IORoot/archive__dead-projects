<?php


/* ========================================================================================
 *
 * Display current user name and make it link to their buddypress profile page.
 *
 * ======================================================================================= */
function mvdb_profile_link(){

    $user = wp_get_current_user();

    if($user){

        if (strpos($user->display_name, '@')) {
            $user->display_name = strstr($user->display_name, '@', true);
        }

        $link = 'http://movementdb.com/members/' . $user->display_name;
        return $link ;
    }

    return 'http://movementdb.com/';

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'profile-link', 'mvdb_profile_link' );
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
        'category'      => 'profile',
        'slug'          => 'profile_link',
        'code'          => '[profile-link]',
        'description'   => 'Display the current username and link it to the buddypress profile page.',
        'outputs'       => '@string name with link',
        'example'       => '[profile-link]',
    )
);
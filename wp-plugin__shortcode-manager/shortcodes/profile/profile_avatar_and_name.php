<?php


/* ========================================================================================
 *
 * Display an avatar AND Name.
 *
 * ======================================================================================= */
function mvdb_profile_link_label(){

    $user = wp_get_current_user();

    if($user){

        if (strpos($user->display_name, '@')) {
            $user->display_name = strstr($user->display_name, '@', true);
        }

        $link = '<div class="mvdb-menu-profile">';
        $link .= '<img class="mvdb-menu-avatar" src="' . esc_url( get_avatar_url( $user->ID ) ) . '" /> ';
        $link .= '<span class="mvdb-menu-name">' . $user->display_name . '</span>';
        $link .= '</div>';
        return $link ;
    }

    return '<i class="ubermenu-icon fa fa-user-circle"></i>Profile';

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'profile-link-label', 'mvdb_profile_link_label' );
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
        'slug'          => 'profile_link_label',
        'code'          => '[profile-link-label]',
        'description'   => 'Display the current user avatar and username without a link.</br>
                            Used on profile page.',
        'outputs'       => '@string image and username',
        'example'       => '[profile-link-label]',
    )
);
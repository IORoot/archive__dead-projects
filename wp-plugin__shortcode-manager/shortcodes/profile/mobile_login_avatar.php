<?php


/* ========================================================================================
 *
 * Used in Mobile touchy menu. Avatar link label.
 *
 * ======================================================================================= */
function mvdb_mobile_avatar_login(){

    $user = wp_get_current_user();

    //var_dump($user);

    if($user->ID != ''){

        if (strpos($user->display_name, '@')) {
            $user->display_name = strstr($user->display_name, '@', true);
        }
        $link_url = 'http://movementdb.com/members/' . $user->display_name;

        $link = '<a class="touchy-email-button" href="'.$link_url.'">';
        $link .= '<span class="touchy-avatar-link">';
        $link .= '<img class="mvdb-touchy-avatar" src="' . esc_url( get_avatar_url( $user->ID ) ) . '" /> ';
        $link .= '</span>';
        $link .= '<span class="mvdb-touchy-avatar-name">' . $user->display_name . '</span>';
        $link .= '</a>';

        echo $link;

        return;

    } else {
        $link = '<a class="touchy-email-button" href="http://www.movementdb.com/login">';
        $link .= '<span class="touchy-avatar-link">';
        $link .= '<i class="touchy-icon fa fa-user-circle"></i>';
        $link .= '</span>';
        $link .= '<span class="mvdb-touchy-avatar-name">Login</span>';
        $link .= '</a>';

        echo $link;
    }

    return;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'mobile-login-avatar', 'mvdb_mobile_avatar_login' );
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
        'slug'          => 'mobile_login_avatar',
        'code'          => '[mobile-login-avatar]',
        'description'   => 'Display the current user avatar on the mobile menu.',
        'outputs'       => '@string Avatar image with link',
        'example'       => '[mobile-login-avatar]',
    )
);
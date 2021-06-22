<?php

// BUDDYPRESS REFERENCE - http://hookr.io/plugins/buddypress/#index=a

/* Change the subnav items of 'change avatar page'. */
function add_settings_subnav_tab() {
    global $bp;
    // rename general settings tab
    $bp->bp_options_nav['settings']['general']['name'] = 'Reset Password';

    //var_dump($bp->bp_nav['profile']);

    //unset($bp->bp_nav['profile']);
    // remove profile menu subnav tabs
    //bp_core_remove_subnav_item( 'profile', 'edit' );
    bp_core_remove_subnav_item( 'profile', 'change-avatar' );
    bp_core_remove_subnav_item( 'profile', 'profile' );

    //remove settings subnav tabs
    bp_core_remove_subnav_item( 'settings', 'profile' );

    // add 'Change profile picture' sub-menu tab
//    bp_core_new_subnav_item( array(
//            'name' => 'Change Profile Picture',
//            'slug' => 'change-profile-picture',
//            'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['settings']['slug'] . '/',
//            'parent_slug' => $bp->bp_nav['settings']['slug'],
//            'screen_function' => 'change_profile_picture',
//            'position' => 30
//        )
//    );
}


/* Function to change the Avatar. */
//function change_profile_picture(){
//    add_action( 'bp_template_content', 'change_profile_picture_screen_content' );
//    xprofile_screen_change_avatar();
//}
//
//
//
//add_filter('xprofile_template_change_avatar', 'filter_changeavatar_template');
//function filter_changeavatar_template($template){
//    return 'members/single/plugins';
//}
//
//
//function change_profile_picture_screen_content() {
//    bp_get_template_part( 'members/single/profile/change-avatar' );
//}

//add_action( 'bp_setup_nav', 'add_settings_subnav_tab', 100 );
/* ------------------------------- */


/* Change the resolution of the uploaded Avatar image. */
//define( 'BP_AVATAR_FULL_WIDTH', 200 );
//define( 'BP_AVATAR_FULL_HEIGHT', 200 );


/* Remove the 'edit profile' button registered by x-theme on the profile page.    */
/* (See registered X-Theme actions in x/framework/global/plugins/buddypress.php)  */
function x_buddypress_current_member_item_buttons(){}
remove_action( 'bp_member_header_actions', 'x_buddypress_current_member_item_buttons' );
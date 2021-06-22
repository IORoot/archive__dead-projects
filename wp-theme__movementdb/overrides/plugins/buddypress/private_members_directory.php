<?php
// List of Buddypress functions here:
// https://buddypress.wp-a2z.org/oik_letters/b/page/25/?post_type=oik_api


/* Redirect Members Directory Page */
function buddydev_hide_members_directory_from_all() {

    if ( bp_is_members_directory() ) {
        bp_core_redirect( site_url('/') );
    }
}
add_action( 'bp_template_redirect', 'buddydev_hide_members_directory_from_all' );


/* Redirect Profile Pages */
function buddydev_hide_members_profile() {

    // If page is a profile page & is NOT MY Profile page...
    if (bp_is_user_profile() && !bp_is_my_profile()){
        bp_core_redirect( site_url('/') );
    }

}
add_action( 'bp_template_redirect', 'buddydev_hide_members_profile' );
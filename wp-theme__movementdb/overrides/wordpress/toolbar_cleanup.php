<?php

add_action( 'admin_bar_menu', 'remove_wp_toolbar_items', 9999 );

function remove_wp_toolbar_items( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
    $wp_admin_bar->remove_node( 'customize' );
    $wp_admin_bar->remove_node( 'comments' );
    $wp_admin_bar->remove_node( 'new-content' );
    $wp_admin_bar->remove_node( 'ubermenu' );
    $wp_admin_bar->remove_node( 'cs-main' );
    $wp_admin_bar->remove_node( 'vc_inline-admin-bar-link' );
    $wp_admin_bar->remove_node( 'new_draft' );
    $wp_admin_bar->remove_node( 'search' );
    $wp_admin_bar->remove_node( 'my-account' );
}
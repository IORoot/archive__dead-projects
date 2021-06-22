<?php

// Custom Search Navigation Icon
// =============================================================================
function x_navbar_search_navigation_item( $items, $args ) {

    if ( x_get_option( 'x_header_search_enable' ) == '1' ) {
        if ( $args->theme_location == 'primary' ) {

            if ( ! class_exists( 'UberMenu' ) ) {

                $items .= '<li class="menu-item x-menu-item x-menu-item-search">'
                    . '<a href="#" class="x-btn-navbar-search">'
                    . '<span><i class="x-icon-search" data-x-icon="" aria-hidden="true"></i><span class="x-hidden-desktop"> ' . __( 'Search', '__x__' ) . '</span></span>'
                    . '</a>'
                    . '</li>';
            } else {
                $items .= '<li class="ubermenu-item ubermenu-item-level-0 x-menu-item x-menu-item-search">'
                    . '<a href="#" class="ubermenu-target x-btn-navbar-search">'
                    . '<span><i class="x-icon-search" data-x-icon="" aria-hidden="true"></i><span class="x-hidden-desktop"> ' . __( 'Search', '__x__' ) . '</span></span>'
                    . '</a>'
                    . '</li>';
            }

        }
    }

    return $items;

}
add_filter( 'wp_nav_menu_items', 'x_navbar_search_navigation_item', 9998, 2 );
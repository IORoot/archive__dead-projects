<?php

// Custom Search Navigation Icon
// =============================================================================
function x_navbar_membership_navigation_item( $items, $args ) {

    if (! is_user_logged_in()) {
        if ($args->theme_location == 'primary') {

            if (!class_exists('UberMenu')) {
                $new_items .= '<li class="menu-item x-menu-item ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-872 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto">'
                    . '<a href="/register/paid-membership/" class="x-btn-navbar ubermenu-item-layout-icon_left">'
                    . '<i class="fa fa-certificate" data-x-icon="" aria-hidden="true"></i><span class="ubermenu-target-title ubermenu-target-text">Membership</span>'
                    . '</a>'
                    . '</li>';
            } else {
                $new_items .= '<li class="menu-item x-menu-item ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-872 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto">'
                    . '<a href="/register/paid-membership/" class="ubermenu-target ubermenu-item-layout-icon_left">'
                    . '<i class="fa fa-certificate" data-x-icon="" aria-hidden="true"></i><span class="ubermenu-target-title ubermenu-target-text">Membership</span>'
                    . '</a>'
                    . '</li>';
            }

            $items = $new_items . $items;
        }
    }

    return $items;

}
// add_filter( 'wp_nav_menu_items', 'x_navbar_membership_navigation_item', 9998, 2 );
<?php

/*
 * 1. Essential Grid
 * 2. Revolution Slider
 * 3. Page Builder / Visual Composer
 * 4. Buddypress
 * 5. ACF (Advanced Custom Fields)
 * 6. Ubermenu
 * 7. MyCred
 */

// Essential Grid
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/add_custom_animations.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/change_grid_params.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/change_skins.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/stop_caching_grids.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/post_series_backgrounds.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/post_series_listing.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/post_highlight_current_video.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/free_pro_dropdown_text.php";
    include get_stylesheet_directory() . "/overrides/plugins/essential_grid/_set_series_essgrid_field.php";

// Revolution Slider
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/revslider/_dynamic_styles.php";


// WPbakery Visual Composer (Page Builder)
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/visual_composer/memberpress_shortcode_wrapper.php";
    include get_stylesheet_directory() . "/overrides/plugins/visual_composer/mycred_video_element.php";
    include get_stylesheet_directory() . "/overrides/plugins/visual_composer/admin_clearpage_control.php";


// WPbakery Visual Composer (Easy Tables)
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/easy_tables/mvdb_custom_theme.php";


// Buddypress
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/buddypress/buddypress_functions.php";
    include get_stylesheet_directory() . "/overrides/plugins/buddypress/add_child_theme_directory.php";
    include get_stylesheet_directory() . "/overrides/plugins/buddypress/private_members_directory.php";


// ACF
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/acf/custom_colour_palette.php";


// Ubermenu
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/ubermenu/_ubermenu_search.php";
    include get_stylesheet_directory() . "/overrides/plugins/ubermenu/_ubermenu_membership.php";


// MyCred
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/mycred/developer_mode.php";
    include get_stylesheet_directory() . "/overrides/plugins/mycred/buddypress_profile_badges.php";
    include get_stylesheet_directory() . "/overrides/plugins/mycred/_mycred_postid_log_column.php";


// Memberpress
// =============================================================================
    include get_stylesheet_directory() . "/overrides/plugins/memberpress/add_child_theme_directory_path.php";
    include get_stylesheet_directory() . "/overrides/plugins/memberpress/add_underscore_shortcodes.php";
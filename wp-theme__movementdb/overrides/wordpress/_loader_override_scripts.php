<?php

/*
 * These scripts will override the base functionality of wordpress.
 */

// Add new Taxonomy
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/add_skill_taxonomy.php";

// Add new Taxonomy
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/add_topic_taxonomy.php";

//  Add new Post Types Meta Boxes
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/register_series_meta_boxes.php";

//  Only search by Title
// =================================================================================
include get_stylesheet_directory() . "/overrides/wordpress/search_by_title_only.php";

// Add SVG MIME Type uploading
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/add_svg_upload.php";

// Add Google Tag Manager into HEAD
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/add_tagmanager_in_head.php";

// Increase archive results count number.
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/search_archive_results_count.php";

// Javascript Upload Button for Avatar
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/js_avatar_upload_button.php";

// Javascript Upload Button for Avatar
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/add_editor_styles.php";

// Clean up the Admin toolbar
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/toolbar_cleanup.php";

// Remove Comments
// =============================================================================
include get_stylesheet_directory() . "/overrides/wordpress/remove_comments.php";
<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// 1. Custom CSS Styles
// 2. Wordpress core override_scripts.
// 3. Custom Shortcodes
// 4. 3rd Party Plugin Overrides
// 5. Sandpit
// 6. Plugin Override directory list.
// =============================================================================


// 1. Enqueue the child theme stylesheet
    include get_stylesheet_directory() . "/styles/_loader_styles.php";

// 2. Load all override scripts for core wordpress.
    include get_stylesheet_directory() . "/overrides/wordpress/_loader_override_scripts.php";

// 3. Load all custom shortcodes.
    // All Custom Shortcodes have now been put into a custom plugin :
    // plugins/ps-movementdb-shortcodes/shortcodes

// 4. Load all 3rd party plugin overrides.
    include get_stylesheet_directory() . "/overrides/plugins/_loader_override_plugins.php";

// 5. Load sandpit
    include get_stylesheet_directory() . "/overrides/sandpit.php";

// 6. Directories that allow child folder overrides.
    /*
     * 1. /framework
     *      Child files of the X-Theme framework. Includes changes to:
     *      - Search & Archive Pages
     *      - headers / footers
     *      - series / video / search template files.
     */


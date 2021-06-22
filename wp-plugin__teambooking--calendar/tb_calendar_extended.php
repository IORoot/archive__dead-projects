<?php
/*
Plugin Name: _ANDYP - Team Booking - Custom 'Calendar' shortcode
Plugin URI: https://londonparkour.com
Description: <strong>🔌PLUGIN</strong> | <em>Teambooking</em> | Custom TeamBooking Calendar - ANDYP - MAKE SURE YOU RUN THE ./create_tb_links.sh script!!!
Version: 1.0.1
Author: Andy Pearson
Author URI: https://londonparkour.com
*/

/* CHECK 1 - TeamBooking Dependency
 *
 * IMPORTANT!!!
 * 
 * Please make the following symbolic links to override standard files.
 * run the ./create_tb_links.sh script to create them.
 * 
 * Ensure that the TeamBooking Plugin is running and activated too.
*/

// ACF Dashboard
include "acf/acf_admin_page.php";

// Create some hooks to use.
include "hooks/schema_hooks.php";

// CUSTOM 2 - New Calendar Shortcode.
include "shortcodes/calendar_extended/Calendar_extended.php";
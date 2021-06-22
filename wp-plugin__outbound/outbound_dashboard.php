<?php
/*
Plugin Name: _ANDYP - Outbound dashboard
Plugin URI: http://londonparkour.com
Description: Posting / Reminders to various media API's
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

// Composer Autoloader -  mgp25 - Instagram API 
require __DIR__.'/vendor/autoload.php';

// Admin Page
require_once __DIR__.'/src/admin/acf_admin_page.php';

// Custom Post Type
require_once __DIR__.'/src/cpt/cpt.php';

// Post to APIs
require_once __DIR__.'/src/post_to_apis.php';

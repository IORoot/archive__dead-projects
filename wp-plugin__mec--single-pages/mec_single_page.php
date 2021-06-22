<?php
/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - MEC - Single Page Alterations
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🔪 MODIFICATION</strong> | <em>Single Events Page</em> | Changes order of widgets, adds payment modal. Note, this is SYMLINKED!
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

define( 'ANDYP_MEC_SINGLE_PAGE_PATH', plugins_url( '/', __FILE__ ) );
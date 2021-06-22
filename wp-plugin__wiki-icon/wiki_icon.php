<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Menus - Wiki Icon & Position
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🎛PANEL</strong> | <em>Post Edit page.</em> | Adds a 'wiki' icon entry box in the sidemenu.
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The ACF                                    │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/acf_panel.php'; 
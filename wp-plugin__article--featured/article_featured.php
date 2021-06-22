<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Articles - Featured & Post View Count
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🎛PANEL</strong> | <em>Article > edit page.</em> | Adds a 'Featured' button and View Count for articles.
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
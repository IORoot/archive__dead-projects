<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Articles - Category Image
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🎛PANEL</strong> | <em>Article Category > edit page.</em> | Allow you to associate an image with an article category.
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
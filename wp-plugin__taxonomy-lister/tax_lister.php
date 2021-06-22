<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Tax Lister
 * Plugin URI:        http://londonparkour.com
 * Description:       Creates a table with all categories listed
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              Enqueue                                    │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/inc/enqueue_scripts.php'; 

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                            The Shortcode                                │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/shortcodes/tax_lister_shortcode.php';
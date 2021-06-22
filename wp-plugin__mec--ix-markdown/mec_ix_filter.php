<?php
/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - MEC - Filter the GCal imported contents for Markdown / HTML
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🔪 MODIFICATION</strong> | <em>Single Events Page</em> | Adds a filter 'andyp_ix_description' before the content is saved. Note, this is SYMLINKED!
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';


// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                          MarkDown Filter                                │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/filter/andyp_ix_description.php';
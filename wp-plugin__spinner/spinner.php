<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Pulse - Load Spinner - Shortcode
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🩳SHORTCODE</strong> | <em>Shortcode [andyp_spinner]</em> | Creates the preloading screen that will disappear once pagehas loaded. Used on pulse.
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
//  │                            The Shortcodes                               │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/shortcodes/spinner.php';
<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Pulse - Angled Scroll - Shortcode
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🩳SHORTCODE</strong> | <em>Shortcode [andyp_pulse_angledscroll] </em> | Creates an angledscroll slideshow of posts
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */
define( 'ANDYP_PULSE_ANGLEDSCROLL_PATH', plugins_url( '/', __FILE__ ) );


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                              The Classes                                │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/classes/class.angledscroll.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                            The Shortcodes                               │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/shortcodes/angledscroll.php';
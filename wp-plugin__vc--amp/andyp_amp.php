<?php


/*
Plugin Name: _ANDYP - AMP - WPBakery Components
Plugin URI: http://londonparkour.com
Description: <strong>🔌WPBAKERY</strong> | AMP components: AMP-Image, AMP-Link, AMP-Shortcodes
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

// Example from https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/assets/


define( 'ANDYP_AMP_URL',  plugins_url( '/', __FILE__ ) );
define( 'ANDYP_AMP_PATH', plugin_dir_path( '/', __FILE__ ) );



// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                                init                                     │
//  └─────────────────────────────────────────────────────────────────────────┘
// Finally initialize code
new ANDYP_VC_AMP();


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';
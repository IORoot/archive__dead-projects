<?php
/*
Plugin Name: _ANDYP - Atomic : InfoPanel Apple
Plugin URI: http://londonparkour.com
Description: <em>ANDYP > Atomic Design</em>
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

define( 'ANDYP_WEBCOMPONENT_INFOPANEL_PATH', __DIR__ );
define( 'ANDYP_WEBCOMPONENT_INFOPANEL_URL', plugins_url( '/', __FILE__ ) );

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                        	   Initialise    		                     │
// └─────────────────────────────────────────────────────────────────────────┘
new andyp\webcomponent_infopanel\initialise;
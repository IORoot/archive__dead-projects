<?php
/*
Plugin Name: _ANDYP - Atomic : Style Guide / Pattern Library
Plugin URI: http://londonparkour.com
Description: <em>ANDYP > Atomic Design</em>
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

define( 'ANDYP_ATOMIC_STYLEGUIDE_PATH', __DIR__ );
define( 'ANDYP_ATOMIC_STYLEGUIDE_URL', plugins_url( '/', __FILE__ ) );

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
new andyp\atomic_styleguide\blocks\register_blocks;

<?php
/*
Plugin Name: _ANDYP - Atomic : Hero Anime.js
Plugin URI: http://londonparkour.com
Description: <strong>🩳SHORTCODE</strong> | <em>ANDYP > Component : Hero </em> | [andyp-hero]
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

define( 'ANDYP_WEBCOMPONENT_HERO_PATH', __DIR__ );
define( 'ANDYP_WEBCOMPONENT_HERO_URL', plugins_url( '/', __FILE__ ) );

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
new andyp\webcomponent_hero\initialise;

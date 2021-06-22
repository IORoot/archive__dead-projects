<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - MEC - Add revisions
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🔪 MODIFICATION</strong> | <em>Single Events Page</em> | Adds 'revisions' to every page.
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */
//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';


 // $supports = apply_filters('mec_event_supports', array('editor', 'title', 'excerpt', 'author', 'thumbnail', 'comments'));
function add_revisions_to_mec_pages_callback( $supports ) {
    
    array_push($supports, 'revisions');

    return $supports;
}

add_filter( 'mec_event_supports', 'add_revisions_to_mec_pages_callback', 100 );
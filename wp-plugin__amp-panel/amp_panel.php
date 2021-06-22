<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - AMP Panel for posts/pages
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🎛PANEL</strong> | <em>Page/Post Edit page.</em> | Allows you to add AMP details for a page or post. Schema, AMP CSS files, Canonical/Amp links, etc..
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
//  │               Load everything else ONLY on these pages                  │
//  └─────────────────────────────────────────────────────────────────────────┘
add_action( 'current_screen', function () {
    $current_screen = \get_current_screen();
    if ( $current_screen->base == "post" ) {
        
        //  ┌─────────────────────────────────────────────────────────────────────────┐
        //  │                              The ACF                                    │
        //  └─────────────────────────────────────────────────────────────────────────┘
        require __DIR__.'/src/acf/acf_panel.php'; 

    }
});

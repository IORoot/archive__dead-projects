<?php

/**
 * Register the Flickity Libraries for use.
 * 
 * DO NOT Enqueue them yet, only do that in the shortcode generation. Otherwise the libraries 
 * will load on every page.
 * 
 */
function register_tax_lister() {
    wp_register_style( 'register_tax_lister_css', '/wp-content/plugins/andyp_tax_lister/src/sass/style.css' );
}

/**
 * This says 'encode' but we're only registering.
 */
add_action( 'wp_enqueue_scripts', 'register_tax_lister' );
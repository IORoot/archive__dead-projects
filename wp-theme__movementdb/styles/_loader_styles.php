<?php

// Enqueue the child theme stylesheets to override the parent one!
function my_theme_enqueue_styles() {

    //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/framework/css/dist/site/stacks/integrity-light.css' );

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'parent-style' ),
        wp_get_theme()->get('Version')
    );
}
add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
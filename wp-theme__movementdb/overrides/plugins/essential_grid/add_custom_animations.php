<?php

/*
 * Add new custom animation names to list through Essential Grid Filter.
 */
add_filter('essgrid_get_hover_animations', 'eg_add_custom_animation');

function eg_add_custom_animation($animations){
    $animations['stack'] = 'Stack';
    return $animations;
}


// Dequeue and Enqueue Javascript files to apply custom animations.
function esg_dequeue_script() {

    // MAIN JS FILE
        // De-queue the original script.
        wp_dequeue_script( 'essential-grid-essential-grid-script' );
        // unregister the original SLUG
        wp_deregister_script( 'essential-grid-essential-grid-script' );
        // Register SLUG with custom override JS file.
        wp_register_script('essential-grid-essential-grid-script', get_template_directory_uri() . '/../movementDB/override_plugins/essential_grid/JS/jquery.themepunch.essential.min.js', array(),'2.1.6.1', true);
        // ReEnqueue override file.
        wp_enqueue_script('essential-grid-essential-grid-script');

}
//add_action( 'wp_print_scripts', 'esg_dequeue_script', 0);



// ADMIN JS FILE Dequeue and Enqueue Javascript files to apply custom animations.
function esg_dequeue_admin_script() {

    // De-queue the original script.
    wp_dequeue_script( 'essential-grid-admin-script' );
    // unregister the original SLUG
    wp_deregister_script( 'essential-grid-admin-script' );
    // Register SLUG with custom override JS file.
    wp_register_script('essential-grid-admin-script', get_template_directory_uri() . '/../movementDB/override_plugins/essential_grid/JS/admin.js', array(),'2.1.6.1', true);
    // ReEnqueue override file.
    wp_enqueue_script('essential-grid-admin-script');
}

//add_action( 'admin_enqueue_scripts', 'esg_dequeue_admin_script', 0);
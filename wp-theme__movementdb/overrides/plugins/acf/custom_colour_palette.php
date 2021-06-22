<?php

// Enqueue the Javascript file that overrides ACF
function my_admin_enqueue_scripts() {

    wp_enqueue_script( 'my-admin-js', get_template_directory_uri() . '/../movementDB/override_plugins/acf/custom_colour_palette.js', array(), '1.0.0', true );

}

add_action('admin_enqueue_scripts', 'my_admin_enqueue_scripts');
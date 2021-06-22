<?php

    function custom_scripts() {
        wp_register_script('file_upload_button', get_template_directory_uri() . '/../movementDB/overrides/wordpress/js/file_upload_button.js', array(),'1.0', true);
        wp_enqueue_script('file_upload_button');
    }

    add_action( 'wp_enqueue_scripts', 'custom_scripts' );
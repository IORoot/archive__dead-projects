<?php

    // TinyMCE Changes
    // =============================================================================

    // The following code is from: https://carriedils.com/add-editor-style/
    add_action( 'init', 'cd_add_editor_styles' );

    function cd_add_editor_styles() {
        add_editor_style( get_stylesheet_directory() . '/styles/plugins/tinymce/editor-style.css');
    }
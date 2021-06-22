<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'WP - Post/Page Body Classes',
        'icon'      => 'file-code',
        'color'     => '#82B1FF',
        'path'      => __FILE__,
    ]);
} );
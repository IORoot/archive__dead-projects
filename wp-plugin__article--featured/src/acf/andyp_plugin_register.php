<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Article Featured Button',
        'icon'      => 'gesture-tap-button',
        'color'     => '#4A148C',
        'path'      => __FILE__,
    ]);
} );
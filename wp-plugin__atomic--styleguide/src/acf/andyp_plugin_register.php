<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Atomic - Style Guide',
        'icon'      => 'atom',
        'color'     => '#E34F65',
        'path'      => __FILE__,
    ]);
} );
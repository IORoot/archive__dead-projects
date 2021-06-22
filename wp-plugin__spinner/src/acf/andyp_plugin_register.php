<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Pulse - Logo Spinner',
        'icon'      => 'sync-circle',
        'color'     => '#A5D6A7',
        'path'      => __FILE__,
    ]);
} );
<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Pulse - Angled Scroller',
        'icon'      => 'format-text-rotation-angle-down',
        'color'     => '#A5D6A7',
        'path'      => __FILE__,
    ]);
} );
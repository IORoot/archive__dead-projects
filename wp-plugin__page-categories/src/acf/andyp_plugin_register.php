<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'WP - Page Types (AMP/Mobile)',
        'icon'      => 'responsive',
        'color'     => '#82B1FF',
        'path'      => __FILE__,
    ]);
} );
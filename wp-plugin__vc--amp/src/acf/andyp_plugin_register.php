<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'AMP WPBakery Components',
        'icon'      => 'flash-circle',
        'color'     => '#FDD835',
        'path'      => __FILE__,
    ]);
} );
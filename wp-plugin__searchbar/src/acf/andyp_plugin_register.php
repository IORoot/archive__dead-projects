<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Article Searchbox',
        'icon'      => 'card-search-outline',
        'color'     => '#4A148C',
        'path'      => __FILE__,
    ]);
} );
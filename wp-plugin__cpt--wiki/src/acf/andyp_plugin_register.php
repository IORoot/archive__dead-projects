<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'CPT: Wiki ',
        'icon'      => 'fountain-pen-tip',
        'color'     => '#38EF7D',
        'path'      => __FILE__,
    ]);
} );
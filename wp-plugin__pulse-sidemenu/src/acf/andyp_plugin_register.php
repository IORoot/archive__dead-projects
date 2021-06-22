<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Pulse - Sidemenu',
        'icon'      => 'page-layout-sidebar-left',
        'color'     => '#A5D6A7',
        'path'      => __FILE__,
    ]);
} );
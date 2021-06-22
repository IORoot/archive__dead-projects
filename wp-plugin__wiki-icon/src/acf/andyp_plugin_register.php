<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'Menus - Wiki Sidemenu Icons',
        'icon'      => 'format-list-bulleted-type',
        'color'     => '#66BB6A',
        'path'      => __FILE__,
    ]);
} );
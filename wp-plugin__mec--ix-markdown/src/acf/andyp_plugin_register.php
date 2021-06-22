<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'M.E.C. gCal Markdown Support',
        'icon'      => 'language-markdown',
        'color'     => '#FF8F00',
        'path'      => __FILE__,
    ]);
} );
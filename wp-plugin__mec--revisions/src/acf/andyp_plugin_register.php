<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'M.E.C. Page Revisions',
        'icon'      => 'step-backward-2',
        'color'     => '#FF8F00',
        'path'      => __FILE__,
    ]);
} );
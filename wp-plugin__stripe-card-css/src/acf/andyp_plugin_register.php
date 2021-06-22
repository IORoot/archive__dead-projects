<?php

add_action( 'plugins_loaded', function() {
    do_action('register_andyp_plugin', [
        'title'     => 'M.E.C. - SVG Stripe Card',
        'icon'      => 'credit-card-scan',
        'color'     => '#FF8F00',
        'path'      => __FILE__,
    ]);
} );
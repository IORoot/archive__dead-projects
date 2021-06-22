<?php

// Register CSS File (footer - stop render blocking)
function register_css_calendar_extended_css_new() {
    wp_register_style( 'tb-calendar-extended-css-new', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style('tb-calendar-extended-css-new');
}
add_action( 'get_footer', 'register_css_calendar_extended_css_new' );

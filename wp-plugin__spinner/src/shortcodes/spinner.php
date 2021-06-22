<?php

/**
 * Create the class and return results.
 */
function andyp_spinner_callback(){

    // Load and enqueue now, before everything else.
    wp_register_style( 'andyp_spinner_css', plugins_url( '/../sass/style.css', __FILE__ ) );
    wp_enqueue_style('andyp_spinner_css');

    wp_register_script('andyp_spinner_js', plugins_url( '/../js/spinner.js', __FILE__ ));
    wp_enqueue_script('andyp_spinner_js');

    //
    $output = '';

    $output .= '<div class="andyp__spinner">';  
        $output .= '<div class="pulsing-logo"></div>';  
    $output .= '</div>';

    echo $output;

    return;
}

add_shortcode( 'andyp_spinner', 'andyp_spinner_callback' );
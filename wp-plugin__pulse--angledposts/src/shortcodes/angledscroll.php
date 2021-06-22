<?php

/**
 * Create the class and return results.
 */
function andyp_pulse_angledscroll_callback($atts){
    
    wp_register_style( 'andyp_angledscroll_css', ANDYP_PULSE_ANGLEDSCROLL_PATH. 'src/sass/style.css' );
    wp_enqueue_style( 'andyp_angledscroll_css' );

    $a = shortcode_atts( 
        array(
            'cpt' => 'article',
            'tax' => 'articlecategory',
            'term' => 'reference-library',
            'items' => 12,
            'order' => 'ASC',
            'orderby' => 'rand',
        ), $atts );

    $stack = new angledscroll($a);

    return $stack->out();
}

add_shortcode( 'andyp_pulse_angledscroll', 'andyp_pulse_angledscroll_callback' );
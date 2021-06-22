<?php

/*
Plugin Name: _ANDYP - YOAST Breadcrumbs
Plugin URI: http://londonparkour.com
Description: Creates a shortcode [yoast_breadcrumbs] to insert into your webpage. 
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/


class andyp_yoast_breadcrumbs {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        $this->create_shortcode();
        return;
    }

    /**
     * create_shortcode
     *
     * @return void
     */
    public function create_shortcode(){
        add_shortcode( 'yoast_breadcrumbs', array( $this, 'render_shortcode' ) );
    }

    /**
     * render_shortcode
     *
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function render_shortcode($atts, $content = null){

        // Use RankMath breadcrumbs
        if( function_exists( 'rank_math_get_breadcrumbs' ) ) {
            echo '<p id="breadcrumbs">'.rank_math_get_breadcrumbs() . '</p>';
        }

        // Use YOAST breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }

        return;

    }


}

new andyp_yoast_breadcrumbs;
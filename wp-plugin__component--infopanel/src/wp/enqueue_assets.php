<?php

namespace andyp\webcomponent_infopanel\wp;

class enqueue_assets
{
    public function __construct()
    {
        add_action( 'get_footer', array($this, 'load_assets' ));
    }


    public function load_assets()
    { 

        /**
         * Default CSS
         */
        wp_register_style( 'andyp_infopanel_style', ANDYP_WEBCOMPONENT_INFOPANEL_URL . '/src/css/andyp_infopanel.css', );
        wp_enqueue_style( 'andyp_infopanel_style' );

        /**
         * Enqueue the extension CSS styles added within ACF.
         */
        wp_enqueue_style('andyp_infopanel_style_extend');


        /**
         * Enqueue the Javascript
         */
        wp_enqueue_script( 'andyp_infopanel_infopanel_js', ANDYP_WEBCOMPONENT_INFOPANEL_URL . '/src/js/andyp_infopanel.js', null, false, true );
    
    }

}

<?php

namespace andyp\webcomponent_hero\wp;

class enqueue_assets
{
    public function __construct()
    {
        add_action( 'get_footer', array($this, 'load_heropanel_assets' ));
    }


    public function load_heropanel_assets()
    { 
        
        /**
         * Default CSS styles.
         */
        wp_register_style( 'andyp_hero_style', ANDYP_WEBCOMPONENT_HERO_URL . '/src/css/heropanel.css' );
        wp_enqueue_style( 'andyp_hero_style' );

        /**
         * Enqueue the extension CSS styles added within ACF.
         */
        wp_enqueue_style('andyp_hero_style_extend');
    }

}

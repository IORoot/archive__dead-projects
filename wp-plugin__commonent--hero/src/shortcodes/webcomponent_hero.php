<?php

namespace andyp\webcomponent_hero\shortcodes;

use andyp\webcomponent_hero\hero\container;

class webcomponent_hero
{
    
    public function __construct()
    {
        add_shortcode( 'andyp_hero', array($this,'webcomponent_callback' ));
    }


    public function webcomponent_callback($args){

        if (empty($args['slug'])){ return 'Please define a slug.'; }


        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                             Create Container                            │
        // └─────────────────────────────────────────────────────────────────────────┘    
        $hero = new container($args['slug']);

        return $hero->get_output();
    }

}
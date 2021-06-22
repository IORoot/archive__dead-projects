<?php

namespace andyp\webcomponent_infopanel\shortcodes;

use andyp\webcomponent_infopanel\infopanel\infopanel;

class andyp_infopanel
{ 
    
    public function __construct()
    {
        add_shortcode( 'andyp_infopanel', array($this,'webcomponent_callback' ));
    }


    public function webcomponent_callback($args){

        if (empty($args['slug'])){ return 'Please define a slug.'; }

        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                             Create InfoPanel                            │
        // └─────────────────────────────────────────────────────────────────────────┘ 

        $infopanel = new infopanel($args['slug']);

        return $infopanel->get_output();

    }

}
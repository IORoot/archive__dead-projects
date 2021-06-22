<?php

namespace andyp\webcomponent_infopanel\infopanel;

use andyp\webcomponent_hero\acf\acf_get_options;
use andyp\webcomponent_infopanel\render\css;
use andyp\webcomponent_infopanel\render\html;
use andyp\webcomponent_infopanel\render\js;

class infopanel
{

    
    /**
     * 
     * This is the name of the webcomponent we wnat.
     */
    public $slug;


    /**
     * 
     * All 'page_instance' options
     * 
     */
    public $options;


    /**
     * 
     * List of all 'hero' webcomponent_instances
     * 
     */
    public $webcomponents = [];

    
    /**
     * 
     * The Webcomponent instance we want to render.
     * 
     */
    public $webcomponent;



    /**
     * 
     * The full HTML output
     * 
     */
	public $output;



    public function __construct($slug)
    {
        
        $this->slug = $slug;

        $this->setup();
        
		$this->renderShortcode();
    }

    public function get_output()
    {
        return $this->output;
    }


    public function renderShortcode()
    {
        if (empty($this->webcomponent)){ return; }
        
        $this->renderCSS(); 
		$this->renderHTML(); 
		$this->renderJS();
    }



    
    private function renderCSS()
    {
        $css = new css;
        $css->set_slug($this->slug);
        $css->set_webcomponent($this->webcomponent);
        $css->add_inline_style();
    }

    

    private function renderHTML()
    {
        $html = new html;
        $html->set_slug($this->slug);
        $html->set_webcomponent($this->webcomponent);
        $html->build();
        $this->output = $html->get_output();

    }


    private function renderJS()
    {
        $js = new js;
        $js->set_webcomponent($this->webcomponent);
        $js->add_inline_js();

    }




    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                             SETUP METHODS                               │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    private function setup()
    {
        $this->get_options();
        $this->get_webcomponents_from_options();
        $this->filter_webcomponents_for_infopanels();
        $this->filter_webcomponents_for_slug();
    }


    /**
     * This will retreive all fields from the 'page_instance' repeater.
     */
    private function get_options()
    {        
        $options = new acf_get_options;
        $this->options = $options->get('page_instance');
    }

    /**
     * loop through options and get all webcomponents.
     */
    private function get_webcomponents_from_options()
    {
        foreach($this->options as $key => $option)
        {
            $this->webcomponents = array_merge($this->webcomponents, $option['webcomponent_instance']);
        }
    }

    /**
     * Loop through and remove any NON-Hero webcomponents.
     */
    private function filter_webcomponents_for_infopanels()
    {
        foreach($this->webcomponents as $key => $infopanel)
        {
            if ($infopanel['acf_fc_layout'] == 'info_panel'){
                continue;
            }

            unset($this->webcomponents[$key]);
        }
    }

    /**
     * Loop Through remaining webcomponents and find the
     * one matching the slug we want.
     */
    private function filter_webcomponents_for_slug()
    {
        foreach($this->webcomponents as $key => $infopanel)
        {
            if ($infopanel['infopanel_slug'] != $this->slug){
                continue;
            }

            $this->webcomponent = $infopanel;
        }
    }
}

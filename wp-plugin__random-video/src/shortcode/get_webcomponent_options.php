<?php
namespace andyp\atomic_random_videos\shortcode;

use andyp\atomic_random_videos\acf\acf_get_options;

class get_webcomponent_options
{

    /**
     * 
     * This is the filed_name of the CLONE field to filter by.
     * 
     */
    public $clone_name;


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




    public function set_clone_name($clone_name)
    {
        $this->clone_name = $clone_name;
    }


    public function run()
    {
        $this->get_options_from_acf();
        $this->get_webcomponents_from_options();
        $this->filter_webcomponents_for_type();
    }

    public function get_result()
    {
        return $this->webcomponent;
    }


    /**
     * This will retreive all fields from the 'page_instance' repeater.
     */
    private function get_options_from_acf()
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
     * Loop through and remove any NON-specified webcomponents.
     */
    private function filter_webcomponents_for_type()
    {
        foreach($this->webcomponents as $key => $type)
        {
            if ($type['acf_fc_layout'] == $this->clone_name){
                continue;
            }

            unset($this->webcomponents[$key]);
        }
    }

    
    /**
     * Loop Through remaining webcomponents and find the
     * one matching the slug we want.
     */
    public function filter_webcomponents_for_slug($field, $value)
    {
        foreach($this->webcomponents as $key => $item)
        {
            if ($item[$field] != $value){
                continue;
            }

            $this->webcomponent = $item;
        }
    }

}
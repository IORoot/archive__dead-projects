<?php

namespace andyp\atomic_admin\acf;

class acf_insert_tab
{

    /**
     * 
     * Set the tabs title.
     * 
     */
    public $title;

    /**
     * 
     * Parent group / repeater / etc.. 
     * 
     */
    public $parent;


    public $placement = 'left';


    public function set_parent($parent)
    {
        $this->parent = $parent;
    }


    public function set_placement($placement)
    {
        if (empty($placement)){ return; }
        $this->placement = $placement;
    }

    public function set_title($title)
    {
        $this->title = $title;
    }

    public function add()
    {
        $this->insert_tab();
    }



    private function insert_tab()
    {
        if (empty($this->parent)){ return; }
        if (empty($this->title)){ return; }

        if (function_exists('acf_add_local_field')) {

            acf_add_local_field(
                array(
                    'key' => 'field_' . uniqid(),
                    'label' => $this->title,
                    'name' => '',
                    'type' => 'tab',
                    'parent' => $this->parent,
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'hide_admin' => 0,
                    'placement' => $this->placement,
                    'endpoint' => 0,
                ),
            );
        }
    }

}

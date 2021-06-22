<?php

namespace andyp\atomic_admin\acf;

class acf_insert_message
{

    /**
     * 
     * Set the tabs title.
     * 
     */
    public $message;

    /**
     * 
     * Parent group / repeater / etc.. 
     * 
     */
    public $parent;


    public function set_parent($parent)
    {
        $this->parent = $parent;
    }

    public function set_message($message)
    {
        $this->message = $message;
    }

    public function add()
    {
        $this->insert_message();
    }



    private function insert_message()
    {
        if (empty($this->parent)){ return; }
        if (empty($this->message)){ return; }

        if (function_exists('acf_add_local_field')) {

            acf_add_local_field(
                array(
                    'key' => 'field_' . uniqid(),
                    'label' => '',
                    'name' => '',
                    'type' => 'message',
                    'parent' => $this->parent,
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '100',
                        'class' => '',
                        'id' => '',
                    ),
                    'hide_admin' => 0,
                    'message' => $this->message ,
                    'new_lines' => 'none',
                    'esc_html' => 0,
                ),
            );

        }
    }

}

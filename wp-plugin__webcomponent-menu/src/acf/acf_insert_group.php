<?php

namespace andyp\atomic_admin\acf;

class acf_insert_group
{

    /**
     * 
     * Set the tabs title.
     * 
     */
    public $field_id;

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

    public function add()
    {
        $this->field_id = 'field_' . uniqid();
        $this->insert_group();
    }

    public function get_field_id()
    {
        return $this->field_id;
    }


    private function insert_group()
    {
        if (empty($this->parent)){ return; }
        if (empty($this->field_id)){ return; }

        if (function_exists('acf_add_local_field')) {

            acf_add_local_field(
                array(
                    'key' => $this->field_id,
                    'label' => '',
                    'name' => 'container_group',
                    'type' => 'group',
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
                    'layout' => 'block',
                    'sub_fields' => array(
                    ),
                )
            );

        }
    }

}

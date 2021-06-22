<?php

namespace andyp\atomic_admin\actions;

use andyp\atomic_admin\acf\acf_insert_tab;
use andyp\atomic_admin\acf\acf_insert_message;
use andyp\atomic_admin\acf\acf_insert_group;

class register_item
{

    /**
     * 
     * This is the parent group to add the TAB and Entry to.
     * 
     */
    private $parent = 'environment';

    
    private $group = [
        'environment' => 'field_5fe9c32e92720',
        'atoms'       => 'field_5fe9c34792721',
        'molecules'   => 'field_5fe9c35192722',
    ];


    /**
     * Wrapping container that holds all of the content.
     * - Canvas
     * - Docs
     * - Code
     */
    public $container;

    /**
     * 
     * Contains the arguments being registered
     * 
     */
    public $args;




    public function __construct()
    {
        add_action('register_atomic_item', array($this, 'register_atomic_item_callback'), 10);    
    }


    /**
     * 
     * Callback function that will be run.
     * 
     */
    public function register_atomic_item_callback($args)
    {
        $this->args = $args;

        if (empty($this->args['group'])) { return; }

        if (empty($this->args['title'])) { return; }


        $this->build_tab_and_container();

        $this->build_demo_block();

        $this->build_code_block();

        $this->build_docs_block();

        unset($this->args['group']);
        unset($this->args['title']);

        $this->build_error_block();

    }



    private function build_tab_and_container()
    {
        // Set to 'environment', 'atoms', 'molecules'
        $this->set_parent($this->args['group']);

        // Add tab to parent.
        $this->add_tab(null, $this->args['title']);

        // Create wrapper group
        $this->add_container_group();

        // Switch to the container as the parent now.
        $this->set_parent('container');

    }



    private function build_demo_block()
    {
        if (empty($this->args['demo'])) { return; }

        /**
         * Wrap in iFrame
         */
        $message = '<iframe src="' . $this->args['demo'] . '" width="100%" height="435px"> </iframe>';

        // Add a tab
        $this->add_tab('top', '<span class="mdi mdi-gesture-double-tap"></span> Demo');

        // Add a message
        $this->add_message($message);

        
    }


    private function build_code_block()
    {
        if (empty($this->args['code'])) { return; }

        /**
         * Wrap code in a codemirror textbox.
         */
        ob_start();  ?>
        <div class="ue__codemirror">
            <textarea><?php echo $this->args['code'] ?></textarea>
        </div>
        <?php $message = ob_get_clean();

        $this->add_message($message);
    }



    private function build_docs_block()
    {
        if (empty($this->args['docs'])) { return; }

        /**
         * Convert Markdown to HTML
         */
        $Parsedown = new \Parsedown();
        $message = $Parsedown->text($this->args['docs']);

        // Add a tab
        $this->add_tab('top', '<span class="mdi mdi-language-markdown"></span> Docs');

        // Add a message
        $this->add_message($message);
    }




    private function build_error_block()
    {
        if (!empty($this->args)){
            return;
        }

        // Add a tab
        $this->add_tab('top', '<span class="mdi mdi-alert-circle"></span> Error');

        // Add a message
        $this->add_message('Component has no code/demo/docs.');

    }


    /**
     * 
     * Set the parent to :
     * - environment
     * - atoms
     * - molecules
     */
    private function set_parent($parent = null)
    {
        if (empty($parent)){ return; }

        $this->parent = $parent;
    }


    /**
     * 
     * Add a Tab
     * 
     */
    private function add_tab($placement = null, $title)
    {
        $parent_id = $this->group[$this->parent];
        
        $tab = new acf_insert_tab;
        $tab->set_parent($parent_id);
        $tab->set_title($title);
        $tab->set_placement($placement);
        $tab->add();
        
    }


    /**
     * 
     * Add a Container Group
     * 
     */
    private function add_container_group()
    {
        $parent_id = $this->group[$this->parent];

        $group = new acf_insert_group;
        $group->set_parent($parent_id);
        $group->add();
        $this->group['container'] = $group->get_field_id();
        
    }


    /**
     * 
     * Add a Message
     * 
     */
    private function add_message($message)
    {
        if (empty($message)){ return; }

        /**
         * $group['container'] should now be available to add stuff to.
         */
        $parent_id = $this->group[$this->parent];

        $acf = new acf_insert_message;
        $acf->set_parent($parent_id);
        $acf->set_message($message);
        $acf->add();
        
    }


}
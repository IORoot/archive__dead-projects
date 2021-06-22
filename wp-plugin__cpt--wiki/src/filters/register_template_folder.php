<?php

namespace andyp\cpt\wiki\filters;


class register_template_folder
{

    public $post_type;

    public $folder;


    public function __construct($post_type)
    {
        $this->post_type = $post_type;

        add_filter('single_template',  [$this, 'register_template'], 99, 3);
        add_filter('template_include', [$this, 'taxonomy_template']);
    }


    public function taxonomy_template($template) {

        global $post;
        $post_type = $post->post_type;

        if ($post_type != $this->post_type){ return $template; }

        if (is_archive())
        {
            $new_template = ANDYP_LABS_CPT_WIKI_PATH . '/src/views/archive-template.php';
            if (file_exists($new_template)) { $template = $new_template; }
        }

        if (is_tax())
        {
            $new_template = ANDYP_LABS_CPT_WIKI_PATH . '/src/views/taxonomy-template.php';
            if (file_exists($new_template)) { $template = $new_template; }
        }

        return $template ;

    }

    /**
     * single-$post_type.php
     * 
     * This is the template for all the /cpt/my-page/ pages
     * 
     * e.g.
     * /tutorials/step-vault-1-introduction/
     * 
     */
    public function register_template($template, $type, $templates) {

        global $post;

        $folder = ANDYP_LABS_CPT_WIKI_PATH . '/src/views/';
    
        if ( $post->post_type != $this->post_type ) {
            return $template;
        }

        if ( !file_exists( $folder . $type . '-template.php'  ) ) {
            return $template;
        }

        return $folder . $type . '-template.php';
    
    }

}
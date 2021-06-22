<?php

namespace andyp\cpt\wiki\filters;

class enqueue_css_in_footer
{

	public function __construct($page_type)
	{
        $this->page_type = $page_type;

        add_action( 'get_footer', [$this,'register_css'] );
	}


    /**
     * Tidy up the titles on the dashboard
     */
    public function register_css() {

        if (is_singular($this->page_type))
        {
            wp_enqueue_style( $this->page_type.'-style', ANDYP_LABS_CPT_WIKI_URL . 'src/css/style.css' );
        }
        
    }

}
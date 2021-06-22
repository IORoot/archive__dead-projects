<?php

namespace andyp\cpt\wiki\setup;

class activate
{

    public function __construct()
    {
        register_activation_hook( ANDYP_LABS_CPT_WIKI_PLUGIN_FILE, [$this, 'flush_post_types'] );
    }

    public function flush_post_types() {

        $wikis = new \andyp\cpt\wiki\initialise;
        $wikis->setup_cpt();
        $wikis->register_cpt();
        $wikis->run_cpt();

        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

}
<?php

namespace andyp\cpt\wiki\cpt;

use andyp\cpt\wiki\register\taxonomy;
use andyp\cpt\wiki\register\tags;
use andyp\cpt\wiki\register\post_type;

class create_cpt
{

    public $singular;

    public $icon = '';


    public function set_singular($singular)
    {
        $this->singular = $singular;
    }

    public function set_icon($icon)
    {
        $this->icon = $icon;
    }

    public function register()
    {
        $this->register_taxonomy();
        $this->register_tags();
        $this->setup_cpt();
        $this->register_cpt();
    }


    public function register_taxonomy()
    {
        $this->tax = new taxonomy;
        $this->tax->set_singular($this->singular);
        $this->tax->set_taxonomy(strtolower($this->singular . '_category'));
        $this->tax->register_on_init();
    }


    public function register_tags()
    {
        $this->tag = new tags;
        $this->tag->set_singular($this->singular);
        $this->tag->set_taxonomy(strtolower($this->singular . '_tags'));
        $this->tag->register_on_init();
    }


    public function setup_cpt()
    {
        $this->cpt = new post_type;
        $this->cpt->set_svgdata_icon($this->icon);
        $this->cpt->set_singular($this->singular);
        $this->cpt->set_taxonomies([
            strtolower($this->singular . '_category'),
            strtolower($this->singular . '_tags'),
        ]);
    }


    public function register_cpt()
    {
        $this->cpt->register_on_init();
    }


    public function run_cpt()
    {
        $this->cpt->register_cpt();
        
    }
}

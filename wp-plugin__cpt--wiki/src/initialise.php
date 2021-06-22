<?php

namespace andyp\cpt\wiki;

class initialise
{

    public $singular = 'wiki'; //lowercase
    public $svgdata_icon = 'data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMjQgMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTE0Ljk3LDE4Ljk1TDEyLjQxLDEyLjkyQzExLjM5LDE0LjkxIDEwLjI3LDE3IDkuMzEsMTguOTVDOS4zLDE4Ljk2IDguODQsMTguOTUgOC44NCwxOC45NUM3LjM3LDE1LjUgNS44NSwxMi4xIDQuMzcsOC42OEM0LjAzLDcuODQgMi44Myw2LjUgMiw2LjVDMiw2LjQgMiw2LjE4IDIsNi4wNUg3LjA2VjYuNUM2LjQ2LDYuNSA1LjQ0LDYuOSA1LjcsNy41NUM2LjQyLDkuMDkgOC45NCwxNS4wNiA5LjYzLDE2LjU4QzEwLjEsMTUuNjQgMTEuNDMsMTMuMTYgMTIsMTIuMTFDMTEuNTUsMTEuMjMgMTAuMTMsNy45MyA5LjcxLDcuMTFDOS4zOSw2LjU3IDguNTgsNi41IDcuOTYsNi41QzcuOTYsNi4zNSA3Ljk3LDYuMjUgNy45Niw2LjA2TDEyLjQyLDYuMDdWNi40N0MxMS44MSw2LjUgMTEuMjQsNi43MSAxMS41LDcuMjlDMTIuMSw4LjUzIDEyLjQ1LDkuNDIgMTMsMTAuNTdDMTMuMTcsMTAuMjMgMTQuMDcsOC4zOCAxNC41LDcuNDFDMTQuNzYsNi43NiAxNC4zNyw2LjUgMTMuMjksNi41QzEzLjMsNi4zOCAxMy4zLDYuMTcgMTMuMyw2LjA3QzE0LjY5LDYuMDYgMTYuNzgsNi4wNiAxNy4xNSw2LjA1VjYuNDdDMTYuNDQsNi41IDE1LjcxLDYuODggMTUuMzMsNy40NkwxMy41LDExLjNDMTMuNjgsMTEuODEgMTUuNDYsMTUuNzYgMTUuNjUsMTYuMkwxOS41LDcuMzdDMTkuMiw2LjY1IDE4LjM0LDYuNSAxOCw2LjVDMTgsNi4zNyAxOCw2LjIgMTgsNi4wNUwyMiw2LjA4VjYuMUwyMiw2LjVDMjEuMTIsNi41IDIwLjU3LDcgMjAuMjUsNy43NUMxOS40NSw5LjU0IDE3LDE1LjI0IDE1LjQsMTguOTVDMTUuNCwxOC45NSAxNC45NywxOC45NSAxNC45NywxOC45NVoiLz48L3N2Zz4=';


    public function run()
    {
        $this->setup_cpt();
        $this->register_cpt();
        $this->switch_on_metaboxes();
        $this->register_template_folder();
        $this->register_sidebar();
        $this->isotope_filters();
        $this->enqueue_css();
        $this->register_shortcodes();
        $this->register_transform_filters();
    }

    public function setup_cpt()
    {
        $this->cpt = new cpt\create_cpt;
        $this->cpt->set_singular(ucfirst($this->singular));
        $this->cpt->set_icon($this->svgdata_icon);
    }
    
    public function register_cpt()
    {
        $this->cpt->register();
    }

    /**
     * This is only for activation.
     * Otherwise it runs on an init filter
     */
    public function run_cpt()
    {
        $this->cpt->run_cpt();
    }

    public function switch_on_metaboxes()
    {
        new acf\switch_on_metaboxes;
    }

    public function register_template_folder()
    {
        new filters\register_template_folder($this->singular);
    }

    public function register_sidebar()
    {
        new register\sidebar(ucfirst($this->singular));
    }

    public function isotope_filters()
    {
        new filters\isotope_filters;
    }

    public function enqueue_css()
    {
        new filters\enqueue_css_in_footer($this->singular);
    }

    public function register_shortcodes()
    {
        new shortcodes\wiki_posts;
    }

    public function register_transform_filters()
    {
        new filters\transforms\parsedown;
        new filters\transforms\tailwind;
        new filters\transforms\p_1;
        new filters\transforms\tag_hide;
        new filters\transforms\youtube_links_to_embeds;
    }

}
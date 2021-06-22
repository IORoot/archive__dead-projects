<?php

namespace andyp\webcomponent_hero\hero;

use andyp\webcomponent_hero\acf\acf_get_options;

class container {

    public $name = 'wc_hero';

    /**
     * 
     * This is the name of the webcomponent we wnat.
     */
    public $slug;


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


    /**
     * 
     * The Container Object
     * 
     */
    public $container;


    /**
     * 
     * The full HTML output
     * 
     */
	public $output;
    




    public function __construct($slug) {    

        $this->slug = $slug;

        $this->setup();

        $this->renderShortcode();
    }


    public function get_output()
    {
        return $this->output;
    }



    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                          OUTPUT GENERATION                              │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░  

    private function renderShortcode() {

        $this->webcomponent['classname'] = '.'.$this->webcomponent['wc_hero_slug'];

        $this->renderContainerStyle();
        
        $this->renderPanels();

        $this->renderContainerJS();

    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                   CSS                                   │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░  

    private function renderContainerStyle()
    {

        $this->container = $this->webcomponent['wc_hero_container_group'];

        $style = '<style>';
            $style .= $this->renderContainerFloatCSS();
            $style .= $this->renderContainerFloatTabletCSS();
            $style .= $this->renderContainerFloatMobileCSS();
            $style .= $this->renderContainerGridCSS();
        $style .= '</style>';

        $this->output .= $style;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 FLOAT                                   │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderContainerFloatCSS(){

        $float = $this->webcomponent['classname'] . '.'.$this->name.'-container {';
            $float .= $this->container['wc_hero_container_float_css'];
        $float .= '}';

        return $float;
    }

    private function renderContainerFloatTabletCSS(){
        return $this->renderContainerBreakpointCSS(
            $this->container["wc_hero_container_tablet_enabled"],
            $this->container["wc_hero_container_tablet_breakpoint"],
            $this->container["wc_hero_container_tablet_float_css"]
        );
    }


    private function renderContainerFloatMobileCSS(){
        return $this->renderContainerBreakpointCSS(
            $this->container["wc_hero_container_mobile_enabled"],
            $this->container["wc_hero_container_mobile_breakpoint"],
            $this->container["wc_hero_container_mobile_float_css"]
        );
    }



    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 GRID                                    │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderContainerGridCSS(){

        $grid = '';

        if ($this->container["wc_hero_container_grid_enabled"] == 'enabled') {

            $grid .= $this->renderContainerGridDefaultCSS();
            $grid .= $this->renderContainerGridTabletCSS();
            $grid .= $this->renderContainerGridMobileCSS();

        }

        return $grid;
    }


    private function renderContainerGridDefaultCSS(){
        $grid = ' @supports (display: grid) {';
            $grid .= $this->webcomponent['classname'] . '.'.$this->name.'-container {';
                $grid .= $this->container['wc_hero_container_grid_css'];
            $grid .= '}';
        $grid .= '}';

        return $grid;
    }


    private function renderContainerGridTabletCSS(){
        $grid = '@supports (display: grid) {';
            $grid .= $this->renderContainerBreakpointCSS(
                $this->container["wc_hero_container_tablet_enabled"],
                $this->container["wc_hero_container_tablet_breakpoint"],
                $this->container["wc_hero_container_tablet_grid_css"]
            );
        $grid .= '}';
        return $grid;
    }


    private function renderContainerGridMobileCSS(){
        $grid = '@supports (display: grid) {';
            $grid .= $this->renderContainerBreakpointCSS(
                $this->container["wc_hero_container_mobile_enabled"],
                $this->container["wc_hero_container_mobile_breakpoint"],
                $this->container["wc_hero_container_mobile_grid_css"]
            );
        $grid .= '}';
        return $grid;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                          BREAKPOINT OUTPUT                              │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderContainerBreakpointCSS($enabled, $breakpoint, $css){

        $style = '';
        if ($enabled == 'enabled' && $breakpoint != ''){ 
            $style .= '@media screen and (max-width:'. $breakpoint . ') { '; 
                $style .= $this->webcomponent['classname'] . '.'.$this->name.'-container {';
                    $style .= $css;
                $style .= '}';
            $style .=  '}'; 
        }
        return $style;
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                   HTML                                  │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderPanels()
    {

        $html = '<div class="'.$this->name.'-container '.$this->webcomponent["wc_hero_slug"].'">';
            
            $panels = new panel($this->webcomponent);
            $html .= $panels->get_output();

        $html .= '</div>';

        $this->output .= $html;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                          Javascript in FOOTER                           │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

	private function renderContainerJS()
	{
		$hero_js = $this->container['wc_hero_container_js'];
		if ($hero_js != "") {
			add_filter('wp_footer', function () use (&$hero_js) {
				echo '<script>'. $hero_js .'</script>';
			}, 30);
		}
	}


    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    private function loadCssAndJs() {
        wp_register_style( 'vc_extend_style_cherocontainer', plugins_url('assets/vc_c-hero__container.css', __FILE__) );
        wp_enqueue_style( 'vc_extend_style_cherocontainer' );
    }



    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                             SETUP METHODS                               │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    private function setup()
    {
        $this->get_options();
        $this->get_webcomponents_from_options();
        $this->filter_webcomponents_for_heroes();
        $this->filter_webcomponents_for_slug();
    }


    /**
     * This will retreive all fields from the 'page_instance' repeater.
     */
    private function get_options()
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
     * Loop through and remove any NON-Hero webcomponents.
     */
    private function filter_webcomponents_for_heroes()
    {
        foreach($this->webcomponents as $key => $hero)
        {
            if ($hero['acf_fc_layout'] == 'hero'){
                continue;
            }

            unset($this->webcomponents[$key]);
        }
    }

    /**
     * Loop Through remaining webcomponents and find the
     * one matching the slug we want.
     */
    private function filter_webcomponents_for_slug()
    {
        foreach($this->webcomponents as $key => $hero)
        {
            if ($hero['wc_hero_slug'] != $this->slug){
                continue;
            }

            $this->webcomponent = $hero;
        }
    }

}
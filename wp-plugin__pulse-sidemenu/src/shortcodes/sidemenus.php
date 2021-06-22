<?php


class pulse_walker extends Walker_Nav_Menu {

	// Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        
        $output .= '<option value="'. $item->url .'">';
            $output .= $item->title;
        $output .= '</option>';
    }
}


class pulse_sidemenu {

    public $menuid;

    public $output;

    public function __construct($menuid)
    {
        $this->menuid = $menuid;
    }

    public function render(){
        
        $this->pulse_header();
        $this->mobile_menu();
        $this->desktop_menu();
        $this->last_ran();

        return $this->output;
    }


    public function pulse_header()
    {
        $this->output .= '<div class="pulse-sidebar-title"><span class="mdi mdi-pulse mdi--sky" style="width:29px; height: 29px;"></span> Pulse <span class="mdi mdi-alpha mdi--smoke"></span></div>';
    }


    public function desktop_menu()
    {
        $this->output .= '<div class="sidemenu__desktop">';

        $this->output .= wp_nav_menu( array(
                'menu' => $this->menuid,
                'container' => '',
                'echo' => false,
            ) );    

        $this->output .=  '</div>';
    }


    public function mobile_menu()
    {
        $this->output .= '<div class="sidemenu__mobile">';

        $this->output .= wp_nav_menu( array(
            'menu' => $this->menuid,
            'items_wrap' => '<select onChange="window.location.href=this.value">%3$s</select>',
            'walker' => new pulse_walker(),
            'container' => '',
            'echo' => false,
        ) );    

        $this->output .=  '</div>';
    }

    
    public function last_ran()
    {
        $this->output .= '<div class="menu-pulse__global-update"><span class="mdi mdi-update mdi--yellow"></span>'.do_shortcode('[andyp_scrape_date scrape_id="global" fmt="ago"]').'</div>';
    }

}





function andyp_pulse_sidemenus_callback($atts){

        
    // Load and enqueue now, before everything else.
    wp_register_style( 'andyp_sidemenus_css', ANDYP_PULSE_SIDEMENUS_PATH.'src/sass/style.css' );
    wp_enqueue_style( 'andyp_sidemenus_css' );

    $output = '';
    
    $a = shortcode_atts( 
        array(
            'menu' => '',
        ), $atts );

    
    $pulse_menu = new pulse_sidemenu($a['menu']);
    echo $pulse_menu->render();

    return;
}

add_shortcode( 'andyp_pulse_sidemenus', 'andyp_pulse_sidemenus_callback' );
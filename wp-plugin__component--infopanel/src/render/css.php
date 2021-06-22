<?php

namespace andyp\webcomponent_infopanel\render;

class css
{

    public $slug;

    public $webcomponent;


    public function set_slug( $slug)
    {
        $this->slug = $slug;
    }

    public function set_webcomponent( $webcomponent)
    {
        $this->webcomponent = $webcomponent;
    }

    public function add_inline_style()
    {
        $this->prefixSlugClass();
        $this->renderStyle();
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 PRIVATE                                 │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderStyle()
    {

        $style = $this->renderOverlayStyles();
        $style .= $this->webcomponent['infopanel_front_css'];
        $style .= $this->webcomponent['infopanel_back_css'];
        $style .= $this->renderFloatStyles();
        $style .= $this->webcomponent['infopanel_css'];

        wp_register_style( 'andyp_infopanel_style_extend', false );
        wp_add_inline_style('andyp_infopanel_style_extend', $style);

    }


    private function renderOverlayStyles()
    {
		$style = '';

        if ($this->webcomponent['infopanel_overlay_type'] == 'background') {
            $style .= ' .'. $this->slug .' .infopanel__overlay';
            
            if ($this->webcomponent['infopanel_overlay_lazyload']) {
                $style .= '.lazyloaded';
            }

            $style .=  '{';
            $style .= $this->renderImage($this->webcomponent['infopanel_overlay_image'], 'background-image', true);
            $style .=  '}';
        }

		$style .= ' '. $this->webcomponent['infopanel_overlay_css'];

        return $style;
    }


    private function renderFloatStyles()
    {
        $style = ' .'. $this->slug . ' {' ;
            
		$style .= 'display: block; ';
		
        if ($this->webcomponent['infopanel_float_width'] != '') {
            $style .= 'width: '.  $this->webcomponent['infopanel_float_width'] .'; ' ;
		}
		
        if ($this->webcomponent['infopanel_float_height'] != '') {
            $style .= 'height: '.  $this->webcomponent['infopanel_float_height'] .'; ' ;
		}
		
        if ($this->webcomponent['infopanel_float_direction'] != '') {
            $style .= 'float: '.  $this->webcomponent['infopanel_float_direction'] .'; ' ;
		}
		
        if ($this->webcomponent['infopanel_float_clear'] != '') {
            $style .= 'clear: '.  $this->webcomponent['infopanel_float_clear'] .'; ' ;
		}
		
        $style .= '}';

        $style .= $this->webcomponent['infopanel_float_css'];

        $style .= $this->renderFloatStyleTablet();
        $style .= $this->renderFloatStyleMobile();

        return $style;
    }


    private function renderFloatStyleTablet()
    {
        $style ='';
        if ($this->webcomponent['infopanel_tablet_enabled'] == 'enabled') {
            if ($this->webcomponent['infopanel_tablet_breakpoint'] != '' && $this->webcomponent['infopanel_tablet_css'] != '') {
                $style .= '@media screen and (max-width:'. $this->webcomponent['infopanel_tablet_breakpoint'] . ') { ';
                $style .=  $this->webcomponent['infopanel_tablet_css'];
                $style .=  '}';
            }
        }
        return $style;
    }


    private function renderFloatStyleMobile()
    {
        $style ='';
        if ($this->webcomponent['infopanel_mobile_enabled'] == 'enabled') {
            if ($this->webcomponent['infopanel_mobile_breakpoint'] != '' && $this->webcomponent['infopanel_mobile_css'] != '') {
                $style .= '@media screen and (max-width:'. $this->webcomponent['infopanel_mobile_breakpoint'] . ') { ';
                $style .= $this->webcomponent['infopanel_mobile_css'];
                $style .=  '}';
            }
        }
        return $style;
	}
	


	private function prefixSlugClass()
	{
		$search = '.infopanel';
		$replace = '.'.$this->slug . ' .infopanel';

		$this->webcomponent['infopanel_overlay_css'] = str_replace($search, $replace, $this->webcomponent['infopanel_overlay_css']);
		$this->webcomponent['infopanel_front_css'] = str_replace($search, $replace, $this->webcomponent['infopanel_front_css']);
		$this->webcomponent['infopanel_back_css'] = str_replace($search, $replace, $this->webcomponent['infopanel_back_css']);
    }
    

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 Images                                  │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    /**
     * Take the input ID and output an <IMG> tag or url().
     */
    public function renderImage($imageID, $extraClassName='background', $cssURL = false)
    {
        $image_full = wp_get_attachment_image_src($imageID, 'full');

        $image_output = '<img class="infopanel__overlay" src="'. $image_full[0] .'" >';

        if ($cssURL == true) {
            $image_output = $extraClassName.': url("'. $image_full[0] .'") ;';
        }
        
        return $image_output;
    }


}
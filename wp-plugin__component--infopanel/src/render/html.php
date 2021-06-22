<?php

namespace andyp\webcomponent_infopanel\render;

class html
{
    public $slug;

    public $webcomponent;

    public $output;


    public function set_slug($slug)
    {
        $this->slug = $slug;
    }

    public function set_webcomponent($webcomponent)
    {
        $this->webcomponent = $webcomponent;
    }

    public function build()
    {
        $this->renderHTML();
    }

    public function get_output()
    {
        return $this->output;
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                PRIVATE                                  │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    private function renderHTML()
    {
        $html = '<div class="infopanel ' .$this->webcomponent['infopanel_slug'].' ' . esc_attr($this->webcomponent['infopanel_classes']) . '">';
			$html .= $this->renderHTMLFront();
			$html .= $this->renderHTMLBack();
        $html .= '</div>';
        $html .= '<div class="infopanel__underlay"></div>';

        $this->output .= $html;
    }



    private function renderHTMLFront()
    {
        $html = '';
        $html .= '<div class="infopanel__panel infopanel__panel--front">';

			$html .= $this->wrapperDiv('infopanel__pre', 'infopanel_front_pre_html');

			$html .= $this->renderHTMLImage();

			$html .= $this->wrapperDiv('infopanel__content', 'infopanel_front_html');

        $html .= '</div>';
        
        return $html;
    }



    private function renderHTMLImage()
    {
        $lazyload = ($this->webcomponent['infopanel_overlay_lazyload'] ? 'lazyload' : '');

        $image = '<div class="infopanel__overlay '.$lazyload.'"></div>';

        if ($this->webcomponent['infopanel_overlay_type'] == 'img') {
            $image = '<div class="infopanel__overlay '.$lazyload.'"> ';
            $image .= $this->renderImage($this->webcomponent['infopanel_overlay_image']);
            $image .= '</div>';
        }

        return $image;
    }



    private function renderHTMLBack()
    {
        $html = '';
        
        if ($this->webcomponent['infopanel_back_enabled'] == true) {

            $html .= '<div class="infopanel__panel infopanel__panel--back toggle--off">';

				$html .= $this->wrapperDiv('infopanel__pre--back', 'infopanel_back_pre_html');

				$html .= $this->wrapperDiv('infopanel__content--back', 'infopanel_back_html');
            
            $html .= '</div>';
        }

        return $html;
    }


    
    private function wrapperDiv($class, $option)
    {
        if (!$option) {
            return;
		}
		if ($this->webcomponent[$option]  == '')
		{
			return;
		}

        $code = $this->parseShortcodes($option);

        $html = '';
        $html .= '<div class="'.$class.'">';
            $html .= $code;
        $html .= '</div>';

        return $html;
    }



    private function parseShortcodes($option)
    {
        $html = $this->webcomponent[$option];

        $html = preg_replace_callback( 
            '/(\[[\s|\S]*?\])/', 
            array($this, 'do_the_shortcode') , 
            $html
        );

        return $html;
    }


    
    private function do_the_shortcode($matches)
    {
        $shortcode = do_shortcode($matches[0]);
        return $shortcode;
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
    private function renderImage($imageID, $extraClassName='background', $cssURL = false)
    {
        $image_full = wp_get_attachment_image_src($imageID, 'full');

        $image_output = '<img class="infopanel__overlay" src="'. $image_full[0] .'" >';

        if ($cssURL == true) {
            $image_output = $extraClassName.': url("'. $image_full[0] .'") ;';
        }
        
        return $image_output;
    }
}
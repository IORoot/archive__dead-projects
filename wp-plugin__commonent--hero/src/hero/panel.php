<?php

namespace andyp\webcomponent_hero\hero;

class panel
{
    public $name = 'heropanel';

    public $options;

    public $output;

    public $panel;

    public function __construct($options)
    {
        $this->options = $options;
        $this->renderPanels();
    }

    public function get_output()
    {
        return $this->output;
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 PRIVATE                                 │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    private function renderPanels()
    {
        $panels = $this->options["wc_hero_panel_instance"];

        foreach ($panels as $panel) {
            $this->renderPanel($panel);
        }
    }

    private function renderPanel($panel)
    {
        $this->panel = $panel;
        $this->panel['class'] = '.'.$this->panel["wc_hero_panel_slug"];
        $this->renderPanelStyle();
        $this->renderPanelHTML();
    }



    private function renderPanelStyle()
    {
        $style = '<style>';
        $style .= $this->renderContentCSS();
        $style .= $this->renderOverlayCSS();
        $style .= $this->renderImageCSS();
        $style .= $this->renderFloatCSS();
        $style .= $this->renderFloatTabletCSS();
        $style .= $this->renderFloatMobileCSS();
        $style .= $this->renderGridCSS();
        $style .= $this->renderCSS();
        $style .= '</style>';
        
        $this->output .= $style;
        // wp_register_style( 'andyp_hero_style_extend', false );
        // wp_add_inline_style('andyp_hero_style_extend', $style);
    }




    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 OVERLAY CSS                             │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderOverlayCSS()
    {
        $style = '';

        if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_image_type"] == 'background') {
            $style .= $this->panel["class"] . ' .'.$this->name.'__overlay';

            if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_image_lazyload"]) {
                $style .= '.lazyloaded';
            }

            $style .= '{';
            $style .= $this->renderImage($this->panel["wc_hero_panel_group"]["wc_hero_panel_image"], 'background-image', true);
            $style .= '}';
        }

        return $style;
    }


    private function renderImageCSS()
    {
        return $this->panel["wc_hero_panel_group"]["wc_hero_panel_image_css"];
    }

    private function renderContentCSS()
    {
        return $this->panel["wc_hero_panel_group"]["wc_hero_panel_content_css"];
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 FLOAT CSS                               │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderFloatCSS()
    {
        return $this->panel["wc_hero_panel_group"]["wc_hero_panel_float_css"];
    }


    private function renderFloatTabletCSS()
    {
        return $this->renderPanelBreakpointCSS(
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_enabled"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_breakpoint"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_float_css"]
        );
    }

    private function renderFloatMobileCSS()
    {
        return $this->renderPanelBreakpointCSS(
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_enabled"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_breakpoint"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_float_css"]
        );
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 GRID CSS                                │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderGridCSS()
    {
        if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_grid_enabled"]) {
            $grid = $this->renderGridDefaultCSS();
            $grid .= $this->renderGridTabletCSS();
            $grid .= $this->renderGridMobileCSS();
        }

        return $grid;
    }

    
    private function renderGridDefaultCSS()
    {
        $grid = '@supports (display: grid) {';
        $grid .= $this->panel["wc_hero_panel_group"]["wc_hero_panel_grid_css"];
        $grid .= '}';

        return $grid;
    }


    private function renderGridTabletCSS()
    {
        $tablet = '@supports (display: grid) {';
        $tablet .= $this->renderPanelBreakpointCSS(
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_enabled"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_breakpoint"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_tablet_grid_css"]
        );
        $tablet .= '}';
        return $tablet;
    }


    private function renderGridMobileCSS()
    {
        $tablet = '@supports (display: grid) {';
        $tablet .= $this->renderPanelBreakpointCSS(
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_enabled"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_breakpoint"],
            $this->panel["wc_hero_panel_group"]["wc_hero_panel_mobile_grid_css"]
        );
        $tablet .= '}';
        return $tablet;
    }

    private function renderCSS()
    {
        return $this->panel["wc_hero_panel_group"]["wc_hero_panel_css"];
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                          BREAKPOINT OUTPUT CSS                          │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderPanelBreakpointCSS($enabled, $breakpoint, $css)
    {
        $style = '';
        if ($enabled == 'enabled' && $breakpoint != '') {
            $style .= '@media screen and (max-width:'. $breakpoint . ') { ';
            $style .= $css;
            $style .=  '}';
        }
        return $style;
    }
    
    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                 RENDER HTML                             │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderPanelHTML()
    {
        $html = '<div class="'.$this->name.' ' . $this->panel["wc_hero_panel_slug"] . ' '.$this->panel["wc_hero_panel_classes"].' ">';
        $html .= $this->renderHTMLPre();
        $html .= $this->renderHTMLOverlay();
        $html .= $this->renderHTMLContent();
        $html .= '</div>';

        $this->output .= $html;
    }

    private function renderHTMLPre()
    {
        $html = '';
        if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_content_pre_html"] != '') {
            $html .= '<div class="'.$this->name.'__pre">';
                $html .= $this->process_shortcodes('wc_hero_panel_content_pre_html');
            $html .= '</div>';
        }

        return $html;
    }


    private function renderHTMLOverlay()
    {
        $lazyload = ($this->panel["wc_hero_panel_group"]["wc_hero_panel_image_lazyload"] ? 'lazyload' : '');
        $html = '';
        if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_image_type"] == 'img') {
            $html .= '<div class="'.$this->name.'__overlay '.$lazyload.'"> ';
            $html .= $this->renderImage($this->panel["wc_hero_panel_group"]["wc_hero_panel_image"]);
            $html .= '</div>';
        } else {
            $html .= '<div class="'.$this->name.'__overlay '.$lazyload.'"></div>';
        }
        return $html;
    }


    private function renderHTMLContent()
    {
        $html = '';
        if ($this->panel["wc_hero_panel_group"]["wc_hero_panel_content_html"] != '') {
            $html .= '<div class="'.$this->name.'__content">';

            $html .= $this->process_shortcodes('wc_hero_panel_content_html');
                
            $html .= '</div>';
        }
        return $html;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                               RENDER IMAGES                             │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function renderImage($imageID, $extraClassName='background', $cssURL = false)
    {
        $image_full = wp_get_attachment_image_src($imageID, 'full');

        // Use relative paths, not absolute.
        $relative_url = str_replace(get_site_url(), '', $image_full[0]);

        $image_output = '<img class= ' . $this->name . '"__overlay" src="'. $relative_url .'" >';

        if ($cssURL == true) {
            $image_output = $extraClassName.': url("'. $relative_url .'") ;';
        }
        
        return $image_output;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                          PROCESS SHORTCODES                             │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    private function process_shortcodes($field)
    {
        $html = $this->panel["wc_hero_panel_group"][$field];

        if ($html == '') {
            return;
        }

        $pattern = get_shortcode_regex();

        preg_match_all('/'.$pattern.'/s', $html, $matches);

        if (empty($matches[0])) {
            return $html;
        }

        foreach ($matches[0] as $match) {

            if ($match == "") {
                continue;
            }

            $shortcode = do_shortcode($match);

            $html = preg_replace('/'.$pattern.'/s', $shortcode, $html);
        }

        return $html;
    }



    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    private function loadCssAndJs()
    {
        wp_register_style('vc_extend_style_hero_panel', plugins_url('assets/vc_c-hero__panel.css', __FILE__));
        wp_enqueue_style('vc_extend_style_hero_panel');
    }
}

<?php

namespace amp\component;

class andyp_amp_shortcodes
{

    /**
     * $contents of shortcode
     *
     * @var undefined
     */
    public $contents;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->create_shortcode();
        $this->create_VC_map();

        return;
    }

    /**
     * create_shortcode
     *
     * @return void
     */
    public function create_shortcode()
    {
        add_shortcode('ampshortcode', array( $this, 'render_shortcode' ));
    }


    /**
     * create_VC_map
     *
     * @return void
     */
    public function create_VC_map()
    {

        //  ┌──────────────────────────────────────┐
        //  │         Create the VC Inputs         │
        //  └──────────────────────────────────────┘
        vc_map(
            array(
            "name" => __("AMP Shortcodes", 'vc_extend'),
            "description" => __("AMP-Shortcodes", 'vc_extend'),
            "base" => "ampshortcode",
            "class" => "",
            "controls" => "full",
            "category" => __('AMP', 'js_composer'),
            "params" => array(

                    //  ┌──────────────────────────────────────┐
                    //  │           SHORTCODES                 │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("Shortcode", 'vc_extend'),
                        "param_name" => "amp_shortcode",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Add the shortcode.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Remove JS", 'vc_extend'),
                        "param_name" => "amp_shortcode_remove_js",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Remove any JS from output.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Remove CSS", 'vc_extend'),
                        "param_name" => "amp_shortcode_remove_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Remove any CSS from output.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                    ),
                    
                )
            )
        );
    }

    

    /**
     * render_shortcode
     *
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function render_shortcode($atts, $content = null)
    {

        //  ┌──────────────────────────────────────┐
        //  │         Shortcode parameters         │
        //  └──────────────────────────────────────┘
        extract(
            shortcode_atts(
                array(
                    'amp_shortcode' => '',
                    'amp_shortcode_remove_js' => false,
                    'amp_shortcode_remove_css' => false,
                ),
                $atts
            )
        );
            
        //  ┌──────────────────────────────────────┐
        //  │         Start Output Buffer          │
        //  └──────────────────────────────────────┘
        ob_start();

        $shortcode = rawurldecode(base64_decode($amp_shortcode));

        $this->contents = do_shortcode($shortcode);

        if ($amp_shortcode_remove_js) {
            $this->filter_out_js();
        }
        if ($amp_shortcode_remove_css) {
            $this->filter_out_css();
        }
        

        echo $this->contents;
    

        return ob_get_clean();
    }

    /**
     * filter_out_CSS
     *
     * Remove ALL <style>...</style> tags
     *
     * @return void
     */
    public function filter_out_css()
    {
        $this->contents = preg_replace("/<style>.*?<\/style>/s", "", $this->contents);
        return;
    }

    /**
     * filter_out_js
     *
     * Remove ALL <Script>...</script> tags
     *
     * @return void
     */
    public function filter_out_js()
    {
        $this->contents = preg_replace("/<script>.*?<\/script>/s", "", $this->contents);
        return;
    }
}

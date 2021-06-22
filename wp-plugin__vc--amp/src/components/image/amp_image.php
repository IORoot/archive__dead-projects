<?php

namespace amp\component;

class andyp_amp_image
{

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
        add_shortcode('ampimage', array( $this, 'render_shortcode' ));
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
            "name" => __("AMP Image", 'vc_extend'),
            "description" => __("AMP-IMG", 'vc_extend'),
            "base" => "ampimage",
            "class" => "",
            "controls" => "full",
            "category" => __('AMP', 'js_composer'),
            "content_element" => true,
            "params" => array(

                    //  ┌──────────────────────────────────────┐
                    //  │                  IMG                 │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "attach_image",
                        "heading" => __("Image", 'vc_extend'),
                        "param_name" => "amp_image",
                        "value" => __("", 'vc_extend'),
                        "content_element" => true,
                        "description" => __("Image", 'vc_extend'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra classes", 'vc_extend'),
                        "param_name" => "amp_image_class",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Extra classes to add onto image", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra inline style", 'vc_extend'),
                        "param_name" => "amp_image_inline_style",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Extra inline style", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Image Size", 'vc_extend'),
                        "param_name" => "amp_image_size",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Size of requested image. (thumbnail, original, etc..)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Image ALT", 'vc_extend'),
                        "param_name" => "amp_image_alt",
                        "value" => __("", 'vc_extend'),
                        "description" => __("ALT Title - REQUIRED", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Image Width", 'vc_extend'),
                        "param_name" => "amp_image_width",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Width - REQUIRED", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Image Height", 'vc_extend'),
                        "param_name" => "amp_image_height",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Height - REQUIRED", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Responsive Image", 'vc_extend'),
                        "param_name" => "amp_image_responsive",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Make Image Responsive", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
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
                    'amp_image' => '',
                    'amp_image_class' => '',
                    'amp_image_inline_style' => '',
                    'amp_image_alt' => '',
                    'amp_image_size' => 'original',
                    'amp_image_width' => '',
                    'amp_image_height' => '',
                    'amp_image_responsive' => false,
                ),
                $atts
            )
        );
            
        //  ┌──────────────────────────────────────┐
        //  │         Start Output Buffer          │
        //  └──────────────────────────────────────┘
        ob_start();

            $image = wp_get_attachment_image_src($amp_image, $amp_image_size);
            if ($amp_image_width == '') {
                $amp_image_width = $image[1];
            }
            if ($amp_image_height == '') {
                $amp_image_height = $image[2];
            }
            if ($amp_image_responsive) {
                $amp_image_responsive = 'layout="responsive"';
            }

            // $output = '<div class="fixed-container">';
            $output = '<amp-img noloading '.$amp_image_responsive.' src="'.$image[0].'" width="'.$amp_image_width.'" height="'.$amp_image_height.'" alt="'.$amp_image_alt.'" style="'.$amp_image_inline_style.'" class="ampimage '.$amp_image_class.' ">';
            $output .= '</amp-img>';
            // $output .= '</div>';

            echo $output;
    
        return ob_get_clean();
    }


}

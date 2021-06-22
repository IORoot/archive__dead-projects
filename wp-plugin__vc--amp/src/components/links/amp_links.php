<?php

namespace amp\component;

if (class_exists('WPBakeryShortCode')) {
    class andyp_amp_links
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
            add_shortcode('amplinks', array( $this, 'render_shortcode' ));
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
            "name" => __("AMP Links", 'vc_extend'),
            "description" => __("AMP-Links", 'vc_extend'),
            "base" => "amplinks",
            "class" => "",
            "controls" => "full",
            "category" => __('AMP', 'js_composer'),
            "params" => array(

                    //  ┌──────────────────────────────────────┐
                    //  │               LINKS                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "vc_link",
                        "heading" => __("Link", 'vc_extend'),
                        "param_name" => "amp_link",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("B__E--M Modifier class.", 'vc_extend'),
                        "param_name" => "amp_link_modifier_class",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Extra Modifier class amp-link--??", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra classes.", 'vc_extend'),
                        "param_name" => "amp_link_extra_class",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Extra classes to add onto image", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Inline styles", 'vc_extend'),
                        "param_name" => "amp_link_inline_styles",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Any extra inline styles", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
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
                    'amp_link' => '',
                    'amp_link_modifier_class' => '',
                    'amp_link_extra_class' => '',
                    'amp_link_inline_styles' => '',
                ),
                $atts
            )
            );
            


            //  ┌──────────────────────────────────────┐
            //  │         Start Output Buffer          │
            //  └──────────────────────────────────────┘
            ob_start();

            $href = vc_build_link($amp_link);

            if ($href['url'] != "") {
                $link =  '<a class="amp-link amp-link--'.$amp_link_modifier_class.' '.$amp_link_extra_class.' "  href=" '.$href['url'].' "  title="'.$href['title'].'" style="'.$amp_link_inline_styles.'" rel="'.$href['rel'].'">';
                $link .= '<span>'.$href['title'].'</span>';
                $link .= '</a>';
            }

            echo $link;

            return ob_get_clean();
        }
    }
}
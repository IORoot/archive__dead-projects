<?php

namespace amp\component;

class andyp_amp_carousel
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->create_VC_map();
        $this->add_js_script('<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.2.js"></script>');
        $this->create_shortcode();
        
        return;
    }


    /**
     * create_shortcode
     *
     * @return void
     */
    public function create_shortcode()
    {
        add_shortcode('ampcarousel', array( $this, 'render_shortcode_open' ));
    }


    public function add_js_script($script)
    {
        $current_array = get_option('amp_js');
        $current_array['andyp_amp_carousel'] = $script;
        update_option('amp_js', $current_array);
    }

    /**
     * create_VC_map
     *
     * @return void
     */
    public function create_VC_map()
    {

        vc_map(
            array(
                "name" => __("AMP Carousel", "my-text-domain"),
                "description" => __("AMP-Carousel", 'vc_extend'),
                "base" => "ampcarousel",
                "category" => __('AMP', 'js_composer'),
                "class" => "",
                "controls" => "full",
                "content_element" => true,
                "params" => array(
                    array(
                        "type" => "attach_images",
                        "heading" => __("Images", 'vc_extend'),
                        "param_name" => "amp_images",
                        "value" => '',
                        "content_element" => true,
                        "description" => __("Image", 'vc_extend'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Carousel Height", 'vc_extend'),
                        "param_name" => "amp_carousel_height",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Carousel Height - REQUIRED", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("WP_Query", 'vc_extend'),
                        "param_name" => "amp_query",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Use the WP_Query to select posts to output the images of. Will override any manually selected images.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-12"),
                    ),
                ),
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
    public function render_shortcode_open($atts, $content = null)
    {

        //  ┌──────────────────────────────────────┐
        //  │         Shortcode parameters         │
        //  └──────────────────────────────────────┘
        extract(
            shortcode_atts(
                array(
                    'amp_image' => '',
                    'amp_carousel_height' => '300px',
                    'amp_query' => '',
                ),
                $atts
            )
        );



        //  ┌──────────────────────────────────────┐
        //  │         Start Output Buffer          │
        //  └──────────────────────────────────────┘
        ob_start();

        $output = '<amp-carousel width="100" height="56.25" layout="responsive" type="slides" autoplay>';


        if ($atts['amp_query'] != '')
        {
            $output .= $this->load_query($atts['amp_query']);
        } else {
            $output .= $this->load_images($atts['amp_images']);
        }
        
        $output .= '</amp-carousel>';

        echo $output;

        return ob_get_clean();
    }




    public function load_images($image_ids)
    {
        $output = '';
        $ids_array = explode(',', $image_ids);

        foreach ($ids_array as $id)
        {
            $image = wp_get_attachment_image_src($id, 'original');
            $imageset = wp_get_attachment_image_srcset($id, 'original');

            $output .= '<amp-img src="'.$image[0].'" srcset="'.$imageset.'" width="100" height="56.25" layout="responsive" ></amp-img>';
        }

        return $output;
    
    }


    public function load_query($query)
    {
        $output = '';
        $args = rawurldecode(base64_decode($query));
        $args = preg_replace( "/\r|\n/", "", $args );
        $args = eval("return " . $args . ";");

        $posts = get_posts($args);

        foreach($posts as $key => $post)
        {
            $image = get_the_post_thumbnail_url($post->ID);
            $output .= '<div class="amp-image-wrapper">';
                $output .= '<amp-img src="'.$image.'" width="100" height="56.25" layout="responsive" ></amp-img>';
                $output .= '<div class="amp-caption">'.$post->post_title.'</div>';
            $output .= '</div>';
        }

        return $output;
    }

}

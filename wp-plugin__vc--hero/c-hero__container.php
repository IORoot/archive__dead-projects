<?php
/*
Plugin Name: _ANDYP - WPBakery component : C-Hero
Plugin URI: http://londonparkour.com
Description: <strong>🧩COMPONENT</strong> | <em>Edit Page > Visual Composer > LondonParkour </em> | LondonParkour Custom Visual Composer Component - Hero Header Container & Panel
Version: 2.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

include_once('c-hero__panel.php');

//  ┌───────────────────────────────────────────┐ 
//  │                                           │░
//  │                                           │░
//  │ Hero Container                            │░
//  │                                           │░
//  │ Will only accept Hero Slides in it to     │░
//  │ present. This will build a CSS Grid so    │░
//  │ that the slides can be positioned         │░
//  │ correctly.                                │░
//  │                                           │░
//  │                                           │░
//  └───────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


// don't load directly
if (!defined('ABSPATH')) die('-1');

// ONLY Run this AFTER WPBakery is initialised, otherwise the class extension will not work.
add_action ( 'init', 'create_c_hero_container', 100);

function create_c_hero_container(){
    
    //  ┌────────────────────────────────────────────────┐
    //  │            Define the Panel vc_map             │
    //  └────────────────────────────────────────────────┘
    include_once('vc_map/c-hero__container_vc_map.php');

    //  ┌──────────────────────────────────────┐
    //  │       C-Panel Container Class        │
    //  └──────────────────────────────────────┘
    class WPBakeryShortCode_cherocontainer extends WPBakeryShortCodesContainer {

        function __construct() {    

            // Use this when creating a shortcode addon
            add_shortcode( 'cherocontainer', array( $this, 'renderShortcode' ) );

            // Register CSS and JS
            add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
            
        }

        /*
        Shortcode logic how it should be rendered
        */
        public function renderShortcode( $atts, $content = null ) {
            
            //  ┌──────────────────────────────────────┐
            //  │         Shortcode parameters         │
            //  └──────────────────────────────────────┘
            extract(
                shortcode_atts(
                    array(
                        // General
                        'chero_container_unique_class' => '',
                        // Floats
                        'container_float_direction' => '',
                        'container_float_width' => '',
                        'container_float_height' => '',
                        'container_float_clear' => '',
                        'container_float_css' => '',

                        // Flexbox
                        'container_flex_enabled' => 'disabled',
                        'container_flex_direction' => '',
                        'container_flex_wrap' => '',
                        'container_flex_justify' => '',
                        'container_flex_align_items' => '',
                        'container_flex_align_content' => '',
                        'container_flex_css' => '',

                        // Grid
                        'container_grid_enabled' => 'enabled',
                        'container_grid_template_columns' => '',
                        'container_grid_template_rows' => '',
                        'container_grid_template_areas' => '',
                        'container_grid_column_gap' => '',
                        'container_grid_row_gap' => '',
                        'container_grid_justify_items' => '',
                        'container_grid_align_items' => '',
                        'container_grid_justify_content' => '',
                        'container_grid_align_content' => '',
                        'container_grid_auto_columns' => '',
                        'container_grid_auto_rows' => '',
                        'container_grid_auto_flow' => '',
                        'container_grid_box_width' => '',
                        'container_grid_box_height' => '',
                        'container_grid_css' => '',

                        // Tablet
                        'container_tablet_enabled' => 'enabled',
                        'container_tablet_max_width' => '',
                        'container_tablet_float_css' => '',
                        'container_tablet_flex_css' => '',
                        'container_tablet_grid_css' => '',

                        // Mobile
                        'container_mobile_enabled' => 'enabled',
                        'container_mobile_max_width' => '',
                        'container_mobile_float_css' => '',
                        'container_mobile_flex_css' => '',
                        'container_mobile_grid_css' => '',

                        // Javascript
                        'js' => '',

                        // CSS
                        'css_custom' => '',

                        // Design
                        'css' => '',
                    ),
                    $atts
                )
            );

            
            $custom_css_class = vc_shortcode_custom_css_class( $css, ' ' );
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $custom_css_class,  $this->settings['   '],  $atts );
            $custom_css_class = '.' . str_replace(' ', '', $custom_css_class); // remove prefixed whitespace.

            $float_out = 'display: block; ';
            if ($container_float_width != '')  { $float_out .= 'width: '.  $container_float_width     .'; ' ; }
            if ($container_float_height != '') { $float_out .= 'height: '. $container_float_height    .'; ' ; }
            if ($container_float_direction)    { $float_out .= 'float: '.  $container_float_direction .'; ' ; }
            if ($container_float_clear != '')  { $float_out .= 'clear: '.  $container_float_clear     .'; ' ; }
            
            $flex_out = 'display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; ';
            if ($container_flex_direction != '')     { $flex_out .= 'flex-direction: '.  $container_flex_direction       .'; ' ; }
            if ($container_flex_wrap != '')          { $flex_out .= 'flex-wrap: ' .      $container_flex_wrap            .'; ' ; }
            if ($container_flex_justify != '')       { $flex_out .= 'justify-content: '. $container_flex_justify         .'; ' ; }
            if ($container_flex_align_items != '')   { $flex_out .= 'align-items: '.     $container_flex_align_items     .'; ' ; }
            if ($container_flex_align_content != '') { $flex_out .= 'align-content: '.   $container_flex_align_content   .'; ' ; }

            $grid_out = 'display: -ms-grid; display: grid;';
            if ($container_grid_template_columns != ''){ $grid_out .= 'grid-template-columns: '. $container_grid_template_columns .'; ' ; }
            if ($container_grid_template_rows != '')   { $grid_out .= 'grid-template-rows: '.    $container_grid_template_rows    .'; ' ; }
            if ($container_grid_template_areas != '')  { $grid_out .= 'grid-template-areas: '.   str_replace('``','"', $container_grid_template_areas)   .'; ' ; }
            if ($container_grid_column_gap != '')      { $grid_out .= 'grid-column-gap: '.       $container_grid_column_gap       .'; ' ; }
            if ($container_grid_row_gap != '')         { $grid_out .= 'grid-row-gap: '.          $container_grid_row_gap          .'; ' ; }
            if ($container_grid_justify_items != '')   { $grid_out .= 'justify-items: '.         $container_grid_justify_items    .'; ' ; }
            if ($container_grid_align_items != '')     { $grid_out .= 'align-items: '.           $container_grid_align_items      .'; ' ; }
            if ($container_grid_justify_content != '') { $grid_out .= 'justify-content: '.       $container_grid_justify_content  .'; ' ; }
            if ($container_grid_align_content != '')   { $grid_out .= 'align-content: '.         $container_grid_align_content    .'; ' ; }
            if ($container_grid_auto_columns != '')    { $grid_out .= 'grid-auto-columns: '.     $container_grid_auto_columns     .'; ' ; }
            if ($container_grid_auto_rows != '')       { $grid_out .= 'grid-auto-rows: '.        $container_grid_auto_rows        .'; ' ; }
            if ($container_grid_auto_flow != '')       { $grid_out .= 'grid-auto-flow: '.        $container_grid_auto_flow        .'; ' ; }
            if ($container_grid_box_width != '')       { $grid_out .= 'width: '.                $container_grid_box_width         .'; ' ; }
            if ($container_grid_box_height != '')      { $grid_out .= 'height: '.               $container_grid_box_height        .'; ' ; }
            

            //  ┌──────────────────────────────────────┐
            //  │         Start Output Buffer          │
            //  └──────────────────────────────────────┘
            ob_start();
            ?>
                <style>
                    <?php echo $custom_css_class; ?> { <?php echo $float_out; ?> 
                        <?php echo rawurldecode( base64_decode( $container_float_css ) ); ?>
                    }

                    <?php  if ($container_tablet_enabled == 'enabled'){ ?>
                        <?php  if ($container_tablet_max_width != ''){ 
                            echo '@media screen and (max-width:'. $container_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $container_tablet_float_css ) );
                            echo '}'; 
                        } ?>
                    <?php } ?>

                    <?php  if ($container_mobile_enabled == 'enabled'){ ?>
                        <?php  if ($container_mobile_max_width != ''){ 
                            echo '@media screen and (max-width:'. $container_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $container_mobile_float_css ) );
                            echo '}';  
                        } ?>
                    <?php } ?>


                    <?php  if ($container_flex_enabled == 'enabled'){ ?>
                        
                            <?php echo $custom_css_class; ?> { <?php echo $flex_out; ?> 
                                <?php echo rawurldecode( base64_decode( $container_flex_css ) ); ?>
                            } 
                        
                            <?php  if ($container_tablet_max_width != ''){ 
                                echo '@media screen and (max-width:'. $container_tablet_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $container_tablet_flex_css ) ); 
                                echo '}'; 
                            } ?>

                            <?php  if ($container_mobile_max_width != ''){ 
                                echo '@media screen and (max-width:'. $container_mobile_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $container_mobile_flex_css ) );
                                echo '}';  
                            } ?>

                    <?php } ?>


                    <?php  if ($container_grid_enabled == 'enabled'){ ?>
                        @supports (display: grid) {
                            <?php echo $custom_css_class; ?> { <?php echo $grid_out; ?> 
                                <?php echo rawurldecode( base64_decode( $container_grid_css ) ); ?>
                            }
                        }
                        
                            <?php  if ($container_tablet_max_width != ''){ 
                                echo '@supports (display: grid) {';
                                    echo '@media screen and (max-width:'. $container_tablet_max_width . ') { '; 
                                        echo rawurldecode( base64_decode( $container_tablet_grid_css ) ); 
                                    echo '}'; 
                                echo '}'; 
                            } ?>

                            <?php  if ($container_mobile_max_width != ''){
                                echo '@supports (display: grid) {'; 
                                    echo '@media screen and (max-width:'. $container_mobile_max_width . ') { '; 
                                        echo rawurldecode( base64_decode( $container_mobile_grid_css ) );
                                    echo '}';  
                                echo '}';  
                            } ?>

                    <?php } ?>
                    
                </style>

                <div class="c-hero-container <?php echo $css_class;?> <?php echo $chero_container_unique_class;?>">
                    <?php echo do_shortcode($content); ?>
                </div>

            <?php

                //  ┌────────────────────────────────────────────────┐
                //  │                                                │
                //  │       Insert Javascript into the footer        │
                //  │                                                │
                //  └────────────────────────────────────────────────┘
                if ($js != ""){
                    add_filter( 'wp_footer', function() use ( &$js) {
                        echo '<script>'. rawurldecode( base64_decode( $js ) ).'</script>';
                    }, 30);
                }
        
            return preg_replace('/\s+/', ' ', ob_get_clean());
            /* return normalize_whitespace( ob_get_clean() ); */

        }


        /*
        Load plugin css and javascript files which you may need on front end of your site
        */
        public function loadCssAndJs() {
            wp_register_style( 'vc_extend_style_cherocontainer', plugins_url('assets/vc_c-hero__container.css', __FILE__) );
            wp_enqueue_style( 'vc_extend_style_cherocontainer' );
        }



        /*
        Show notice if your plugin is activated but Visual Composer is not
        */
        public function showVcVersionNotice() {
            $plugin_data = get_plugin_data(__FILE__);
            echo '
            <div class="updated">
            <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
            </div>';
        }

    }

    new WPBakeryShortCode_cherocontainer();
}
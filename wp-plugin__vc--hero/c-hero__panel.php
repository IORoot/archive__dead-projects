<?php

// ┌─────────────────────────────────────┐ 
// │                                     │░
// │                                     │░
// │         LondonParkour C-Hero        │░
// │                                     │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// Example from https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/assets/

// don't load directly
if (!defined('ABSPATH')) die('-1');

add_action ( 'plugins_loaded', 'create_c_hero_panel', 10);

function create_c_hero_panel(){

    include_once('vc_map/c-hero__panel_vc_map.php');

    
    //  ┌──────────────────────────────────────┐
    //  │            C-Panel Class             │
    //  └──────────────────────────────────────┘
    class WPBakeryShortCode_chero_panel extends WPBakeryShortCode{

        function __construct() {

            // Use this when creating a shortcode addon
            add_shortcode( 'cheropanel', array( $this, 'renderShortcode' ) );
            
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
                        'panel_unique_class' => '',
                        'panel_additional_class' => '',

                        // Overlay
                        'panel_overlay_image' => '',
                        'panel_overlay_type' => '',
                        'panel_overlay_lazyload' => '',
                        'panel_overlay_css_custom' => '',

                        // Content
                        'panel_pre_content' => '',
                        'panel_pre_content_css_custom' => '',
                        'panel_content_css_custom' => '',
                        'panel_post_content' => '',
                        'panel_post_content_css_custom' => '',

                        // Floats
                        'panel_float_width' => '',
                        'panel_float_height' => '',
                        'panel_float_direction' => '',
                        'panel_float_clear' => '',
                        'panel_float_css' => '',

                        // Flexbox
                        'panel_flex_enabled' => 'disabled',
                        'panel_flex_order' => '',
                        'panel_flex_value' => '',
                        'panel_flex_align_self' => '',
                        'panel_flex_css' => '',
                        // Flexbox container
                        'panel_flex_container_enabled' => '',
                        'panel_flex_container_direction' => '',
                        'panel_flex_container_wrap' => '',
                        'panel_flex_container_justify' => '',
                        'panel_flex_container_align_items' => '',
                        'panel_flex_container_align_content' => '',

                        // Grid
                        'panel_grid_enabled' => '',
                        'panel_grid_column' => '',
                        'panel_grid_row' => '',
                        'panel_grid_area' => '',
                        'panel_grid_justify_self' => '',
                        'panel_grid_align_self' => '',
                        'panel_grid_width' => 'auto',
                        'panel_grid_height' => 'auto',
                        
                        // Subgrid
                        'panel_subgrid_template_columns' => '',
                        'panel_subgrid_template_rows' => '',
                        'panel_subgrid_template_areas' => '',
                        'panel_subgrid_column_gap' => '',
                        'panel_subgrid_row_gap' => '',
                        'panel_grid_css' => '',

                        // Tablet
                        'panel_tablet_enabled' => 'enabled',
                        'panel_tablet_max_width' => '',
                        'panel_tablet_float_css' => '',
                        'panel_tablet_flex_css' => '',
                        'panel_tablet_grid_css' => '',

                        // Mobile
                        'panel_mobile_enabled' => 'enabled',
                        'panel_mobile_max_width' => '',
                        'panel_mobile_float_css' => '',
                        'panel_mobile_flex_css' => '',
                        'panel_mobile_grid_css' => '',
                        
                        // JS
                        'panel_js_disable' => '',
                        'panel_js_disable_width' => '',
                        'panel_js' => '',

                        // custom CSS
                        'panel_css' => '',
                        'panel_css_custom' => '',

                    ),
                    $atts
                )
            );

            // Used for the CSS Design Tab that comes with WPBakery.
            $generated_class = vc_shortcode_custom_css_class( $panel_css, ' ' );
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $generated_class,  $this->settings['base'],  $atts );
            $generated_class = '.' . str_replace(' ','', $generated_class); // remove whitespace            

            $float_out = 'display: block; ';
            if ($panel_float_width != '')  { $float_out .= 'width: '.  $panel_float_width     .'; ' ; }
            if ($panel_float_height != '') { $float_out .= 'height: '. $panel_float_height    .'; ' ; }
            if ($panel_float_direction)    { $float_out .= 'float: '.  $panel_float_direction .'; ' ; }
            if ($panel_float_clear != '')  { $float_out .= 'clear: '.  $panel_float_clear     .'; ' ; }

            $flex_out = '';
            if ($panel_flex_order != '')     { $flex_out .= '-webkit-box-ordinal-group: '.  $panel_flex_order       .'; ' ; }
            if ($panel_flex_order != '')     { $flex_out .= '-moz-box-ordinal-group: '.     $panel_flex_order       .'; ' ; }
            if ($panel_flex_order != '')     { $flex_out .= '-ms-flex-order: '.             $panel_flex_order       .'; ' ; }
            if ($panel_flex_order != '')     { $flex_out .= '-webkit-order: '.              $panel_flex_order       .'; ' ; }
            if ($panel_flex_order != '')     { $flex_out .= 'order: '.                      $panel_flex_order       .'; ' ; }
            if ($panel_flex_value != '')     { $flex_out .= '-webkit-box-flex: ' .          $panel_flex_value       .'; ' ; }
            if ($panel_flex_value != '')     { $flex_out .= '-moz-box-flex: ' .             $panel_flex_value       .'; ' ; }
            if ($panel_flex_value != '')     { $flex_out .= '-webkit-flex: ' .              $panel_flex_value       .'; ' ; }
            if ($panel_flex_value != '')     { $flex_out .= '-ms-flex: ' .                  $panel_flex_value       .'; ' ; }
            if ($panel_flex_value != '')     { $flex_out .= 'flex: ' .                      $panel_flex_value       .'; ' ; }
            if ($panel_flex_align_self != ''){ $flex_out .= 'align-self: '.                 $panel_flex_align_self  .'; ' ; }
            
            if ($panel_flex_container_enabled != ''){       $flex_out .= 'display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; ' ; }
            if ($panel_flex_container_direction != ''){     $flex_out .= 'flex-direction: '.   $panel_flex_container_direction  .'; ' ; }
            if ($panel_flex_container_wrap != ''){          $flex_out .= 'flex-wrap: '.        $panel_flex_container_wrap  .'; ' ; }
            if ($panel_flex_container_justify != ''){       $flex_out .= 'justify-content: '.  $panel_flex_container_justify  .'; ' ; }
            if ($panel_flex_container_align_items != ''){   $flex_out .= 'align-items: '.      $panel_flex_container_align_items  .'; ' ; }
            if ($panel_flex_container_align_content != ''){ $flex_out .= 'align-content: '.    $panel_flex_container_align_content  .'; ' ; }


            $grid_out = '';
            if ($panel_grid_column != ''){       $grid_out .= 'grid-column: '.       $panel_grid_column  .'; ' ; }
            if ($panel_grid_row != ''){          $grid_out .= 'grid-row: '.          $panel_grid_row  .'; ' ; }
            if ($panel_grid_area != ''){         $grid_out .= 'grid-area: '.         $panel_grid_area  .'; ' ; }
            if ($panel_grid_justify_self != ''){ $grid_out .= 'justify-self: '.      $panel_grid_justify_self  .'; ' ; }
            if ($panel_grid_align_self != ''){   $grid_out .= 'align-self: '.        $panel_grid_align_self  .'; ' ; }
            if ($panel_grid_width != ''){        $grid_out .= 'width: '.             $panel_grid_width  .'; ' ; }
            if ($panel_grid_height != ''){       $grid_out .= 'height: '.            $panel_grid_height  .'; ' ; }

            if ($panel_subgrid_template_columns != ''){ $grid_out .= 'display: grid;' ; }
            if ($panel_subgrid_template_columns != ''){ $grid_out .= 'grid-template-columns: '. $panel_subgrid_template_columns  .'; ' ; }
            if ($panel_subgrid_template_rows != ''){    $grid_out .= 'grid-template-rows: '.    $panel_subgrid_template_rows  .'; ' ; }
            if ($panel_subgrid_template_areas != ''){   $grid_out .= 'grid-template-areas: '.   $panel_subgrid_template_areas  .'; ' ; }
            if ($panel_subgrid_column_gap != ''){       $grid_out .= 'grid-column-gap: '.       $panel_subgrid_column_gap  .'; ' ; }
            if ($panel_subgrid_row_gap != ''){          $grid_out .= 'grid-row-gap: '.          $panel_subgrid_row_gap  .'; ' ; }



            // Add 'dot' for class.
            $unique_class = '.'.$panel_unique_class;

            //  ┌──────────────────────────────────────┐
            //  │         Start Output Buffer          │
            //  └──────────────────────────────────────┘
            ob_start(); 
            
            ?>
                <?php echo '<style>'; ?>

                    <?php echo rawurldecode( base64_decode( $panel_pre_content_css_custom ) ); ?>

                    <?php if ($panel_overlay_type == 'background'){
                        echo $unique_class . ' .c-hero-panel__overlay';
                        if ($panel_overlay_lazyload){echo '.lazyloaded';}
                        echo '{';
                            echo $this->renderImage($panel_overlay_image,'background-image', true);
                        echo '}';
                    } ?>

                    <?php echo rawurldecode( base64_decode( $panel_overlay_css_custom ) ); ?>
                    <?php echo rawurldecode( base64_decode( $panel_content_css_custom ) ); ?>
                    <?php echo rawurldecode( base64_decode( $panel_post_content_css_custom ) ); ?>

                    /* -- Float -- */
                    <?php echo $unique_class . ' {'; ?> 
                        /* Float - Web */
                        <?php echo $float_out; ?> 
                    <?php echo ' }'; ?>
                    <?php echo rawurldecode( base64_decode( $panel_float_css ) ); ?>
                    
                    <?php  if ($panel_tablet_enabled == 'enabled'){ ?>
                        /* Float - Tablet */
                        <?php  if ($panel_tablet_max_width != '' && $panel_tablet_float_css != ''){ 
                            echo '@media screen and (max-width:'. $panel_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $panel_tablet_float_css ) );
                            echo '}'; 
                        } ?>
                    <?php } ?>
                    
                    <?php  if ($panel_mobile_enabled == 'enabled'){ ?>
                        /* Float - Mobile */
                        <?php  if ($panel_mobile_max_width != '' && $panel_mobile_float_css != ''){ 
                            echo '@media screen and (max-width:'. $panel_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $panel_mobile_float_css ) );
                            echo '}';  
                        } ?>
                    <?php } ?>
                    
                    /* -- Flex -- */
                    <?php  if ($panel_flex_enabled == 'enabled'){ ?>

                        <?php echo $unique_class; ?> { 
                            /* Flex - Web */
                            <?php echo $flex_out; ?> 
                        } 
                        <?php echo rawurldecode( base64_decode( $panel_flex_css ) ); ?>

                        <?php  if ($panel_tablet_max_width != '' && $panel_tablet_flex_css != ''){ 

                            /* Flex - Tablet */
                            echo '@media screen and (max-width:'. $panel_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $panel_tablet_flex_css ) ); 
                            echo '}'; 
                        } ?>

                        <?php  if ($panel_mobile_max_width != '' && $panel_mobile_flex_css != ''){ 

                            /* Flex - Mobile */
                            echo '@media screen and (max-width:'. $panel_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $panel_mobile_flex_css ) );
                            echo '}';  
                        } ?>

                    <?php } ?>
                    

                    /* -- Grid -- */
                    <?php  if ($panel_grid_enabled == ''){ ?>
                        @supports (display: grid) {
                            <?php echo $unique_class; ?> { 
                                <?php echo $grid_out; ?> 
                            } 
                            <?php echo rawurldecode( base64_decode( $panel_grid_css ) ); ?>
                        }

                        <?php  if ($panel_tablet_max_width != '' && $panel_tablet_grid_css != ''){ 

                            // Grid Tablet
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $panel_tablet_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $panel_tablet_grid_css ) ); 
                                echo '}'; 
                            echo '}'; 
                        } ?>

                        <?php  if ($panel_mobile_max_width != '' && $panel_mobile_grid_css != ''){ 

                            // Grid Mobile
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $panel_mobile_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $panel_mobile_grid_css ) );
                                echo '}';  
                            echo '}';  
                        } ?>
                        
                    <?php } ?> 

                    /* Custom CSS */
                    <?php echo rawurldecode( base64_decode( $panel_css_custom ) ); ?>
                    

                    <?php echo '</style>'; ?>


                
                <div class="c-hero-panel <?php echo esc_attr( $panel_unique_class ); ?> <?php echo esc_attr( $panel_additional_class ); ?> <?php echo esc_attr( $css_class ); ?> ">

                    <?php if ($panel_pre_content != '') {
                        echo '<div class="c-hero-panel__pre">';
                            echo rawurldecode( base64_decode( $panel_pre_content )); 
                        echo '</div>';
                    } ?>

                    <?php 
                        $lazyload = ($panel_overlay_lazyload ? 'lazyload' : '');
                        if ($panel_overlay_type == 'img') {
                        echo '<div class="c-hero-panel__overlay '.$lazyload.'"> ';
                            $this->renderImage($panel_overlay_image);
                        echo '</div>';
                    } else {
                        echo '<div class="c-hero-panel__overlay '.$lazyload.'"> ';
                        echo '</div>';
                    }?>

                    <?php if ($content != '') {
                        echo '<div class="c-hero-panel__content">';
                            echo $content; 
                        echo '</div>';
                    } ?>

                    <?php if ($panel_post_content != '') {
                        echo '<div class="c-hero-panel__post">';
                            echo rawurldecode( base64_decode( $panel_post_content )); 
                        echo '</div>';
                    } ?>

                </div>

            <?php

                //  ┌────────────────────────────────────────────────┐
                //  │                                                │
                //  │       Insert Javascript into the footer        │
                //  │                                                │
                //  └────────────────────────────────────────────────┘

                if ($panel_js != ""){
                    add_filter( 'wp_footer', function() use ( &$panel_js) {
                        echo '<script>';
                            echo rawurldecode( base64_decode( $panel_js ) );
                        echo '</script>';
                    }, 30);
                }
                
                    
            return ob_get_clean();

        }


        /**
         * Take the input ID and output an <IMG> tag or url().
         */
        public function renderImage($imageID, $extraClassName='background', $cssURL = false){

            $image_full = wp_get_attachment_image_src( $imageID, 'full' );

            // Use relative paths, not absolute.
            $relative_url = str_replace( get_site_url(), '', $image_full[0] );

            $image_output = '<img class="c-hero-panel__overlay" src="'. $relative_url .'" >';

            if($cssURL == true){
                $image_output = $extraClassName.': url("'. $relative_url .'") ;';
            } 
            
            echo $image_output;

            return;
        }


        /*
        Load plugin css and javascript files which you may need on front end of your site
        */
        public function loadCssAndJs() {
            wp_register_style( 'vc_extend_style_hero_panel', plugins_url('assets/vc_c-hero__panel.css', __FILE__) );
            wp_enqueue_style( 'vc_extend_style_hero_panel' );
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


    // Finally initialize code
    new WPBakeryShortCode_chero_panel();
    
}

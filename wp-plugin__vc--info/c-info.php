<?php
/*
Plugin Name: _ANDYP - WPBakery component : C-Info
Plugin URI: http://londonparkour.com
Description: <strong>🧩COMPONENT</strong> | <em>Edit Page > Visual Composer > LondonParkour </em> | LondonParkour Custom Visual Composer Component - Info
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/


// ┌─────────────────────────────────────┐ 
// │                                     │░
// │                                     │░
// │        LondonParkour C-Info         │░
// │                                     │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// Example from https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/assets/

// don't load directly
if (!defined('ABSPATH')) die('-1');

// ONLY Run this AFTER WPBakery is initialised, otherwise the class extension will not work.
add_action ( 'init', 'create_c_info', 100);


function create_c_info(){

	//  ┌────────────────────────────────────────────────┐
    //  │            Define the Info vc_map              │
    //  └────────────────────────────────────────────────┘
	include_once('vc_map/info_vc_map.php');
	
	//  ┌──────────────────────────────────────┐
	//  │             C-Info Class             │
	//  └──────────────────────────────────────┘
	class VC_C_Info {

		public function __construct() {
	
			// Use this when creating a shortcode addon
			add_shortcode( 'cinfo', array( $this, 'renderShortcode' ) );

			// Register CSS and JS
			add_action( 'get_footer', array( $this, 'loadCssAndJs' ) );
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
						'info_unique_class' => '',
						'info_additional_class' => '',

						// Overlay
						'info_overlay_image' => '',
						'info_overlay_type' => '',
						'info_overlay_lazyload' => '',
						'info_overlay_css_custom' => '',

						// Front
						'info_pre_content' => '',
						'info_pre_content_css_custom' => '',
						'info_content_css_custom' => '',
						'info_post_content' => '',
						'info_post_content_css_custom' => '',
						// back
						'info_back_panel' => 'enabled',
						'info_pre_back_content' => '',
						'info_pre_back_content_css_custom' => '',
						'info_back_content' => '',
						'info_back_content_css_custom' => '',
						'info_post_back_content' => '',
						'info_post_back_content_css_custom' => '',

						// Floats
						'info_float_width' => '',
						'info_float_height' => '',
						'info_float_direction' => '',
						'info_float_clear' => '',
						'info_float_css' => '',

						// Flexbox
						'info_flex_enabled' => 'disabled',
						'info_flex_order' => '',
						'info_flex_value' => '',
						'info_flex_align_self' => '',
						'info_flex_css' => '',
						// Flexbox container
						'info_flex_container_enabled' => '',
						'info_flex_container_direction' => '',
						'info_flex_container_wrap' => '',
						'info_flex_container_justify' => '',
						'info_flex_container_align_items' => '',
						'info_flex_container_align_content' => '',

						// Grid
						'info_grid_enabled' => '',
						
						// Subgrid
						'info_subgrid_template_columns' => '',
						'info_subgrid_template_rows' => '',
						'info_subgrid_template_areas' => '',
						'info_subgrid_column_gap' => '',
						'info_subgrid_row_gap' => '',
						'info_grid_css' => '',

						// Tablet
						'info_tablet_enabled' => 'enabled',
						'info_tablet_max_width' => '',
						'info_tablet_float_css' => '',
						'info_tablet_flex_css' => '',
						'info_tablet_grid_css' => '',

						// Mobile
						'info_mobile_enabled' => 'enabled',
						'info_mobile_max_width' => '',
						'info_mobile_float_css' => '',
						'info_mobile_flex_css' => '',
						'info_mobile_grid_css' => '',
						
						// JS
						'info_js' => '',

						// custom CSS
						'info_css' => '',
						'info_css_custom' => '',
					),
					$atts
				)
			);
		
            // Used for the CSS Design Tab that comes with WPBakery.
            $generated_class = vc_shortcode_custom_css_class( $info_css, ' ' );
            //$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $generated_class, $this->settings['base'], $attr );
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $generated_class, 'cinfo', $atts );
            $generated_class = '.' . str_replace(' ','', $generated_class); // remove whitespace

			$float_out = 'display: block; ';
            if ($info_float_width != '')  { $float_out .= 'width: '.  $info_float_width     .'; ' ; }
            if ($info_float_height != '') { $float_out .= 'height: '. $info_float_height    .'; ' ; }
            if ($info_float_direction)    { $float_out .= 'float: '.  $info_float_direction .'; ' ; }
            if ($info_float_clear != '')  { $float_out .= 'clear: '.  $info_float_clear     .'; ' ; }

            $flex_out = '';
            if ($info_flex_order != '')     { $flex_out .= '-webkit-box-ordinal-group: '.  $info_flex_order       .'; ' ; }
            if ($info_flex_order != '')     { $flex_out .= '-moz-box-ordinal-group: '.     $info_flex_order       .'; ' ; }
            if ($info_flex_order != '')     { $flex_out .= '-ms-flex-order: '.             $info_flex_order       .'; ' ; }
            if ($info_flex_order != '')     { $flex_out .= '-webkit-order: '.              $info_flex_order       .'; ' ; }
            if ($info_flex_order != '')     { $flex_out .= 'order: '.                      $info_flex_order       .'; ' ; }
            if ($info_flex_value != '')     { $flex_out .= '-webkit-box-flex: ' .          $info_flex_value       .'; ' ; }
            if ($info_flex_value != '')     { $flex_out .= '-moz-box-flex: ' .             $info_flex_value       .'; ' ; }
            if ($info_flex_value != '')     { $flex_out .= '-webkit-flex: ' .              $info_flex_value       .'; ' ; }
            if ($info_flex_value != '')     { $flex_out .= '-ms-flex: ' .                  $info_flex_value       .'; ' ; }
            if ($info_flex_value != '')     { $flex_out .= 'flex: ' .                      $info_flex_value       .'; ' ; }
            if ($info_flex_align_self != ''){ $flex_out .= 'align-self: '.                 $info_flex_align_self  .'; ' ; }
            
            if ($info_flex_container_enabled != ''){       $flex_out .= 'display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; ' ; }
            if ($info_flex_container_direction != ''){     $flex_out .= 'flex-direction: '.   $info_flex_container_direction  .'; ' ; }
            if ($info_flex_container_wrap != ''){          $flex_out .= 'flex-wrap: '.        $info_flex_container_wrap  .'; ' ; }
            if ($info_flex_container_justify != ''){       $flex_out .= 'justify-content: '.  $info_flex_container_justify  .'; ' ; }
            if ($info_flex_container_align_items != ''){   $flex_out .= 'align-items: '.      $info_flex_container_align_items  .'; ' ; }
            if ($info_flex_container_align_content != ''){ $flex_out .= 'align-content: '.    $info_flex_container_align_content  .'; ' ; }


            $grid_out = '';

            if ($info_subgrid_template_columns != ''){ $grid_out .= 'display: grid;' ; }
            if ($info_subgrid_template_columns != ''){ $grid_out .= 'grid-template-columns: '. $info_subgrid_template_columns  .'; ' ; }
            if ($info_subgrid_template_rows != ''){    $grid_out .= 'grid-template-rows: '.    $info_subgrid_template_rows  .'; ' ; }
            if ($info_subgrid_template_areas != ''){   $grid_out .= 'grid-template-areas: '.   $info_subgrid_template_areas  .'; ' ; }
            if ($info_subgrid_column_gap != ''){       $grid_out .= 'grid-column-gap: '.       $info_subgrid_column_gap  .'; ' ; }
            if ($info_subgrid_row_gap != ''){          $grid_out .= 'grid-row-gap: '.          $info_subgrid_row_gap  .'; ' ; }



            // Add 'dot' for class.
			$unique_class = '.'.$info_unique_class;
			
        	//  ┌──────────────────────────────────────┐
            //  │         Start Output Buffer          │
            //  └──────────────────────────────────────┘
            ob_start(); 
            
            ?>
                <?php echo '<style>'; ?>

                    <?php echo rawurldecode( base64_decode( $info_pre_content_css_custom ) ); ?>

                    <?php if ($info_overlay_type == 'background'){
						echo $unique_class . ' .c-info__overlay';
						if ($info_overlay_lazyload){echo '.lazyloaded';} 
						echo '{';
                            echo $this->renderImage($info_overlay_image,'background-image', true);
                        echo '}';
                    } ?>

                    <?php echo rawurldecode( base64_decode( $info_overlay_css_custom ) ); ?>
                    <?php echo rawurldecode( base64_decode( $info_content_css_custom ) ); ?>
					<?php echo rawurldecode( base64_decode( $info_post_content_css_custom ) ); ?>
					
					<?php echo rawurldecode( base64_decode( $info_pre_back_content_css_custom ) ); ?>
                    <?php echo rawurldecode( base64_decode( $info_back_content_css_custom ) ); ?>
					<?php echo rawurldecode( base64_decode( $info_post_back_content_css_custom ) ); ?>
					
                    /* -- Float -- */
                    <?php echo $unique_class . ' {'; ?> 
                        /* Float - Web */
                        <?php echo $float_out; ?> 
                    <?php echo ' }'; ?>
                    <?php echo rawurldecode( base64_decode( $info_float_css ) ); ?>
                    
                    <?php  if ($info_tablet_enabled == 'enabled'){ ?>
                        /* Float - Tablet */
                        <?php  if ($info_tablet_max_width != '' && $info_tablet_float_css != ''){ 
                            echo '@media screen and (max-width:'. $info_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $info_tablet_float_css ) );
                            echo '}'; 
                        } ?>
                    <?php } ?>
                    
                    <?php  if ($info_mobile_enabled == 'enabled'){ ?>
                        /* Float - Mobile */
                        <?php  if ($info_mobile_max_width != '' && $info_mobile_float_css != ''){ 
                            echo '@media screen and (max-width:'. $info_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $info_mobile_float_css ) );
                            echo '}';  
                        } ?>
                    <?php } ?>
                    
                    /* -- Flex -- */
                    <?php  if ($info_flex_enabled == 'enabled'){ ?>

                        <?php echo $unique_class; ?> { 
                            /* Flex - Web */
                            <?php echo $flex_out; ?> 
                        } 
                        <?php echo rawurldecode( base64_decode( $info_flex_css ) ); ?>

                        <?php  if ($info_tablet_max_width != '' && $info_tablet_flex_css != ''){ 

                            /* Flex - Tablet */
                            echo '@media screen and (max-width:'. $info_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $info_tablet_flex_css ) ); 
                            echo '}'; 
                        } ?>

                        <?php  if ($info_mobile_max_width != '' && $info_mobile_flex_css != ''){ 

                            /* Flex - Mobile */
                            echo '@media screen and (max-width:'. $info_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $info_mobile_flex_css ) );
                            echo '}';  
                        } ?>

                    <?php } ?>
                    

                    /* -- Grid -- */
                    <?php  if ($info_grid_enabled == ''){ ?>
                        @supports (display: grid) {
                            <?php echo $unique_class; ?> { 
                                <?php echo $grid_out; ?> 
                            } 
                            <?php echo rawurldecode( base64_decode( $info_grid_css ) ); ?>
                        }

                        <?php  if ($info_tablet_max_width != '' && $info_tablet_grid_css != ''){ 

                            // Grid Tablet
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $info_tablet_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $info_tablet_grid_css ) ); 
                                echo '}'; 
                            echo '}'; 
                        } ?>

                        <?php  if ($info_mobile_max_width != '' && $info_mobile_grid_css != ''){ 

                            // Grid Mobile
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $info_mobile_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $info_mobile_grid_css ) );
                                echo '}';  
                            echo '}';  
                        } ?>
                        
                    <?php } ?> 

                    /* Custom CSS */
                    <?php echo rawurldecode( base64_decode( $info_css_custom ) ); ?>
                    

                    <?php echo '</style>'; ?>


                
                <div class="c-info <?php echo esc_attr( $info_unique_class ); ?> <?php echo esc_attr( $info_additional_class ); ?> <?php echo esc_attr( $css_class ); ?> ">

						<div class="c-info__panel c-info__panel--front">

							<?php if ($info_pre_content != '') {
								echo '<div class="c-info__pre">';
									echo rawurldecode( base64_decode( $info_pre_content )); 
								echo '</div>';
							} ?>

							<?php 
							$lazyload = ($info_overlay_lazyload ? 'lazyload' : '');
							if ($info_overlay_type == 'img') {
								echo '<div class="c-info__overlay '.$lazyload.'"> ';
									$this->renderImage($info_overlay_image);
								echo '</div>';
							} else {
								echo '<div class="c-info__overlay '.$lazyload.'"> ';
								echo '</div>';
							}?>

							<?php if ($content != '') {
								echo '<div class="c-info__content">';
									echo $content; 
								echo '</div>';
							} ?> 

							<?php if ($info_post_content != '') {
								echo '<div class="c-info__post">';
									echo rawurldecode( base64_decode( $info_post_content )); 
								echo '</div>';
							} ?>
						</div>

						<?php if ($info_back_panel == 'enabled') { ?>

							<div class="c-info__panel c-info__panel--back">
								<?php if ($info_pre_back_content != '') {
									echo '<div class="c-info__pre--back">';
										echo rawurldecode( base64_decode( $info_pre_back_content )); 
									echo '</div>';
								} ?>

								<?php if ($info_back_content != '') {
									echo '<div class="c-info__content--back">';
										echo rawurldecode( base64_decode( $info_back_content )); 
									echo '</div>';
								} ?>

								<?php if ($info_post_back_content != '') {
									echo '<div class="c-info__post--back">';
										echo rawurldecode( base64_decode( $info_post_back_content )); 
									echo '</div>';
								} ?>
							</div>
							
						<?php } ?>
	

				</div>
				<div class="c-info__underlay"></div>

            <?php

                //  ┌────────────────────────────────────────────────┐
                //  │                                                │
                //  │       Insert Javascript into the footer        │
                //  │                                                │
                //  └────────────────────────────────────────────────┘
                if ($info_js != ""){
                    add_filter( 'wp_footer', function() use ( &$info_js) {
                        echo '<script>'. rawurldecode( base64_decode( $info_js ) ).'</script>';
                    }, 30);
                }
                    
            return ob_get_clean();

        }


        /**
         * Take the input ID and output an <IMG> tag or url().
         */
        public function renderImage($imageID, $extraClassName='background', $cssURL = false){

            $image_full = wp_get_attachment_image_src( $imageID, 'full' );

            $image_output = '<img class="c-info__overlay" src="'. $image_full[0] .'" >';

            if($cssURL == true){
                $image_output = $extraClassName.': url("'. $image_full[0] .'") ;';
            } 
            
            echo $image_output;

            return;
        }



		/*
		Load plugin css and javascript files which you may need on front end of your site
		*/
		public function loadCssAndJs() {
			wp_register_style( 'vc_extend_style_info', plugins_url('assets/vc_c-info.css', __FILE__) );
			wp_enqueue_style( 'vc_extend_style_info' );

			wp_enqueue_script( 'vc_extend_info_js', plugins_url('assets/vc_c-info.js', __FILE__), array('jquery'), false, true );
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
	new VC_C_Info();

}
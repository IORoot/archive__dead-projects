<?php
/*
Plugin Name: _ANDYP - WPBakery component : C-Media
Plugin URI: http://londonparkour.com
Description: <strong>🧩COMPONENT</strong> | <em>Edit Page > Visual Composer > LondonParkour </em> | LondonParkour Custom Visual Composer Component - Media
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/


// ┌─────────────────────────────────────┐ 
// │                                     │░
// │                                     │░
// │        LondonParkour C-Media        │░
// │                                     │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// Example from https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/assets/

// don't load directly
if (!defined('ABSPATH')) die('-1');

// ONLY Run this AFTER WPBakery is initialised, otherwise the class extension will not work.
add_action ( 'init', 'create_c_media', 100);


function create_c_media(){

	//  ┌────────────────────────────────────────────────┐
    //  │            Define the media vc_map              │
    //  └────────────────────────────────────────────────┘
	include_once('vc_map/media_vc_map.php');
	
	//  ┌──────────────────────────────────────┐
	//  │             C-media Class             │
	//  └──────────────────────────────────────┘
	class VC_C_media {

		function __construct() {
	
			// Use this when creating a shortcode addon
			add_shortcode( 'cmedia', array( $this, 'renderShortcode' ) );

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
						'media_unique_class' => '',
						'media_additional_class' => '',

						// Media
						'media_image_one_title' => '',
						'media_image_one' => '',
						'media_image_one_link_url' => '',
						'media_image_one_enable' => 'enabled',
						'media_image_one_background' => '',
						// two
						'media_image_two_title' => '',
						'media_image_two' => '',
						'media_image_two_link_url' => '',
						'media_image_two_enable' => 'disabled',
						'media_image_two_background' => '',
						// three
						'media_image_three_title' => '',
						'media_image_three' => '',
						'media_image_three_link_url' => '',
						'media_image_three_enable' => 'disabled',
						'media_image_three_background' => '',
						//four
						'media_image_four_title' => '',
						'media_image_four' => '',
						'media_image_four_link_url' => '',
						'media_image_four_enable' => 'disabled',
						'media_image_four_background' => '',
						// five
						'media_image_five_title' => '',
						'media_image_five' => '',
						'media_image_five_link_url' => '',
						'media_image_five_enable' => 'disabled',
						'media_image_five_background' => '',
						// custom css
						'media_list_css' => '',
						'media_media_css' => '',
						
						// Overlay
						'media_overlay_one_html' => '',
						'media_overlay_one_css' => '',

						// Floats
						'media_float_width' => '',
						'media_float_height' => '',
						'media_float_direction' => '',
						'media_float_clear' => '',
						'media_float_css' => '',

						// Flexbox
						'media_flex_enabled' => 'disabled',
						'media_flex_order' => '',
						'media_flex_value' => '',
						'media_flex_align_self' => '',
						'media_flex_css' => '',
						// Flexbox container
						'media_flex_container_enabled' => '',
						'media_flex_container_direction' => '',
						'media_flex_container_wrap' => '',
						'media_flex_container_justify' => '',
						'media_flex_container_align_items' => '',
						'media_flex_container_align_content' => '',

						// Grid
						'media_grid_enabled' => '',
						
						// Subgrid
						'media_subgrid_template_columns' => '',
						'media_subgrid_template_rows' => '',
						'media_subgrid_template_areas' => '',
						'media_subgrid_column_gap' => '',
						'media_subgrid_row_gap' => '',
						'media_grid_css' => '',

						// Tablet
						'media_tablet_enabled' => 'enabled',
						'media_tablet_max_width' => '',
						'media_tablet_float_css' => '',
						'media_tablet_flex_css' => '',
						'media_tablet_grid_css' => '',

						// Mobile
						'media_mobile_enabled' => 'enabled',
						'media_mobile_max_width' => '',
						'media_mobile_float_css' => '',
						'media_mobile_flex_css' => '',
						'media_mobile_grid_css' => '',
						
						// JS
						'media_js' => '',

						// custom CSS
						'media_css' => '',
						'media_css_custom' => '',
					),
					$atts
				)
			);
		
            // Used for the CSS Design Tab that comes with WPBakery.
            $generated_class = vc_shortcode_custom_css_class( $media_css, ' ' );
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $generated_class,  'cmedia',  $atts );
            $generated_class = '.' . str_replace(' ','', $generated_class); // remove whitespace

			$float_out = 'display: block; ';
            if ($media_float_width != '')  { $float_out .= 'width: '.  $media_float_width     .'; ' ; }
            if ($media_float_height != '') { $float_out .= 'height: '. $media_float_height    .'; ' ; }
            if ($media_float_direction)    { $float_out .= 'float: '.  $media_float_direction .'; ' ; }
            if ($media_float_clear != '')  { $float_out .= 'clear: '.  $media_float_clear     .'; ' ; }

            $flex_out = '';
            if ($media_flex_order != '')     { $flex_out .= '-webkit-box-ordinal-group: '.  $media_flex_order       .'; ' ; }
            if ($media_flex_order != '')     { $flex_out .= '-moz-box-ordinal-group: '.     $media_flex_order       .'; ' ; }
            if ($media_flex_order != '')     { $flex_out .= '-ms-flex-order: '.             $media_flex_order       .'; ' ; }
            if ($media_flex_order != '')     { $flex_out .= '-webkit-order: '.              $media_flex_order       .'; ' ; }
            if ($media_flex_order != '')     { $flex_out .= 'order: '.                      $media_flex_order       .'; ' ; }
            if ($media_flex_value != '')     { $flex_out .= '-webkit-box-flex: ' .          $media_flex_value       .'; ' ; }
            if ($media_flex_value != '')     { $flex_out .= '-moz-box-flex: ' .             $media_flex_value       .'; ' ; }
            if ($media_flex_value != '')     { $flex_out .= '-webkit-flex: ' .              $media_flex_value       .'; ' ; }
            if ($media_flex_value != '')     { $flex_out .= '-ms-flex: ' .                  $media_flex_value       .'; ' ; }
            if ($media_flex_value != '')     { $flex_out .= 'flex: ' .                      $media_flex_value       .'; ' ; }
            if ($media_flex_align_self != ''){ $flex_out .= 'align-self: '.                 $media_flex_align_self  .'; ' ; }
            
            if ($media_flex_container_enabled != ''){       $flex_out .= 'display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; ' ; }
            if ($media_flex_container_direction != ''){     $flex_out .= 'flex-direction: '.   $media_flex_container_direction  .'; ' ; }
            if ($media_flex_container_wrap != ''){          $flex_out .= 'flex-wrap: '.        $media_flex_container_wrap  .'; ' ; }
            if ($media_flex_container_justify != ''){       $flex_out .= 'justify-content: '.  $media_flex_container_justify  .'; ' ; }
            if ($media_flex_container_align_items != ''){   $flex_out .= 'align-items: '.      $media_flex_container_align_items  .'; ' ; }
            if ($media_flex_container_align_content != ''){ $flex_out .= 'align-content: '.    $media_flex_container_align_content  .'; ' ; }

            $grid_out = '';
            if ($media_subgrid_template_columns != ''){ $grid_out .= 'display: grid;' ; }
            if ($media_subgrid_template_columns != ''){ $grid_out .= 'grid-template-columns: '. $media_subgrid_template_columns  .'; ' ; }
            if ($media_subgrid_template_rows != ''){    $grid_out .= 'grid-template-rows: '.    $media_subgrid_template_rows  .'; ' ; }
            if ($media_subgrid_template_areas != ''){   $grid_out .= 'grid-template-areas: '.   $media_subgrid_template_areas  .'; ' ; }
            if ($media_subgrid_column_gap != ''){       $grid_out .= 'grid-column-gap: '.       $media_subgrid_column_gap  .'; ' ; }
            if ($media_subgrid_row_gap != ''){          $grid_out .= 'grid-row-gap: '.          $media_subgrid_row_gap  .'; ' ; }


			// remove any spaces from IDs
			$media_image_one_id = str_replace(' ', '-', $media_image_one_title);
			$media_image_two_id = str_replace(' ', '-', $media_image_two_title);
			$media_image_three_id = str_replace(' ', '-', $media_image_three_title);
			$media_image_four_id = str_replace(' ', '-', $media_image_four_title);
			$media_image_five_id = str_replace(' ', '-', $media_image_five_title);

            // Add 'dot' for class.
			$unique_class = '.'.$media_unique_class;
						
			$link_height = 0;
			if ($media_image_one_enable == 'enabled'){ $link_height += 87; }
			if ($media_image_two_enable == 'enabled'){ $link_height += 87; }
			if ($media_image_three_enable == 'enabled'){ $link_height += 87; }
			if ($media_image_four_enable == 'enabled'){ $link_height += 87; }
			if ($media_image_five_enable == 'enabled'){ $link_height += 87; }
			
        	//  ┌──────────────────────────────────────┐
            //  │         Start Output Buffer          │
            //  └──────────────────────────────────────┘
            ob_start(); 
            
            ?>
				<?php echo '<style>'; ?>
				
					<?php  echo $unique_class . ' .c-media__linklist { height: '.$link_height.'px; }'; ?>
					

					<?php if ($media_image_one != ''){
						echo $unique_class . ' .c-media__imageitem--' . $media_image_one_id; 
						echo '.lazyloaded {';
                            echo $this->renderImage($media_image_one, 'background-image', true);
                        echo '}';
					} ?>

					<?php if ($media_image_two != ''){
						echo $unique_class . ' .c-media__imageitem--' . $media_image_two_id;
						echo '.lazyloaded {';
                            echo $this->renderImage($media_image_two, 'background-image', true);
                        echo '}';
					} ?>

					<?php if ($media_image_three != ''){
						echo $unique_class . ' .c-media__imageitem--' . $media_image_three_id;
						echo '.lazyloaded {';
                            echo $this->renderImage($media_image_three, 'background-image', true);
                        echo '}';
					} ?>

					<?php if ($media_image_four != ''){
						echo $unique_class . ' .c-media__imageitem--' . $media_image_four_id;
						echo '.lazyloaded {';
                            echo $this->renderImage($media_image_four, 'background-image', true);
                        echo '}';
					} ?>

					<?php if ($media_image_five != ''){
						echo $unique_class . ' .c-media__imageitem--' . $media_image_five_id;
						echo '.lazyloaded {';
                            echo $this->renderImage($media_image_five, 'background-image', true);
                        echo '}';
					} ?>



					<?php if ($media_image_one_background != ''){
                        echo $unique_class . ' .c-media__link--' . $media_image_one_id . ' {';
                            echo 'outline-color:' . $media_image_one_background;
                        echo '}';
					} ?>
					<?php if ($media_image_two_background != ''){
                        echo $unique_class . ' .c-media__link--' . $media_image_two_id . ' {';
                            echo 'outline-color:' . $media_image_two_background;
                        echo '}';
					} ?>
					<?php if ($media_image_three_background != ''){
                        echo $unique_class . ' .c-media__link--' . $media_image_three_id . ' {';
                            echo 'outline-color:' . $media_image_three_background;
                        echo '}';
					} ?>
					<?php if ($media_image_four_background != ''){
                        echo $unique_class . ' .c-media__link--' . $media_image_four_id . ' {';
                            echo 'outline-color:' . $media_image_four_background;
                        echo '}';
					} ?>
					<?php if ($media_image_five_background != ''){
                        echo $unique_class . ' .c-media__link--' . $media_image_five_id . ' {';
                            echo 'outline-color:' . $media_image_five_background;
                        echo '}';
					} ?>

					<?php echo rawurldecode( base64_decode( $media_list_css ) ); ?>
					<?php echo rawurldecode( base64_decode( $media_media_css ) ); ?>

					<?php echo rawurldecode( base64_decode( $media_overlay_one_css ) ); ?>

                    /* -- Float -- */
                    <?php echo $unique_class . ' {'; ?> 
                        /* Float - Web */
                        <?php echo $float_out; ?> 
					<?php echo ' }'; ?>
					
                    <?php echo rawurldecode( base64_decode( $media_float_css ) ); ?>
                    
                    <?php  if ($media_tablet_enabled == 'enabled'){ ?>
                        /* Float - Tablet */
                        <?php  if ($media_tablet_max_width != '' && $media_tablet_float_css != ''){ 
                            echo '@media screen and (max-width:'. $media_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $media_tablet_float_css ) );
                            echo '}'; 
                        } ?>
                    <?php } ?>
                    
                    <?php  if ($media_mobile_enabled == 'enabled'){ ?>
                        /* Float - Mobile */
                        <?php  if ($media_mobile_max_width != '' && $media_mobile_float_css != ''){ 
                            echo '@media screen and (max-width:'. $media_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $media_mobile_float_css ) );
                            echo '}';  
                        } ?>
                    <?php } ?>
                    
                    /* -- Flex -- */
                    <?php  if ($media_flex_enabled == 'enabled'){ ?>

                        <?php echo $unique_class; ?> { 
                            /* Flex - Web */
                            <?php echo $flex_out; ?> 
                        } 
                        <?php echo rawurldecode( base64_decode( $media_flex_css ) ); ?>

                        <?php  if ($media_tablet_max_width != '' && $media_tablet_flex_css != ''){ 

                            /* Flex - Tablet */
                            echo '@media screen and (max-width:'. $media_tablet_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $media_tablet_flex_css ) ); 
                            echo '}'; 
                        } ?>

                        <?php  if ($media_mobile_max_width != '' && $media_mobile_flex_css != ''){ 

                            /* Flex - Mobile */
                            echo '@media screen and (max-width:'. $media_mobile_max_width . ') { '; 
                                echo rawurldecode( base64_decode( $media_mobile_flex_css ) );
                            echo '}';  
                        } ?>

                    <?php } ?>
                    

                    /* -- Grid -- */
                    <?php  if ($media_grid_enabled == ''){ ?>
                        @supports (display: grid) {
                            <?php echo $unique_class; ?> { 
                                <?php echo $grid_out; ?> 
                            } 
                            <?php echo rawurldecode( base64_decode( $media_grid_css ) ); ?>
                        }

                        <?php  if ($media_tablet_max_width != '' && $media_tablet_grid_css != ''){ 

                            // Grid Tablet
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $media_tablet_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $media_tablet_grid_css ) ); 
                                echo '}'; 
                            echo '}'; 
                        } ?>

                        <?php  if ($media_mobile_max_width != '' && $media_mobile_grid_css != ''){ 

                            // Grid Mobile
                            echo '@supports (display: grid) {';
                                echo '@media screen and (max-width:'. $media_mobile_max_width . ') { '; 
                                    echo rawurldecode( base64_decode( $media_mobile_grid_css ) );
                                echo '}';  
                            echo '}';  
                        } ?>
                        
                    <?php } ?> 

                    /* Custom CSS */
                    <?php echo rawurldecode( base64_decode( $media_css_custom ) ); ?>
                    

                    <?php echo '</style>'; ?>


                
                <div class="c-media <?php echo esc_attr( $media_unique_class ); ?> <?php echo esc_attr( $media_additional_class ); ?> <?php echo esc_attr( $css_class ); ?> ">

					<div class="c-media__links">

						<ul class="c-media__linklist">

							<?php  if ($media_image_one_enable == 'enabled'){ ?>
								<?php  if ($media_image_one_id != ''){ ?>
									<?php echo '<li>'; ?>
										<?php echo '<a class="c-media__link c-media__link--' . $media_image_one_id . '" id="' . $media_image_one_id . '">'.$media_image_one_title.'</a>'; ?>
									<?php echo '</li>'; ?>
								<?php } ?>
							<?php } ?>


							<?php  if ($media_image_two_enable == 'enabled'){ ?>
								<?php  if ($media_image_two_id != ''){ ?>
									<?php echo '<li>'; ?>
										<?php echo '<a class="c-media__link c-media__link--' . $media_image_two_id . '" id="' . $media_image_two_id . '">'.$media_image_two_title.'</a>'; ?>
									<?php echo '</li>'; ?>
								<?php } ?>
							<?php } ?>

							<?php  if ($media_image_three_enable == 'enabled'){ ?>
								<?php  if ($media_image_three_id != ''){ ?>
									<?php echo '<li>'; ?>
										<?php echo '<a class="c-media__link c-media__link--' . $media_image_three_id . '" id="' . $media_image_three_id . '">'.$media_image_three_title.'</a>'; ?>
									<?php echo '</li>'; ?>
								<?php } ?>
							<?php } ?>

							<?php  if ($media_image_four_enable == 'enabled'){ ?>
								<?php  if ($media_image_four_id != ''){ ?>
									<?php echo '<li>'; ?>
										<?php echo '<a class="c-media__link c-media__link--' . $media_image_four_id . '" id="' . $media_image_four_id . '">'.$media_image_four_title.'</a>'; ?>
									<?php echo '</li>'; ?>
								<?php } ?>
							<?php } ?>

							<?php  if ($media_image_five_enable == 'enabled'){ ?>
								<?php  if ($media_image_five_id != ''){ ?>
									<?php echo '<li>'; ?>
										<?php echo '<a class="c-media__link c-media__link--' . $media_image_five_id . '" id="' . $media_image_five_id . '">'.$media_image_five_title.'</a>'; ?>
									<?php echo '</li>'; ?>
								<?php } ?>
							<?php } ?>

						</ul>

					</div>
	
					<div class="c-media__media">

						<?php echo rawurldecode( base64_decode( $media_overlay_one_html) ); ?>
						
						<?php  if ($media_image_one_enable == 'enabled'){ ?>					
							<?php  if ($media_image_one_link_url != ''){ echo $this->buildImageLink($media_image_one_link_url, 'c-media__external--one', $css_class); } ?>
								<?php echo '<div id="' . $media_image_one_id . '" class="c-media__imageitem lazyload c-media__imageitem--' . $media_image_one_id . '"></div>'; ?>
							<?php  if ($media_image_one_link_url != ''){ echo '</a>'; }?>
						<?php } ?>		


						<?php  if ($media_image_two_enable == 'enabled'){ ?>					
							<?php  if ($media_image_two_link_url != ''){ echo $this->buildImageLink($media_image_two_link_url, 'c-media__external--two', $css_class); } ?>
								<?php echo '<div id="' . $media_image_two_id . '" class="c-media__imageitem lazyload c-media__imageitem--' . $media_image_two_id . '"></div>'; ?>
							<?php  if ($media_image_two_link_url != ''){ echo '</a>'; }?>
						<?php } ?>	

						<?php  if ($media_image_three_enable == 'enabled'){ ?>					
							<?php  if ($media_image_three_link_url != ''){ echo $this->buildImageLink($media_image_three_link_url, 'c-media__external--three', $css_class); } ?>
								<?php echo '<div id="' . $media_image_three_id . '" class="c-media__imageitem lazyload c-media__imageitem--' . $media_image_three_id . '"></div>'; ?>
							<?php  if ($media_image_three_link_url != ''){ echo '</a>'; }?>
						<?php } ?>	

						<?php  if ($media_image_four_enable == 'enabled'){ ?>					
							<?php  if ($media_image_four_link_url != ''){ echo $this->buildImageLink($media_image_four_link_url, 'c-media__external--four', $css_class); } ?>
								<?php echo '<div id="' . $media_image_four_id . '" class="c-media__imageitem lazyload c-media__imageitem--' . $media_image_four_id . '"></div>'; ?>
							<?php  if ($media_image_four_link_url != ''){ echo '</a>'; }?>
						<?php } ?>	

						<?php  if ($media_image_five_enable == 'enabled'){ ?>					
							<?php  if ($media_image_five_link_url != ''){ echo $this->buildImageLink($media_image_five_link_url, 'c-media__external--five', $css_class); } ?>
								<?php echo '<div id="' . $media_image_five_id . '" class="c-media__imageitem lazyload c-media__imageitem--' . $media_image_five_id . '"></div>'; ?>
							<?php  if ($media_image_five_link_url != ''){ echo '</a>'; }?>
						<?php } ?>	

					</div>

				</div>

            <?php

                //  ┌────────────────────────────────────────────────┐
                //  │                                                │
                //  │       Insert Javascript into the footer        │
                //  │                                                │
                //  └────────────────────────────────────────────────┘
                if ($media_js != ""){
                    add_filter( 'wp_footer', function() use ( &$media_js) {
                        echo '<script>'. rawurldecode( base64_decode( $media_js ) ).'</script>';
                    }, 30);
                }
                    
            return ob_get_clean();

        }

		public function buildImageLink($link, $unique_class, $css_class){

			// Use the link builder element to create the URL link.
			$href = vc_build_link( $link, true );

			if ($href['url'] != "") { 
				$output = '<a class="c-media__external '.$unique_class .' '. esc_attr( $css_class ).'" href="'.$href['url'].'" title="'.$href['title'].'" target="'.$href['target'].'" rel="'.$href['rel'].'">';
			} 

			return $output;
		}


        /**
         * Take the input ID and output an <IMG> tag or url().
         */
        public function renderImage($imageID, $extraClassName='background', $cssURL = false){

            $image_full = wp_get_attachment_image_src( $imageID, 'full' );

            $image_output = '<img class="c-media__image" src="'. $image_full[0] .'" >';

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
			wp_register_style( 'vc_extend_style_media', plugins_url('assets/vc_c-media.css', __FILE__) );
			wp_enqueue_style( 'vc_extend_style_media' );

			wp_enqueue_script( 'vc_extend_media_js', plugins_url('assets/vc_c-media.js', __FILE__), array('jquery'), false, true );
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
	new VC_C_media();

}
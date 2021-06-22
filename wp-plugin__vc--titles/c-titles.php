<?php
/*
Plugin Name: _ANDYP - WPBakery component : C-Title
Plugin URI: http://londonparkour.com
Description: <strong>🧩COMPONENT</strong> | <em>Edit Page > Visual Composer > LondonParkour </em> | LondonParkour Custom Visual Composer Component - Title
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

// ┌─────────────────────────────────────┐ 
// │                                     │░
// │                                     │░
// │        LondonParkour C-Title        │░
// │                                     │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// Example from https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/assets/

// don't load directly
if (!defined('ABSPATH')) die('-1');


//  ┌──────────────────────────────────────┐
//  │            C-Panel Class             │
//  └──────────────────────────────────────┘
class VC_C_Title {

    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'ctitle', array( $this, 'renderShortcode' ) );

        // Register CSS and JS
        add_action( 'get_footer', array( $this, 'loadCssAndJs' ) );
    }
 



    public function integrateWithVC() {

        // Check if WPBakery Page Builder is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Extend WPBakery Page Builder is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

		//  ┌──────────────────────────────────────┐
		//  │         Create the VC Inputs         │
		//  └──────────────────────────────────────┘
        vc_map( array(
            "name" => __("C-Title", 'vc_extend'),
            "description" => __("Component - Title", 'vc_extend'),
            "base" => "ctitle",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/ldnpk.png', __FILE__), // or css class name which you can refer in your css file later. Example: "vc_extend_my_class"
            "category" => __('LondonParkour', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(

				//  ┌──────────────────────────────────────┐
				//  │                                      │
				//  │        GENERAL PANEL SETTINGS        │
				//  │                                      │
				//  └──────────────────────────────────────┘

					//  ┌──────────────────────────────────────┐
					//  │              Unique ID               │
					//  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "holder" => "div",		// used to display on edit page.
                            "heading" => __("Unique Class Name", 'vc_extend'),
                            "param_name" => "unique_identifier",
                            "value" => __("Title-001", 'vc_extend'),
                            "description" => __("This is a unique identifier class nane for CSS to target this Title.", 'vc_extend')
                        ),
                        
                    
                    //  ┌──────────────────────────────────────┐
					//  │              Content                 │
					//  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_html",
                            "heading" => __("Content", 'vc_extend'),
                            "param_name" => "content",
                            "value" => __("<h1>Title</h1><p>Subtext goes here.</p>", 'vc_extend'),
                            "description" => __("Use utility classes (mt__1, mb__1, pt__4, pb__3) for spacing", 'vc_extend')
                        ),
                    

                //  ┌──────────────────────────────────────┐
				//  │                                      │
				//  │              CSS Design              │
				//  │                                      │
                //  └──────────────────────────────────────┘	
                
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'Css', 'my-text-domain' ),
                        'param_name' => 'css',
                        'group' => __( 'Design options', 'my-text-domain' ),
                    ),
            )
        ) );
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
					'unique_identifier' => '',
		
					// Design
					'css' => '',
				),
				$atts
			)
		);
	
		// Used for the CSS Design Tab that comes with WPBakery.
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ctitle', $atts );

		// Add the prefix on.
		$class_id = '.c-title-'.$unique_identifier;

            
		//  ┌──────────────────────────────────────┐
		//  │         Start Output Buffer          │
		//  └──────────────────────────────────────┘
		ob_start(); 
		?>
            <div class="c-title <?php echo 'c-title-'.$unique_identifier; ?> <?php echo esc_attr( $css_class ); ?> ">
                <div class="c-title__content"><?php echo $content; ?></div>
			</div>
		<?php

		return ob_get_clean();

    }





    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function loadCssAndJs() {
      wp_register_style( 'vc_extend_style_title', plugins_url('assets/vc_c-title.css', __FILE__) );
      wp_enqueue_style( 'vc_extend_style_title' );
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
new VC_C_Title();
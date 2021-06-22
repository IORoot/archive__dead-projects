<?php

/**
 * Include ACF into plugin.
 * 
 */

if( function_exists('acf_add_options_page') ) {
    
    $args = array(

        'page_title' => 'Oubound Settings',
        'menu_title' => 'Oubound Settings',
        'menu_slug' => 'outbound_settings',
        'capability' => 'manage_options',
        'position' => '100.1',
        'parent_slug' => 'edit.php?post_type=outbound_post',
        'icon_url' => 'dashicons-screenoptions',
        'redirect' => true,
        'post_id' => 'options',
        'autoload' => false,
        'update_button'		=> __('Update', 'acf'),
        'updated_message'	=> __("Options Updated", 'acf'),
    );

    /**
     * Create a new options page.
     */
    acf_add_options_sub_page($args);
    
}


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                            Load the CSS & JS                            │
//  └─────────────────────────────────────────────────────────────────────────┘

add_action( 'admin_enqueue_scripts', 'loadOutboundCssAndJs' );

function loadOutboundCssAndJs() {
    wp_register_style( 'load_outbound_css', plugins_url('andyp_outbound/src/css/admin.css') );
    wp_enqueue_style( 'load_outbound_css' );

    //wp_enqueue_script( 'vc_extend_media_js', plugins_url('assets/vc_c-media.js', __FILE__), array('jquery'), false, true );
}

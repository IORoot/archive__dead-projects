<?php


add_action('acf/init', 'menu_isotope');

function menu_isotope(){

    if (function_exists('acf_add_options_page')) {
        $args = array(

            'page_title' => '<svg viewBox="0 0 24 24" style="height:1.3em; vertical-align:text-bottom; fill:#FF80AB;" xmlns="http://www.w3.org/2000/svg"><path d="M10,4V8H14V4H10M16,4V8H20V4H16M16,10V14H20V10H16M16,16V20H20V16H16M14,20V16H10V20H14M8,20V16H4V20H8M8,14V10H4V14H8M8,8V4H4V8H8M10,14H14V10H10V14M4,2H20A2,2 0 0,1 22,4V20A2,2 0 0,1 20,22H4C2.92,22 2,21.1 2,20V4A2,2 0 0,1 4,2Z"/></svg> Metafizzy Isotope',
            'menu_title' => '<svg viewBox="0 0 24 24" style="height:1.3em; vertical-align:text-bottom; fill:#FF80AB;" xmlns="http://www.w3.org/2000/svg"><path d="M10,4V8H14V4H10M16,4V8H20V4H16M16,10V14H20V10H16M16,16V20H20V16H16M14,20V16H10V20H14M8,20V16H4V20H8M8,14V10H4V14H8M8,8V4H4V8H8M10,14H14V10H10V14M4,2H20A2,2 0 0,1 22,4V20A2,2 0 0,1 20,22H4C2.92,22 2,21.1 2,20V4A2,2 0 0,1 4,2Z"/></svg> Metafizzy Isotope',
            'menu_slug' => 'isotopeshortcodes',
            'capability' => 'manage_options',
            'position' => 4,
            'parent_slug' => 'andyp',
            'icon_url' => 'dashicons-screenoptions',
            'redirect' => true,
            'post_id' => 'options',
            'autoload' => false,
            'update_button'		=> __('Update', 'acf'),
            'updated_message'	=> __("Options Updated", 'acf'),
        );

        acf_add_options_sub_page($args);
    }

}
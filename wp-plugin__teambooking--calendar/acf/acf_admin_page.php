<?php

/**
 * Include ACF into plugin.
 * 
 */

// Create New Menu
if( function_exists('acf_add_options_page') ) {
    
    $args = array(

        'page_title' => 'Schema Event Images',
        'menu_title' => 'Schema Event Images',
        'menu_slug' => 'schemaimages',
        'capability' => 'manage_options',
        'position' => '100.3',
        'parent_slug' => 'team-booking',
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


/**
 * Create the ACF Panel under TeamBooking.
 */
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e457be345dba',
        'title' => 'TeamBooking Schema Event Images',
        'fields' => array(
            array(
                'key' => 'field_5e457c40de7ed',
                'label' => 'Schema Item',
                'name' => 'schema_item',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'hide_admin' => 0,
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e457d43de7ee',
                        'label' => 'Service ID',
                        'name' => 'service_id',
                        'type' => 'text',
                        'instructions' => 'Use the service Class event ID from Teambooking. i.e. \'parkour-class\'',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '20',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5e457d67de7ef',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'The image to include in the Schema for this Event.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '80',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'schemaimages',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'The images to use within the schema for each class/service type.',
    ));
    
    endif;
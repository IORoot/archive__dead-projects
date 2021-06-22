<?php

// Create New Menu
if( function_exists('acf_add_options_page') ) {
    
    $args = array(

        'page_title' => 'Loyalty Counter',
        'menu_title' => 'Loyalty Counter',
        'menu_slug' => 'loyaltycounter',
        'capability' => 'manage_options',
        'position' => '100.2',
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


// Create Admin Page Elements
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e209cc02834a',
        'title' => 'Loyalty Counter',
        'fields' => array(
            array(
                'key' => 'field_5e209d7b36ece',
                'label' => 'Reservation',
                'name' => 'reservation',
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
                        'key' => 'field_5e209d8936ecf',
                        'label' => 'ID',
                        'name' => 'id',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '7',
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
                        'key' => 'field_5e209df736ed6',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '21',
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
                        'key' => 'field_5e209e0336ed7',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '28',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_5e209e1136ed8',
                        'label' => 'Last Class',
                        'name' => 'last_class',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '21',
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
                        'key' => 'field_5e209e2036ed9',
                        'label' => 'Class Count',
                        'name' => 'class_count',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '7',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5e209e2f36eda',
                        'label' => 'Class TimeAgo',
                        'name' => 'class_timeago',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '14',
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
                        'key' => 'field_5e209e4136edb',
                        'label' => 'Free Classes',
                        'name' => 'free_classes',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '7',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'loyaltycounter',
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
        'description' => '',
    ));
    
    endif;


// Load into ACF
add_filter('acf/load_value/name=reservation', 'my_free_class_values', 10, 3);

function my_free_class_values($value, $post_id, $field) {


    /**
     * REMOVED FOR NOW - THIS WILL ALLOW YOU TO SAVE ENTRIES, BUT ALSO WILL NOT
     * UPDATE NEWER ENTRIES. NEEDS FIXING.
     */
    // if (!empty($value)) {
    //     // if the value is exactly NULL it means
    //     // the field has never been updated
    //     // we don't want to change fields that have already been editied
    //     return $value;
    // }

    $lc = new tbk_loyalty_counter;
    $lc->output_reservations();
    return $lc->get_acf_rows();
}


/**
 * Add the widget on dashboard setup page.
 */
add_action('wp_dashboard_setup', 'loyalty_widget');

/**
 * Create a widget
 */
function loyalty_widget() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_loyalty_widget', 'Free Loyalty Classes', 'loyalty_free_class_widget');
}

/**
 * Output the details of this function to widget
 */
function loyalty_free_class_widget(){
    $lc = new tbk_loyalty_counter;
    $lc->output_widget();
    $rows = $lc->get_widget_rows();

    echo '<table>';

    foreach ($rows as $row){

        $bg = '#E0E0E0';
        if ($row['free'] == 1){ $bg = '#FCC53B'; }
        if ($row['free'] == 2){ $bg = '#38EF7D'; }
        if ($row['free'] == 3){ $bg = '#D0C8B3'; }
        if ($row['free'] == 4){ $bg = '#27C9C1'; }
        if ($row['free'] == 5){ $bg = '#ED64AF'; }

        echo '<tr>';
            echo '<td>';
                echo $row['name'];
            echo '</td>';
            echo '<td>';
                echo $row['email'];
            echo '</td>';
            echo '<td>';
                echo $row['total'];
            echo '</td>';
            echo '<td style="background-color:'.$bg.'">';
                echo $row['free'];
            echo '</td>';
        echo '</tr>';
    }
    echo '</table>';

    return;
}
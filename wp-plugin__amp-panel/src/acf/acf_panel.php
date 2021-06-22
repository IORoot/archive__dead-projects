<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5da73e2725954',
        'title' => 'AMP post/page panel',
        'fields' => array(
            array(
                'key' => 'field_5da73eace91aa',
                'label' => 'Canonical Link',
                'name' => 'canonical_link',
                'type' => 'link',
                'instructions' => 'This is the (Canonical) HTML page that the AMP page is connected to.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_5da95ffe1f6c0',
                'label' => 'AMP Link',
                'name' => 'amp_link',
                'type' => 'link',
                'instructions' => 'This is the (AMPHTML) page that the HTML page is connected to. This is placed on the NORMAL page.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_5da742551b45b',
                'label' => 'JSON Schema',
                'name' => 'json_schema',
                'type' => 'textarea',
                'instructions' => 'Any JSON-formatted Schema to add into the AMP page HEAD',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '{
                    "@context": "http://schema.org",
                    "@type": "NewsArticle",
                    "headline": "LondonParkour",
                    "datePublished": "2015-10-07T12:02:41Z",
                    "image": [ "/wp-content/uploads/2019/10/LDNPK_AMP_BlackTXT_190x36.png" ]
    }',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_5daab994724c7',
                'label' => 'AMP CSS file',
                'name' => 'amp_css_file',
                'type' => 'text',
                'instructions' => 'This is the name of the CSS file you wish to use under the current theme directory. So If your file is: `/domain.com/wp-contents/themes/mytheme/sass/style.css`, you\'ll want to put `sass/style.css` (no leading slash).',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5da744f78cc52',
                'label' => 'AMP CSS',
                'name' => 'amp_css',
                'type' => 'textarea',
                'instructions' => 'Any CSS to add into the HEAD. This is loaded AFTER the specified CSS file in the previous textbox.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '100',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
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
        'description' => 'Populate the details of the AMP template',
    ));
    
    endif;
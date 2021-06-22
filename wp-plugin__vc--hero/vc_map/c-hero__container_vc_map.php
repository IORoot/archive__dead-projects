<?php

    vc_map( array(
        "name" => __("C-Hero Grid Container", 'vc_extend'),
        "description" => __("Component - Hero Container (v2)", 'vc_extend'),
        "base" => "cherocontainer",
        "class" => "",
        'as_parent' => array('only' => 'cheropanel'),
        "is_container" => true,
        "js_view" => 'VcColumnView',
        "controls" => "full",
        "category" => __('LondonParkour', 'js_composer'),
        //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
        //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
        "params" => array(
    
                //  ┌──────────────────────────────────────┐
                //  │              Unique ID               │
                //  └──────────────────────────────────────┘
                array(
                    "type" => "textfield",
                    "holder" => "div",		// used to display on edit page.
                    "heading" => __("Unique Class Name (c-hero-container__?) *REQUIRED*", 'vc_extend'),
                    "param_name" => "chero_container_unique_class",
                    "value" => __("", 'vc_extend'),
                    "description" => __("Unique Class to target. Will create : .c-hero-container__[classname]", 'vc_extend')
                ),

                //  ┌──────────────────────────────────────┐
                //  │                                      │
                //  │               GENERAL                │
                //  │                                      │
                //  └──────────────────────────────────────┘

                        //  ┌──────────────────────────────────────┐
                        //  │           Container Width            │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("1.1 Box Width", 'vc_extend'),
                            "param_name" => "container_float_width",
                            "value" => __("", 'vc_extend'),
                            "description" => __("( px / % / em ) only.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-3"),
                        ),
                        
                        //  ┌──────────────────────────────────────┐
                        //  │           Container height           │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("1.2 Box Height", 'vc_extend'),
                            "param_name" => "container_float_height",
                            "value" => __("", 'vc_extend'),
                            "description" => __("( px / % / em ) only", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-3"),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │          Float Direction             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("1.3 Float Direction", 'vc_extend'),
                            "param_name" => "container_float_direction",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'Left',  "my-text-domain"  ) => 'left',
                                __( 'Right',  "my-text-domain"  ) => 'right',
                                __( 'None',  "my-text-domain"  ) => 'none',
                            ),
                            "description" => __("Left, Right, None", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-3"),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │             Float Clear              │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("1.4 Float Clear", 'vc_extend'),
                            "param_name" => "container_float_clear",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'None',  "my-text-domain"  ) => 'none',
                                __( 'Left',  "my-text-domain"  ) => 'left',
                                __( 'Right',  "my-text-domain"  ) => 'right',
                                __( 'Both',  "my-text-domain"  ) => 'both',
                                __( 'Inherit',  "my-text-domain"  ) => 'inherit',
                            ),
                            "description" => __("Left, Right, None", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-3"),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │                 CSS                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("1.5 Additional CSS RULES (just add rules)", 'vc_extend'),
                            "param_name" => "container_float_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __(".hero-container{...}", 'vc_extend'),
                        ),  
                
                //  ┌──────────────────────────────────────┐
                //  │                                      │
                //  │                 FLEX                 │
                //  │                                      │
                //  └──────────────────────────────────────┘

                        //  ┌──────────────────────────────────────┐
                        //  │                Flex                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2. Flex (disabled by default)", 'vc_extend'),
                            "param_name" => "container_flex_enabled",
                            'value' => array(
                                __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                                __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                            ),
                            "description" => __("Flexbox Enabled.", 'vc_extend'),
                            "group" => __("< Flex", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │           Flex-Direction             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2.1 Flex Direction", 'vc_extend'),
                            "param_name" => "container_flex_direction",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'Row',  "my-text-domain"  ) => 'row',
                                __( 'Row-Reverse',  "my-text-domain"  ) => 'row-reverse',
                                __( 'Column',  "my-text-domain"  ) => 'column',
                                __( 'Column-Reverse',  "my-text-domain"  ) => 'column-reverse',
                            ),
                            "description" => __("Flexbox direction.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Flex", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │              Flex-Wrap               │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2.2 Flex <br/>Wrap", 'vc_extend'),
                            "param_name" => "container_flex_wrap",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'nowrap',  "my-text-domain"  ) => 'nowrap',
                                __( 'wrap',  "my-text-domain"  ) => 'wrap',
                                __( 'wrap-reverse',  "my-text-domain"  ) => 'wrap-reverse',
                            ),
                            "description" => __("Flexbox wrapping.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Flex", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │             Flex-Justify             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2.3 Flex <br/>Justify", 'vc_extend'),
                            "param_name" => "container_flex_justify",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'flex-start',  "my-text-domain"  ) => 'flex-start',
                                __( 'flex-end',  "my-text-domain"  ) => 'flex-end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                                __( 'space-between',  "my-text-domain"  ) => 'space-between',
                                __( 'space-around',  "my-text-domain"  ) => 'space-around',
                                __( 'space-evenly',  "my-text-domain"  ) => 'space-evenly',
                            ),
                            "description" => __("Flexbox Justify Content.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Flex", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │           Flex-Align Items           │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2.4 Flex Align Items", 'vc_extend'),
                            "param_name" => "container_flex_align_items",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'flex-start',  "my-text-domain"  ) => 'flex-start',
                                __( 'flex-end',  "my-text-domain"  ) => 'flex-end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                                __( 'baseline',  "my-text-domain"  ) => 'baseline',
                            ),
                            "description" => __("Flexbox Align Items.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Flex", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │          Flex-Align Content          │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("2.4 Flex Align Content", 'vc_extend'),
                            "param_name" => "container_flex_align_content",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'flex-start',  "my-text-domain"  ) => 'flex-start',
                                __( 'flex-end',  "my-text-domain"  ) => 'flex-end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                                __( 'space-between',  "my-text-domain"  ) => 'space-between',
                                __( 'space-around',  "my-text-domain"  ) => 'space-around',
                            ),
                            "description" => __("Flexbox Align Content.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Flex", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │                 CSS                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("2.7 Additional CSS RULES (just add rules)", 'vc_extend'),
                            "param_name" => "container_flex_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("NO @supports(display:flex){  } RULES surround these.", 'vc_extend'),
                            "group" => __("< Flex", 'vc_extend'),
                        ),  
                        

                //  ┌──────────────────────────────────────┐
                //  │                                      │
                //  │                 GRID                 │
                //  │                                      │
                //  └──────────────────────────────────────┘

                        //  ┌──────────────────────────────────────┐
                        //  │                Grid                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("3. Grid (will be in a @supports(display:grid) query)", 'vc_extend'),
                            "param_name" => "container_grid_enabled",
                            'value' => array(
                                __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                                __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            ),
                            "description" => __("Grid rules in CSS.", 'vc_extend'),
                            "group" => __("< Grid", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │       Grid Template Columns          │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.1 Grid Template Columns", 'vc_extend'),
                            "param_name" => "container_grid_template_columns",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │         Grid Template Rows           │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.2 Grid Template Rows", 'vc_extend'),
                            "param_name" => "container_grid_template_rows",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │         Grid Template Areas          │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.3 Grid Template Areas", 'vc_extend'),
                            "param_name" => "container_grid_template_areas",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Names of the areas. With quotes around each row.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Grid Column Gap            │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.4 Grid Column Line Gap", 'vc_extend'),
                            "param_name" => "container_grid_column_gap",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Size of the grid columnlines.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │             Grid Row Gap             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.5 Grid Row Line Gap", 'vc_extend'),
                            "param_name" => "container_grid_row_gap",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Size of the grid row lines.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Grid Justify Items         │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("3.6 Grid Justify Items", 'vc_extend'),
                            "param_name" => "container_grid_justify_items",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'Stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'start',  "my-text-domain"  ) => 'start',
                                __( 'end',  "my-text-domain"  ) => 'end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                            ),
                            "description" => __("Grid Item Justify.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │              Align Items             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("3.7 Align <br/>Items", 'vc_extend'),
                            "param_name" => "container_grid_align_items",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'Stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'start',  "my-text-domain"  ) => 'start',
                                __( 'end',  "my-text-domain"  ) => 'end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                            ),
                            "description" => __("Grid Item Align.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Justify Content            │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("3.8 Justify Content", 'vc_extend'),
                            "param_name" => "container_grid_justify_content",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'start',  "my-text-domain"  ) => 'start',
                                __( 'end',  "my-text-domain"  ) => 'end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                                __( 'Stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'space-around',  "my-text-domain"  ) => 'space-around',
                                __( 'space-between',  "my-text-domain"  ) => 'space-between',
                                __( 'space-evenly',  "my-text-domain"  ) => 'space-evenly',
                                
                            ),
                            "description" => __("Grid Content Justify.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │             Align Content            │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("3.9 Align Content", 'vc_extend'),
                            "param_name" => "container_grid_align_content",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'start',  "my-text-domain"  ) => 'start',
                                __( 'end',  "my-text-domain"  ) => 'end',
                                __( 'center',  "my-text-domain"  ) => 'center',
                                __( 'Stretch',  "my-text-domain"  ) => 'stretch',
                                __( 'space-around',  "my-text-domain"  ) => 'space-around',
                                __( 'space-between',  "my-text-domain"  ) => 'space-between',
                                __( 'space-evenly',  "my-text-domain"  ) => 'space-evenly',
                            ),
                            "description" => __("Grid Align Content.", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │         Grid Auto Columns            │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.10 Grid Auto Columns", 'vc_extend'),
                            "param_name" => "container_grid_auto_columns",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Grid Auto Rows             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.11 Grid Auto Rows", 'vc_extend'),
                            "param_name" => "container_grid_auto_rows",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Grid Auto Flow             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.12 Grid Auto Flow", 'vc_extend'),
                            "param_name" => "container_grid_auto_flow",
                            'value' => array(
                                __( '-',  "my-text-domain"  ) => '',
                                __( 'Row',  "my-text-domain"  ) => 'row',
                                __( 'Column',  "my-text-domain"  ) => 'column',
                                __( 'Dense',  "my-text-domain"  ) => 'dense',
                            ),
                            "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-2"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Override Width             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.13 Box Width override", 'vc_extend'),
                            "param_name" => "container_grid_box_width",
                            "value" => __("", 'vc_extend'),
                            "description" => __("px / % / vw / unset / (fit/min/max)-content", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-6"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │           Override Width             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("3.14 Box Height override", 'vc_extend'),
                            "param_name" => "container_grid_box_height",
                            "value" => __("", 'vc_extend'),
                            "description" => __("px / % / vw / unset / (fit/min/max)-content", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-6"),
                            "group" => __("< Grid", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │                 CSS                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("3.15 Additional CSS RULES (just add rules)", 'vc_extend'),
                            "param_name" => "container_grid_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@supports(display:grid){ .hero-container{...} }", 'vc_extend'),
                            "group" => __("< Grid", 'vc_extend'),
                        ),  

                //  ┌──────────────────────────────────────┐
                //  │                                      │
                //  │               TABLET                 │
                //  │                                      │
                //  └──────────────────────────────────────┘

                        //  ┌──────────────────────────────────────┐
                        //  │              Tablet                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("4. Tablet", 'vc_extend'),
                            "param_name" => "container_tablet_enabled",
                            'value' => array(
                                __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                                __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            ),
                            "description" => __("Tablet in CSS rules.", 'vc_extend'),
                            "group" => __("< Tablet", 'vc_extend'),
                        ),

                        //  ┌──────────────────────────────────────┐
                        //  │            Tablet Width              │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("4.1 Media query max-width ", 'vc_extend'),
                            "param_name" => "container_tablet_max_width",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Width for the media query. (1024px). @media screen and (max-width(X))", 'vc_extend'),
                            "group" => __("< Tablet", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │              Float Rules             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("4.2 Default Float CSS", 'vc_extend'),
                            "param_name" => "container_tablet_float_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(X)){ .hero-container{...} } ", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Tablet", 'vc_extend'),
                        ), 
                        //  ┌──────────────────────────────────────┐
                        //  │            Flexbox Rules             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("4.3 < Flexbox CSS", 'vc_extend'),
                            "param_name" => "container_tablet_flex_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(X)){ @supports(display:flex){ .hero-container{...} } }", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Tablet", 'vc_extend'),
                        ), 
                        //  ┌──────────────────────────────────────┐
                        //  │              Grid Rules              │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("4.4 < Grid CSS", 'vc_extend'),
                            "param_name" => "container_tablet_grid_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(X)){ @supports(display:grid){ .hero-container{...} } }", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Tablet", 'vc_extend'),
                        ), 
                //  ┌──────────────────────────────────────┐
                //  │                                      │
                //  │               MOBILE                 │
                //  │                                      │
                //  └──────────────────────────────────────┘

                        //  ┌──────────────────────────────────────┐
                        //  │              Tablet                  │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "dropdown",
                            "heading" => __("5. Mobile", 'vc_extend'),
                            "param_name" => "container_mobile_enabled",
                            'value' => array(
                                __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                                __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            ),
                            "description" => __("Mobile in CSS rules.", 'vc_extend'),
                            "group" => __("< Mobile", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │            mobile Width              │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textfield",
                            "heading" => __("5.1 Media query max-width ", 'vc_extend'),
                            "param_name" => "container_mobile_max_width",
                            "value" => __("", 'vc_extend'),
                            "description" => __("Mobile Width for the media query. (768px)?", 'vc_extend'),
                            "group" => __("< Mobile", 'vc_extend'),
                        ),
                        //  ┌──────────────────────────────────────┐
                        //  │              Float Rules             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("5.2 Default Float CSS", 'vc_extend'),
                            "param_name" => "container_mobile_float_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(Y)){ .hero-container{...} }", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Mobile", 'vc_extend'),
                        ), 
                        //  ┌──────────────────────────────────────┐
                        //  │            Flexbox Rules             │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("5.3 < Flexbox CSS", 'vc_extend'),
                            "param_name" => "container_mobile_flex_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(Y)){ @supports(display:flex){ .hero-container{...} } }", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Mobile", 'vc_extend'),
                        ), 
                        //  ┌──────────────────────────────────────┐
                        //  │             Grid Rules               │
                        //  └──────────────────────────────────────┘
                        array(
                            "type" => "textarea_raw_html",
                            "heading" => __("5.4 < Grid CSS", 'vc_extend'),
                            "param_name" => "container_mobile_grid_css",
                            "value" => __("", 'vc_extend'),
                            "description" => __("@media screen and (max-width(Y)){ @supports(display:grid){ .hero-container{...} } }", 'vc_extend'),
                            "edit_field_class" => __("vc_col-xs-4"),
                            "group" => __("< Mobile", 'vc_extend'),
                        ), 

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │                 JS                   │
            //  │                                      │
            //  └──────────────────────────────────────┘	
                        array(
                            'type' => 'textarea_raw_html',
                            'heading' => __( 'JS Code', 'my-text-domain' ),
                            'param_name' => 'js',
                            'description' => __("Custom JS scripts. No need to add script tags. Will be loaded into footer.", 'vc_extend'),
                            'group' => __( 'JS', 'my-text-domain' ),
                        ),

        

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │              Design                  │
            //  │                                      │
            //  └──────────────────────────────────────┘	
                        array(
                            'type' => 'css_editor',
                            'heading' => __( 'Css', 'my-text-domain' ),
                            'param_name' => 'css',
                            'group' => __( 'Design', 'my-text-domain' ),
                        ),
        )
    ) );
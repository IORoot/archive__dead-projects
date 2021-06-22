<?php

//  ┌──────────────────────────────────────┐
//  │         Create the VC Inputs         │
//  └──────────────────────────────────────┘
vc_map( array(
    "name" => __("C-media", 'vc_extend'),
    "description" => __("Component - media Panel", 'vc_extend'),
    "base" => "cmedia",
    "class" => "",
    "controls" => "full",
    "icon" => plugins_url('../assets/ldnpk.png', __FILE__), // or css class name which you can refer in your css file later. Example: "vc_extend_my_class"
    "category" => __('LondonParkour', 'js_composer'),
    //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
    //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
    "params" => array(

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │               General                │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │              Unique ID               │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "holder" => "div",		// used to display on edit page.
                        "heading" => __("Unique CSS Class. i.e. (c-media__?) *REQUIRED*", 'vc_extend'),
                        "param_name" => "media_unique_class",
                        "value" => __("c-media__", 'vc_extend'),
                        "description" => __("Unique Class Name to be added to the panel", 'vc_extend'),
                        "group" => __("Class *", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │             Additional Classes       │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Additional classes", 'vc_extend'),
                        "param_name" => "media_additional_class",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Additional Classes to be added onto the panel.", 'vc_extend'),
                        "group" => __("Class *", 'vc_extend'),
                    ),

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │                 Media                │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │               Media One              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Image One Title", 'vc_extend'),
                        "param_name" => "media_image_one_title",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link One Title", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Overlay Image One", 'vc_extend'),
                        "param_name" => "media_image_one",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Image One", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
						"type" => "colorpicker",
						"heading" => __("Background", 'vc_extend'),
						"param_name" => "media_image_one_background",
						"value" => '', 
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
						"edit_field_class" => __("vc_col-xs-2"),
                    ),
                    array(
                        "type" => "vc_link",
						"heading" => __("External Link", 'vc_extend'),
						"param_name" => "media_image_one_link_url",
                        "value" => __("", 'vc_extend'),
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Image One", 'vc_extend'),
                        "param_name" => "media_image_one_enable",
                        'value' => array(
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
					

                    //  ┌──────────────────────────────────────┐
                    //  │               Media Two              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Image Two Title", 'vc_extend'),
                        "param_name" => "media_image_two_title",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link Two Title", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Overlay Image two", 'vc_extend'),
                        "param_name" => "media_image_two",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Image two", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
						"type" => "colorpicker",
						"heading" => __("Background", 'vc_extend'),
						"param_name" => "media_image_two_background",
						"value" => '', 
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
						"edit_field_class" => __("vc_col-xs-2"),
                    ),
					array(
                        "type" => "vc_link",
						"heading" => __("External Link", 'vc_extend'),
						"param_name" => "media_image_two_link_url",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link URL", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Image Two", 'vc_extend'),
                        "param_name" => "media_image_two_enable",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Media two Enabled.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │               Media Three              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Image three Title", 'vc_extend'),
                        "param_name" => "media_image_three_title",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link three Title", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Overlay Image three", 'vc_extend'),
                        "param_name" => "media_image_three",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Image three", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
						"type" => "colorpicker",
						"heading" => __("Background", 'vc_extend'),
						"param_name" => "media_image_three_background",
						"value" => '', 
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
						"edit_field_class" => __("vc_col-xs-2"),
                    ),
					array(
                        "type" => "vc_link",
						"heading" => __("External Link", 'vc_extend'),
						"param_name" => "media_image_three_link_url",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link URL", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Image three", 'vc_extend'),
                        "param_name" => "media_image_three_enable",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Media three Enabled.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │               Media four              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Image four Title", 'vc_extend'),
                        "param_name" => "media_image_four_title",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link four Title", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Overlay Image four", 'vc_extend'),
                        "param_name" => "media_image_four",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Image four", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
						"type" => "colorpicker",
						"heading" => __("Background", 'vc_extend'),
						"param_name" => "media_image_four_background",
						"value" => '', 
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
						"edit_field_class" => __("vc_col-xs-2"),
                    ),
					array(
                        "type" => "vc_link",
						"heading" => __("External Link", 'vc_extend'),
						"param_name" => "media_image_four_link_url",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link URL", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Image four", 'vc_extend'),
                        "param_name" => "media_image_four_enable",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Media four Enabled.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │               Media five              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("Image five Title", 'vc_extend'),
                        "param_name" => "media_image_five_title",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link five Title", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => __("Overlay Image five", 'vc_extend'),
                        "param_name" => "media_image_five",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Image five", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("Media", 'vc_extend'),
                    ),
                    array(
						"type" => "colorpicker",
						"heading" => __("Background", 'vc_extend'),
						"param_name" => "media_image_five_background",
						"value" => '', 
                        "description" => __("", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
						"edit_field_class" => __("vc_col-xs-2"),
                    ),
					array(
                        "type" => "vc_link",
						"heading" => __("External Link", 'vc_extend'),
						"param_name" => "media_image_five_link_url",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Link URL", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Image five", 'vc_extend'),
                        "param_name" => "media_image_five_enable",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Media five Enabled.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("Media", 'vc_extend'),
                    ),


                    //  ┌──────────────────────────────────────┐
                    //  │                 CSS                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("Css Rules for the list", 'vc_extend'),
                        "param_name" => "media_list_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("List Custom CSS (.c-media__links > ul.c-media__linklist)", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("Css Rules for the media", 'vc_extend'),
                        "param_name" => "media_media_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Media Custom CSS (.c-media__media)", 'vc_extend'),
                        "group" => __("Media", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),  

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │           OVERLAY  SETTINGS          │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │                 CSS                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("<br/>HTML overlay", 'vc_extend'),
                        "param_name" => "media_overlay_one_html",
                        "value" => __("", 'vc_extend'),
                        "description" => __("HTML overlay of media", 'vc_extend'),
                        "group" => __("Overlay", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("CSS overlay", 'vc_extend'),
                        "param_name" => "media_overlay_one_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("CSS overlay of media", 'vc_extend'),
                        "group" => __("Overlay", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                    ),

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │           BOX PANEL SETTINGS         │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │            Float Width               │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("<br/>1.1 Box Width *", 'vc_extend'),
                        "param_name" => "media_float_width",
                        "value" => __("", 'vc_extend'),
                        "description" => __("( px / % / em ) only.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Box *", 'vc_extend'),
                    ),
                    
                    //  ┌──────────────────────────────────────┐
                    //  │            Float height              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("1.2 Box Height *", 'vc_extend'),
                        "param_name" => "media_float_height",
                        "value" => __("", 'vc_extend'),
                        "description" => __("( px / % / em ) only", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Box *", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │          Float Direction             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("1.3 Float Direction", 'vc_extend'),
                        "param_name" => "media_float_direction",
                        'value' => array(
                            __( '-',  "my-text-domain"  ) => '',
                            __( 'Left',  "my-text-domain"  ) => 'left',
                            __( 'Right',  "my-text-domain"  ) => 'right',
                            __( 'None',  "my-text-domain"  ) => 'none',
                        ),
                        "description" => __("Left, Right, None", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Box *", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │             Float Clear              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("1.4 Float Clear", 'vc_extend'),
                        "param_name" => "media_float_clear",
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
                        "group" => __("< Box *", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │                 CSS                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("1.5 Additional CSS RULES", 'vc_extend'),
                        "param_name" => "media_float_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("(5th)", 'vc_extend'),
                        "group" => __("< Box *", 'vc_extend'),
                    ),  

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │             FLEX ITEMS               │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │                Flex                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("2. Flex (disabled by default)", 'vc_extend'),
                        "param_name" => "media_flex_enabled",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Flexbox Enabled.", 'vc_extend'),
                        "group" => __("< Flex", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │                Order                 │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("2.1 Flex Order", 'vc_extend'),
                        "param_name" => "media_flex_order",
                        "value" => __("", 'vc_extend'),
                        "description" => __("order number", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Flex", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │                 Grow                 │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("2.2 Flex (exclude the `flex:` key)", 'vc_extend'),
                        "param_name" => "media_flex_value",
                        "value" => __("", 'vc_extend'),
                        "description" => __("flex: none | [ <'flex-grow'> <'flex-shrink'>? || <'flex-basis'> ]", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-6"),
                        "group" => __("< Flex", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │             Flex-Justify             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("2.3 Flex Align Self", 'vc_extend'),
                        "param_name" => "media_flex_align_self",
                        'value' => array(
                            __( '-',  "my-text-domain"  ) => '',
                            __( 'auto',  "my-text-domain"  ) => 'auto',
                            __( 'flex-start',  "my-text-domain"  ) => 'flex-start',
                            __( 'flex-end',  "my-text-domain"  ) => 'flex-end',
                            __( 'center',  "my-text-domain"  ) => 'center',
                            __( 'baseline',  "my-text-domain"  ) => 'baseline',
                            __( 'stretch',  "my-text-domain"  ) => 'stretch',
                        ),
                        "description" => __("Flexbox Align Self. Override container alignment.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Flex", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │                Flex                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("2.4 Flex Container", 'vc_extend'),
                        "param_name" => "media_flex_container_enabled",
                        'value' => array(
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                        ),
                        "description" => __("Make a Flexbox container.", 'vc_extend'),
                        "group" => __("< Flex", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │           Flex-Direction             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("2.5 Flex Direction", 'vc_extend'),
                        "param_name" => "media_flex_container_direction",
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
                        "heading" => __("2.6 Flex <br/>Wrap", 'vc_extend'),
                        "param_name" => "media_flex_container_wrap",
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
                        "heading" => __("2.7 Flex <br/>Justify", 'vc_extend'),
                        "param_name" => "media_flex_container_justify",
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
                        "heading" => __("2.8 Flex Align Items", 'vc_extend'),
                        "param_name" => "media_flex_container_align_items",
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
                    //  │             Flex-Justify             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("2.9 Flex Align Content", 'vc_extend'),
                        "param_name" => "media_flex_container_align_content",
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
                        "heading" => __("2.4 Additional CSS RULES", 'vc_extend'),
                        "param_name" => "media_flex_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("NO @supports(display:flex){ } rule is surrounding these rules. (8th)", 'vc_extend'),
                        "group" => __("< Flex", 'vc_extend'),
                    ),

            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │               Grid                   │
            //  │                                      │
            //  └──────────────────────────────────────┘

                    //  ┌──────────────────────────────────────┐
                    //  │                Grid                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "dropdown",
                        "heading" => __("<br/>3. Grid (will be in a @supports(display:grid) query)", 'vc_extend'),
                        "param_name" => "media_grid_enabled",
                        'value' => array(
                            __( 'Enabled',  "my-text-domain"  ) => 'enabled',
                            __( 'Disabled',  "my-text-domain"  ) => 'disabled',
                        ),
                        "description" => __("Grid rules in CSS.", 'vc_extend'),
                        "group" => __("< Grid", 'vc_extend'),
                    ),

                    //  ┌──────────────────────────────────────┐
                    //  │     SubGrid Template Columns         │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("3.8 SubGrid <br/>Columns", 'vc_extend'),
                        "param_name" => "media_subgrid_template_columns",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Grid", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │      SubGrid Template Rows           │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("3.9 SubGrid <br/>Rows", 'vc_extend'),
                        "param_name" => "media_subgrid_template_rows",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Track size / line-name / repeat() / repeat(x, minmax(min,1fr))", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-3"),
                        "group" => __("< Grid", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │      SubGrid Template Areas          │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("3.10 SubGrid <br/>Areas", 'vc_extend'),
                        "param_name" => "media_subgrid_template_areas",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Names of the areas. With quotes around each row.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("< Grid", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │        SubGrid Column Gap            │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("3.11 Column <br/>Line Gap", 'vc_extend'),
                        "param_name" => "media_subgrid_column_gap",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Size of the grid columnlines.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("< Grid", 'vc_extend'),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │         SubGrid Row Gap             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textfield",
                        "heading" => __("3.12 Row <br/>Line Gap", 'vc_extend'),
                        "param_name" => "media_subgrid_row_gap",
                        "value" => __("", 'vc_extend'),
                        "description" => __("Size of the grid row lines.", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-2"),
                        "group" => __("< Grid", 'vc_extend'),
                    ),
                    
                    //  ┌──────────────────────────────────────┐
                    //  │                 CSS                  │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("3.13 Additional CSS RULES ", 'vc_extend'),
                        "param_name" => "media_grid_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@supports(display:grid){ ... } (11th)", 'vc_extend'),
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
                        "param_name" => "media_tablet_enabled",
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
                        "param_name" => "media_tablet_max_width",
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
                        "param_name" => "media_tablet_float_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(X)){ ... } (6th)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                        "group" => __("< Tablet", 'vc_extend'),
                    ), 
                    //  ┌──────────────────────────────────────┐
                    //  │            Flexbox Rules             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("4.3 < Flexbox CSS", 'vc_extend'),
                        "param_name" => "media_tablet_flex_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(X)){ ... } (9th)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                        "group" => __("< Tablet", 'vc_extend'),
                    ), 
                    //  ┌──────────────────────────────────────┐
                    //  │              Grid Rules              │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("4.4 < Grid CSS", 'vc_extend'),
                        "param_name" => "media_tablet_grid_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(X)){ @supports(display:grid){ ... } }. (12th)", 'vc_extend'),
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
                        "param_name" => "media_mobile_enabled",
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
                        "param_name" => "media_mobile_max_width",
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
                        "param_name" => "media_mobile_float_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(Y)){ ... }. (7th)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                        "group" => __("< Mobile", 'vc_extend'),
                    ), 
                    //  ┌──────────────────────────────────────┐
                    //  │            Flexbox Rules             │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("5.3 < Flexbox CSS", 'vc_extend'),
                        "param_name" => "media_mobile_flex_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(Y)){ ... } (10th)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                        "group" => __("< Mobile", 'vc_extend'),
                    ), 
                    //  ┌──────────────────────────────────────┐
                    //  │             Grid Rules               │
                    //  └──────────────────────────────────────┘
                    array(
                        "type" => "textarea_raw_html",
                        "heading" => __("5.4 < Grid CSS", 'vc_extend'),
                        "param_name" => "media_mobile_grid_css",
                        "value" => __("", 'vc_extend'),
                        "description" => __("@media screen and (max-width(Y)){ @supports(display:grid){ ... } }. (13th)", 'vc_extend'),
                        "edit_field_class" => __("vc_col-xs-4"),
                        "group" => __("< Mobile", 'vc_extend'),
                    ), 



            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │                  CSS                 │
            //  │                                      │
            //  └──────────────────────────────────────┘	
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'Css', 'my-text-domain' ),
                        'param_name' => 'media_css',
                        'group' => __( '< CSS', 'my-text-domain' ),
                    ),
                    //  ┌──────────────────────────────────────┐
                    //  │             Custom CSS               │
                    //  └──────────────────────────────────────┘
                    array(
                        'type' => 'textarea_raw_html',
                        'heading' => __( 'Custom CSS', 'my-text-domain' ),
                        'param_name' => 'media_css_custom',
                        'description' => __("Custom CSS (Not nested in a rule). Added Last in the cascade (14th).", 'vc_extend'),
                        'group' => __( '< CSS', 'my-text-domain' ),
                    ),


            //  ┌──────────────────────────────────────┐
            //  │                                      │
            //  │                 JS                   │
            //  │                                      │
            //  └──────────────────────────────────────┘	
                    array(
                        'type' => 'textarea_raw_html',
                        'heading' => __( 'JS Code', 'my-text-domain' ),
                        'param_name' => 'media_js',
                        'description' => __("Custom JS scripts. No need to add script tags. Will be loaded into footer.", 'vc_extend'),
                        'group' => __( 'JS', 'my-text-domain' ),
                    ),

    )
) );
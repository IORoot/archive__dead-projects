<?php

add_action( 'vc_before_init', 'memberpress_integrateWithVC' );

function memberpress_integrateWithVC() {
    vc_map( array(
        "name" => "Memberpress Wrapper",
        "base" => "mepr_active",
        "category" => "Structure",
        "class" => "vc_memberpress",
        "admin_enqueue_css" => array(get_stylesheet_directory_uri() . "/styles/plugins/visual_composer/memberpress_widget.css"),
        "as_parent" => array('except' => ''),
        "is_container" => true,
        "js_view" => 'VcColumnView',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => "Rules",
                "param_name" => "rules",
                "value" => null,
                "description" => "Memberpress Rule ID's"
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => "Memberships",
                "param_name" => "memberships",
                "value" => null,
                "description" => "Memberpress Membership ID's"
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => "IfAllowed",
                "param_name" => "ifallowed",
                "value" => 'show',
                "description" => "Show / Hide"
            )
        )
    ) );

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Mepr_Active extends WPBakeryShortCodesContainer {
    }
}
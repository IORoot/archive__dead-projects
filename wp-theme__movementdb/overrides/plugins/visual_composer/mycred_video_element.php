<?php

add_action( 'vc_before_init', 'mycredvideo_integrateWithVC' );

function mycredvideo_integrateWithVC() {
    vc_map( array(
        "name" => "MyCred Video",
        "base" => "mycred_video",
        "description" => "MyCred Video + Points Allocation",
        "category" => "Structure",
        "class" => "vc_mycred",
        "admin_enqueue_css" => array(get_stylesheet_directory_uri() . "/styles/plugins/visual_composer/mycred_video_element.css"),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => "Vimeo ID",
                "param_name" => "id",
                "admin_label" => true,
                "value" => null,
                "description" => "ID number of VIMEO Video."
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => "Point type",
                "param_name" => "ctype",
                "admin_label" => true,
                'value'       => array(
                    'Vaulting'      => 'vaulting_points',
                    'Jumping'       => 'jumping_points',
                    'Balancing'     => 'balancing_points',
                    'Attributes'    => 'attributes_points',
                    'Bars'          => 'bars_points',
                    'Brachiation'   => 'brachiation_points',
                    'Climbing'      => 'climbing_points',
                    'Coaching'      => 'coaching_points',
                    'Mobility'      => 'mobility_points',
                    'QM'            => 'quadrupedal_points',
                    'Rolling'       => 'rolling_points',
                    'Strength'      => 'strength_points',
                ),
                'std'         => 'Vaulting',
                "description" => "Which MyCred point type should allocate points to?"
            )
        )
    ) );

}
<?php

add_action( 'init', 'create_skill_taxonomy' );

function create_skill_taxonomy() {

    $labels = array(
        'name'                           => 'Skill Levels',
        'singular_name'                  => 'Skill Level',
        'search_items'                   => 'Search Skill Levels',
        'all_items'                      => 'All Skill Levels',
        'edit_item'                      => 'Edit Skill Level',
        'update_item'                    => 'Update Skill Level',
        'add_new_item'                   => 'Add New Skill Level',
        'new_item_name'                  => 'New Skill Level Name',
        'menu_name'                      => 'Skill Level',
        'view_item'                      => 'View Skill Level',
        'popular_items'                  => 'Popular Skill Level',
        'separate_items_with_commas'     => 'Separate skill levels with commas',
        'add_or_remove_items'            => 'Add or remove skill levels',
        'choose_from_most_used'          => 'Choose from the most used skill levels',
        'not_found'                      => 'No skill levels found'
    );

    register_taxonomy(
        'skill',
        'post',
        array(
            'label' => __( 'Skill Level' ),
            'hierarchical' => true,
            'labels' => $labels
        )
    );


}
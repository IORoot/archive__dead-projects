<?php

add_action( 'init', 'create_topic_taxonomy' );

function create_topic_taxonomy() {

    $labels = array(
        'name'                           => 'Topic Category',
        'singular_name'                  => 'Topic Category',
        'search_items'                   => 'Search Topic Categories',
        'all_items'                      => 'All Topic Categories',
        'edit_item'                      => 'Edit Topic Category',
        'update_item'                    => 'Update Topic Category',
        'add_new_item'                   => 'Add New Topic Category',
        'new_item_name'                  => 'New Topic Category Name',
        'menu_name'                      => 'Topic Category',
        'view_item'                      => 'View Topic Category',
        'popular_items'                  => 'Popular Topic Category',
        'separate_items_with_commas'     => 'Separate Topic Categories with commas',
        'add_or_remove_items'            => 'Add or remove Topic Categories',
        'choose_from_most_used'          => 'Choose from the most used Topic Categories',
        'not_found'                      => 'No Topic Categories found'
    );

    register_taxonomy(
        'topic',
        'knowledgebase',
        array(
            'label' => __( 'Topic Category' ),
            'hierarchical' => true,
            'labels' => $labels
        )
    );


}
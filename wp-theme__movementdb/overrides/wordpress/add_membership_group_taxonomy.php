<?php
add_action( 'init', 'create_membership_taxonomy' );

function create_membership_taxonomy() {

    $labels = array(
        'name'                           => 'Membership Group',
        'singular_name'                  => 'Membership Group',
        'search_items'                   => 'Search Membership Groups',
        'all_items'                      => 'All Membership Groups',
        'edit_item'                      => 'Edit Membership Group',
        'update_item'                    => 'Update Membership Group',
        'add_new_item'                   => 'Add New Membership Group',
        'new_item_name'                  => 'New Membership Group Name',
        'menu_name'                      => 'Membership Group',
        'view_item'                      => 'View Membership Group',
        'popular_items'                  => 'Popular Membership Group',
        'separate_items_with_commas'     => 'Separate Membership Group with commas',
        'add_or_remove_items'            => 'Add or remove Membership Groups',
        'choose_from_most_used'          => 'Choose from the most used Membership Groups',
        'not_found'                      => 'No Membership Groups found'
    );

    register_taxonomy(
        'membershipgroup',
        'post',
        array(
            'label' => __( 'Membership Group' ),
            'hierarchical' => true,
            'labels' => $labels
        )
    );


}
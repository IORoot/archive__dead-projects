<?php

// Set the metadata entry for every 'series' Custom Post Type post.
// Example Grid ID = 8
// Example Skin ID = 54
//
// Set metadata value 'eg_use_skin' = {"8":{"use-skin":"54"}}
add_action('init','update_all_series_posts_skin');

function update_all_series_posts_skin(){

    $post_type = 'series';
    $grid_id = 8;
    $skin_id = 54;

    // Search for all posts of 'series' post_type.
    // For other criteria, use https://developer.wordpress.org/reference/functions/get_posts/
    $my_posts = get_posts( array('post_type' => $post_type, 'numberposts' => -1 ) );

    // For each of the matching posts, update or add the meta_data value.
    foreach ( $my_posts as $my_post )
    {
        if (isset($my_post->eg_use_skin)){
            update_post_meta($my_post->ID, 'eg_use_skin', '{"'.$grid_id.'":{"use-skin":"'.$skin_id.'"}}');
        } else {
            add_post_meta($my_post->ID, 'eg_use_skin', '{"'.$grid_id.'":{"use-skin":"'.$skin_id.'"}}');
        }
    }

}
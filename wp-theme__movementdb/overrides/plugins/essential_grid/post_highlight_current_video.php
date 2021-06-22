<?php

add_filter('essgrid_post_meta_handle', 'eg_add_post_option');
add_filter('essgrid_post_meta_content', 'eg_add_post_content', 10, 4);

function eg_add_post_option($post_options){
    // where 'author_id' is the attribute of the data to pull in
    $post_options['current_video'] = array('name' => 'current_video');
    return $post_options;
}

function eg_add_post_content($meta_value, $meta, $post_id, $post){

    // where 'author_id' is the attribute of the data to pull in
    if($meta === 'current_video'){

        $current_post_id = get_the_ID();

        if ($current_post_id == $post_id){
            return '<i class="fa fa-eye"></i>';
        }
    }

    return $meta_value;

}
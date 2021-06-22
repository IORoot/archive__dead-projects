<?php

/*
 *  This will only display the episodes for the current Series, not all series.
 */

add_filter('essgrid_get_posts', 'eg_get_query', 10, 2);
// essgrid_get_posts filter will run BEFORE the query.


// Run this Query Alteration
function eg_get_query($query, $grid_id){

    global $post;

    // Grid 20 is the 'First Episode in Series' grid on the series page.
    if($grid_id == 20) {

        $query['tax_query'] = array(
            array(
                'taxonomy' => 'series',
                'field' => 'slug',
                'terms' => array( $post->post_name )
            )
        );
    }

    return $query;
}
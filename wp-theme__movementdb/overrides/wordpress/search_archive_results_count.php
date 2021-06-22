<?php

// Increase number of results on archive page to 100.

function wpsites_query( $query ) {
    if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 100 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );
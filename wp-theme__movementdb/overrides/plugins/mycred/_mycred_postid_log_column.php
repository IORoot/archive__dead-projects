<?php

// Log Post ID on Video Watch
add_filter( 'mycred_run_this', 'mycred_log_POSTID_when_video_watched', 10, 2 );

function mycred_log_POSTID_when_video_watched( $request ) {

    $request['ref_id'] = get_the_ID();
    return $request;
}



// Add Post ID in Log
add_filter( 'mycred_log_column_headers', 'mycred_add_POSTTITLE_column', 10, 2 );

function mycred_add_POSTTITLE_column( $columns ) {

    $columns['POSTID'] = 'Post ID';

    return $columns;
}





// Display Column Content in log
add_filter( 'mycred_log_POSTID', 'mycred_show_POSTID_column_content', 10, 2 );

function mycred_show_POSTID_column_content( $content, $log_entry ) {

    if ( $log_entry->ref == 'watching_video' )
        return $log_entry->ref_id;

    return '-';

}
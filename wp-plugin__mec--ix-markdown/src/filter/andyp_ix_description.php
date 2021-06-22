<?php

function andyp_ix_description_callback( $description ) {

    $Parsedown = new Parsedown();
    $description = $Parsedown->text($description);

    // Add any videos using lite-youtube
    $replaced .= preg_replace('/\{\{yt=([\s|\S|-]*)\}\}/','<lite-youtube videoid="${1}"></lite-youtube>',$description);

    return $replaced;
}

add_filter( 'andyp_ix_description', 'andyp_ix_description_callback' );
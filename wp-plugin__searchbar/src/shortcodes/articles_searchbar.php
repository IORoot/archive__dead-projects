<?php

/*                                                                              
*   ┌─────────────────────────────────────────────────────────────────────────┐ 
*   │                                                                         │░
*   │                               Search box                                │░
*   │                                                                         │░
*   │                            Used on /articles                            │░
*   │                                                                         │░
*   └─────────────────────────────────────────────────────────────────────────┘░
*    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
*/     

function articles_searchbar($atts){

    $output = '<form role="search" action="'. site_url('/') .'" method="get" id="searchform" class="articlesearchform">';
        $output .= '<input type="text" name="s" placeholder="Search"/>';
        $output .= '<input type="hidden" name="post_type" value="article" />';
    $output .= '</form>';

    echo $output;
    
    return;
}

add_shortcode( 'articles_searchbar', 'articles_searchbar' );
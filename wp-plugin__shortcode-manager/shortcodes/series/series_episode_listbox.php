<?php

/* ========================================================================================
 *
 * Return a list of all episodes in the series
 *
 * Used on the series page and the episode pages to list all other episodes.
 *
 * Location:    Series Page
 *              Episode Page
 *
 * [series_episode_listbox]
 *
 * @param   string  $post_id        Optional override of post ID. This will retrieve all
 *                                  other posts in the series that this post is part of.
 * @param   string  series_id       Optional series ID to specify which series you wish to
 *                                  list all episodes that are a part of it.
 *
 * @return  string                  Unordered List of results.
 *
 * ======================================================================================= */
function shortcode_series_episode_listbox($attr = null){

    global $cpt_onomy;

    // Optional Series_ID : Default is current post.
    $args = shortcode_atts( array(
        'post_id' => get_the_id(),
        'series_id' => null,
        'series_page' => null,
    ), $attr );

    // If series_page is not NULL Then this is a series page, NOT an episode page!
    if ($args['series_page']) { $args['series_id'] = get_the_id(); }

    // Get Array of 'series' objects that this post is part of.
    $current_series = wp_get_object_terms( $args['post_id'], 'series' );

    // Override the series_id if set!
    $series_id = ($args['series_id']) ? $args['series_id'] : $current_series[0]->term_id;

    // Get Array of all IDs of episodes that is part of that series.
    $series = $cpt_onomy->get_objects_in_term( $series_id, 'series');


    // Get all posts
    $posts_args = array(
        'numberposts'   => -1 ,
        'include'       => $series,
        'meta_key'		=> 'video_series_order_number',
        'orderby'		=> 'meta_value',
        'order'         => 'ASC',
    );
    $all_episodes = get_posts( $posts_args );

    // If not array is not empty.
    if ($all_episodes[0] != null){

        // Get list of all WPCompleted episodes for user.
        $user_completed_json = get_user_meta( get_current_user_id(), 'wp_completed', true );
        $user_completed = ( $user_completed_json ) ? json_decode( $user_completed_json, true ) : array();
        $user_completed_array = array_keys( $user_completed );

        $out = '<ul class="mvdb_series_episode_list" id="series_id_'.$series_id.'" >';

        // Series header.
        $out .= '<li class="mvdb_series_list_header mvdb_episode even">';
        $out .= '<i class="mvdb_series_icon fa fa-list-ul"></i>';
        $out .= '<a href="'.esc_url( get_permalink($series_id) ).'">'. get_the_title($series_id) .' - Contents</a>';
        $out .= '<li>';


        foreach ($all_episodes as $episode){

            // Is episode in wpcompleted list?
            $ep_completed = '';
            if (in_array($episode->ID, $user_completed_array)){
                $ep_completed = '<i class="mvdb_episode_wpcompleted fa fa-check-circle"></i>';
            }

            $zebra = ($c++%2==1) ? "even" : "odd";

            $out .= '<li class="mvdb_episode '.$zebra.'" id="episode_'.$episode->ID.'">';

            // If current post, put an 'eye' icon in. else a TV icon.
            if ($args['post_id'] == $episode->ID){
                $out .= '<i class="mvdb_episode_icon fa fa-eye"></i>';
            } else {
                $out .= '<i class="mvdb_episode_icon fa fa-television"></i>';
            }

            // If user is NOT logged in show a lock icon.
            //if(!is_user_logged_in()) { $out .= '<i class="mvdb_episode_icon fa fa-lock"></i>'; }

            $out .= '<div class="mvdb_episode_order">'. get_field('video_series_order_number', $episode->ID) .'</div>';
            $out .= '<div class="mvdb_episode_title"><a href="'.esc_url( get_permalink($episode->ID) ).'">'. $episode->post_title . $ep_completed . '</a></div>';
            $out .= '<div class="mvdb_episode_duration">'. get_field('video_duration', $episode->ID) .'</div>';

            $out .= '</li>';
        }

        $out .= '</ul>';

    }

    echo $out;

    return;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_episode_listbox', 'shortcode_series_episode_listbox' );
});



/* ========================================================================================
 *
 * 3. ADD DOCUMENTATION FOR SHORTCODE
 *
 * Add documentation for this shortcode to the custom shortcode admin page.
 *
 * @param cataegory
 * @param slug
 * @param code
 * @param description
 * @param inputs
 * @param outputs
 * @param filters
 * @param actions
 * @param example
 *
 * ======================================================================================== */

register_custom_shortcode_docs(
    array(
        'category'      => 'series',
        'slug'          => 'series_episode_listbox',
        'code'          => '[series_episode_listbox]',
        'description'   => 'Used on the series page and the episode pages to list all other episodes.',
        'inputs'        => '<ul><li>post_id @string</li>
                                <li>series_id @string</li>
                                <li>series_page @string</li>
                                </ul>',
        'outputs'       => '@string UL list of all episodes.',
        'example'       => '[series_episode_listbox series_id="1424"]',
    )
);

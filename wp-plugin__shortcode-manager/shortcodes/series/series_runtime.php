<?php

/* ========================================================================================
 *
 * Calculate series total runtime.
 *
 * ======================================================================================= */
function shortcode_series_runtime($attr = null){

    global $cpt_onomy;

    // Optional Series_ID : Default is current post.
    $args = shortcode_atts( array(
        'series_id' => get_the_id(),
    ), $attr );

    // Get Array of all IDs of episodes that is part of that series.
    $episode_list = $cpt_onomy->get_objects_in_term( $args['series_id'], 'series');

    // If series is empty.
    if (!$episode_list[0] ){
        return '00:00:00';
    }

    // Get all posts
    $posts_args = array(
        'numberposts'   => -1,
        'include'       => $episode_list,
        'order'         => 'ASC',
    );
    $all_episodes = get_posts( $posts_args );

    // declare array
    $times = array();

    // push each episode duration into array
    foreach( $all_episodes as $episode )
    {
        array_push($times, get_field('video_duration', $episode->ID));
    }

    $date = '1970-01-01';
    $datetime = strtotime("$date 00:00:00");

    // Add all times together.
    $sum = 0;
    foreach($times as $time) {
        $sum += strtotime("$date $time") - $datetime;
    }


    return date(' H \h\o\u\r\s, i \m\i\n, s \s\e\c\s', $sum);
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_runtime', 'shortcode_series_runtime' );
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
        'slug'          => 'series_runtime',
        'code'          => '[series_runtime]',
        'description'   => 'Used to calculate series total runtime.',
        'inputs'        => '<ul>
                                <li>series_id @string</li>
                                </ul>',
        'outputs'       => '@string Total runtime of series.',
        'example'       => '[series_runtime series_id="1424"]',
    )
);

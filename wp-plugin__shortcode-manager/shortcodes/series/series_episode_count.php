<?php

/* ========================================================================================
 *
 * Return the number of episodes in the series
 *
 * Used to look at the current series or a specified series and return the number of
 * episode posts associated with it.
 * Location:    Slider > Homepage slider
 *              Slider > Header - Series Page
 *              Page   > Episode Post > Under Title
 *              Grid   > MVDB Series
 *
 * [series_episode_count]
 *
 * @param   string  $id             Optional series ID can be supplied..
 *
 * @return  int     $count          Returns number of episodes
 *
 * ======================================================================================= */
function shortcode_series_episode_count($attr = null){

    global $cpt_onomy;

    // Optional Series_ID : Default is current post.
    $args = shortcode_atts( array(
        'post_id' => get_the_id(),
        'membership_id' => null,
    ), $attr );

    // Optional Series_ID : Default is current post.
//    $args = shortcode_atts( array(
//        'post_id' => get_the_id(),
//        'membership_id' => null,
//    ), $attr );

    // Override the ID by finding the Series ID via the Membership ID.
    if ($args['membership_id']){ $args['post_id'] = get_field('associated_series', $args['membership_id'])[0]; }

    // Get the list of ALL episodes in series ( Drafts / Published / Deleted / etc )
    $series = $cpt_onomy->get_objects_in_term( $args['post_id'], 'series' );

    // Check for 'publish' status only.
    $published_list = array();
    foreach ($series as $episode){
        if ( get_post_status($episode) == 'publish') { array_push($published_list, $episode); }
    }

    return count($published_list);

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'series_episode_count', 'shortcode_series_episode_count' );
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
        'slug'          => 'series_episode_count',
        'code'          => '[series_episode_count]',
        'description'   => 'Return the number of episodes in the series.',
        'inputs'        => '<ul><li>post_id @string</li>
                                <li>membership_id @string</li>
                                </ul>',
        'outputs'       => '@int count.',
        'example'       => '[series_episode_count]',
    )
);

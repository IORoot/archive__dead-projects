<?php

/* ========================================================================================
 *
 * Return a <style> tag to style essential grid.
 *
 * Get the
 * Location:    Grid > MVDB Videos > Background
 *
 * [post_tax]
 *
 * @param   string  $id                 Required Post ID
 * @param   string  $episode            Required Episode Number
 * @return  string  $style              Output a style tag for the episode background
 *
 * ======================================================================================= */
function shortcode_episode_number_background($atts){

    $args = shortcode_atts( array(
        'id' => 'id',
        'episode' => 'episode'
    ), $atts );

    $style = '
        <style>
            #esg-grid-2-1 li#eg-2-post-id-'.$args['id'].' .esg-entry-media:after {
            content: "'. $args['episode'] .'";
            }
        </style>
    ';
    return $style;
}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'episode_number_background', 'shortcode_episode_number_background' );
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
        'category'      => 'posts',
        'slug'          => 'mvdb_episode_number_background',
        'code'          => '[episode_number_background]',
        'description'   => 'Return a \<style\> tag to style a specific post within a specific essential grid.',
        'inputs'        => '<ul><li>@string Required Post id.</li>
                            <li>@string Required Episode number.</li></ul>',
        'outputs'       => '@string Output a style tag.',
        'example'       => '[episode_number_background id="2144" episode="123"]',
    )
);
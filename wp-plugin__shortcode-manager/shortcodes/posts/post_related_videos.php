<?php


/* ========================================================================================
 *
 * Return the related videos to episode.
 *
 * This will look at the current post's related video ACF Field and return a list of
 * formatted videos.
 * Location:    Page > Post > Related Videos
 *
 * [post_related_videos]
 *
 * @return  string  $relatedvideos      Styled video list.
 *
 * ======================================================================================= */
function shortcode_related_videos( $attr ){

    $args = shortcode_atts( array(
        'id' => null,
    ), $attr );

    $posts = get_field('prerequisite_videos', $args['id']);

    if( $posts ) {
        $result = '<ul class="mvdb-related-videos">';

        foreach( $posts as $p){ // variable must be called $post (IMPORTANT)

            $title = get_the_title( $p->ID );
            $link = get_permalink( $p->ID );
            $img = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'single-post-thumbnail' );

            $result .= '<li class="mvdb-related-videos-item">';
            $result .= '<a class="mvdb-related-videos-link" href=" ' . $link . '">';
            $result .= '<div class="mvdb-related-videos-image-background">';
            $result .= '<img class="mvdb-related-videos-image" src="' . $img[0] . '">';
            $result .= '</div>';
            $result .= '<div class="mvdb-related-videos-title">' . $title . '</div>';
            $result .= '</a>';
            $result .= '</li>';
        }

        $result .= '</ul>';

        return $result;
    }

}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'post_related_videos', 'shortcode_related_videos' );
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
        'slug'          => 'mvdb_post_related_videos',
        'code'          => '[post_related_videos]',
        'description'   => 'This will look at the current posts related video ACF Field and return a list of formatted videos.',
        'outputs'       => '@int Output styled list of videos.',
        'example'       => '[post_related_videos]',
    )
);
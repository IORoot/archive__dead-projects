<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/META/ENTRIES.PHP
// -----------------------------------------------------------------------------
// Registers the meta boxes for pages, posts, and portfolio items.
// =============================================================================

// Posts
// =============================================================================

function x_add_series_meta_boxes() {

    $meta_box = array(
        'id'          => 'x-meta-box-post',
        'title'       => __( 'Post Settings', '__x__' ),
        'description' => __( 'Here you will find various options you can use to create different page styles.', '__x__' ),
        'page'        => 'series',
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'name' => __( 'Body CSS Class(es)', '__x__' ),
                'desc' => __( 'Add a custom CSS class to the &lt;body&gt; element. Separate multiple class names with a space.', '__x__' ),
                'id'   => '_x_entry_body_css_class',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => __( 'Fullwidth Post Layout', '__x__' ),
                'desc' => __( 'If your global content layout includes a sidebar, selecting this option will remove the sidebar for this post.', '__x__' ),
                'id'   => '_x_post_layout',
                'type' => 'checkbox',
                'std'  => ''
            ),
            array(
                'name' => __( 'Alternate Index Title', '__x__' ),
                'desc' => __( 'Filling out this text input will replace the standard title on all index pages (i.e. blog, category archives, search, et cetera) with this one.', '__x__' ),
                'id'   => '_x_entry_alternate_index_title',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => __( 'Background Image(s)', '__x__' ),
                'desc' => __( 'Click the button to upload your background image(s), or enter them in manually using the text field above. Loading multiple background images will create a slideshow effect. To clear, delete the image URLs from the text field and save your page.', '__x__' ),
                'id'   => '_x_entry_bg_image_full',
                'type' => 'uploader',
                'std'  => ''
            ),
            array(
                'name' => __( 'Background Image(s) Fade', '__x__' ),
                'desc' => __( 'Set a time in milliseconds for your image(s) to fade in. To disable this feature, set the value to "0."', '__x__' ),
                'id'   => '_x_entry_bg_image_full_fade',
                'type' => 'text',
                'std'  => '750'
            ),
            array(
                'name' => __( 'Background Images Duration', '__x__' ),
                'desc' => __( 'Only applicable if multiple images are selected, creating a background image slider. Set a time in milliseconds for your images to remain on screen.', '__x__' ),
                'id'   => '_x_entry_bg_image_full_duration',
                'type' => 'text',
                'std'  => '7500'
            )
        )
    );

    x_add_meta_box( $meta_box );

    //
    // Video.
    //

    $meta_box = array(
        'id'          => 'x-meta-box-video',
        'title'       => __( 'Video Post Settings', '__x__' ),
        'description' => __( 'These settings enable you to embed videos into your posts.', '__x__' ),
        'page'        => 'series',
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'name'    => __( 'Aspect Ratio', '__x__' ),
                'desc'    => __( 'Select the aspect ratio for your video.', '__x__' ),
                'id'      => '_x_video_aspect_ratio',
                'type'    => 'select',
                'std'     => '',
                'options' => array( '16:9', '5:3', '5:4', '4:3', '3:2' )
            ),
            array(
                'name' => __( 'M4V File URL', '__x__' ),
                'desc' => __( 'The URL to the .m4v video file.', '__x__' ),
                'id'   => '_x_video_m4v',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => __( 'OGV File URL', '__x__' ),
                'desc' => __( 'The URL to the .ogv video file.', '__x__' ),
                'id'   => '_x_video_ogv',
                'type' => 'text',
                'std'  => ''
            ),
            array(
                'name' => __( 'Embedded Video Code', '__x__' ),
                'desc' => __( 'If you are using something other than self hosted video such as YouTube, Vimeo, or Wistia, paste the embed code here. This field will override the above.', '__x__' ),
                'id'   => '_x_video_embed',
                'type' => 'textarea',
                'std'  => ''
            )
        )
    );

    x_add_meta_box( $meta_box );

}

add_action( 'add_meta_boxes', 'x_add_series_meta_boxes' );
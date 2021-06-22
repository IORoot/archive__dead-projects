<?php

/* ========================================================================================
 *
 * 1. DEFINE SHORTCODE
 *
 * Very simple shortcode to return the current post title.
 * Location:    Page > Post > Post Title
 *
 * [post_title]
 *
 * @return  string  $title      Returns the title.
 *
 * ======================================================================================= */

        function mvdb_post_title( $attr ){
            
            $args = shortcode_atts( array(
                'id' => get_the_id(),
            ), $attr );

            return get_the_title($args['id']);
        }



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */
        add_filter('init', 'add_mvdb_post_title');

        function add_mvdb_post_title() {
            add_shortcode( 'post_title', 'mvdb_post_title' );
        }



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
                'category'     => 'posts',
                'slug'         => 'mvdb_post_title',
                'code'         => '[post_title]',
                'description'  => 'Displays the current posts title.',
                'outputs'      => '@string ',
            )
        );
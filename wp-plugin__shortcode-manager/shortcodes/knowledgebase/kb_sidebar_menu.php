<?php


/* ========================================================================================
 *
 * Return a category list and posts for knowledgebase
 *
 * ======================================================================================= */
function shortcode_kb_sidebar_menu($attr = null){

    // Optional Series_ID : Default is current post.
    $input_args = shortcode_atts( array(
        'post_type' => 'knowledgebase',
        'taxonomy' => 'topic',
        'status' => 'publish',
    ), $attr );

    // Is user is NOT Editor or Admin then only display public posts.
    // Otherwise keep it to what it is set to. (Published / private / future / etc)
    $post_status = 'publish';
    if( current_user_can('editor') || current_user_can('administrator') ){
        $post_status = $input_args['status'];
        $tabbed_one_start = '[vc_tta_tabs][vc_tta_section title="Pubilc" tab_id="1521716634040-65f0912d-d1cf"][vc_column_text]';
        $tabbed_one_end = '[/vc_column_text][/vc_tta_section]';
        $tabbed_two_start = '[vc_tta_section title="Private" tab_id="1521716634061-4065cbad-bc83"][vc_column_text]';
        $tabbed_two_end = '[/vc_column_text][/vc_tta_section][/vc_tta_tabs]';
    }


    // create list of all categories within the 'topic' taxonomy.
    // (Episodes / Listings / Profile / Search / Series / Site)
    $custom_terms = get_terms($input_args['taxonomy'], array(
        'hide_empty' => false,
    ));

    //var_dump($custom_terms);

    // If ADMIN, Add a tabbed Public/Private.
    if ($tabbed_one_start){
        $sidebar .= $tabbed_one_start;
        $sidebar .= create_sidebar_list($input_args, $custom_terms, 'publish');
        $sidebar .= $tabbed_one_end;
    } else {
        // Otherwise just display public posts.
        $sidebar .= create_sidebar_list($input_args, $custom_terms, 'publish');
    }


    if ($tabbed_two_start){
        $sidebar .= $tabbed_two_start;
        $sidebar .= create_sidebar_list($input_args, $custom_terms, 'private');
        $sidebar .= $tabbed_two_end;
    }

    return $sidebar;
}

function create_sidebar_list($input_args, $custom_terms, $post_status){
    // Start building sidebar.
    $sidebar .= '<ul class="mvdb-kb-accordion-menu">';

    // Loop through each category
    $loopcount = 0;
    foreach($custom_terms as $custom_term) {

        $loopcount++;
        wp_reset_query();

        /* Setup Query parameters based on post_type and current category.
         *
         * https://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters
         * https://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
         * https://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters
         *
        */
        $args = array('post_type' => $input_args['post_type'],
            'tax_query' => array(
                array(
                    'taxonomy' => $input_args['taxonomy'],
                    'field' => 'slug',
                    'terms' => $custom_term->slug,
                ),
            ),
            'post_status' => $post_status,
        );


        $loop = new WP_Query($args);

        if($loop->have_posts()) {

            // Term Header
            $sidebar.= '<li class="has-children">';

            $sidebar.= '<input class="mvdb-kb-term-checkbox" type="checkbox" name="'.$post_status.'-group-'.$loopcount.'" id="'.$post_status.'-group-'.$loopcount.'">';
            $sidebar.= '<label class="mvdb-kb-term-label" for="'.$post_status.'-group-'.$loopcount.'"><i class="fa fa-caret-right mvdb-kb-caret"></i>'. $custom_term->name. '</label>';

            // List of posts under term
            $sidebar.= '<ul class="mvdb-kb-term-list">';

            while($loop->have_posts()) : $loop->the_post();
                $sidebar.= '<li class="mvdb-kb-post">';
                $sidebar.= '<a class="mvdb-kb-post-link" href="'.get_permalink().'">';
                $sidebar.= '<span class="mvdb-kb-post-title">';
                $sidebar.= preg_replace('#Private:#', '', get_the_title()) ;

                if (get_post_status() == 'private'){
                    $sidebar.= '<i class="fa fa-asterisk mvdb-kb-post-internal"></i>';
                }

                $sidebar.= '</span>';
                $sidebar.= '</a>';




                $sidebar.= '</li>';
            endwhile;

            $sidebar.= '</ul>';


            $sidebar.= '</li>';

        }
    };

    $sidebar.= '</ul>'; // outer mvdb-kb-sidebar

    return $sidebar;
}


/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'kb_sidebar_menu', 'shortcode_kb_sidebar_menu' );
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
        'category'      => 'knowledgebase',
        'slug'          => 'kb_sidebar_menu',
        'code'          => '[kb_sidebar_menu]',
        'description'   => 'Builds a structured list and menu of all articles for the knowledgebase.</br>
                            If the user is Editor/Admin then will see two menus for public & private.</br>
                            Design based on Github developer documentation.',
        'inputs'        => '<ul>
                                <li>post_type @string</li>
                                <li>taxonomy @string</li>
                                <li>status @string</li>
                            </ul>',
        'outputs'       => '@string the sidemenu.',
        'example'       => '[kb_sidebar_menu]',
    )
);
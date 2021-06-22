<?php

/* ========================================================================================
 *
 * Return a formatted taxonomy name
 *
 * Get the
 * Location:    Page > Post > Series Name
 *              Page > Post > Category Name
 *              Grid > MVDB Videos > Series Name
 *              Grid > MVDB Videos > Category Name
 *              Grid > MVDB Library Posts > Series Name
 *              Grid > MVDB Library Posts > Category Name
 *
 * [post_tax]
 *
 * @param   string  $id                 Optional Post ID
 * @param   string  $tax_name           Required Taxonomy name
 * @return  string  $relatedvideos      Styled Taxonomy Name
 *
 * ======================================================================================= */
function shortcode_current_taxonomy( $attr ){

    $args = shortcode_atts( array(
        'id' => get_the_id(),
        'tax_name' => ''
    ), $attr );

    $series = get_the_terms($args['id'], $args['tax_name']);

    if ( ! empty( $series ) ) {
        return '<a href="'. get_the_permalink($series[0]->term_id) .'"><div class="mvdb-video-series">' . esc_html( $series[0]->name ) . '</div></a>';
    }

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
    add_shortcode( 'post_tax', 'shortcode_current_taxonomy' );
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
        'slug'          => 'mvdb_post_tax',
        'code'          => '[post_tax]',
        'description'   => 'Return a formatted category(tax) name for a specific post.',
        'inputs'        => '<ul><li>@string Optional Post id.</li>
                            <li>@string Optional Tax Name.</li></ul>',
        'outputs'       => '@string Output category of post.',
        'example'       => '[post_tax id="2144" tax_name="series"]',
    )
);
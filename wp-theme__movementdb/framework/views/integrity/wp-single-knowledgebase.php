<?php


// =============================================================================
// VIEWS/INTEGRITY/WP-SINGLE-KNOWLEDGEBASE.PHP
// -----------------------------------------------------------------------------
// Single-knowledgebase custom post type output for Integrity.
// =============================================================================

?>

<?php get_header(); ?>

    <div class="x-container max width offset">
        <div class="x-main left" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php x_get_view( 'integrity', 'content', get_post_format() ); ?>
            <?php endwhile; ?>

        </div>

        <aside class="<?php x_sidebar_class(); ?>" role="complementary">
            <?php if ( get_option( 'ups_sidebars' ) != array() ) : ?>
                <?php dynamic_sidebar( apply_filters( 'ups_sidebar', 'knowledgebase' ) ); ?>
            <?php else : ?>
                <?php dynamic_sidebar( 'sidebar-main' ); ?>
            <?php endif; ?>
        </aside>

    </div>

<?php get_footer(); ?>
<?php

// =============================================================================
// VIEWS/INTEGRITY/CONTENT-KNOWLEDGEBASE.PHP
// -----------------------------------------------------------------------------
// Video post output for Integrity. Customised for KNOWLEDGEBASE CPT.
// =============================================================================

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-wrap">
        <?php x_get_view( 'integrity', '_content', 'post-header' ); ?>
        <?php x_get_view( 'global', '_content' ); ?>
    </div>
    <?php x_get_view( 'integrity', '_content', 'post-footer' ); ?>
</article>
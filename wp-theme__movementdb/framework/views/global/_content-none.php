<?php

// =============================================================================
// VIEWS/GLOBAL/_CONTENT-NONE.PHP
// -----------------------------------------------------------------------------
// Output when no posts or pages are available.
// =============================================================================

?>

<article id="post-0" class="post-0 post type-post status-publish hentry content-none">
  <div class="entry-wrap">
    <header class="entry-header">
        <br/>
      <h1 class="entry-title"><?php _e( 'Sorry, nothing has been found. Here are our latest posts instead...', '__x__' ); ?></h1>
    </header>
    <div class="entry-content">
        <div class="mvdb-search">
            <?php echo do_shortcode( '[series_item_backgrounds id="8"]' ); ?>
            <?php echo do_shortcode( '[ess_grid alias="mvdb-search-results" special="latest"]' ); ?>
        </div>
    </div>
  </div>
</article> <!-- end #post-0 -->
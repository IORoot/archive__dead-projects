<?php

// =============================================================================
// SINGLE.PHP
// -----------------------------------------------------------------------------
// Handles output of individual posts.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's posts, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "wp-single.php," where you'll be able to find the
// appropriate output.
//
// ANDYP
// This points to the framework/views/integrity/wp-single-series.php file.
//
// =============================================================================

?>

<?php x_get_view( x_get_stack(), 'wp', 'single-series' ); ?>
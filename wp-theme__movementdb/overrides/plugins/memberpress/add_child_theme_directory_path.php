<?php

/*
 * This filter will make memberpress look into this folder for new views.
 * The reason is to get the themes/movementdb/memberpress directory moved to
 * a better location.
 * themes/movementdb/overrides/plugins/memberpress
 */

add_filter('mepr_view_paths', 'run_this_mvdb_filter_check');

function run_this_mvdb_filter_check($paths){

    // Define new directory
    $child_theme_directory = get_stylesheet_directory() . "/overrides/plugins/memberpress/views";

    // Push new location onto front of paths array.
    array_unshift($paths, $child_theme_directory);

    return $paths;

}
<?php

add_filter('essgrid_query_caching', 'eg_stop_caching', 10, 2);

// turn off caching for your grid
function eg_stop_caching($do_cache, $grid_id) {
    if($grid_id == 1) return false;
    if($grid_id == 2) return false;
    if($grid_id == 4) return false;
    if($grid_id == 8) return false;
    if($grid_id == 15) return false;

    return true;
}
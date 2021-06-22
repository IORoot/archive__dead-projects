<?php

function eg_change_skin($skin_id) {
    return $_GET['egskin'];
}

// wp will watch run this action on load.
add_action( 'wp', 'switch_the_essgrid_skin' );

// Run this filter if the 'egskin' parameter is supplied.
function switch_the_essgrid_skin() {
    // IF there is a 'Skin' parameter in the URL.
    if ($_GET['egskin']) {
        // Run Filter to change the skin.
        add_filter('essgrid_switch_item_skin', 'eg_change_skin', 10, 2);
    }
}
<?php

/*
 * This filter will make buddypress look into this folder for new views.
 * The reason is to get the themes/movementdb/buddypress directory moved to
 * a better location.
 * themes/movementdb/overrides/plugins/buddypress
 */
function cm_load_template_filter() {
    bp_register_template_stack( 'cm_get_template_location');
}
add_filter( 'bp_located_template', 'cm_load_template_filter');

/* Return the new location */
function cm_get_template_location() {
    return get_stylesheet_directory() . "/overrides/plugins/buddypress/templates";
}
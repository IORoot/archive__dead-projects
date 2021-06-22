<?php

/*
 * Remove the [' '] around the text. Not sure why this is happening. Fault of Essgrid.
 */
add_filter('essgrid_output_filter_unwrapped', 'run_this_filter_check');

function run_this_filter_check($args){

    $args = str_replace("['Pro']",'Pro',$args);
    $args = str_replace("['Free']",'Free',$args);
    return $args;

}
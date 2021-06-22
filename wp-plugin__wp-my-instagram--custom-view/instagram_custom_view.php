<?php
/*
Plugin Name: _ANDYP - Instagram custom view
Plugin URI: http://londonparkour.com
Description: <strong>🧬FILTER</strong> | <em>filter on wpmi_item_template</em> | Alter the view on the Instagram plugin to include descriptions.
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

add_filter( 'wpmi_item_template', 'filter_instagram_item' );

function filter_instagram_item($instagram_item_url){

    // change the url to be OUR version of the item
    $our_instagram_item_url = __DIR__ . '/item.php';

    return $our_instagram_item_url;

}
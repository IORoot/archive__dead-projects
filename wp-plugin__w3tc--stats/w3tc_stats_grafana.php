<?php

/*
Plugin Name: _ANDYP - W3 Total Cache - Stats to Grafana
Plugin URI: http://londonparkour.com
Description: <strong>ð§®METRICS</strong> | <em>Grafana</em> | Uses the filters on W3TC to output the stats for grafana.
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

/*                                                                              
*   âââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââ 
*   â                                                                         ââ
*   â          &triggerstats on the URL line will run this function.          ââ
*   â                                                                         ââ
*   â It will get the contents of the 'w3tc_stats_history' MySQL field in the ââ
*   â               options table and (over)write the log file.               ââ
*   â                                                                         ââ
*   â                     This file is run from crontab.                      ââ
*   â                                                                         ââ
*   ââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââ
*    âââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââââ
*/

if (array_key_exists('triggerstats', $_GET)){

    $filename = plugin_dir_path( __FILE__ ) . '/w3tc_stats.log';
    $output = '';

    // get array of entries.
    $data = json_decode(get_site_option( 'w3tc_stats_history'));

    // Iterate over every entry of the array
    // Overwriting each line - grok_exporter only takes the first REGEX hit
    // And stores it in prometheus. 
    foreach ($data as $entry) {
        $output = json_encode($entry)."\n"; 
    }

    // output to the file.
    file_put_contents($filename, $output);
}

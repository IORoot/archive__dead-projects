<?php
/*
Plugin Name: MovementDB Custom Shortcodes
Plugin URI: http://movementdb.com
description: Set of custom shortcodes used for the movementdb.com website. Created by Pearson Solutions.
Version: 1.0
Author: Andy Pearson
Author URI: http://movementdb.com
License: GPL2
*/

/* Constant Definitions */
        define( 'PLUGIN_DIR', dirname(__FILE__).'/' );

/* INCLUDES - Add Admin pages */
        include( plugin_dir_path( __FILE__ ) . 'admin/admin_page.php');


/* INCLUDES - Add all php files in 'shortcodes' directory */
        foreach(glob(PLUGIN_DIR . "/shortcodes/*/*.php") as $file){
            require $file;
        }

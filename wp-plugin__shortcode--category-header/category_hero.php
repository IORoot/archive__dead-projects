<?php

/*
 * @package   ANDYP - Tutorial Category Hero
 * @author    Andy Pearson <andy@londonparkour.com>
 * @copyright 2020 LondonParkour
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Tutorials Category Hero
 * Plugin URI:        http://londonparkour.com
 * Description:       Dynamically generates the tutorials category header hero.
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Text Domain:       andyp-category-hero
 * Domain Path:       /languages
 */

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                  ACF Admin Page for Options & Settings                  │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/admin/acf_admin_page.php';

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                           The Shortcode                                 │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/shortcodes/category_hero.php';
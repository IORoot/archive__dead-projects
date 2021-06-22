<?php
/*
Plugin Name: _ANDYP - Team Booking - Coupon creator
Plugin URI: https://londonparkour.com
Description: <strong>🎛PANEL</strong> | <em>ANDYP > Generate Coupons</em> | Custom TeamBooking coupon generator. Warning! Requires BOTH TeamBooking & Stripe Payments.
Version: 2.0.0
Author: Andy Pearson
Author URI: https://londonparkour.com
*/

// Admin - ACF Options page
include "src/admin/acf_admin_page.php";
include "src/admin/acf_get_options.php"; 
include "src/admin/acf_panel.php"; 

// Generate Coupons class
include "src/db/generate-coupon.php";

// Hooks
include "src/hooks/hook_stripe_payment.php";

// Shortcodes
include "src/shortcodes/check_coupon_code.php";

// Filters
include "src/filters/display_coupon_code.php";

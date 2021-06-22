<?php
/*
Plugin Name: _ANDYP - Team Booking - Loyalty Counter
Plugin URI: http://londonparkour.com
Description: <strong>🎛PANEL</strong> | <em>Teambooking > Loyalty Counter</em> | Show how many classes each person has booked.
Version: 1.0
Author: Andy Pearson
Author URI: http://londonparkour.com
*/

// DB Access
require_once __DIR__.'/src/db/db.php';

// Helper functions
require_once __DIR__.'/src/helpers/helpers.php';

// ACF Views
require_once __DIR__.'/src/views/acf_summary.php';

// Dashboard widget
require_once __DIR__.'/src/views/dashboard_widget.php';


class tbk_loyalty_counter {

    // DB Access
    use loyalty_db;

    // Helper functions
    use loyalty_helpers;

    // ACF Views
    use acf_summary;

    // Dashboard Widget
    use dashboard_widget;

    /**
     * $reservations_raw
     * Serialised and eencoded data.
     *
     * @var array
     */
    public $reservations_raw = [];


    /**
     * $reservations_formatted
     * This is all of the reservations after being
     * deserialised. This is real strings.
     *
     * @var array
     */
    public $reservations_formatted = [];

    
    /**
     * $reservations_acf
     *
     * @var array
     */
    public $reservations_acf = [];


    /**
     * $widget_free
     *
     * @var array
     */
    public $widget_free = [];


    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        // populates $reservations_formatted array
        $this->get_reservations();

        return;
    }


    /**
     * output_reservations
     *
     * @return void
     */
    public function output_reservations(){

        // Only admins.
        if( !current_user_can('administrator') ) { 
            return;
        }

        // Add count of total number of classes to array 
        $this->add_total_classes();

        // Combine together
        $this->combine_by_field('email');

        // sort array by email
        $this->sort_array('total', SORT_DESC);

        // Output view of array.
        $this->acf_summary(null,  0);

        return;
    }


    /**
     * output_widget
     *
     * @return void
     */
    public function output_widget(){

        // Only admins.
        if( !current_user_can('administrator') ) { 
            return;
        }

        // Add count of total number of classes to array 
        $this->add_total_classes();

        // Combine together
        $this->combine_by_field('email');

        // sort array by email
        $this->sort_array('total', SORT_DESC);

        // Output dashboard widget.
        $this->dashboard_widget();

        return;
    }


    /**
     * get_acf_rows
     *
     * @return void
     */
    public function get_acf_rows(){
        return $this->reservations_acf;
    }

    
    /**
     * get_widget_rows
     *
     * @return void
     */
    public function get_widget_rows(){
        return $this->widget_free;
    }
    
}


// ACF Admin Pages
require_once __DIR__.'/src/admin/acf_admin_page.php';

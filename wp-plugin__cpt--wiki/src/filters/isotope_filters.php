<?php

namespace andyp\cpt\wiki\filters;

class isotope_filters
{

	public function __construct()
	{
        add_filter('andyp-grid__cell-title', [$this,'andyp_grid_cell_title']);
        add_filter('andyp-grid__cell-count', [$this,'andyp_grid_cell_count']);
	}


    /**
     * Tidy up the titles on the dashboard
     */
    public function andyp_grid_cell_title($title) {

        $title = preg_replace( "/ - SlowMo/", "", $title );
        $title = preg_replace( "/ - side view/", "", $title );
        $title = preg_replace( "/ - back view/", "", $title );
        $title = preg_replace( "/ - front view/", "", $title );

        return $title;
    }


    /**
     * Append ' Videos' to the end of the count.
     */
    public function andyp_grid_cell_count($count) {

        return $count . ' videos';
    }

}

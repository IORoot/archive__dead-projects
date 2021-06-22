<?php

class andyp_tax_lister_shortcode {

    public $tax;
    public $title;

    public $results = [];

    public $output;



    /**
     * __construct
     *
     * @return void
     */
    public function __construct($tax, $title){

        $this->tax = $tax;
        $this->title = $title;

        $this->get_results();
        $this->enqueue_css();

        return $this;
    }




    /**
     * get_results
     *
     * @return void
     */
    public function get_results(){

        $this->results = get_terms([
            'taxonomy' => $this->tax,
            'hide_empty' => false,
        ]);

        return $this;

    }



    /**
     * render_results
     *
     * @return void
     */
    public function render_results(){

        ob_start();

        $output = $this->render_title();

        $output .= '<ul class="andyp-tax-list">';

            // Check if any results exist
            if ( ! empty( $this->results ) && is_array( $this->results ) ) {

                foreach ( $this->results as $cell ) {
                    $output .= $this->render_cell($cell);
                }
            }

        $output .= '</table>';

        echo $output;

        return ob_end_flush();
    }



    /**
     * render_title
     *
     * @return void
     */
    public function render_title(){

        return '<h3 class="andyp-tax-list__header">'.$this->title.'</h3>';

    }



    /**
     * render_cell
     *
     * @return void
     */
    public function render_cell($cell){

        $output = '<li class="andyp-tax-list__item" >';
            $output .= '<a class="andyp-tax-list__link" href="' . esc_url( get_term_link($cell->term_id) ) . '">';

                // Category name
                $output .= '<p class="andyp-tax-list__title">'.$cell->name.'</p>';
                // $output .= '<div class="andyp-tax-list__description">'.$cell->description.'</div>';

            $output .= '</a>';
        $output .= '</tr>';

        return $output;

    }

    

    /**
     * enqueue_css
     *
     * @return void
     */
    public function enqueue_css(){

        // $css = '';
        // wp_add_inline_style( 'andyp_tax-list_css' , $css );

        // Finally enqueue the grid css.
        wp_enqueue_style( 'register_tax_lister_css' );

        return $this;
    }


}



/**
 * Create the class and return results.
 */
function andyp_tax_lister($atts){

    // Extract the 'slug' attribute
    $a = shortcode_atts( 
        array(
            'tax' => '',
            'title' => ''
            ) , $atts );

    $grid = new andyp_tax_lister_shortcode($a['tax'], $a['title']);

    $grid->render_results();

    return;
}

add_shortcode( 'andyp_tax_lister', 'andyp_tax_lister' );
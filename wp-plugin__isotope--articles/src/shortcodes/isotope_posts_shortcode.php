<?php

class andyp_isotope_post_shortcode {

    public $options = [];

    public $results = [];

    public $output;

    public $slug;

    public $term;

    public $tax;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct($slug, $tax = null, $term = null){

        $this->slug = $slug;
        $this->tax = $tax;
        $this->term = $term;

        $this->get_options();
        $this->get_results();
        $this->enqueue_css();

        return $this;
    }


    /**
     * get_options
     *
     * @return void
     */
    public function get_options(){

        $result = []; 

        // // If field exists as an option
        if( have_rows('isotope_shortcode', 'option') ) {

            // Go through all rows of 'repeater'
            while( have_rows('isotope_shortcode', 'option') ): $row = the_row();

                // Fields to retrieve from repeater
                $result = array ( 
                    'slug'              => get_sub_field('shortcode_slug'),
                    'title'             => get_sub_field('shortcode_title'),
                    'viewport_cells'    => get_sub_field('viewport_cells'),
                    'vertical_grid'     => get_sub_field('viewport_vertical_grid'),
                    'render_filters'    => get_sub_field('render_filters'),
                    'request_type'      => get_sub_field('request_type'),
                    'post_args'         => $this->lb(get_sub_field('args')), 
                    'isotope_args'     => $this->lb(get_sub_field('isotope_args')), 
                    'isotope_css'      => $this->lb(get_sub_field('isotope_css')), 
                );

                // push onto result array if the right slug is being used.
                if ($result['slug'] == $this->slug){                   
                    $this->options = $result;
                }
                
            endwhile;
        }

        return $this;

    }


    /**
     * remove_linebreaks
     *
     * @param mixed $in
     * @return void
     */
    public function lb($in){

        return preg_replace( "/\r|\n/", "", $in );

    }


    /**
     * get_results
     *
     * @return void
     */
    public function get_results(){

        $post_args = preg_replace( "/\r|\n/", "", $this->options['post_args'] );

        if ($post_args != ''){
            $args = eval("return $post_args;");

            $args = $this->filter_optional_term($args);
        }

        if ($this->options['request_type'] == 'get_terms'){
            $this->results = get_terms($args);
            return $this;
        }

        $this->results = get_posts($args);
        return $this;

    }


    /**
     * insert_tax
     *
     * @param mixed $args
     * @return void
     */
    public function filter_optional_term($args){

        if (!empty($this->tax) && !empty($this->term)){
            $args['tax_query'] = [
                [
                    'taxonomy' => $this->tax,
                    'field' => 'slug',
                    'terms' => $this->term
                ]
            ];
        }

        return $args;

    }


    /**
     * render_results
     *
     * @return void
     */
    public function render_results(){

        ob_start();

        $output = '<div class="andyp-isotope '.$this->options['slug'].'">';

            $output .= $this->render_title();

            if ($this->options['render_filters'] == TRUE){
                $output .= $this->render_controls();
            }

            $isotope = '';
            if ($this->options['isotope_args'] != ''){
                $isotope = 'data-isotope=\' '.$this->options['isotope_args'].' \'';
            }

            $output .= '<div class="andyp-isotope__main-isotope grid" '.$isotope.'>';

            // Check if any results exist
            if ( ! empty( $this->results ) && is_array( $this->results ) ) {

                // Loop the results array.
                foreach ( $this->results as $cell ) {

                    if ($this->options['request_type'] == 'get_terms'){ 

                        // Terms , not posts.
                        $output .= $this->render_term($cell); 

                    } else {

                        // Default Posts.
                        $output .= $this->render_cell($cell);
                    }

                    
                }
                
            }
            
            $output .= '</div>';

        $output .= '</div>';

        echo $output;

        return ob_end_flush();
    }



    /**
     * render_title
     *
     * @return void
     */
    public function render_title(){

        // Append the taxonomy term to the front of the titles.
        $suffix = '';
        if (!empty($this->term)){
            $this->term = str_replace('-', ' ', $this->term);
            $suffix = ucwords($this->term);
        }

        if ($this->options['title'] != ''){
            return '<h3 class="andyp-isotope__header">'. $this->options['title'] . '<span class="andyp-isotope__header-tax"> '. $suffix .'</span></h3><div id="andyp-isotope__results-total"></div>';
        }

        return;
    }



    public function render_controls(){

        $controls = '';
        $views = '';
        $tags = '';
        $fx = '';

        $terms = get_terms(array(
            'taxonomy' => 'articletags',
            'hide_empty' => false,
        ));

        // Create all options.
        foreach ($terms as $term){
            
            if (strpos($term->slug, 'view') !== false) {
                $views .= $this->render_select_option('.'. $term->slug, $term->name);
            } elseif (strpos($term->slug, 'slowmo') !== false) {
                $fx .= $this->render_select_option('.'. $term->slug, $term->name);
            } else {
                $tags .= $this->render_select_option('.'. $term->slug, $term->name);
            }
            
        }
        
        // Render controls.
        $controls = '<div class="andyp-isotope__filters">';
            $controls .= $this->render_filter_group($tags, 'tags');
            $controls .= $this->render_filter_group($views, 'views'); 
            $controls .= $this->render_filter_group($fx, 'fx');
        $controls .= '</div>';

        return $controls;
    }



    /**
     * render_button_group - Combination of selects
     *
     * @param mixed $controls
     * @param mixed $group
     * @return void
     */
    public function render_filter_group($controls, $group = 'all'){
        $output = '<div class="andyp-isotope__filter" data-filter-group="'.$group.'">';
            $output .= $this->render_select($controls, $group);
        $output .= '</div>';

        return $output;
    }

    
    /**
     * render_select
     *
     * @param mixed $controls
     * @return void
     */
    public function render_select($controls, $all){
        $output = '<i class="mdi mdi-chevron-down andyp-isotope__select-icon"></i>';
        $output .= '<select class="andyp-isotope__select">';
            $output .= $this->render_select_option(null, 'All ' . ucfirst($all)); // ALL
            $output .= $controls;
        $output .= '</select>';

        return $output;
    }


    /**
     * render_select_option
     *
     * @param mixed $value
     * @param mixed $name
     * @return void
     */
    public function render_select_option($value = '*', $name = 'ALL'){

        $output = '<option class="andyp-isotope__option" value="'.$value.'">'.$name.'</option>';

        return $output;

    }



    /**
     * render_cell
     *
     * @return void
     */
    public function render_cell($cell){

        $filter_classes = $this->add_terms_as_classes($cell->ID);

        $output = '<div class="andyp-isotope__cell pushin '.$filter_classes.'">'; 

            $output .= '<a class="andyp-isotope__cell-link" href="' . esc_url( get_post_permalink($cell->ID) ) . '">';

                $image_url = get_the_post_thumbnail_url($cell->ID, 'full');

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-overlay"><i class="andyp-isotope__cell-icon mdi mdi-eye"></i></div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-image lazyload" data-bg="'.$image_url.'"></div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-date floorfade">'.human_time_diff( get_the_time( 'U', $cell->ID ), current_time( 'timestamp' ) ).' ago.</div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-title">';

                    // Image / video / playlist icon + title
                    $output .= '<i class="andyp-isotope__cell-icon mdi--smoke mdi '.$this->video_or_image($cell).'" ></i>';
                    $output .= apply_filters('andyp-isotope__cell-title', $cell->post_title);

                $output .= '</div>';

                

            $output .= '</a>';

        $output .= '</div>';

        return $output;

    }


    /**
     * render_term
     *
     * @param mixed $cell
     * @return void
     */
    public function render_term($cell){

        $output = '<div class="andyp-isotope__cell pushin">'; 

            $output .= '<a class="andyp-isotope__cell-link" href="' . esc_url( get_term_link($cell->term_id) ) . '">';

                $image =  get_field("article_category_image", 'term_'.$cell->term_id);

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-overlay"><i class="andyp-isotope__cell-icon mdi mdi-eye"></i></div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-image lazyload" data-bg="'.$image['url'].'"></div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-date floorfade">'.$cell->count.' Items. </div>';

                $output .= '<div class="andyp-isotope__cell-meta andyp-isotope__cell-title">';

                    // Image / video / playlist icon + title
                    $output .= '<i class="andyp-isotope__cell-icon mdi--smoke mdi '.$this->video_or_image($cell).'" ></i>';
                    $output .= apply_filters('andyp-isotope__cell-title', $cell->name);

                $output .= '</div>';

            $output .= '</a>';

        $output .= '</div>';

        return $output;

    }


    /**
     * video_or_image
     *
     * @param mixed $cell
     * @return void
     */
    public function video_or_image($cell){

        if(get_post_meta($cell->ID, 'videoId', true) == '') {
            return 'mdi-book-open';  
        }

        return 'mdi-play-circle-outline';
    }


    /**
     * add_terms_as_classes
     * 
     * Add each tag to a class list
     *
     * @param mixed $title
     * @return void
     */
    public function add_terms_as_classes($post_id){

        $filter_classes = '';

        $all_terms = get_the_terms($post_id, 'articletags');

        if ($all_terms == false){return;}

        foreach ($all_terms as $term){
            $filter_classes .= $term->slug . ' ';
        }

        return $filter_classes;
    }


    /**
     * enqueue_css
     *
     * @return void
     */
    public function enqueue_css(){

        // Load and enqueue now, before everything else.
        wp_register_style( 'andyp_isotope_immediate_css', ANDYP_ISOTOPE_PATH . 'src/sass/immediate.css' );
        wp_enqueue_style( 'andyp_isotope_immediate_css' );

        // Load later (in shortcode)
        wp_register_style( 'andyp_isotope_css', ANDYP_ISOTOPE_PATH.'src/sass/style.css' );
        wp_register_script( 'andyp_isotope_js', ANDYP_ISOTOPE_PATH.'src/js/andyp-isotope.js' );

        // ISOTOPE
        wp_register_script( 'isotope_js', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js' );

        $css = '';
        $default_viewport_cells = 4;
        $default_vertical_grid = 5;
        $meta_lines = 1;


        // Add resizing Number of Cells for CSS.
        if ($this->options['viewport_cells'] != ''){
            $css .= '.'.$this->options['slug'] . ' .andyp-isotope__cell { ';         
                $css .= 'width: '. 100 / $this->options['viewport_cells'] . '%; ';
            $css .= '}';
        }

        // Add resizing Height of Cell Image for CSS.
        if ($this->options['vertical_grid'] == ''){ $this->options['vertical_grid'] = $default_vertical_grid; }

        // Each cell min-height
        $css .= '.'.$this->options['slug'] . ' .andyp-isotope__cell { ';         
            $css .= 'height: '. 29 * ($this->options['vertical_grid'] + $meta_lines) . 'px !important; ';
        $css .= '}';

        // Each cell image height
        $css .= '.'.$this->options['slug'] . ' .andyp-isotope__cell-image { ';         
            $css .= 'height: '. 29 * $this->options['vertical_grid'] . 'px !important; ';
        $css .= '}';
        

        // Add any rules included in the ACF CSS Field.
        $css .= $this->options['isotope_css'];

        wp_add_inline_style( 'andyp_isotope_css' , $css );

        // Enqueue the ISOTOPE JS
        wp_enqueue_script('isotope_js');

        // Plugin CSS / JS.
        wp_enqueue_script('andyp_isotope_js');
        wp_enqueue_style( 'andyp_isotope_css' );

        return $this;
    }


}



/**
 * Create the class and return results.
 */
function andyp_isotope_posts($atts){

    $a = shortcode_atts( 
        array(
            'slug' => '',
            'tax'  => null,
            'term' => null,
        ), $atts );

    $grid = new andyp_isotope_post_shortcode($a['slug'], $a['tax'], $a['term']);

    $grid->render_results();

    return;
}

add_shortcode( 'andyp_isotope', 'andyp_isotope_posts' );
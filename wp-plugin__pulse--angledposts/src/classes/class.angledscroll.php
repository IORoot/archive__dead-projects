<?php

class angledscroll {

    public $cpt;

    public $taxonomy;

    public $term;

    public $items;

    public $orderby = '';

    public $order = 'ASC';

    public $rows = 3;

    public $entries_on_a_row = 4;

    public $row_result;

    public $result;

    public function __construct($attributes)
    {
        $this->set_attributes($attributes);
        $this->get_pulse_posts();
        $this->render();
    }


    public function set_attributes($attributes)
    {
        $this->cpt = $attributes['cpt'];
        $this->taxonomy = $attributes['tax'];
        $this->term = $attributes['term'];
        $this->items = $attributes['items'];
        $this->orderby = $attributes['orderby'];
        $this->order = $attributes['order'];
    }


    public function get_pulse_posts()
    {

        $args = [
            'numberposts'   => $this->items,
            'post_type'		=> $this->cpt,
            'orderby' 		=> $this->orderby, 
            'order' 		=> $this->order,
            'tax_query'     => $this->get_tax_queries()
        ];

        $this->result = get_posts($args);

        return;
    }





    public function get_tax_queries()
    {

        $output = [];

        $term_array = str_getcsv($this->term);

        if (!isset($term_array)){

            $output = [
                [
                    'taxonomy' => $this->taxonomy,
                    'field' => 'slug',
                    'terms' => $this->term
                ],
            ];

            return $output;
        }


        $output["relation"] = "OR";

        foreach ($term_array as $key => $option)
        {
            $output[] = 
                [
                    'taxonomy' => $this->taxonomy,
                    'field' => 'slug',
                    'terms' => $option
                ];
        }

        return $output;
    }




    public function render()
    {
        if (!isset($this->result))
        {
            return;
        }

        $output = '<div class="angledscroll scroll">';

            $output .= $this->create_rows();

        $output .= '</div>';

        $this->result = $output;
    }


    public function create_rows()
    {
        $output = '';

        for ($i = 1; $i <= $this->rows; $i++) {

            $output .= '<div class="angledscroll__row angledscroll__row--'.$i.' '. $this->odd_or_even($i) .'">';
            
            $output .= $this->create_entry();

            $output .= '</div>'; 

        }

        return $output;

    }



    public function create_entry()
    {
        $output = '';

        // Only take the first 4 entries.
        $this->row_result = array_slice($this->result, 0, $this->entries_on_a_row);

        // remove those entries from the main result array.
        $this->result = array_slice($this->result, $this->entries_on_a_row);

        foreach ($this->row_result as $key => $post) {

            $image_url = get_the_post_thumbnail_url($post, 'thumbnail');

            $output .= '<div class="angledscroll__item stack__item-'.$key.'">';
            $output .= '<div class="angledscroll__image" style="background-image: url(\''.$image_url.'\');" ></div>';
            $output .= '</div>';
        }

        return $output;
    }




    public function odd_or_even($i)
    {
        $loop = 'odd';
        if ($i % 2 == 0){
            $loop = 'even';
        }

        return $loop;
    }



    public function out()
    {
        return $this->result;
    }

}
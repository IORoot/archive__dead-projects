<?php

/**
 * Create schema.
 * 
 * When do_action('build_schema'); is used, run the schema_render function.
 * 
 */

class create_schema {

    /**
     * $schema
     * This is the array built up.
     *
     * @var undefined
     */
    public $schema = array();

    public $slot;

    public $acf_options;

    public $base_path = '/classes/class';




    public function __construct($args){

        $this->slot = $args;

        $this->address_firstline();
        
        $this->get_options();

        return $this;
    }



    public function render(){

        $this->open_script();

            $this->event_head();
            $this->event_url();
            $this->event_images();
            $this->event_offer();
            $this->event_performer();
            $this->event_location();

        $this->close_script();

        return $this->schema_to_string();
    }



    public function get_options(){

        $this->acf_options = array ( 
            'schema_item' => get_field('schema_item', 'option'),
        );

        return $this;
    }



    public function open_script(){
        $this->schema[] = '<script type="application/ld+json">{';
        return $this;
    }
    


    public function close_script(){
        $this->schema[] = '}</script>';
        return $this;
    }



    public function schema_to_string(){
        return implode(' ', $this->schema);
    }



    public function address_firstline(){

        if ($this->slot['location'] == '') {
            $this->slot['address_firstline'] = 'London';
            return $this;
        }

        $address_array = explode(",", $this->slot['location']);
        $this->slot['address_firstline'] = $address_array[0];

        return $this;
    }



    public function event_head(){
        $this->schema[] = '"@context": "http://schema.org",';
        $this->schema[] = '"name": "'.$this->slot['title'].' - Parkour Class",';
        $this->schema[] = '"@type": "'.$this->slot['type'].'",';
        $this->schema[] = '"startDate": "'.$this->slot['start'].'",';
        $this->schema[] = '"endDate": "'.$this->slot['end'].'",';
        $this->schema[] = '"description": "'.$this->slot['info'].'",';

        return $this;
    }



    public function event_url(){

        $date_string = date("d-m-Y", strtotime($this->slot['start']));

        $tbk_date = '?tbk_date='.$date_string;
        $tbk_service = '&tbk_service='.$this->slot['id'];

        $url = WP_SITEURL . $this->base_path . $tbk_date . $tbk_service;
        
        $this->schema[] = '"url": "'.$url.'",';

        return $this;
    }



    public function event_images(){

        // Check if there are entries in ACF for the images.
        if( have_rows( 'schema_item', 'option') ) {

            while( have_rows('schema_item', 'option') ): the_row();

                if (get_sub_field('service_id') != $this->slot['id']){ continue; }

                $this->acf_images = get_sub_field('image');

            endwhile;
        }


        // If not empty, use the URL of image.
        if (!empty($this->acf_images)){
            $this->schema[] = '"image": "'.$this->acf_images['url'].'",';
            return $this;
        }


        // Default fallback
        $this->schema[] = '"image": "https://londonparkour.com/wp-content/uploads/2018/05/Eliza_LDNPK_Classes_1920x1920.jpg",';

        return $this;
    }



    public function event_offer(){

        $this->schema[] = '"offers": {';

            $this->schema[] = '"@type": "Offer",';
            $this->schema[] = '"availability": "http://schema.org/InStock",';
            $this->schema[] = '"price": "'.$this->slot['price'].'",';
            $this->schema[] = '"priceCurrency": "GBP",';
            $this->schema[] = '"url": "https://londonparkour.com/classes",';
            $this->schema[] = '"validFrom": "'.date("Y-m-d", time() - 86400).'"';

        $this->schema[] = '},';

        return $this;
    }



    public function event_performer(){

        $this->schema[] = '"performer": {';

            $this->schema[] = '"@type": "Person",';
            $this->schema[] = '"name": "LondonParkour"';

        $this->schema[] = '},';    

        return $this;
    }



    public function event_location(){

        $this->schema[] = '"location": {';

            $this->schema[] = '"@type": "Place",';
            $this->schema[] = '"name": "Class Location",';

            $this->schema[] = '"address": {';

                $this->schema[] = '"@type": "PostalAddress",';
                $this->schema[] = '"streetAddress": "'.$this->slot['address_firstline'].'",';
                $this->schema[] = '"addressRegion": "London",';
                $this->schema[] = '"addressCountry": "UK"';

            $this->schema[] = '}';  

        $this->schema[] = '}';  

        return $this;
    }

} 


/**
 * Register this action called 'build_schema' to execute function.
 * 
 * priority 10
 * arguments 2
 */
add_action('build_schema', 'build_schema', 10, 2);

/**
 * Build up schema for TeamBooking.
 */
function build_schema($slot){

    /**
     * Create new object
     */
    $sc = new create_schema($slot);

    /**
     * Run render method
     */
    echo $sc->render();

    return;
}
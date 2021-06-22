<?php

trait loyalty_db {
    
    /**
     * get_reservations
     * 
     * This will get all of the reservations from the DB
     * and also deserialise the results to be read.
     * 
     * Builds up multidimensional array of results from Database SQL call
     * 
     * $this->reservations_formatted [
     *      0:[
     *          name: 'Me'
     *          email: 'me@me.com'
     *          service: 'Youth'
     *          date: timestamp
     *          paid: "Paid"
     *        ]
     *      1: [...]
     * ]
     *
     * @return void
     */
    public function get_reservations(){
        $this->reservations_raw = $this->get_reservation_list();

        foreach($this->reservations_raw as $index => $reservation){
            $this->reservations_formatted[$index] = $this->deserialise_reservation_array($reservation);
        }
        return $this;
    }

    /**
     * get_reservation_list
     * 
     * form_fields = serialised string
     * service_name = class
     * start = start of reservation
     * paid = if paid or not
     *
     * @return void
     */
    public function get_reservation_list(){

        global $wpdb;

        $yearstart = date('U',strtotime(date('Y-01-01')));

        // Select all paid entries.
        // 1577836800 = 01/01/2020
        // No FREE classes
        $sql = "SELECT `id`, `form_fields`, `service_name`, `start`, `paid`
            FROM `wp_teambooking_reservations`
            WHERE `start` > $yearstart AND `service_name` NOT LIKE '%Free%'
            ORDER BY id DESC
        ";

        return $wpdb->get_results( $sql );

    }


    /**
     * Access the reservation fields.
     * 
     * Cheeky way because we are accessing the private values by casting.
     */
    public function deserialise_reservation_array($reservation){

        // Decode / unserialize / gzinflate the form_fields.
        $form_fields = $this->decode_object($reservation->form_fields);

        // ACCESS PRIVATE VALUES!
        // Use helper functions to Cast PRIVATE paramenters to arrays so we can access them.
        //
        // The ID =1234 is when the form changed (new website v2 - in 2020) and the fields 
        // were changed about.
        $id = intval($reservation->id) ;
        
        $firstname = '';
        $name = '';
        $email = '';

        foreach ($form_fields as $form_field){
            $field_array = $this->obj2array($form_field);
            
            if ($field_array['name'] == 'email'){ 
                $email = $field_array['value']; 
            }

            // Does the ['name'] field contain the word 'name'.
            if(strpos($field_array['name'], 'name') !== false ){

                if(strpos($field_array['name'], 'first_name') !== false ){ 
                    $firstname = $field_array['value'] . ' ';
                } 

                $name = $firstname . $field_array['value']; 
            }
            
        }

        // Set the output fields.
        $output['id']       =  $reservation->id;
        $output['name']     =  strtolower($name);
        $output['email']    =  strtolower($email);
        $output['service']  =  $reservation->service_name;
        $output['date']     =  $reservation->start;
        $output['paid']     =  $this->format_paid($reservation->paid);

        return $output;


    }

    
}
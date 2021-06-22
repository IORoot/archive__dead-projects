<?php

trait loyalty_helpers {


    //  ┌─────────────────────────────────────────────────────────────────────────┐ 
    //  │                                                                         │░
    //  │                              OBJECT ACCESS                              │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░                                                                                                                                                    

    /**
     * decode_object
     * 
     * decode / unserialize / gzinflate an object.
     *
     * @param mixed $obj
     * @return void
     */
    public function decode_object($obj){

        $obj_base = base64_decode($obj, TRUE);
        if (!$obj_base) {
            $obj = unserialize($obj);
        } else {
            $obj = unserialize(gzinflate($obj_base));
        }
        return $obj;

    }

    /**
     * obj2array
     * 
     * Will cast an object to an array so that we can access the PRIVATE properties
     * on the object.
     * 
     * @param mixed &$Instance
     * @return void
     */
    public function obj2array ( &$Instance ) {
        $clone = (array) $Instance;
        $rtn = array ();
        $rtn['___SOURCE_KEYS_'] = $clone;
    
        while ( list ($key, $value) = each ($clone) ) {
            $aux = explode ("\0", $key);
            $newkey = $aux[count($aux)-1];
            $rtn[$newkey] = &$rtn['___SOURCE_KEYS_'][$key];
        }
    
        return $rtn;
    }


    //  ┌─────────────────────────────────────────────────────────────────────────┐ 
    //  │                                                                         │░
    //  │                           MANIPULATE ARRAYS                             │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    /**
     * sort_array
     * 
     * Sort the $this->reservations_formatted array by specified field.
     *
     * @param mixed $sort_this_array
     * @param mixed $field
     * @return void
     */
    public function sort_array($field = 'date', $direction = SORT_DESC){

        $column = array_column($this->reservations_formatted, $field);

        array_multisort($column, $direction, $this->reservations_formatted);

        return;
    }

    /**
     * count_entries
     * 
     * Count the number of entries by field
     *
     * @param mixed $array_to_count
     * @return void
     */
    public function add_total_classes($field = 'email'){

        $out = array();

        // Iterate over the whole result array
        foreach ($this->reservations_formatted as $key => $value){

            // iterate over a single entry
            foreach ($value as $key2 => $value2){
                
                // the field isn't the specified one, skip it.
                if ($key2 !== $field) { continue; } 

                // If the value of the chosen field exists in the output array
                // add 1 to it's existing count.
                // otherwise, it's a new entry and so add it as a new entry
                // with a value of 1.
                if (array_key_exists($value2, $out)){
                    $out[$value2]++;
                } else {
                    $out[$value2] = 1;
                }
                
            }

        }

        /**
         * Combine the array of totals with the original reservation list.
         */
        $this->merge_totals($out);
        
        return;
    }



    /**
     * Combine the totals onto each array entry and also combine
     * all email duplicates into a single entry.
     */
    public function merge_totals($totals){

        // iterate through each reservation
        foreach($this->reservations_formatted as $reservation_key => $reservation_array){

            // find the corresponding total and combine it onto the array.
            $this->reservations_formatted[$reservation_key]['total'] = $totals[$reservation_array['email']];
        }

        return;
    }


    /**
     * combine_by_field
     *
     * @param mixed $field
     * 
     * @return void
     */
    public function combine_by_field($field = 'email'){

        $this->reservations_formatted = array_reverse(
                array_values(
                    array_column(
                        array_reverse($this->reservations_formatted),
                        null,
                        $field
                    )
                )
            );

        return;
    }

    
    // return paid or not.
    public function format_paid($paid){
        if ($paid){
            return 'Paid';
        }
        return 'Not Paid';
    }


    /**
     * free_sessions
     *
     * @param mixed $class_count
     * @return void
     */
    public function free_sessions($class_count){

        $free_classes = floor($class_count / 10);

        return $free_classes;
    }



    //  ┌─────────────────────────────────────────────────────────────────────────┐ 
    //  │                                                                         │░
    //  │                                TIME /DATE                               │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    // format timestamp into RFC 2822 formatted date
    public function format_time($timestamp){
        return date('r' ,$timestamp);
    }



    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
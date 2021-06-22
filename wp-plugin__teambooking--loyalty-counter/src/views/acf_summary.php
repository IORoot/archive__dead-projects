<?php

trait acf_summary {

    /**
     * output_summary
     * 
     * ID | NAME | EMAIL | CLASS | TOTAL NUMBER OF ATTENDENCES | LAST RESERVATION DATE | FREE CLASSES
     *
     * @param mixed $olderthan          = Return results only older than this date.
     * @param mixed $limit              = Number of returned results
     * @return void
     */
    public function acf_summary($olderthan = null, $limit = 10){

        foreach($this->reservations_formatted as $reservation_email => $reservation_array){

            // Skip if less than limit of bookings
            if ($reservation_array['total'] < $limit){ continue; }

            // Skip if younger than date
            if ($olderthan != null && $reservation_array['date'] < $olderthan){ continue; }

            // Format Rows for ACF
            $reservation = array(
                'field_5e209d8936ecf' => $reservation_array['id'],
                'field_5e209df736ed6' => $reservation_array['name'],
                'field_5e209e0336ed7' => $reservation_array['email'],
                'field_5e209e1136ed8' => $reservation_array['service'],
                'field_5e209e2036ed9' => $reservation_array['total'] ,
                'field_5e209e2f36eda' => $this->time_elapsed_string($this->format_time($reservation_array['date'])),
                'field_5e209e4136edb' => $this->free_sessions($reservation_array['total']),
            );

            array_push($this->reservations_acf, $reservation);

        }

        return;
    }

}
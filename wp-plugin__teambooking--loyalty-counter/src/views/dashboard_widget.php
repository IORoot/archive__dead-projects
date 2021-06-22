<?php

trait dashboard_widget {

    /**
     * output_summary
     * 
     * ID | NAME | EMAIL | CLASS | TOTAL NUMBER OF ATTENDENCES | LAST RESERVATION DATE | FREE CLASSES
     *
     * @param mixed $olderthan          = Return results only older than this date.
     * @param mixed $limit              = Number of returned results
     * @return void
     */
    public function dashboard_widget(){

        foreach($this->reservations_formatted as $reservation_email => $reservation_array){

            // Skip if total classes < 5
            if ($reservation_array['total'] < 5){ continue; }
            
            // Format Rows for ACF
            $widget_row = array(
                'name' => $reservation_array['name'],
                'email' => $reservation_array['email'],
                'total' => $reservation_array['total'] ,
                'free' => $this->free_sessions($reservation_array['total']),
            );

            array_push($this->widget_free, $widget_row);

        }

        return;
    }

}
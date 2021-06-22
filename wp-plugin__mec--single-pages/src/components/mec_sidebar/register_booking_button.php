<!-- Register Booking Button -->
<?php 
    if($this->main->can_show_booking_module($event) and $single->found_value('register_btn', $settings) == 'on'):
        $data_lity = $data_lity_class =  ''; 
        if( isset($settings['single_booking_style']) and $settings['single_booking_style'] == 'modal' ){ 
            $data_lity_class = 'mec-booking-data-lity'; 
        }
        echo '<a class="mec-booking-button mec-bg-color '.$data_lity_class; 
        if( isset($settings['single_booking_style']) and $settings['single_booking_style'] != 'modal' ) 
            echo 'simple-booking" ';
            echo 'href="#mec-events-meta-group-booking-'. $this->uniqueid .'" ';
            echo $data_lity.'>';
            echo esc_html($this->main->m('register_button', __('REGISTER', 'mec') ));
            echo '</a>';

    elseif (
            $single->found_value('register_btn', $settings) == 'on' 
            and isset($event->data->meta['mec_more_info']) 
            and trim($event->data->meta['mec_more_info']) 
            and $event->data->meta['mec_more_info'] != 'http://'
            ): 
    
                echo '<a class="mec-booking-button mec-bg-color"';
                echo 'target="'.(isset($event->data->meta['mec_more_info_target']) ? $event->data->meta['mec_more_info_target'] : '_self').'" ';
                echo 'href="'.$event->data->meta['mec_more_info'].'">';
                
                if (isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) {
                    echo esc_html(trim($event->data->meta['mec_more_info_title']), 'mec');
                } else {
                    echo esc_html($this->main->m('register_button', __('REGISTER', 'mec')));
                }

                echo '</a>';
    endif;

?>
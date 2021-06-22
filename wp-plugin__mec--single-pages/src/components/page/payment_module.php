<?php 
// ┌─────────────────────────────────────────────────────────────────────────┐ 
// │                                                                         │░
// │                                                                         │░
// │                         Booking Module - Modal                          │░
// │                                                                         │░
// │                                                                         │░
// └─────────────────────────────────────────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                              Sold Out Warning                           │
    // └─────────────────────────────────────────────────────────────────────────┘
    if ( !empty($event->date) ): if($this->main->is_sold($event, (trim($occurrence) ? $occurrence : $event->date['start']['date'])) and count($event->dates) <= 1):
        echo '<div class="mec-sold-tickets warning-msg">'. _e('Sold out!', 'wpl') .'</div>';

    elseif($this->main->can_show_booking_module($event)):

        $data_lity_class = ''; 
        
        if( isset($settings['single_booking_style']) and $settings['single_booking_style'] == 'modal' ) 
        {
            $data_lity_class = 'lity-hide ';
        }
    

        $id = 'mec-events-meta-group-booking-'.$this->uniqueid.'-modal';
        
        $style = '<style>';
        $style .= '#'.$id.' { display: none; } ';
        $style .= '#'.$id.':checked ~ .modal-backdrop { opacity: 1; z-index: 998; } ';
        $style .= '#'.$id.':checked ~ .modal-content { opacity: 1; z-index: 999; overflow: auto; pointer-events: auto; cursor: auto;} ';
        $style .= '</style>';
        echo $style;
        
        $closebtn = '<label class="modal-close-btn" for="'.$id.'">';
        $closebtn .= '<svg width="29" height="29" viewBox="0 0 50 50">';
        $closebtn .= '<line x1="10" y1="10" x2="40" y2="40"/>';
        $closebtn .= '<line x1="40" y1="10" x2="10" y2="40"/>';
        $closebtn .= '</svg>';
        $closebtn .= '</label>';
    
        echo '<div class="mec-modal-container">';

            echo '<input type="checkbox" id="'.$id.'">';
            echo '<label class="modal-backdrop" for="'.$id.'"></label>';
            echo '<div id="mec-events-meta-group-booking-' . $this->uniqueid .'" class="'.$data_lity_class.'mec-events-meta-group mec-events-meta-group-booking modal-content">';
                echo $closebtn;
            
                if( isset($settings['booking_user_login']) and $settings['booking_user_login'] == '1' and !is_user_logged_in() ) {
                    echo do_shortcode('[MEC_login]');
                } elseif ( isset($settings['booking_user_login']) and $settings['booking_user_login'] == '0' and !is_user_logged_in() and isset($booking_options['bookings_limit_for_users']) and $booking_options['bookings_limit_for_users'] == '1' ) {
                    echo do_shortcode('[MEC_login]');
                } else {

                    do_shortcode('[andyp_stripecard]');
                    echo '<div class="progress"><div class="progress__step progress__step--1"></div><div class="progress__step progress__step--2"></div><div class="progress__step progress__step--3"></div></div>';
                    echo $this->main->module('booking.default', array('event'=>$this->events)); 
                }
                
            echo '</div>';

        echo '</div>';
    endif; 
    endif;

    $script = '<script>';
    $script .= '

        document.addEventListener(\'click\', function (event) {
            if (event.target.matches(\'#mec-book-form-btn-step-1\')) { document.querySelector(".progress__step--1").style.backgroundColor = "#38EF7D"; }
            if (event.target.matches(\'#mec-book-form-back-btn-step-2\')) { document.querySelector(".progress__step--1").style.backgroundColor = "#FFFFFF"; }
            if (event.target.matches(\'#mec-book-form-btn-step-2\')) { document.querySelector(".progress__step--2").style.backgroundColor = "#38EF7D"; }
            if (event.target.matches(\'#mec-book-form-back-btn-step-3\')) { document.querySelector(".progress__step--2").style.backgroundColor = "#FFFFFF"; }
            if (event.target.matches(\'#mec-book-form-btn-step-3\')) { document.querySelector(".progress__step--3").style.backgroundColor = "#38EF7D"; }
            if (event.target.matches(\'#mec-book-form-back-btn-step-4\')) { document.querySelector(".progress__step--4").style.backgroundColor = "#FFFFFF"; }
            if (event.target.matches(\'.mec-book-form-next-button\')) { 
                if (event.target.parentElement.parentElement.matches(\'.mec-book-form-gateway-checkout\')) {
                    document.querySelector(".progress__step--3").style.backgroundColor = "#38EF7D";
                }
                if (event.target.parentElement.parentElement.parentElement.matches(\'.mec-book-form-gateway-checkout\')) {
                    document.querySelector(".progress__step--3").style.backgroundColor = "#38EF7D";
                }
                if (event.target.parentElement.parentElement.parentNode.matches(\'#mec_book_payment_form\')) {
                    document.querySelector(".progress__step--3").style.backgroundColor = "#38EF7D";
                }
            }
        }, false);
    ';
    $script .= '</script>';
    echo $script;


    ?>
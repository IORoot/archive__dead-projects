<?php 

    include(__DIR__.'/mec_sidebar/event_booking_button.php');

    include(__DIR__.'/mec_sidebar/event_countdown.php');

    do_action('mec_single_event_under_category' , $event);

    include(__DIR__.'/mec_sidebar/event_organiser.php');

    include(__DIR__.'/mec_sidebar/register_booking_button.php');

?>
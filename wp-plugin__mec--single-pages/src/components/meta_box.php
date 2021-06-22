<?php 
    if ( 
        $single->found_value('data_time', $settings) == 'on' || 
        $single->found_value('local_time', $settings) == 'on' || 
        $single->found_value('event_cost', $settings) == 'on' || 
        $single->found_value('more_info', $settings) == 'on' || 
        $single->found_value('event_label', $settings) == 'on' || 
        $single->found_value('event_location', $settings) == 'on' || 
        $single->found_value('event_categories', $settings) == 'on'
    ) {
        echo '<div class="mec-event-info-desktop mec-event-meta mec-color-before mec-frontbox">';

            include(__DIR__.'/mec_sidebar/event_date_and_time.php');

            include(__DIR__.'/mec_sidebar/event_local_time.php');

            include(__DIR__.'/mec_sidebar/event_cost.php');

            include(__DIR__.'/mec_sidebar/more_info.php');

            include(__DIR__.'/mec_sidebar/event_labels.php');

            include(__DIR__.'/mec_sidebar/event_location.php');

            include(__DIR__.'/mec_sidebar/event_categories.php');

        echo '</div>';
    }
    ?>
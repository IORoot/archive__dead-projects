<?php
    // Event Date and Time
    if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']))
    {
        $midnight_event = $this->main->is_midnight_event($event);
    ?>
        <div class="mec-single-event-date">
            <i class="mec-sl-calendar"></i>
            <h3 class="mec-date"><?php _e('Date', 'mec'); ?></h3>

            <?php if($midnight_event): ?>
            <dd><abbr class="mec-events-abbr"><?php echo $this->main->dateify($event, $this->date_format1); ?></abbr></dd>
            <?php else: ?>
            <dd><abbr class="mec-events-abbr"><?php if(!empty($event->date)): echo $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end']) ? $event->date['end'] : NULL)), $this->date_format1); endif; ?></abbr></dd>
            <?php endif; ?>

            <?php echo $this->main->holding_status($event); ?>
        </div>

        <?php  
        if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
        {
            $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
            $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
            ?>
            <div class="mec-single-event-time">
                <i class="mec-sl-clock " style=""></i>
                <h3 class="mec-time"><?php _e('Time', 'mec'); ?></h3>
                <i class="mec-time-comment"><?php echo (isset($time_comment) ? $time_comment : ''); ?></i>
                
                <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
                <dd><abbr class="mec-events-abbr"><?php echo $event->data->time['start']; ?><?php echo (trim($event->data->time['end']) ? ' - '.$event->data->time['end'] : ''); ?></abbr></dd>
                <?php else: ?>
                <dd><abbr class="mec-events-abbr"><?php _e('All Day', 'mec'); ?></abbr></dd>
                <?php endif; ?>
            </div>
        <?php
        }
    }
?>
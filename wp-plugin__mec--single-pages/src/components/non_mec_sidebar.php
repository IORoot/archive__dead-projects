<div class="mec-event-info-desktop mec-event-meta mec-color-before mec-frontbox">

    <?php include(__DIR__.'/src/components/non_mec_sidebar/date_and_time.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/local_time.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/more_info.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/event_labels.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/event_location.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/event_categories.php'); ?>

    <?php do_action('mec_single_event_under_category' , $event); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/event_organiser.php'); ?>

    <?php include(__DIR__.'/src/components/non_mec_sidebar/event_booking_button.php'); ?>

</div>

<?php echo $this->main->module('speakers.details', array('event'=>$event)); ?>

<?php echo $this->main->module('attendees-list.details', array('event'=>$event)); ?>

<?php echo $this->main->module('next-event.details', array('event'=>$event)); ?>

<?php echo $this->main->module('links.details', array('event'=>$event)); ?>

<?php echo $this->main->module('weather.details', array('event'=>$event)); ?>

<?php include(__DIR__.'/src/components/non_mec_sidebar/event_map.php'); ?>

<?php echo $this->main->module('qrcode.details', array('event'=>$event)); ?>

<?php dynamic_sidebar(); ?>
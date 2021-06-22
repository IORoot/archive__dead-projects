<div class="mec-event-content">
    <?php 
        echo $this->main->display_cancellation_reason($event->data->ID, $display_reason); 
    ?>
    
    <!-- <h1 class="mec-single-title"><?php //the_title(); ?></h1> -->
    <?php include(__DIR__.'/../mec_sidebar/event_booking_button.php'); ?>

    <div class="mec-single-event-description mec-events-content"><?php the_content(); ?></div>
</div>
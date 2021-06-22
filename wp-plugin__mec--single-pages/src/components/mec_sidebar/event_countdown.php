<!-- Countdown module -->
<?php if($this->main->can_show_countdown_module($event)): ?>
    <div class="mec-events-meta-group mec-events-meta-group-countdown">
        <h3>Next class in:</h3>
        <?php echo $this->main->module('countdown.details', array('event'=>$this->events)); ?>
    </div> 
<?php endif; ?>
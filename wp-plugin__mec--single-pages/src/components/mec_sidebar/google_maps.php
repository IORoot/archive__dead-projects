<!-- Google Maps Module -->
<?php if ($single->found_value('google_map', $settings) == 'on'): ?>
    <div class="mec-events-meta-group mec-events-meta-group-gmap">
        <?php echo $this->main->module('googlemap.details', array('event'=>$this->events)); ?>
    </div>
<?php endif; ?>
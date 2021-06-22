<?php if($single->found_value('event_speakers', $settings) == 'on') echo $this->main->module('speakers.details', array('event'=>$event)); ?>

<?php if($single->found_value('attende_module', $settings) == 'on') echo $this->main->module('attendees-list.details', array('event'=>$event)); ?>

<?php if($single->found_value('next_module', $settings) == 'on') echo $this->main->module('next-event.details', array('event'=>$event)); ?>

<?php if($single->found_value('weather_module', $settings) == 'on') echo $this->main->module('weather.details', array('event'=>$event)); ?>

<?php include(__DIR__.'/mec_sidebar/google_maps.php'); ?>

<?php if($single->found_value('qrcode_module', $settings) == 'on') echo $this->main->module('qrcode.details', array('event'=>$event)); ?>

<?php if($single->found_value('links_module', $settings) == 'on') echo $this->main->module('links.details', array('event'=>$event)); ?>

<?php dynamic_sidebar('mec-single-sidebar'); ?>
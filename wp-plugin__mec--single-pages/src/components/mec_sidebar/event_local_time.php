<?php
    // Local Time Module
    if($single->found_value('local_time', $settings) == 'on') echo $this->main->module('local-time.details', array('event'=>$event));
    ?>
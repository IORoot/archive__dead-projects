<?php

$image = $event->data->thumbnails['full']; 
$image = str_replace('class="', 'class="lazyload ', $image );

    echo '<div class="mec-events-event-image">';
    echo $image;
    echo '</div>';
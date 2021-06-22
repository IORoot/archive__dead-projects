<?php
    // More Info
    if(isset($event->data->meta['mec_more_info']) and trim($event->data->meta['mec_more_info']) and $event->data->meta['mec_more_info'] != 'http://')
    {
        ?>
        <div class="mec-event-more-info">
            <i class="mec-sl-info"></i>
            <h3 class="mec-cost"><?php echo $this->main->m('more_info_link', __('More Info', 'mec')); ?></h3>
            <dd class="mec-events-event-more-info"><a class="mec-more-info-button mec-color-hover" target="<?php echo (isset($event->data->meta['mec_more_info_target']) ? $event->data->meta['mec_more_info_target'] : '_self'); ?>" href="<?php echo $event->data->meta['mec_more_info']; ?>"><?php echo ((isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) ? $event->data->meta['mec_more_info_title'] : __('Read More', 'mec')); ?></a></dd>
        </div>
        <?php
    }
?>
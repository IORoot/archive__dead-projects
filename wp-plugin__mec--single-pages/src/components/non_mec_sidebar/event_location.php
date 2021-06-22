<?php
    // Event Location
    if(isset($event->data->meta['mec_location_id']) and isset($event->data->locations[$event->data->meta['mec_location_id']]) and !empty($event->data->locations[$event->data->meta['mec_location_id']]))
    {
        $location = $event->data->locations[$event->data->meta['mec_location_id']];
        ?>
        <div class="mec-single-event-location">
            <?php if($location['thumbnail']): ?>
            <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
            <?php endif; ?>
            <i class="mec-sl-location-pin"></i>
            <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec')); ?></h3>
            <dd class="author fn org"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></dd>
            <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></span></address></dd>

            <?php if(isset($location['url']) and trim($location['url'])): ?>
            <dd class="mec-location-url">
                <i class="mec-sl-sitemap"></i>
                <h6><?php _e('Website', 'mec'); ?></h6>
                <span><a href="<?php echo (strpos($location['url'], 'http') === false ? 'http://'.$location['url'] : $location['url']); ?>" class="mec-color-hover" target="_blank"><?php echo $location['url']; ?></a></span>
            </dd>
            <?php endif; ?>
        </div>
        <?php
        $this->show_other_locations($event); // Show Additional Locations
    }
?>
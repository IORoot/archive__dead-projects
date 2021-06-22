<?php
    // Event Organizer
    if(isset($event->data->organizers[$event->data->meta['mec_organizer_id']]) && !empty($event->data->organizers[$event->data->meta['mec_organizer_id']]))
    {
        $organizer = $event->data->organizers[$event->data->meta['mec_organizer_id']];
        ?>
        <div class="mec-single-event-organizer">
            <?php if(isset($organizer['thumbnail']) and trim($organizer['thumbnail'])): ?>
                <img class="mec-img-organizer" src="<?php echo esc_url($organizer['thumbnail']); ?>" alt="<?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?>">
            <?php endif; ?>
            <h3 class="mec-events-single-section-title"><?php echo $this->main->m('taxonomy_organizer', __('Organizer', 'mec')); ?></h3>
            <?php if(isset($organizer['thumbnail'])): ?>
            <dd class="mec-organizer">
                <i class="mec-sl-home"></i>
                <h6><?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?></h6>
            </dd>
            <?php endif;
            if(isset($organizer['tel']) && !empty($organizer['tel'])): ?>
            <dd class="mec-organizer-tel">
                <i class="mec-sl-phone"></i>
                <h6><?php _e('Phone', 'mec'); ?></h6>
                <a href="tel:<?php echo $organizer['tel']; ?>"><?php echo $organizer['tel']; ?></a>
            </dd>
            <?php endif;
            if(isset($organizer['email']) && !empty($organizer['email'])): ?>
            <dd class="mec-organizer-email">
                <i class="mec-sl-envelope"></i>
                <h6><?php _e('Email', 'mec'); ?></h6>
                <a href="mailto:<?php echo $organizer['email']; ?>"><?php echo $organizer['email']; ?></a>
            </dd>
            <?php endif;
            if(isset($organizer['url']) && !empty($organizer['url']) and $organizer['url'] != 'http://'): ?>
            <dd class="mec-organizer-url">
                <i class="mec-sl-sitemap"></i>
                <h6><?php _e('Website', 'mec'); ?></h6>
                <span><a href="<?php echo (strpos($organizer['url'], 'http') === false ? 'http://'.$organizer['url'] : $organizer['url']); ?>" class="mec-color-hover" target="_blank"><?php echo $organizer['url']; ?></a></span>
                <?php do_action( 'mec_single_default_organizer', $organizer ); ?>
            </dd>
            <?php endif;
            $organizer_description_setting = isset( $settings['organizer_description'] ) ? $settings['organizer_description'] : ''; $organizer_terms = get_the_terms($event->data, 'mec_organizer');  if($organizer_description_setting == '1'): foreach($organizer_terms as $organizer_term) { if ($organizer_term->term_id == $organizer['id'] ) {  if(isset($organizer_term->description) && !empty($organizer_term->description)): ?>
            <dd class="mec-organizer-description">
                <p><?php echo $organizer_term->description;?></p>
            </dd>
            <?php endif; } } endif; ?>
        </div>
    <?php
        $this->show_other_organizers($event); // Show Additional Organizers
    }
?>
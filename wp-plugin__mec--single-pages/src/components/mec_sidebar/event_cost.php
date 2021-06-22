<?php
    // Event Cost
    if(isset($event->data->meta['mec_cost']) and $event->data->meta['mec_cost'] != '' and $single->found_value('event_cost', $settings) == 'on')
    {
        ?>
        <div class="mec-event-cost">
            <i class="mec-sl-wallet"></i>
            <h3 class="mec-cost"><?php echo $this->main->m('cost', __('Cost', 'mec')); ?></h3>
            <dd class="mec-events-event-cost"><?php echo (is_numeric($event->data->meta['mec_cost']) ? $this->main->render_price($event->data->meta['mec_cost']) : $event->data->meta['mec_cost']); ?></dd>
        </div>
        <?php
    }
?>
<?php
    // Event labels
    if(isset($event->data->labels) and !empty($event->data->labels) and $single->found_value('event_label', $settings) == 'on')
    {
        $mec_items = count($event->data->labels);
        $mec_i = 0; ?>
        <div class="mec-single-event-label">
            <i class="mec-fa-bookmark-o"></i>
            <h3 class="mec-cost"><?php echo $this->main->m('taxonomy_labels', __('Labels', 'mec')); ?></h3>
            <?php foreach($event->data->labels as $labels=>$label) : 
            $seperator = (++$mec_i === $mec_items ) ? '' : ',';
            echo '<dd style="color:' . $label['color'] . '">' . $label["name"] . $seperator . '</dd>';
            endforeach; ?>
        </div>
        <?php
    }
?>
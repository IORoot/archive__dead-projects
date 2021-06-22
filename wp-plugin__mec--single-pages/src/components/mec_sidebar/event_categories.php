<?php
    // Event Categories
    if(isset($event->data->categories) and !empty($event->data->categories) and $single->found_value('event_categories', $settings) == 'on')
    {
        ?>
        <div class="mec-single-event-category">
            <i class="mec-sl-folder"></i>
            <dt><?php echo $this->main->m('taxonomy_categories', __('Category', 'mec')); ?></dt>
            <?php
            foreach($event->data->categories as $category)
            {
                $icon = get_metadata('term', $category['id'], 'mec_cat_icon', true);
                $icon = isset($icon) && $icon != '' ? '<i class="'.$icon.' mec-color"></i>' : '<i class="mec-fa-angle-right"></i>';
                echo '<dd class="mec-events-event-categories">
                <a href="'.get_term_link($category['id'], 'mec_category').'" class="mec-color-hover" rel="tag">'.$icon . $category['name'] .'</a></dd>';
            }
            ?>
        </div>
        <?php
    }
?>
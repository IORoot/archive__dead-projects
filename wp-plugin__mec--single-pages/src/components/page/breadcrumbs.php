<!-- start breadcrumbs -->
<?php
$breadcrumbs_settings = isset( $settings['breadcrumbs'] ) ? $settings['breadcrumbs'] : '';
if($breadcrumbs_settings == '1' ): ?>
    <div class="mec-breadcrumbs">
        <?php $single->display_breadcrumb_widget( get_the_ID() ); ?>
    </div>
<?php endif; ?>
<!-- end breadcrumbs -->
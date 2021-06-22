<li class="wpmi-item liftup">
    <a href="<?php echo esc_attr($item['url']);?>" target="<?php echo esc_attr($args['target']);?>">
        <img src="<?php echo esc_url($item[$args['size']]);?>"  alt="" title="<?php echo esc_attr($item['description']);?>"/>
        <p class="instagram__content"><?php 

            $desc = esc_attr($item['description']);
            $desc = preg_replace('/\<(.*?)\>/', '', $desc); // remove any tags
            $desc = preg_replace('/⠀/', '<br>', $desc);         // SPECIAL INSTAGRAM NEWLINE CHARACTER
            $desc = preg_replace('/⠀ /', '<br>', $desc);        // SPECIAL INSTAGRAM NEWLINE CHARACTER

            echo $desc;
        ?>
        </p>
    </a>
</li>
<?php

    $arr = explode("\n", $item['description']);
    array_shift($arr);
    array_shift($arr);
    $description = substr(implode("\n", $arr), 0, 200);

    $title = esc_attr( strtok($item['description'], "\n") );

    $timeago = esc_attr( human_time_diff( $item['time'] , current_time( 'U' ) ));

?>

<li class="wpmi-item liftup">
    <a href="<?php echo esc_attr( $item['url'] );?>" target="<?php echo esc_attr( $args['target'] );?>">
        <div class="instagram__hero"><img src="<?php echo esc_url( $item[$args['size']] );?>"  alt="" title="<?php substr(esc_attr( $item['description'] ), 0, 55);?>"/></div>
        <div class="instagram__content">
            <div class="instagram__title"><?php echo $title;?></div>
            <div class="instagram__description"><?php echo $description;?>...</div>
            <div class="instagram__date"><?php echo $timeago;?> ago</div>
        </div>
    </a>
</li>
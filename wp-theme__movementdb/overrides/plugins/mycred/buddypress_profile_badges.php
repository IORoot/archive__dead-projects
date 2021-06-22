<?php

/*
 * This filter will add the number of points onto the end of the badge
 * on the buddypress profile page.
 */
add_filter('mycred_get_badge', 'profile_badges_points');

function profile_badges_points($output, $user_id = null){

//    echo '-- VAR_DUMP --</BR><textarea>';
//    var_dump($output, $user_id);
//    echo '</textarea></BR></BR>-- VAR_DUMP END-- </BR></BR></BR></BR></BR>';

    $point_type = $output->levels[0]['requires'][0]['type'];
    $profile_id = bp_displayed_user_id();
    $balance = mycred_display_users_balance( $profile_id, $point_type );

    $output->level_label = $output->level_label . '<span class="mvdb_point_balance"> ' . $balance . ' <i class="fa fa-bullseye"></i></span>';

    return $output;

}
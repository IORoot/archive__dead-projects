<?php

// test bed

// All user meta
//$all_meta_for_user = get_user_meta( 1 );
//var_dump( $all_meta_for_user );


//  FOOTER - ALL POST METADATA
// =============================================================================
//function my_post_meta( $content ) {
//
//    $my_meta = get_post_meta( get_the_ID() );
//    $my_meta_data = '<pre>' . print_r( $my_meta, true ) . '</pre>';
//
//    return $content . $my_meta_data;
//
//}
//
//if( !is_admin() ) {
//    add_filter( 'the_content', 'my_post_meta' );
//}

// TEST ESSENTIAL GRID FILTERS/ACTIONS
// =============================================================================

//set the filter or action to test here!

//add_filter('mepr_view_paths', 'run_this_mvdb_filter_check');
//
//function run_this_mvdb_filter_check($args, $one = null, $two = null, $three = null){
//
//    echo '-- VAR_DUMP --</BR><textarea>';
//    var_dump($args, $one, $two, $three);
//    echo '</textarea></BR></BR>-- VAR_DUMP END-- </BR></BR></BR></BR></BR>';
//
//    return $args;
//
//}
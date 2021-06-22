<?php


/* ========================================================================================
 *
 * Show the user's log of their past video watching.
 * Uses the MyCred Plugin Log to determine which videos have been watched.
 *
 * ======================================================================================= */
function profile_history_log(){

    $args = array(
        'user_id' => get_current_user_id(),
        'number'  => 10,
        'ctype' => ''
    );
    $log = new myCRED_Query_Log( $args );

    // The Loop
    if ( $log->have_entries() ) {

        $output = '<table>';
        $output .= '<th>Time - Date</th>';
        $output .= '<th>Episode</th>';
        $output .= '<th>Points Category</th>';
        // Build your custom loop
        foreach ( $log->results as $entry ) {

            // Present the results anyway you like
            $output .= '<tr>';
            $output .= '<td>'. date('H:i - d M y', $entry->time) .'</td>';
            $output .= '<td>'. format_episode_title($entry->ref_id) .'</td>';
            $output .= '<td>'. ucfirst(substr($entry->ctype, 0, strpos($entry->ctype, '_'))) .'</td>';
            $output .= '</tr>';

        }
        $output .= '</table>';

    }

    echo $output;

    return;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'history-log', 'profile_history_log' );
});



/* ========================================================================================
 *
 * 3. ADD DOCUMENTATION FOR SHORTCODE
 *
 * Add documentation for this shortcode to the custom shortcode admin page.
 *
 * @param cataegory
 * @param slug
 * @param code
 * @param description
 * @param inputs
 * @param outputs
 * @param filters
 * @param actions
 * @param example
 *
 * ======================================================================================== */

register_custom_shortcode_docs(
    array(
        'category'      => 'charts',
        'slug'          => 'history_log',
        'code'          => '[history-log]',
        'description'   => 'Show a table of a users history of video watching.',
        'inputs'        => '<ul>
                                <li>user_id $int optional user ID (defaults to current)</li>
                                <li>number $int optional number of results (defaults to 10)</li>
                                <li>ctype $string optional point type to show. (defaults to all)</li>
                            </ul>',
        'outputs'       => '@int table log of watching.',
        'example'       => '[history-log]',
    )
);
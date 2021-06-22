<?php


/* ========================================================================================
 *
 * Display a graph of video watching by user.
 * Uses chart.js to render graph.
 *
 * ======================================================================================= */
function profile_history_chart(){

    $chart_array = array();
    $chart_labels = array();
    $chart_series = array();

    $args = array(
        'user_id' => get_current_user_id(),
        'number'  => 30,
        'ctype' => ''
    );
    $log = new myCRED_Query_Log( $args );

    foreach ($log->results as $item){
        // make associative array of DATE => VIDEO ID entries.
        if ($item->entry === 'viewing video'){
            array_push($chart_array, date( 'd M y',$item->time));
        }
    }
    // Make an associative array with the count of each day.
    $chart_array = array_count_values($chart_array);

    // Create a label and data array.
    foreach($chart_array as $date => $dailycount) {
        array_push($chart_labels, $date);
        array_push($chart_series, $dailycount);
    }

    $output .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>';
    $output .= '<div class="chart-history-background">
                    <h2 style="margin-top:0px">Watching History</h2>
                    <p>Track your Viewing progress on MovementDB.</p>
                    <div class="chart-history-container"> 
                        <canvas id="historyChart"></canvas> 
                    </div>
                </div>';
    $output .= '<script>';

    $output .= '
            var ctx = document.getElementById("historyChart").getContext(\'2d\');
            
            var yellow_gradient = ctx.createLinearGradient(0, 0, 0, 400);
            yellow_gradient.addColorStop(0, \'rgba(251,192,45,1)\');
            yellow_gradient.addColorStop(1, \'rgba(255,255,255,0)\');
            
            var historyChart = new Chart(ctx, {
                type: \'line\',
                
                data: {
                    labels: ' . json_encode($chart_labels) . ',
                    
                    datasets: [{
                        fill: \'origin\',
                        
                        label: \'# of Videos Watched\',
                        
                        data: ' . json_encode($chart_series) . ',
                        
                        backgroundColor: yellow_gradient,
                        
                        borderColor: \'rgba(251,192,45,1)\',
                        
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: \'bottom\'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                stepSize : 10
                            }
                        }]
                    }
                }
            });
         
    ';
    $output .= '</script>';

    echo $output;

    return;

}

function format_episode_title($post_id = 0){

    if ($post_id == 0){ return 'Unavailable data'; }

    $link_title = get_the_title($post_id);
    $link = '<a href="' . get_post_permalink($post_id) . '">' . $link_title . '</a>';

    return $link;

}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'chart-history', 'profile_history_chart' );
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
        'slug'          => 'chart_history',
        'code'          => '[chart-history]',
        'description'   => 'Render a graph of user video watching.',
        'inputs'        => '<ul>
                                <li>user_id $int optional user ID (defaults to current)</li>
                                <li>number $int optional number of results (defaults to 10)</li>
                                <li>ctype $string optional point type to show. (defaults to all)</li>
                            </ul>',
        'outputs'       => '@string graph of video watching',
        'example'       => '[chart-history]',
    )
);
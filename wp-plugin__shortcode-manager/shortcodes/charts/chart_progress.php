<?php


/* ========================================================================================
 *
 * Display a graph of video watching by user.
 * Uses chart.js to render graph.
 *
 * ======================================================================================= */
function profile_chart_total_progress(){

    $data_array = array();

    /* Total number of posts (videos) */
    $total_video_count = wp_count_posts()->publish;

    /* Balance = number of videos watched. Use the function at bottom! */
    $balance = user_total_points();

    $data_array = [$balance, $total_video_count - $balance];

    $output .= '<div class="chart-progress">
                    <h4 style="margin-top:0px">Total Progress</h4>
                    <p>Percentage of total videos you have watched.</p>
                    <div class="chart-progress-container"> 
                        <canvas id="progressChart"></canvas> 
                    </div>
                </div>';
    $output .= '<script>';

    $output .= '
     
            var ctx = document.getElementById("progressChart").getContext(\'2d\');
            var progressChart = new Chart(ctx, {
                type: \'doughnut\',
                
                data: {
                    datasets: [{
                       
                        data:               ' . json_encode($data_array) . ',
                        backgroundColor:    [\'rgba(251,192,45, 0.4)\', \'rgba(255,255,255, 0.4)\'],
                        borderColor:        [\'rgba(251,192,45, 0.4)\', \'rgba(224,224,224, 0.4)\'],
                        borderWidth:        1
                    }],
                    labels: [
                        \'Videos Watched\',
                        \'Videos Remaining\'
                    ]
                },
                
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    cutoutPercentage: 90,
                    legend: {
                        position: \'bottom\'
                    }
                }
                
            });
         
    ';
    $output .= '</script>';

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
    add_shortcode( 'chart-progress', 'profile_chart_total_progress' );
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
        'slug'          => 'chart_progress',
        'code'          => '[chart-progress]',
        'description'   => 'Render a Donut chart of video progress of current user.',
        'outputs'       => '@string donut chart of video progress',
        'example'       => '[chart-progress]',
    )
);
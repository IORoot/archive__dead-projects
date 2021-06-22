<?php


/* ========================================================================================
 *
 * Display a graph of total number of achievements.
 *
 * ======================================================================================= */
function profile_chart_achievements(){

    $data_array = array();

    $badge_ids = mycred_get_users_badges( get_current_user_id() );

    /* Get the number of badges the user has. */
    $user_badge_count = 0;
    if ( ! empty( $badge_ids ) ){
        $user_badge_count = count( $badge_ids );
    }
    /* Get the total number of badges */
    $total_badges = mycred_get_badge_ids();
    $total_badges = count( $total_badges );

    /* # of badges user has, remainder that they do not have. */
    $data_array = [$user_badge_count, $total_badges - $user_badge_count];

    $output .= '<div class="chart-achievements">
                    <h4 style="margin-top:0px">Achievements Progress</h4>
                    <p>Track the available badges you can earn.</p>
                    <div class="chart-achievements-container"> 
                        <canvas id="achievementChart"></canvas> 
                    </div>
                </div>';
    $output .= '<script>';

    $output .= '
     
            var ctx = document.getElementById("achievementChart").getContext(\'2d\');
            var achievementChart = new Chart(ctx, {
                type: \'doughnut\',
                
                data: {
                    datasets: [{
                       
                        data:               ' . json_encode($data_array) . ',
                        backgroundColor:    [\'rgba(251,192,45, 0.4)\', \'rgba(255,255,255, 0.4)\'],
                        borderColor:        [\'rgba(251,192,45, 0.4)\', \'rgba(224,224,224, 0.4)\'],
                        borderWidth:        1
                    }],
                    labels: [
                        \'Badges Achieved\',
                        \'Badges Remaining\'
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
    add_shortcode( 'chart-achievements', 'profile_chart_achievements' );
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
        'slug'          => 'chart_achievements',
        'code'          => '[chart-achievements]',
        'description'   => 'Render a Donut chart of user achievement distribution.</br>
                            NOTE - Currently requires \'chart_history\' shortcode to embed the chart.js library</br>
                            for all others to work. bad design! Need to separate so all can work independently.',
        'outputs'       => '@string donut chart of achievements.',
        'example'       => '[chart-achievements]',
    )
);
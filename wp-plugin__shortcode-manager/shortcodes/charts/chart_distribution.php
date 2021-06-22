<?php


/* ========================================================================================
 *
 * Plot the chart.js chart for distribution of all the user's points.
 *
 * ======================================================================================= */
function profile_chart_distribution(){

    $data_array = array();


    /* Use the category_colours function (below) to grab the default category colours */
    $background_array = json_encode(category_colours(0.4));
    $border_array = json_encode(category_colours(1));

    /* Balance = number of videos watched. Use the function at bottom! */
    $data_array = user_total_points(true);

    $output .= '<div class="chart-distribution">
                    <h4 style="margin-top:0px">Point Distribution</h4>
                    <p>Track how your points are made up.</p>
                    <div class="chart-distribution-container"> 
                        <canvas id="distributionChart"></canvas> 
                    </div>
                </div>';
    $output .= '<script>';

    $output .= '
     
            var ctx = document.getElementById("distributionChart").getContext(\'2d\');
            var distributionChart = new Chart(ctx, {
                type: \'doughnut\',
                
                data: {
                    datasets: [{
                       
                        data:               ' . json_encode(array_values($data_array)) . ',
                        backgroundColor:    ' . $background_array . ',
                        borderColor:        ' . $border_array . ',
                        borderWidth:        1
                    }],
                    labels:                 ' . json_encode(array_keys($data_array)) . '
                },
                
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    cutoutPercentage: 90,
                    legend: {
                        position: \'right\',
                        display: true
                    }
                }
                
            });
         
    ';
    $output .= '</script>';

    echo $output;

    return;

}

/* Generic Functions */

function user_total_points($returnArray = null){
    $total = 0;
    $user_id = get_current_user_id();

    if ($user_id){
        $balance1 = (int) get_user_meta( $user_id, 'mycred_default', true );
        $balance2 = (int) get_user_meta( $user_id, 'attributes_points', true );
        $balance3 = (int) get_user_meta( $user_id, 'balancing_points', true );
        $balance4 = (int) get_user_meta( $user_id, 'bars_points', true );
        $balance5 = (int) get_user_meta( $user_id, 'brachiation_points', true );
        $balance6 = (int) get_user_meta( $user_id, 'climbing_points', true );
        $balance7 = (int) get_user_meta( $user_id, 'coaching_points', true );
        $balance8 = (int) get_user_meta( $user_id, 'jumping_points', true );
        $balance9 = (int) get_user_meta( $user_id, 'mobility_points', true );
        $balance10 = (int) get_user_meta( $user_id, 'quadrupedal_points', true );
        $balance11 = (int) get_user_meta( $user_id, 'rolling_points', true );
        $balance12 = (int) get_user_meta( $user_id, 'strength_points', true );
        $balance13 = (int) get_user_meta( $user_id, 'vaulting_points', true );

    } else {
        $balance1 = 0;
        $balance2 = rand(1,100);
        $balance3 = rand(1,100);
        $balance4 = rand(1,100);
        $balance5 = rand(1,100);
        $balance6 = rand(1,100);
        $balance7 = rand(1,100);
        $balance8 = rand(1,100);
        $balance9 = rand(1,100);
        $balance10 = rand(1,100);
        $balance11 = rand(1,100);
        $balance12 = rand(1,100);
        $balance13 = rand(1,100);
    }


    $total = $balance1 + $balance2 + $balance3 + $balance4 + $balance5 + $balance6 + $balance7 + $balance8 + $balance9 + $balance10 + $balance11 + $balance12 + $balance13;

    // Return an array of all the balances.
    if ($returnArray){
        return (array) [
            'Special' => $balance1,
            'Attributes' => $balance2,
            'Balancing' => $balance3,
            'Bars' => $balance4,
            'Brachiation' => $balance5,
            'Climbing' => $balance6,
            'Coaching' => $balance7,
            'Jumping' => $balance8,
            'Mobility' => $balance9,
            'Quadrupedal' => $balance10,
            'Rolling' => $balance11,
            'Strength' => $balance12,
            'Vaulting' => $balance13
        ];
    }
    return $total;
}



function category_colours($opacity){

    $colour_array = array();

    /* Get ALL Categories */
    $categories = get_terms( 'category', array('hide_empty' => false) );

    foreach ($categories as $category){

        $colour = get_field('category_colour', $category);

        if ($colour) {
            list($r,$g,$b) = array_map('hexdec',str_split(ltrim($colour, '#'),2));

            $rgba = 'rgba(' . $r . ','. $g . ','. $b . ',' . $opacity . ')';

            array_push($colour_array, $rgba);
        } else {
            array_push($colour_array, 'rgba(255,255,255,0.1)');
        }

    }

    return $colour_array;
}



/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'chart-distribution', 'profile_chart_distribution' );
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
        'slug'          => 'chart_distribution',
        'code'          => '[chart-distribution]',
        'description'   => 'Display a donut chart of the distribution of users points.',
        'outputs'       => '@string donut chart of achievement distribution.',
        'example'       => '[chart-distribution]',
    )
);
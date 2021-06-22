<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h2>Custom Shortcodes</h2>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">


                    <!-- sidebar -->
                    <div id="postbox-container-1" class="postbox-container">

                        <div class="meta-box-sortables">

                            <div class="postbox">

                                <h3><span>Shortcode Index</span></h3>
                                <div class="inside">
                                    <ul class="cust_short_list">
                                        <?php
                                        $shortcode_list = get_option( 'cust_short_all' );

                                        /* Organise shortcode into an array list. */
                                        foreach ($shortcode_list as $shortcode){
                                            $cat_code_combo[$shortcode['code']] = $shortcode['category'];
                                        }
                                        asort($cat_code_combo);

                                        $header = '';
                                        foreach ($cat_code_combo as $code => $category){

                                            if($header != $category){
                                                $header = $category;
                                                echo '<h2 class="cust_short_list_header">'.$category.'</h2>';
                                            }
                                            echo '<li>';
                                            echo '<a href="#'.$code.'">'. $code .'</a>';
                                            echo '</li>';
                                        }

                                        ?>
                                        <!-- Retrieve list of defined shortcodes. -->
                                    </ul>
                                </div> <!-- .inside -->

                            </div> <!-- .postbox -->

                        </div> <!-- .meta-box-sortables -->

                    </div> <!-- #postbox-container-1 .postbox-container -->

                    <div class="wrap">
                        <div id="accordion">
                            <!-- Description -->
                            <?php
                            $shortcode_list = get_option( 'cust_short_all' );

                            foreach ($shortcode_list as $shortcode_single){

                                echo '<div class="inside">';
                                    echo '<a name="'. $shortcode_single['code'] . '"></a>';
                                    echo '<h3>'. $shortcode_single['code'] .'</h3>';

                                    echo '<div>';

                                        if ($shortcode_single['code']){
                                            echo '<h5>SHORTCODE</h5>';
                                            echo '<h2><code>'. $shortcode_single['code'] .'</code></h2>';
                                        }

                                        if ($shortcode_single['desc']){
                                            echo '<h5>DESCRIPTION</h5>';
                                            echo '<div class="custom_shortcode_description">'.  $shortcode_single['desc'] .'</div>';
                                        }

                                        if ($shortcode_single['in']){
                                            echo '<h5>PARAMETERS</h5>';
                                            echo '<div style="font-family:Courier">'. $shortcode_single['in'] .'</div>';
                                        }

                                        if ($shortcode_single['out']){
                                            echo '<h5>RETURNS</h5>';
                                            echo '<div style="font-family:Courier">'. $shortcode_single['out'] .'</div>';
                                        }

                                        if ($shortcode_single['filters']) {
                                            echo '<h5>FILTERS</h5>';
                                            echo '<div style="font-family:Courier">'. $shortcode_single['filters'] .'</div>';
                                        }

                                        if ($shortcode_single['actions']) {
                                            echo '<h5>ACTIONS</h5>';
                                            echo '<div style="font-family:Courier">'. $shortcode_single['actions'] .'</div>';
                                        }

                                        if ($shortcode_single['example']) {
                                            echo '<h4>Example</h4>';
                                            echo '<table border="1px"><tr><td>';
                                            echo $shortcode_single['example'];
                                            echo '</td></tr>';
                                            echo '<tr><td>';
                                            echo '<pre style="white-space: pre-wrap; font-size:10px;">'.htmlspecialchars(do_shortcode($shortcode_single['example']) ) . '</pre>';
                                            echo '</td></tr></table>';
                                        }

                                    echo '</div>';

                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>



            </div> <!-- post-body-content -->

        </div> <!-- #post-body .metabox-holder .columns-2 -->

    </div> <!-- #poststuff -->

</div> <!-- .wrap -->
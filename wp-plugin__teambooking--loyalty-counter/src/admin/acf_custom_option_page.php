<?php


new add_boxes_to_options_page();

class add_boxes_to_options_page {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        // add_action('acf/input/admin_head', array($this, 'add_boxes_before'), 1);
        add_action('acf/input/admin_head', array($this, 'add_boxes_after'), 20);
    } 

    /**
     * add_boxes_before
     *
     * @return void
     */
    public function add_boxes_before() {
        $screen = get_current_screen();
        if ($screen->id == 'teambooking-0_page_loyaltycounter') {
        add_meta_box('custom-mb-before-acf', 'CUSTOM MB BEFORE ACF', array($this, 'callback_top'), 'acf_options_page', 'normal', 'high');
        }
    } 

    /**
     * add_boxes_after
     *
     * @return void
     */
    public function add_boxes_after() {
        $screen = get_current_screen();
        if ($screen->id == 'teambooking-0_page_loyaltycounter') {
            add_meta_box('custom-mb-after-acf', 'Manual Coded to be inserted AFTER ACF on Options Page.', array($this, 'callback_bottom'), 'acf_options_page', 'normal', 'high');
        }
    } // end public function add_boxes_after

    /**
     * callback_top
     *
     * @param mixed $post
     * @param mixed $args=array(
     * @return void
     */
    public function callback_top($post, $args=array()) {
        echo '<div><pre>'; 
            var_dump( get_current_screen() ); 
            var_dump( $post ); 
            var_dump($args); 
        echo '</pre></div>'; 
    }

    /**
     * callback_bot
     *
     * @param mixed $post
     * @param mixed $args=array(
     * @return void
     */
    public function callback_bottom($post, $args=array()) {

        do_shortcode('[tbk_loyalty_counter]');

        // echo '<div><pre>';  var_dump($post); var_dump($args); echo '</pre></div>';
    }

}
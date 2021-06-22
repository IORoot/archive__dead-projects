<?php

/* Register the custom shortcode admin page */
        add_action('admin_menu', 'shortcode_register_admin_panel');

/* Declare the Plugin Admin Page */
        function shortcode_register_admin_panel(){
            add_menu_page(
                    'Custom Shortcodes',
                    'Shortcodes',
                    'manage_options',
                    'custom-shortcodes',
                    'custom_shortcodes_initialise_admin_page' );

            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-accordion' );
            wp_enqueue_script( 'cust-short-ui-js', plugin_dir_url( __FILE__ ).'inc/js/cust-short-ui.js', array( 'jquery-ui-core' ) );
            wp_enqueue_style('cust-short-admin-ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css');
            wp_enqueue_style('cust-short-css', plugin_dir_url( __FILE__ ).'inc/css/cust-short.css');
        }

/* Run this function when the page is opened. */
        function custom_shortcodes_initialise_admin_page(){
            //Get the Display page
            require( 'admin_page_template.php' );
        }



/* Register the documentation of the new shortcode. */

        /*
         * @param   string  slug            This is the unique identifier of the shortcode for the page.
         * @param   string  category        The category (and directory name) of the shortcode to be organised.
         * @param   string  code            The actual shortcode to be used.
         * @param   string  description     The description of the shortcode to be used on the admin page.
         * @param   string  inputs          Any parameters that the shortcode takes.
         * @param   string  outputs         What the shortcode will return.
         * @param   string  filters         Any defined filters within the shortcode.
         * @param   string  actions         Any defined actions within the shortcode.
         * @param   string  example         Example of the shortcode in action.
         */
        function register_custom_shortcode_docs($attributes) {

            global $options;

            $options[$attributes['slug']] = array(
                'slug'      => $attributes['slug'],
                'category'  => $attributes['category'],
                'code'      => $attributes['code'],
                'desc'      => $attributes['description'],
                'in'        => null,
                'out'       => null,
                'filters'   => null,
                'actions'   => null,
                'example'   => null,
            );

            update_option('cust_short_all', $options);

            return;
        }
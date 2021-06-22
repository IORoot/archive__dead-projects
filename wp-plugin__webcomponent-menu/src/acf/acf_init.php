<?php

namespace andyp\atomic_admin\acf;

class acf_init
{
    public function __construct()
    {
        /**
         * Register the Admin Page
         */
        new acf_admin_page;

        /**
         * Register the Admin Field Group
         */
        new acf_admin_field_group;

        /**
         * Register the admin CSS
         */
        new acf_admin_css;


    }
}

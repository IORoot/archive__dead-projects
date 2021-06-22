<?php

namespace andyp\atomic_admin\acf;

class acf_admin_css
{
    public function __construct()
    {
        add_action('acf/input/admin_head', array($this,'atomic_admin_head'));

    }

    public function atomic_admin_head() {

        ?> 
        <style type="text/css">
            <?php include 'css/admin.css'; ?>
        </style>

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css" rel="stylesheet">
        
        <?php
    }

}

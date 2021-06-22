<?php

function my_acf_mf_admin_head() {
    ?>
    
    <style type="text/css">

        .acf-field-5eb8f4619c286 .acf-field-5eb8f9d429015  {
            padding: 0px;
            border: 0px;
            background: transparent;
        }
        .acf-field-5eb8f4619c286 .acf-field-5eb8f9d429015 .acf-input > .acf-fields {
            border: 0px;
            background: transparent;
        }
        .acf-field-5eb8f4619c286 .acf-field-5eb8f9d429015 .acf-label {
            display: none;
        }

    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_mf_admin_head');
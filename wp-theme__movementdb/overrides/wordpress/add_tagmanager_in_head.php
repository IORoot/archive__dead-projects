<?php

/* Add TagManager into the HEAD */
function add_head_tagmanager() {
    ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-NDHH3W2');
        </script>
        <!-- End Google Tag Manager -->
    <?php
}
//add_action( 'wp_head', 'add_head_tagmanager', 999 );

/* Add TagManager into the X-THEME Body */
function add_body_tagmanager(){
    ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNVHL7C"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php
}
//add_action( 'x_before_site_begin', 'add_body_tagmanager', 999 );
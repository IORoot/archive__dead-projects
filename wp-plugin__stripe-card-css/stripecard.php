<?php

/*
 * 
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - MEC - Stripe Debit Card graphic 
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>🩳SHORTCODE</strong> | <em>Payment on MEC single events page.</em> | [andyp_stripecard] Shortcode to display stripe debit card graphic.
 * Version:           1.0.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

define( 'ANDYP_STRIPECARD_PATH', plugins_url( '/', __FILE__ ) );


//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                    Register with ANDYP Plugins                          │
//  └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/src/acf/andyp_plugin_register.php';



//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                            The Shortcodes                               │
//  └─────────────────────────────────────────────────────────────────────────┘
function andyp_stripecard_callback(){

    wp_register_style( 'andyp_stripecard_css', ANDYP_STRIPECARD_PATH.'sass/style.css' );
    wp_enqueue_style(  'andyp_stripecard_css');

    $card = 
        '<div class="stripecard">
            <div class="center">
                <div class="card">
                    <div class="front">
                        <svg class="logo" width="20%" height="10%" viewBox="0 0 468 222.5" style="enable-background:new 0 0 468 222.5;">
                            <g>
                            <path class="st0" d="M414,113.4c0-25.6-12.4-45.8-36.1-45.8c-23.8,0-38.2,20.2-38.2,45.6c0,30.1,17,45.3,41.4,45.3
                                c11.9,0,20.9-2.7,27.7-6.5v-20c-6.8,3.4-14.6,5.5-24.5,5.5c-9.7,0-18.3-3.4-19.4-15.2h48.9C413.8,121,414,115.8,414,113.4z
                                M364.6,103.9c0-11.3,6.9-16,13.2-16c6.1,0,12.6,4.7,12.6,16H364.6z"/>
                            <path class="st0" d="M301.1,67.6c-9.8,0-16.1,4.6-19.6,7.8l-1.3-6.2h-22v116.6l25-5.3l0.1-28.3c3.6,2.6,8.9,6.3,17.7,6.3
                                c17.9,0,34.2-14.4,34.2-46.1C335.1,83.4,318.6,67.6,301.1,67.6z M295.1,136.5c-5.9,0-9.4-2.1-11.8-4.7l-0.1-37.1
                                c2.6-2.9,6.2-4.9,11.9-4.9c9.1,0,15.4,10.2,15.4,23.3C310.5,126.5,304.3,136.5,295.1,136.5z"/>
                            <polygon class="st0" points="223.8,61.7 248.9,56.3 248.9,36 223.8,41.3 	"/>
                            <rect x="223.8" y="69.3" class="st0" width="25.1" height="87.5"/>
                            <path class="st0" d="M196.9,76.7l-1.6-7.4h-21.6v87.5h25V97.5c5.9-7.7,15.9-6.3,19-5.2v-23C214.5,68.1,202.8,65.9,196.9,76.7z"/>
                            <path class="st0" d="M146.9,47.6l-24.4,5.2l-0.1,80.1c0,14.8,11.1,25.7,25.9,25.7c8.2,0,14.2-1.5,17.5-3.3V135
                                c-3.2,1.3-19,5.9-19-8.9V90.6h19V69.3h-19L146.9,47.6z"/>
                            <path class="st0" d="M79.3,94.7c0-3.9,3.2-5.4,8.5-5.4c7.6,0,17.2,2.3,24.8,6.4V72.2c-8.3-3.3-16.5-4.6-24.8-4.6
                                C67.5,67.6,54,78.2,54,95.9c0,27.6,38,23.2,38,35.1c0,4.6-4,6.1-9.6,6.1c-8.3,0-18.9-3.4-27.3-8v23.8c9.3,4,18.7,5.7,27.3,5.7
                                c20.8,0,35.1-10.3,35.1-28.2C117.4,100.6,79.3,105.9,79.3,94.7z"/>
                            </g>
                        </svg>
                        <div class="chip">
                        <div class="chip-line"></div>
                        <div class="chip-line"></div>
                        <div class="chip-line"></div>
                        <div class="chip-line"></div>
                        <div class="chip-main"></div>
                        </div>
                        <svg class="wave" viewBox="0 3.71 26.959 38.787" width="26.959" height="38.787" fill="white">
                        <path d="M19.709 3.719c.266.043.5.187.656.406 4.125 5.207 6.594 11.781 6.594 18.938 0 7.156-2.469 13.73-6.594 18.937-.195.336-.57.531-.957.492a.9946.9946 0 0 1-.851-.66c-.129-.367-.035-.777.246-1.051 3.855-4.867 6.156-11.023 6.156-17.718 0-6.696-2.301-12.852-6.156-17.719-.262-.317-.301-.762-.102-1.121.204-.36.602-.559 1.008-.504z"></path>
                        <path d="M13.74 7.563c.231.039.442.164.594.343 3.508 4.059 5.625 9.371 5.625 15.157 0 5.785-2.113 11.097-5.625 15.156-.363.422-1 .472-1.422.109-.422-.363-.472-1-.109-1.422 3.211-3.711 5.156-8.551 5.156-13.843 0-5.293-1.949-10.133-5.156-13.844-.27-.309-.324-.75-.141-1.114.188-.367.578-.582.985-.542h.093z"></path>
                        <path d="M7.584 11.438c.227.031.438.144.594.312 2.953 2.863 4.781 6.875 4.781 11.313 0 4.433-1.828 8.449-4.781 11.312-.398.387-1.035.383-1.422-.016-.387-.398-.383-1.035.016-1.421 2.582-2.504 4.187-5.993 4.187-9.875 0-3.883-1.605-7.372-4.187-9.875-.321-.282-.426-.739-.266-1.133.164-.395.559-.641.984-.617h.094zM1.178 15.531c.121.02.238.063.344.125 2.633 1.414 4.437 4.215 4.437 7.407 0 3.195-1.797 5.996-4.437 7.406-.492.258-1.102.07-1.36-.422-.257-.492-.07-1.102.422-1.359 2.012-1.075 3.375-3.176 3.375-5.625 0-2.446-1.371-4.551-3.375-5.625-.441-.204-.676-.692-.551-1.165.122-.468.567-.785 1.051-.742h.094z"></path>
                        </svg>
                        <div class="card-number"> 
                            <svg viewBox="0 0 160 20" width="100%">
                                <text x="0" fill="#fff" y="15">5453 0000 0000 0000</text>
                            </svg>
                        </div>
                        <div class="end">
                        <span class="end-text">
                            <svg viewBox="0 0 70 26" width="10%" height="5%">
                                <text x="0" fill="#fff" y="15">exp. end:</text>
                            </svg>
                            <svg viewBox="0 0 45 20" height="5%" width="15%">
                                <text x="0" fill="#fff" y="15">11/22</text>
                            </svg>
                        </span>
                        </div>
                        <div class="card-holder">
                            <svg viewBox="0 0 200 20" height="5%" width="90%">
                                <text x="0" fill="#fff" y="15">MR JOHN MATRIX</text>
                            </svg>
                        </div>
                        <div class="master">
                        <div class="circle master-red"></div>
                        <div class="circle master-yellow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    echo $card;
    
    return;
}

add_shortcode( 'andyp_stripecard', 'andyp_stripecard_callback' );

<?php

namespace andyp\atomic_admin;

class initialise
{
    public function __construct()
    {

        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                        		 Load ACF    		                     │
        // └─────────────────────────────────────────────────────────────────────────┘
        new acf\acf_init;

        // ┌─────────────────────────────────────────────────────────────────────────┐
        // │                           Register the Actions                          │
        // └─────────────────────────────────────────────────────────────────────────┘
        new actions\register_item;

    }
}
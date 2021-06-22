<?php

//  ┌─────────────────────────────────────────────────────────────────────────┐ 
//  │                                                                         │░
//  │         Dynamically Generates the Hero Header off $_GET['msf']          │░
//  │                                                                         │░
//  └─────────────────────────────────────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░



//  ┌──────────────────────────────────────────────────────────┐
//  │               Get Options from Admin Page                │
//  └──────────────────────────────────────────────────────────┘
function get_options($category = null){

    if ($category == null){ return false; }

    $options = [];

    if( have_rows( 'category_heros', 'option') ) {

        while( have_rows('category_heros', 'option') ): the_row();

            if (get_sub_field('msf_value') != $category){ continue; }

            $options = array ( 
                'msf_value'             => get_sub_field('msf_value'),
                'hero_title'            => get_sub_field('hero_title'),
                'hero_description'      => get_sub_field('hero_description'),
                'hero_image'            => get_sub_field('hero_image'),
                'hero_css_rules'        => get_sub_field('hero_css_rules'),        
            );

        endwhile;
    }

    return $options;

}


//  ┌──────────────────────────────────────────────────────────┐
//  │                     Generate Header                      │
//  └──────────────────────────────────────────────────────────┘
function category_hero_header(){

    $options = false;
    
    // Get the categeory and options for that entry.
    if (isset($_GET['msf'])){
        $category = str_replace('CAT-', '', $_GET['msf']);
        $options = get_options($category);
    }

    // If not found, Set Default.
    if ($options == false ){ 
        $options = array ( 
            'msf_value'             => 'default',
            'hero_title'            => 'Parkour Tutorials',
            'hero_description'      => 'Practical Movement Training by LondonParkour.',
            'hero_image'            => '',
            'hero_css_rules'        => '.category-hero { background-color: #53A5E3; padding: 29px 0px 0px 58px; height: 290px;}',        
        );
    }

    // Output.
    $output = '<style>';
        $output .= $options['hero_css_rules'];
    $output .='</style>';
    $output  .= '<div class="category-hero category-hero__'.$options['msf_value'].'" style="background-image: url(\''.$options['hero_image'].'\')" >';
        $output .= '<h1 class="category-hero__title">'. $options['hero_title'] .'</h1>';
        $output .= '<p class="category-hero__description">'. $options['hero_description'] .'</p>';
    $output .= '</div>';

    return $output;
}



add_shortcode( 'tutorial_category_hero', 'category_hero_header' );
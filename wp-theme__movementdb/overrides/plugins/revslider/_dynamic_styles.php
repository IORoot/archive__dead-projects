<?php

add_action('wp_head', 'dynamic_slider_font_colours', 100);

function dynamic_slider_font_colours()
{
    $slider_font_colour = get_field('series_slider_main_font_colour');
    $slider_title_colour = get_field('series_slider_title_font_colour');

    $css = '
      .mvdb-series-slider-font-colour { color: '. $slider_font_colour .' !important; }
      .mvdb-series-slider-background-colour { background-color: '. $slider_font_colour .' !important; }
      .mvdb-series-slider-border-colour { border-color: '. $slider_font_colour .' !important; }
      .mvdb-series-slider-title-colour { color: '. $slider_title_colour .' !important; }
      .mvdb-series-slider-title-background-colour { background-color: '. $slider_title_colour .' !important; }
      .mvdb-series-slider-title-border-colour { border-color: '. $slider_title_colour .' !important; }
    ';

    echo "<style>" . $css . "</style>";
}
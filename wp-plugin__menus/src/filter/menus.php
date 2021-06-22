<?php


class mc_menus
{
    public $icon;


    public function __construct()
    {
        $this->menu_filters();
        return;
    }


    public function menu_filters()
    {
        add_filter('wp_nav_menu_objects', array($this, 'nav_icons'), 10, 2);
        add_filter('walker_nav_menu_start_el', array($this, 'nav_description'), 10, 4);
        add_filter('walker_nav_menu_start_el', array($this, 'nav_image'), 10, 4);
    }


    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │
    // │                                  ICON                                   │
    // │                                                                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    public function nav_icons($items, $args)
    {
        // loop
        foreach ($items as $item) {
            $item->title = $this->icon($item);
        }

        // return
        return $items;
    }


    public function icon($item)
    {
        // vars
        $icon     = get_field('mc_icon', $item);
        $colour   = get_field('mc_icon_colour', $item);
        $position = get_field('mc_icon_position', $item);
        $class    = get_field('mc_icon_class', $item);

        // append icon
        if ($icon) {
            $this->icon = '<i class="mdi mdi-';
            $this->icon .= $icon;
            
            if ($class) {
                $this->icon .= ' '.$class. ' ';
            }

            $this->icon .= '"';  //close class

            if ($colour) {
                $this->icon .= ' style="color:'.$colour. '" ';
            }

            $this->icon .= '></i>';

            if ($position == 'after') {
                return  $item->title . $this->icon;
            }

            return $this->icon . $item->title;
        }

        return  $item->title;
    }

    


    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │
    // │                                 IMAGE                                   │
    // │                                                                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    public function nav_image($item_output, $item, $depth, $args)
    {
        
        // vars
        $image    = get_field('mc_image', $item);
        $position = get_field('mc_image_position', $item);

        if (!$image) {
            return $item_output;
        }

        $image_html = '<div class="menu-item-image lazyload" data-bg="'.$image['url'].'" alt="'.$image['alt'].'"></div>';

        if ($position == 'after') {
            $item_output = preg_replace('/(<\/a.*?>)/', $image_html.'$1', $item_output);
            return $item_output;
        }

        $item_output = preg_replace('/(<a.*?>)/', '$1'.$image_html, $item_output);
        return $item_output;
    }


    // ┌─────────────────────────────────────────────────────────────────────────┐
    // │                                                                         │
    // │                              DESCRIPTION                                │
    // │                                                                         │
    // └─────────────────────────────────────────────────────────────────────────┘
    public function nav_description($item_output, $item, $depth, $args)
    {
        
        // vars
        $switch = get_field('mc_description', $item);

        if (!$switch) {
            return $item_output;
        }

        $item_output = str_replace($args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output);

        // return
        return $item_output;
    }
}

new mc_menus;

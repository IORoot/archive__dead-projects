<?php

/* ========================================================================================
 *
 * Display a dropdown list of different skins
 *
 * Uses the GET parameter to determine which skin to apply and display on the dropdown list
 * in the series listings page.
 *
 * Location: Series Page
 *
 * [mvdb_essgrid_skin_dropdown]
 *
 * @return  string  dropdown button      Returns a styled dropdown button for skins.
 *
 * ======================================================================================= */

function shortcode_skin_dropdown($attr = null){

    switch($_GET['egskin']){
        case 66:
            $current_skin = '<i class="fa fa-list"></i> List';
            break;
        case 55:
            $current_skin = '<i class="fa fa-th"></i> Grid';
            break;
        case 67:
            $current_skin = '<i class="fa fa-th-large"></i> Detail';
            break;
        default:
            $current_skin = '<i class="fa fa-id-badge"></i> Card';
            break;
    }

    $dropdown .= '<div class="mvdb-filter-skin">';

    $dropdown .= '<div class="mvdb-dropdown-button"><span>'.$current_skin.'</span><i class="eg-icon-down-open"></i></div>';

    $dropdown .= '<div class="mvdb-dropdown-wrapper">';

    $dropdown .= '<div class="mvdb-filterbutton"><a href="?egskin=66"><i class="fa fa-list"></i> List</a></div>';
    $dropdown .= '<div class="mvdb-filterbutton"><a href="?egskin=55"><i class="fa fa-th"></i> Grid</a></div>';
    $dropdown .= '<div class="mvdb-filterbutton"><a href="?egskin=67"><i class="fa fa-th-large"></i> Detail</a></div>';
    $dropdown .= '<div class="mvdb-filterbutton"><a href="http://www.movementdb.com/series/"><i class="fa fa-id-badge"></i> Card</a></div>';

    $dropdown .= '</div>';

    $dropdown .= '<div class="eg-clearfix"></div>';

    $dropdown .= '</div>';

    echo $dropdown;

    return;
}




/* ========================================================================================
 *
 * 2. REGISTER SHORTCODE
 *
 * On Wordpress INIT hook, Add the new shortcode.
 *
 * ======================================================================================== */

add_filter( 'init',function(){
    add_shortcode( 'mvdb_essgrid_skin_dropdown', 'shortcode_skin_dropdown' );
});



/* ========================================================================================
 *
 * 3. ADD DOCUMENTATION FOR SHORTCODE
 *
 * Add documentation for this shortcode to the custom shortcode admin page.
 *
 * @param cataegory
 * @param slug
 * @param code
 * @param description
 * @param inputs
 * @param outputs
 * @param filters
 * @param actions
 * @param example
 *
 * ======================================================================================== */

register_custom_shortcode_docs(
    array(
        'category'      => 'Essential Grid',
        'slug'          => 'mvdb_essgrid_skin_dropdown',
        'code'          => '[mvdb_essgrid_skin_dropdown]',
        'description'   => 'Will create a new dropdown selection for the series page essential grid. </br>
                            This enables the user to select a different skin for the grid.',

        'outputs'       => '@string styled dropdown menu.',
        'example'       => '[mvdb_essgrid_skin_dropdown]',
    )
);
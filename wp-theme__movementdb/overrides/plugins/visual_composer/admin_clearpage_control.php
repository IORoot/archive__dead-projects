<?php

// ADD Button NOT WORKING!!!!
//add_filter('vc_nav_controls', 'admin_clearpage_control');

function admin_clearpage_control($list){



    $new_button = array(
        'clearpage',
        '   
            <li class="vc_show-mobile">	
                <a href="#" class="vc_icon-btn vc_element-button" id="vc_clearpage" title="Clear All"
                    onClick="(function(){
                        tinymce.innerHTML = "";
                        return false;
                    })(); return false;"
                >    
                    <i class="vc-composer-icon vc-c-icon-delete_empty"></i>	
                </a>
            </li>'
    );

    array_push($list, $new_button);

//    echo '-- VAR_DUMP --</BR><textarea>';
//    var_dump($list);
//    echo '</textarea></BR></BR>-- VAR_DUMP END-- </BR></BR>';

    return $list;

}
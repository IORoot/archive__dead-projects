<?php

namespace andyp\webcomponent_infopanel\render;

class js
{

    public $webcomponent;


    public function set_webcomponent($webcomponent)
    {
        $this->webcomponent = $webcomponent;
    }

    public function add_inline_js()
    {
        $this->renderJS();
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                                PRIVATE                                  │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


    private function renderJS()
	{

		$infopanel_js = $this->webcomponent['infopanel_js'];

		if (empty($infopanel_js)) { return; }

        add_filter('wp_footer', function () use (&$infopanel_js) {
            echo '<script>'. $infopanel_js .'</script>';
        }, 30);
		
	}


}
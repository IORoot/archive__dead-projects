<?php

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                                                                         │░
//  │                                                                         │░
//  │                           LOAD COMPONENTS                               │░
//  │                                                                         │░
//  │                                                                         │░
//  └─────────────────────────────────────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


class ANDYP_VC_AMP {


    function __construct() {
        add_action( 'init', array( $this, 'integrateWithVC' ) );
    }


    public function integrateWithVC() {

        // Check if WPBakery Page Builder is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        $this->load_components();
    }
	

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
            <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }


    /**
     * load_components
     * 
     * Loads all components in the amp\component namespace.
     * Uses the composer autoload_classmap to load them.
     *
     * @return void
     */
    public function load_components()
    {
        $classMap = array_keys( require(__DIR__.'/../../vendor/composer/autoload_classmap.php'));
        
        $namespace = 'amp\component';
    
        foreach($classMap as $class){
            if(strpos($class, $namespace) === 0){
                new $class;
            }
        }
    }



}

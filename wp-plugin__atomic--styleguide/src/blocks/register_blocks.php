<?php

namespace andyp\atomic_styleguide\blocks;

class register_blocks
{

    /**
     * 
     * Contains array of all blocks and info to register in
     * the atomic style guide.
     * 
     * [
     *  'button' => [
     *          'folder'    => 'atomic'
     *          'classname' => 'button'
     *          'title'     => '<span class="mdi mdi-button"></span> Button'
     *      ]
     *  'grid' => [
     *          'folder'    => 'environment'
     *          'classname' => 'Vertical Rhythm'
     *          'title'     => '<span class="mdi mdi-grid"></span> Vertical Rhythm'
     *      ]
     * 
     * ]
     */
    public $block;



    public function __construct()
    {

        $this->environment  = $this->get_classnames('environment');
        $this->atoms        = $this->get_classnames('atoms');
        $this->molecules    = $this->get_classnames('molecules');

        $this->declare_action();

    }


    /**
     * 
     * Get the list of all blocks
     * 
     */
    private function get_classnames($folder)
    {
        if (empty($folder)){ return; }

        // .../src/blocks/atomic
        $dir = __DIR__ . '/' . $folder;

        // array of all files in directory
        $contents = scandir( $dir );


        foreach($contents as $filename)
        {
            // remove . and ..
            if ($filename == '.' || $filename == '..' )  { continue; }
            // remove all php files
            if (strpos($filename, '.php') !== false) { continue; }
            // only accept directories
            if (!is_dir($dir . '/' . $filename)) { continue; }

            
            $namespaced_classname = 'andyp\\atomic_styleguide\\blocks\\' . $folder. '\\' . $filename. '\\' . $filename;     
            
            if (!class_exists($namespaced_classname)){ return; }


            $this->block[$filename]['folder']    = $folder;    // atomic 

            $this->block[$filename]['classname'] = $filename;  // button (directory name)

            $this->block[$filename]['title'] = (new $namespaced_classname)->title();  // <span class="mdi mdi-button"></span> button

        }
        
    }


    /**
     * 
     * Once all plugin are loaded, run this action.
     * 
     */
    private function declare_action()
    {
        add_action( 'plugins_loaded', array($this, 'action_callback'));
    }


    /**
     * 
     * Loop through the $this->block array and fire off 
     * all of the register actions.
     * 
     */
    public function action_callback()
    {

        foreach ($this->block as $classname => $block)
        {
            $action['group'] = $block['folder'];

            $action['title'] = $block['title'];

            $path = plugin_dir_path( __FILE__ ) . $block['folder'] . '/' . $block['classname'];
            $url  = plugins_url( '/', __FILE__ ) . $block['folder'] . '/' . $block['classname'];


            if (file_exists( $path . '/_demo.php'))
            {
                $action['demo'] = $url . '/_demo.php';
            }
    
            if (file_exists($path . '/_code.php'))
            {
                $action['code'] = file_get_contents($path . '/_code.php');
            }
    
            if (file_exists($path . '/_docs.md'))
            {
                $action['docs'] = file_get_contents($path . '/_docs.md');
            }
    
            do_action('register_atomic_item', $action);

            unset($action);

        }

    }

}
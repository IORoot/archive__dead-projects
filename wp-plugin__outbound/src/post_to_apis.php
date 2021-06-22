<?php

//  ┌─────────────────────────────────────────────────────────────────────────┐ 
//  │                                                                         │░
//  │                          Submit posts to APIs                           │░
//  │                                                                         │░
//  └─────────────────────────────────────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

class post_to_apis {

    /**
     * $post
     * 
     * Contains all of the data about the post *except* the ACF data.
     *
     * @var undefined
     */
    public $post;

    /**
     * $acf
     * 
     * Contains all of the post ACF data.
     *
     * @var undefined
     */
    public $acf;

    /**
     * $instagram
     *
     * @var undefined
     */
    public $instagram;
    
   /**
    * __construct
    *
    * @return void
    */
    function __construct(){

        // Start all action hooks
        $this->start_actions();

    }
  
    /**
     * start_actions
     *
     * @return void
     */
    public function start_actions(){

        // On save / update of a post.
        add_action('acf/save_post',array($this, 'save_post_callback'));

    }
    
    /**
     * save_post_callback
     * 
     * Run this function when a post is saved or updated.
     *
     * @param mixed $post_id
     * @return void
     */
    public function save_post_callback($post_id){

        // Get & Set all post details.
        global $post;
        $this->post = $post;
        $this->acf = get_fields( $post_id );
    
        // Check post_type is correct.
        if ($this->post->post_type != 'outbound_post'){ return; }
        
        // Check all outbound targets
        foreach ($this->acf['outbound_post_targets'] as $target){

            // run post_$target method.
            $targetMethod = 'post_'.$target;
            $this->$targetMethod();

        }

        return;
    }

    /**
     * post_instagram
     * 
     * Use the instagram API to post the media.
     *
     * @return void
     */
    public function post_instagram(){

        $this->instagram = new outbound_instagram();

        $media_abs_path = $this->url_to_path($this->acf['outbound_post_media']['url']);

        $this->instagram->setMedia($media_abs_path);
        $this->instagram->setMediaType($this->acf['outbound_post_media']['type']);
        $result = $this->instagram->setCaptionText($this->post->post_content);
        
    }

    /**
     * post_gmb
     * 
     * Use the Google My Business API to post the media.
     *
     * @return void
     */
    public function post_gmb(){
        
    }


    /**
     * url_to_path
     *
     * @param mixed $url
     * @return void
     */
    public function url_to_path($url){
        $path = str_replace(WP_SITEURL, WP_CONTENT_DIR, $url);
        $path = str_replace('wp-content/wp-content/', 'wp-content/', $path);

        return $path;
    }


}

$outbound_posts = new post_to_apis();
<?php

set_time_limit(0);
date_default_timezone_set('UTC');

class outbound_instagram {

    /**
     * $ig
     * 
     * Instagram object to interact with.
     *
     * @var undefined
     */
    private $ig;
    private $ig_username;
    private $ig_password;
    private $ig_debug = false;
    private $ig_trunc_debug = false;

    public $media_filename;
    public $media_type;
    public $caption_text;

    public function __construct(){

         // Check for username & password in ACF.
         $this->get_instagram_credentials();

         // Turn ON the use in a website.
         \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
 
         // Create Instagram Object.
         $this->ig = new \InstagramAPI\Instagram($this->ig_debug, $this->ig_trunc_debug);

         // Login.
         $this->ig_login();

         return $this;
    }

    /**
     * setMedia
     *
     * @param mixed $filename
     * @return void
     */
    public function setMedia($filename){
        $this->media_filename = $filename;
    }

    /**
     * setMediaType
     *
     * @param mixed $type
     * @return void
     */
    public function setMediaType($type){
        $this->media_type = $type;
    }

    /**
     * setCaptionText
     *
     * @param mixed $captionText
     * @return void
     */
    public function setCaptionText($captionText){
        $this->caption_text = $captionText;
    }


    /**
     * get_instagram_credentials
     * 
     * Get all details from ACF Outbound Dashboard - Instagram Settings panel
     * @return void
     */
    public function get_instagram_credentials(){
  
        $this->ig_username = get_field('instagram_account_username', 'option');
        $this->ig_password = get_field('instagram_account_password', 'option');
        $this->ig_debug = get_field('instagram_debug', 'option');
        $this->ig_trunc_debug = get_field('instagram_truncate_debug', 'option');

        return $this;
    }


    /**
     * ig_login
     *
     * @return void
     */
    public function ig_login(){

        // Empty credentials.
        if ($this->ig_username == '' || $this->ig_password == ''){ return; }

        try {
            $this->ig->login($this->ig_username, $this->ig_password);
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }

        return $this;
    }


    /**
     * ig_post_photo
     *
     * @param mixed $photoFilename
     * @return void
     */
    public function ig_post(){
        
        try {
            // The most basic upload command, if you're sure that your photo file is
            // valid on Instagram (that it fits all requirements), is the following:
            // $ig->timeline->uploadPhoto($photoFilename, ['caption' => $captionText]);
            // However, if you want to guarantee that the file is valid (correct format,
            // width, height and aspect ratio), then you can run it through our
            // automatic photo processing class. It is pretty fast, and only does any
            // work when the input file is invalid, so you may want to always use it.
            // You have nothing to worry about, since the class uses temporary files if
            // the input needs processing, and it never overwrites your original file.
            //
            // Also note that it has lots of options, so read its class documentation!
            $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($this->media_filename);

            $this->ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $this->caption_text]);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }

        return $this;
    }

}
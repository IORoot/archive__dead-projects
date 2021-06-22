<?php

namespace andyp\atomic_random_videos\shortcode;

class random_video {


    /**
     * 
     * The Parent group slug
     * 
     */
    public $slug;



    /**
     * 
     * The Group Options
     * 
     */
    public $options;


    /**
     * 
     * The single panel to use
     * 
     */
    public $panel;



    /**
     * 
     * The HTML built up.
     * 
     */
    public $html = '';
    public $cover_image = '';





    /**
     * $video_list
     * 
     * List of videos to use in the random selection pool.
     * Good for limiting down to the ones you want to use.
     *
     * @var undefined
     */
    public $video_list = [];



    public function __construct(){

        add_shortcode( 'andyp_random_video', array($this, 'render_shortcode') );
        
    }




    /**
     * render_shortcode
     *
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function render_shortcode($atts, $content = null){

        unset($this->slug);
        unset($this->html);

        //  ┌──────────────────────────────────────┐
		//  │         Shortcode parameters         │
		//  └──────────────────────────────────────┘
		extract(
			shortcode_atts(
				array(
					'slug' => null,
				),
				$atts
			)
        );

        if (empty($atts['slug'])){ return; }

        $this->slug = $atts['slug'];

        $this->setup();

        $this->randomise_panel();
        
        $this->create_cover_image();

        $this->create_html();

        return $this->html;
    }



    private function setup()
    {
        $options = new get_webcomponent_options;
        $options->set_clone_name('random_video_panel');
        $options->run();
        $options->filter_webcomponents_for_slug('video_group_slug', $this->slug);
        $this->options = $options->get_result();
    }



    private function randomise_panel()
    {

        if (empty($this->options['random_video_panels'])){ return; }

        $random_key = array_rand($this->options['random_video_panels']);

        $this->panel = $this->options['random_video_panels'][$random_key];

        unset($this->options);
    }



    private function create_cover_image()
    {
        if (empty($this->panel['random_video_cover_image'])){ return; }
        if ($this->panel['random_video_cover_image'] == ''){ return; }
        
        // Cover Image
        $this->cover_image = ' style="background-image: url(\''.$this->panel['random_video_cover_image'].'\');" ';
        
    }


    private function create_html()
    {

        if (empty($this->panel)){ return; }

        $output = '<div class="random-video '.$this->panel['random_video_class'].'" >';
            $output .= '<div class="random-video__left">';
                $output .= '<div class="random-video__meta">';
                    $output .= '<h2>'.$this->panel['random_video_title'].'</h2>';
                    $output .= '<h4>'.$this->panel['random_video_description'].'</h4>';
                    $output .= '<a class="button button__arrow--right mdi__pseudo--night" href="'.$this->panel['random_video_link']['url'].'"  alt="'.$this->panel['random_video_link']['title'].'" target="'.$this->panel['random_video_link']['target'].'">Learn More</a>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<lite-youtube class="random-video__lite-yt liftup" videoid="'.$this->panel['random_video_youtube_id'].'" '.$this->cover_image.'></lite-youtube>';
        $output .= '</div>';
    
        unset($this->cover_image);
        unset($this->panel);

        $this->html =  $output;
    }


}
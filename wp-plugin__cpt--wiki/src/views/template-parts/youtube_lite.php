
<?php 

	$videoId = get_post_meta($post->ID, 'videoId', true);
    $thumbnail_url = get_the_post_thumbnail_url($post->ID,);
    $thumbnail = null;
    
    if (!empty($thumbnail_url))
    {
        $thumbnail = 'style="background-image: url(\'' . $thumbnail_url . '\');"';
    }

    if (empty($videoId)){
        the_post_thumbnail(null, ['class' => 'w-full']);
    } else {
        echo '<lite-youtube 
                    class="lazyload w-full h-screen-3/4 md:h-screen-1/2 mb-24 bg-cover bg-center bg-no-repeat bg-night fill-youtube flex cursor-pointer" 
                    id="ytplayer" 
                    videoid="'. $videoId .'" 
                    ' . $thumbnail . '>' . PHP_EOL;

        echo '<svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,15L15.19,12L10,9V15M21.56,7.17C21.69,7.64 21.78,8.27 21.84,9.07C21.91,9.87 21.94,10.56 21.94,11.16L22,12C22,14.19 21.84,15.8 21.56,16.83C21.31,17.73 20.73,18.31 19.83,18.56C19.36,18.69 18.5,18.78 17.18,18.84C15.88,18.91 14.69,18.94 13.59,18.94L12,19C7.81,19 5.2,18.84 4.17,18.56C3.27,18.31 2.69,17.73 2.44,16.83C2.31,16.36 2.22,15.73 2.16,14.93C2.09,14.13 2.06,13.44 2.06,12.84L2,12C2,9.81 2.16,8.2 2.44,7.17C2.69,6.27 3.27,5.69 4.17,5.44C4.64,5.31 5.5,5.22 6.82,5.16C8.12,5.09 9.31,5.06 10.41,5.06L12,5C16.19,5 18.8,5.16 19.83,5.44C20.73,5.69 21.31,6.27 21.56,7.17Z"/></svg>'. PHP_EOL;

        echo '</lite-youtube>'. PHP_EOL;
    }
?>

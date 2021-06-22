<?php

    $backlink = '/wikis'; 
    $backname = 'Wiki'; 

?>

<div class="">
    <?php 
        $back = '<a href="' .$backlink. '" rel="tag" class="border-2 border-night text-night px-10 py-6 mt-10 rounded-xl inline-block fill-black hover:bg-night hover:text-white hover:fill-white">';
        $back .= '<svg class="w-4 h-6 inline-block align-top mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/></svg>';
        $back .= 'Back to ' . $backname;
        $back .= '</a>';
        echo $back; 
    ?>
</div>



<h1 class="text-3xl lg:text-8xl mt-24 mb-12 text-night w-3/5 capitalize"><?php the_title(); ?></h1>
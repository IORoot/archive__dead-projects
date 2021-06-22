<div class="w-full md:w-1/4 xl:w-1/5 bg-ghost p-4">

    <div class="text-xl text-sky">Classes</div>
        
    <div class="flex flex-col mb-4 ml-4">

        <?php 
            $code = "[wiki_posts cat=\"classes\" posts_per_page=\"50\" order=\"ASC\"]
                <a href=\"{{guid}}\" class=\"hover:underline hover:text-sky py-1\">
                    <div class=\"flex\">
                        <div class=\"inline-block pt-1 mr-1 w-4\">{{icon}}</div>
                        <div>{{post_title}}</div>
                    </div>
                </a>
            [/wiki_posts]";
            echo do_shortcode($code);
        ?>
        
    </div>

    <div class="text-xl text-sky">Company</div>

    <div class="flex flex-col mb-4 ml-4">
        <?php 
            $code = "[wiki_posts cat=\"company\" posts_per_page=\"50\" order=\"ASC\"]
                <a href=\"{{guid}}\" class=\"hover:underline hover:text-sky py-1\">
                    <div class=\"flex\">
                        <div class=\"inline-block pt-1 mr-1 w-4\">{{icon}}</div>
                        <div>{{post_title}}</div>
                    </div>
                </a>
            [/wiki_posts]";

            echo do_shortcode($code);
        ?>
    </div>

    <div class="text-xl text-sky">Website</div>

    <div class="flex flex-col mb-4 ml-4">
        <?php 
            $code = "[wiki_posts cat=\"website\" posts_per_page=\"50\" order=\"ASC\"]
                <a href=\"{{guid}}\" class=\"hover:underline hover:text-sky py-1\">
                    <div class=\"flex\">
                        <div class=\"inline-block pt-1 mr-1 w-4\">{{icon}}</div>
                        <div>{{post_title}}</div>
                    </div>
                </a>
            [/wiki_posts]";
            echo do_shortcode($code);
        ?>
    </div>

</div>
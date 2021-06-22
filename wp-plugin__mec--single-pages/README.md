# Default Single Page for Modern Events Calendar

The file in this directory is SYMLINKED. you need to symlink it to the following directory:

wp-content/plugins/modern-events-calendar/app/skins/single/default.php

use the command (while in that directory):

`ln -s ../../../../andyp_mec_single_page_view/default.php`

## Note

This is just a copy of the file, do not enable it as a plugin because it won't work. There are $this obejt calls within it that will break wordpress.
It will oNLY work being symlinked.
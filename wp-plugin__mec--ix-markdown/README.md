# Filter for imported google calendar descriptions

NOTE - The file in this directory is SYMLINKED. you need to create the symlink to override the original code.

This little plugin will allow you to add Github-flavoured Markdown into the descriptions of your google calendar.
When Modern Events Calendar imports your google event and looks at the description field it will run it through a 
wordpress filter before inserting it as a post.
That filter will run the https://github.com/erusev/parsedown code and convert the markdown into HTML - ready for
the post insert.

This is just one thing you can do, the filter allows you to do anything to the description if you wanted.

## Install

1. within the plugin directory, run `composer install` to install the parsedown dependency from https://github.com/erusev/parsedown
2. You now need to replace the original importer file within Modern Events Calendar with this new one by using a symlink.
   ``` 
   cd wp-content/plugins/modern-events-calendar/app/features/; 
   mv ix.php ix.php.orig
   ln -s ../../../andyp_mec_ix_filter/ix.php
   ```
3. Activate the plugin.

## Uninstall

1. If you want to remove the symlink and return the code back to the original, just delete the symlink and rename the original.
    ``` 
   cd wp-content/plugins/modern-events-calendar/app/features/; 
   rm ix.php
   mv ix.php.orig ix.php
   ```
2. Deactivate the plugin.


## Details

1. Once the new file is being used, it introduces a filter on the description field of the calendar when being imported. That filter is called `andyp_ix_description`
2. You can implement your own filter by using `apply_filter('andyp_ix_description', 'my_callback');`
3. or, Use this plugin that incorporates the parsedown package to easily filter Markdown into HTML.
4. When Modern Events Calendar does an import, it'll now parse markdown!

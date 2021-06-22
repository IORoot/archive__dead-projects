# Atomic Styleguide

This plugin declares all of the blocks of the style guide.

### Groups

1. Environment
2. Atoms
3. Molecules

### Blocks

Each block is a folder that is nested under the group.

```bash

./blocks/molecules

./blocks/atoms

    ./blocks/atoms/button
    ./blocks/atoms/typography

./blocks/environment

    ./blocks/environment/responsive
    ./blocks/environment/vertical_rhythm
```

### Required File

Each block folder needs a PHP file with the same name as the folder. For instance,
`./blocks/atoms/button` needs a file called `./blocks/atoms/button/button.php`.

This file is a class that will return the title of the Tab and the block.

```php
<?php
namespace andyp\atomic_styleguide\blocks\atoms\button;

class button 
{
    public function title(){
        return '<span class="mdi mdi-gesture-tap-button"></span> Button';
    }
}
```

Make sure :
1. File is called `button.php`
2. The namespace is within a `button` namespace.
3. The class is called `button`
4. Has a method called `title()` that returns the Tab title HTML.

### Optional Files

#### _code.php

This contains the content that is echoed out into the codemirror textarea on the atomic styl guide.

#### _demo.php

This contains the code that will be put into an iFrame and run. This should actually render. 

If you want to display the theme style, you will need to add into the top of the file.

```
<link rel="stylesheet" id="londonparkourv4-style-css" 
href="https://dev.londonparkour.com/wp-content/themes/londonparkour.com_v4/style.css?ver=5.6" 
type="text/css" media="all">

<h1>This is the Themed Header, based off the theme stylesheet.</h1>
```

#### _docs.md

This is a markdown file that will be parsed with `Parsedown` to be converted into HTML. That will be displayed on the DOCS tab.


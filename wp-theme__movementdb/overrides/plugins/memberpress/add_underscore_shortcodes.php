<?php

/* Originals on Line 40 - 45 in /controllers/MeprRulesCtrl.php
 * Change all of the shortcodes to underscores rather than hypens.
 *
 * This is so the Visual Composer can register this shortcode as one that can be used.
 * The custom Visual composer element is /override_plugins/visual_composer/memberpress_shortcode_wrapper.php
 *
 * This allows me to wrap the mepr-show shortcode around other elements.
*/


// Register the mepr-active as mepr_active so it can be used in visual composer as a nestable element.
add_shortcode('mepr_active', 'MeprRulesCtrl::active_shortcode');
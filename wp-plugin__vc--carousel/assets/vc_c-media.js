// ┌─────────────────────────────────────┐ 
// │                                     │░
// │   Behaviour of the Component-media   │░
// │                                     │░
// │       Requires jQuery to run.       │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


//  ┌──────────────────────────────────────┐
//  │   Trigger the C-media switch         │
//  └──────────────────────────────────────┘
function triggerCmedia(){ 

    jQuery(this).parents(".c-media__linklist").find(".c-media__link").css('text-decoration', 'none');
    jQuery(this).css('text-decoration', 'underline');

    mediaID = "#"+jQuery(this).attr('id');
    // Use 'outline color' as background color!
    backgroundColor = jQuery(this).css('outline-color'); 

    // Give top level component a custom class background colour.
    jQuery(this).parents(".c-media").css('background-color', backgroundColor);

    // switch all off and make height of parent = 0 (so links work)
    jQuery(this).parents(".c-media").children(".c-media__media").find(".c-media__imageitem").css('opacity', '0');
    jQuery(this).parents(".c-media").children(".c-media__media").find(".c-media__imageitem").parent('.c-media__external').css('height', '0px');
    
    // Switch the specified one ON.
    jQuery(this).parents(".c-media").children(".c-media__media").find(mediaID).css('opacity', '1');
    jQuery(this).parents(".c-media").children(".c-media__media").find(mediaID).parent('.c-media__external').css('height', '100%');

}

//  ┌──────────────────────────────────────┐
//  │ Show / Hide triggers for button and  │
//  │               underlay               │
//  └──────────────────────────────────────┘
jQuery('.c-media__link').on('click', triggerCmedia)
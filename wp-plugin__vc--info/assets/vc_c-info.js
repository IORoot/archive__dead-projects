// ┌─────────────────────────────────────┐ 
// │                                     │░
// │   Behaviour of the Component-info   │░
// │                                     │░
// │       Requires jQuery to run.       │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


//  ┌──────────────────────────────────────┐
//  │Trigger the C-info switch to the back │
//  │                info.                 │
//  └──────────────────────────────────────┘
function triggerCinfo(){ 

    //  ┌──────────────────────────────────────┐
    //  │       Toggle 'display:none' to       │
    //  │            'display:grid'            │
    //  │         on front / back panels       │
    //  └──────────────────────────────────────┘
    jQuery(this).parents( ".c-info__panel" ).toggle();
    jQuery(this).parents( ".c-info__panel" ).siblings('.c-info__panel').toggle();

    //  ┌──────────────────────────────────────┐
    //  │Toggle class on 'back' info so we can │
    //  │     give it a background-colour.     │
    //  └──────────────────────────────────────┘
    jQuery(this).parents(".c-info").toggleClass('c-info--toggled');

    //  ┌──────────────────────────────────────┐
    //  │  Trigger the underlay to darken the  │
    //  │          rest of the page.           │
    //  └──────────────────────────────────────┘
    jQuery(this).parents(".c-info").siblings('.c-info__underlay').toggleClass('c-info__underlay--on');
}

//  ┌──────────────────────────────────────┐
//  │                                      │
//  │  Change the $this context from the   │
//  │underlay to the button in the c-info. │
//  │ We need to do this otherwise all of  │
//  │the .parent / .sibling functions will │
//  │ be wrong since the underlay is at a  │
//  │  different DOM level to the button.  │
//  │                                      │
//  └──────────────────────────────────────┘
function triggerCinfoFromUnderlay(){ 

    //  ┌──────────────────────────────────────┐
    //  │  Change the context to the back      │
    //  │            panel button              │
    //  └──────────────────────────────────────┘
    var changeContextToButton = jQuery(this).siblings(".c-info--toggled").find(".c-info__panel--back").find(".c-info__button");

    //  ┌──────────────────────────────────────┐
    //  │ Use the 'call()' method to pass the  │
    //  │  different context to the function.  │
    //  └──────────────────────────────────────┘
    triggerCinfo.call(changeContextToButton);
}


//  ┌──────────────────────────────────────┐
//  │ Show / Hide triggers for button and  │
//  │               underlay               │
//  └──────────────────────────────────────┘
jQuery('.c-info__button').on('click', triggerCinfo)
jQuery('.c-info__underlay').on('click', triggerCinfoFromUnderlay)
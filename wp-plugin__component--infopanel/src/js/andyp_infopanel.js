// ┌─────────────────────────────────────┐ 
// │                                     │░
// │   Behaviour of the Component-info   │░
// │                                     │░
// └─────────────────────────────────────┘░
//  ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

var vanillatriggerInfoPanel = function(el){ 

    // This function will get all siblings in an array
    // Reason we need this is because nextSibling / previousSibling
    // won't work when switching between panels.
    // when on the front panel, the function needs to be nextSibling
    // to get the back.
    // When on the back panel, the function needs to be previousSibling
    // to get the front.
    // Using this method allows us to bypass this and just get all 
    // siblings, regardless of being infront or behind.
    var getSiblings = function (elem) {

        // Setup siblings array and get the first sibling
        var siblings = [];
        var sibling = elem.parentNode.firstChild;
    
        // Loop through each sibling and push to the array
        while (sibling) {
            if (sibling.nodeType === 1 && sibling !== elem) {
                siblings.push(sibling);
            }
            sibling = sibling.nextSibling
        }
    
        return siblings;
    
    };

    //  ┌──────────────────────────────────────┐
    //  │       Toggle 'display:none' to       │
    //  │            'display:grid'            │
    //  │         on front / back panels       │
    //  └──────────────────────────────────────┘
    var current_panel = el.parentElement.parentElement;
    current_panel.classList.toggle('toggle--off');
    
    var sibling_panel = getSiblings(current_panel);
    sibling_panel[0].classList.toggle('toggle--off');

    //  ┌──────────────────────────────────────┐
    //  │Toggle class on 'back' info so we can │
    //  │     give it a background-colour.     │
    //  └──────────────────────────────────────┘
    var infopanel = current_panel.parentNode;
    infopanel.classList.toggle('infopanel--toggled');

    //  ┌──────────────────────────────────────┐
    //  │  Trigger the underlay to darken the  │
    //  │          rest of the page.           │
    //  └──────────────────────────────────────┘
    var underlay = infopanel.nextSibling;
    underlay.classList.toggle('infopanel__underlay--on');
};


// Vanilla add onclick to all buttons
[].forEach.call(document.querySelectorAll('.infopanel__button'), function(el) {
    el.addEventListener('click', function() {
        vanillatriggerInfoPanel(el)
    })
});

// Vanilla add onclick to all underlays
[].forEach.call(document.querySelectorAll('.infopanel__underlay'), function(el) {
    el.addEventListener('click', function() {
        var panel = el.previousSibling;
        var backpanel = panel.querySelectorAll('.infopanel__panel--back'); // querySelectorAll returns an array.
        var backbutton = backpanel[0].querySelectorAll('.infopanel__button');
        vanillatriggerInfoPanel(backbutton[0])
    })
});
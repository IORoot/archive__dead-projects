//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │                                      │░
//  │           Fade-in (x & y)            │░
//  │                                      │░
//  │   Opacity and directional fadein.    │░
//  │                                      │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

anime__fadeinX('.heropanel__fly .heropanel__button',2200, -50);


function anime__fadeinX(target, delay = 0, translateAmount = 50) {

    anime({
        targets: target,
        translateX: translateAmount,
        opacity: 0,
        duration: 300,
        endDelay: delay,
        direction: 'reverse',
        easing: 'easeOutQuint',
    });
}

function anime__fadeinY(target, delaythis, translateAmount = 50) {

    anime({
        targets: target,
        translateY: [translateAmount, 0],
        opacity: [0, 1],
        duration: 300,
        delay: delaythis,
        easing: 'easeOutQuint',
    });
}
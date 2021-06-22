//  ┌───────────────────────────────────────────┐ 
//  │                                           │░
//  │                                           │░
//  │              Animate Stacks               │░
//  │                HOMEPAGE                   │░
//  │                                           │░
//  └───────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░


anime__poppins('.animated-stack');

/**
 * 
 * This will scroll left -> right, on each item will punch in / out.
 * Used on londonparkour homepage for parkourpulse block
 */
function anime__poppins(target) {

    var stackItemTimeline = anime.timeline({
        duration: 4000,
        easing: 'easeOutElastic(1, .8)',
        loop: true,
        delay: 1000,
    });

    var zoomInOut = [
        { scaleX: 1.1, scaleY: 1.1 },
        { scaleX: 1, scaleY: 1 },
    ];

    stackItemTimeline
        .add({
            targets: target + ' .one',
            keyframes: zoomInOut,
        })
        .add({
            targets: target + ' .two',
            keyframes: zoomInOut,
        })
        .add({
            targets: target + ' .three',
            keyframes: zoomInOut,
        })
        .add({
            targets: target + ' .four',
            keyframes: zoomInOut,
        })
        .add({
            targets: target + ' .zero',
            keyframes: zoomInOut,
        });


    anime({
        targets: target,
        easing: 'easeInOutSine',

        loop: true,

        keyframes: [
            { translateX: 'calc(40px - (20% - 20px))' },
            { translateX: 'calc(40px - (40% - 20px))', delay: 4000 },
            { translateX: 'calc(40px - (60% - 20px))', delay: 4000 },
            { translateX: 'calc(40px - (80% - 20px))', delay: 4000 },
            { translateX: 'calc(40px - (0% - 20px))', delay: 4000 },
            { translateX: '40px', delay: 5000 },
        ],

        duration: 4000,
    });

}
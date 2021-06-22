//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │           Punchin - image            │░
//  │                                      │░
//  │  Will appear from the top/ bottom/   │░
//  │ sides, scaled down. Will then punch  │░
//  │     up and grow into full frame.     │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// e.g.
anime__punchin('.heropanel__fly .heropanel__overlay', 50, 'L');
anime__punchin('.heropanel__fly .heropanel__xxl', 150, 'L');
anime__punchin('.heropanel__fly .heropanel__eyebrow', 200, 'L');
anime__punchin('.heropanel__fly',0,'L');
anime__punchin('.heropanel__pt', 300, 'R');
anime__punchin('.heropanel__pulse',600, 'B');



function anime__punchin(imgtarget, delaythis = 0, fromDirection = 'L') {

    if (fromDirection == 'L') {
        var translateit = [
            { opactity: 0, delay: 0, duration: 0 },
            { translateX: -2000, opacity: [0, 0.8], scale: 0.8, delay: delaythis, duration: 1000 },
            { translateX: 0, opacity: 0.8, scale: 0.8, delay: 300, duration: 300 },
            { translateX: 0, opacity: 1, scale: 1, delay: 300, duration: 1000 },
        ]
    }
    if (fromDirection == 'R') {
        var translateit = [
            { opactity: 0, delay: 0, duration: 0 },
            { translateX: 2000, opacity: [0, 0.8], scale: 0.8, delay: delaythis, duration: 1000 },
            { translateX: 0, opacity: 0.8, scale: 0.8, delay: 300, duration: 300 },
            { translateX: 0, opacity: 1, scale: 1, delay: 300, duration: 1000 },
        ]
    }
    if (fromDirection == 'T') {
        var translateit = [
            { opactity: 0, delay: 0, duration: 0 },
            { translateY: -2000, opacity: [0, 0.8], scale: 0.8, delay: delaythis, duration: 1000 },
            { translateY: 0, opacity: 0.8, scale: 0.8, delay: 300, duration: 300 },
            { translateY: 0, opacity: 1, scale: 1, delay: 300, duration: 1000 },
        ]
    }
    if (fromDirection == 'B') {
        var translateit = [
            { opactity: 0, delay: 0, duration: 0 },
            { translateY: 2000, opacity: [0, 0.8], scale: 0.8, delay: delaythis, duration: 1000 },
            { translateY: 0, opacity: 0.8, scale: 0.8, delay: 300, duration: 300 },
            { translateY: 0, opacity: 1, scale: 1, delay: 300, duration: 1000 },
        ]
    }

    anime({
        targets: imgtarget,
        keyframes: translateit,
        easing: 'easeOutQuint',
    });
}
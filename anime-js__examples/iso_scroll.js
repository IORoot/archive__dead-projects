//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │           Isometric Scroll           │░
//  │                                      │░
//  │ Use for 'the pulse' image to make it │░
//  │     isometric and scroll it in.      │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// function anime__isometricScroll(target, delay = 0) {

//     var imgtarget = target;
//     var imgheight = anime.get(document.querySelector(imgtarget), 'height');

//     anime({
//         targets: imgtarget,
//         keyframes: [
//             {rotateX: 60, rotateY: 0, rotateZ: -45, duration: 0, height: 0},
//             {height: imgheight, duration: 1000 },
//         ],
//         delay: delay,
//         easing: 'easeOutQuint'
//     });
// }

anime__isometricScroll('.heropanel__pulse > .heropanel__overlay');

function anime__isometricScroll(target) {

    var imgtarget = target;
    var imgheight = anime.get(document.querySelector(imgtarget), 'height');

    var tl = anime.timeline({
        targets: target,
        easing: 'easeOutExpo',
        delay: function (el, i) { return i * 300 },
        duration: 1500,

        complete: function (anim) {
            anime({
                targets: target,
                loop: true,
                scale: [1.2, 1.1],
                direction: 'alternate',
            })
        }

    });

    tl
        .add({
            backgroundPosition: '50% -70%',
        })
        .add({
            backgroundPosition: '0% 0%',
            delay: 3000, opacity: 0.8, rotateX: 60, rotateY: 0, rotateZ: -45, translateX: 100, translateY: 50, translateZ: 0, height: imgheight,
        })
        .add({
            opacity: 1, scale: 3, translateX: 500, translateY: 500, translateZ: 0,
        })
        .add({
            translateY: -250,
        })
        .add({
            translateX: 50,
        })
        .add({
            opacity: 1, scale: 1.1, translateX: 50, translateY: 300, translateZ: 50,
        });
}
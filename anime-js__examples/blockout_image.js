//  ┌───────────────────────────────────────────┐ 
//  │                                           │░
//  │ Blockout - Image                          │░
//  │                                           │░
//  │ Redacted-type image that appears behind   │░
//  │ coloured block rectangle.                 │░
//  │                                           │░
//  │ CSS Class Requirement:                    │░
//  │ <img class="anime__blockoutImg ">         │░
//  │ This class is needed to work correctly.   │░
//  │                                           │░
//  │ Override border colours to change the     │░
//  │ block colour.                             │░
//  │                                           │░
//  │                                           │░
//  └───────────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

function anime__blockoutImg(imgtarget, delay) {

    // Give the target the relevant CSS class for this effect
    document.querySelector(imgtarget).classList.add('anime__blockoutimg');

    var imgheight = document.querySelector(imgtarget);

    anime({
        targets: imgtarget,
        keyframes: [
            { delay: delay, opacity: 0, duration: 0 },
            // Hide image and create Blockout
            {
                duration: 0, opacity: 1,
                clipPath: 'inset(0px 0px ' + anime.get(imgheight, 'height') + ' 0px)',
                "-webkit-clipPath": 'inset(0px 0px ' + anime.get(imgheight, 'height') + ' 0px)'
            },
            { duration: 1000, borderTopWidth: 0, height: anime.get(imgheight, 'height') },
            {
                duration: 1000,
                borderTopWidth: anime.get(imgheight, 'height'),
                clipPath: 'inset(0px 0px 0px 0px)',
                "-webkit-clipPath": 'inset(0px 0px 0px 0px)'
            },
            // switch to bottom border
            { duration: 0, borderTopWidth: 0, borderBottomWidth: anime.get(imgheight, 'height') },
            // return to normal
            { duration: 1000, borderTopWidth: 0, borderBottomWidth: 0, height: anime.get(imgheight, 'height') },
        ],
        easing: 'easeOutQuint',
    });
}
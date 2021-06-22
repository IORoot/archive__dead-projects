//  ┌──────────────────────────────────────┐ 
//  │                                      │░
//  │            Blockout Text             │░
//  │                                      │░
//  │    Redacted-effect on text layer.    │░
//  │                                      │░
//  └──────────────────────────────────────┘░
//   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

// NOTE - All accompanying CSS is created in /wp-content/themes/londonparkour_v4/sass/anime_js/_blockoutTxt.scss
anime__blockoutText('.heropanel__pt .heropanel__content h4');
anime__blockoutText('.heropanel__pt .heropanel__content p', 500);

function anime__blockoutText(target, delay = 0) {

    // Give the target the relevant CSS class for this effect
    document.querySelector(target).classList.add('anime__blockouttxt');

    var txttarget = document.querySelector(target)
    var txtwidth = anime.get(txttarget, 'width');

    anime({
        targets: txttarget,
        keyframes: [
            // Hidden
            {
                width: txtwidth,
                duration: 0,
                clipPath: 'inset(0px ' + txtwidth + ' 0px 0px)',
                "-webkit-clipPath": 'inset(0px ' + txtwidth + ' 0px 0px)'
            },
            // line appears
            {
                delay: 1500,
                duration: 500,
                borderLeftWidth: txtwidth,
                clipPath: 'inset(0px 0px 0px 0px)',
                "-webkit-clipPath": 'inset(0px 0px 0px 0px)'
            },
            // switch to right border
            { duration: 0, borderLeftWidth: 0, borderRightWidth: txtwidth },
            // reveal image
            { duration: 500, borderLeftWidth: 0, borderRightWidth: 0 },
        ],
        delay: delay,
        easing: 'easeOutQuint',
    });
}
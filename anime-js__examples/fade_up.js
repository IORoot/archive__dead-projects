
// Main hero on homepage.

function parkourpulse() {

    var tl_h = anime.timeline({
        easing: 'easeInOutQuint',
        duration: 1000
    });

    tl_h.add({
        targets: '.hero-svg .image',
        translateY: [100, 0],
        opacity: [0, 1],
    });

    tl_h.add({
        targets: '.hero-svg svg',
        scale: [0, 1],
        opacity: [0, 1],
    }, '-=500');


}

window.addEventListener("load", parkourpulse);
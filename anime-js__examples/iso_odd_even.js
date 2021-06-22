// converge odd / even columns together.

function parkourpulse() {

    var tl = anime.timeline({
        easing: 'easeInOutQuint',
        duration: 1000,
    });

    tl.add({
        targets: '.parkourpulse .even',
        translateX: [-500, 0],
        delay: anime.stagger(200)
    })

    tl.add({
        targets: '.parkourpulse .odd',
        translateX: [400, 0],
        delay: anime.stagger(200)
    }, '-=1000')


}

window.addEventListener("load", parkourpulse);
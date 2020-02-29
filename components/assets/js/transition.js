// dummy example to illustrate rules and hooks
barba.init({
    debug: true,

    transitions: [{
        // do leave and enter concurrently
        sync: false,

        // available hooks…
        beforeOnce() {
            console.log('before Once')
        },
        once() {
            console.log('before Once')
        },
        afterOnce() {
            console.log('after Once')
        },
        beforeLeave() {
            console.log('after Once')
        },
        leave(data) {
            console.log(data.current)
            // return $('main').fadeOut().promise()
            return $(data.current.container).animate({opacity: 0}).promise()
        },
        afterLeave() {
            console.log('after leave')
        },
        beforeEnter({ next }) {
            next.container.style.opacity = -1
            console.log('before Enter')
        },
        enter({ next }) {
            console.log('enter',next.container)
            return $(next.container).animate({opacity: 0.9}).promise()
        },
        afterEnter() {
            console.log('after Enter')
        }
    }]
});

barba.hooks.before(() => {
    var height = $("[data-barba='container']").height()
    $("[data-barba='wrapper']").css({
        'min-height': height
    })
    barba.wrapper.classList.add('is-animating');
})

barba.hooks.after(() => {
    barba.wrapper.classList.remove('is-animating');
    var height = $("[data-barba='container']").height()
    $("[data-barba='wrapper']").css({
        'min-height': height
    })
})
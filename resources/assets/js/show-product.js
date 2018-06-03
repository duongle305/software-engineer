$.fn.andSelf = function() {
    return this.addBack.apply(this, arguments);
}

if($('.full-width').length) {
    $('.full-width').owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        nav: true,
        autoplay: true,
        autoplayTimeout:5500,
        navText: ["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]
    });
}
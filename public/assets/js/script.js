$(document).ready(function(){
    var bannerHeight = $(window).height();

    $('.banner .item').height(bannerHeight);


    $('.owl-carousel').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            1000:{
                items:1
            }
        }
    })
})


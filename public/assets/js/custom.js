$(document).ready(function(){
  /*main slider top*/
  $('.carharu-carousel').slick({
    centerMode: true,
      centerPadding: '10px',
      slidesToShow: 3,
      autoplay: true,
      autoplaySpeed: 10000,
      prevArrow: '<div class="prev"><i class="fas fa-chevron-left"></i></div>',
      nextArrow: '<div class="next"><i class="fas fa-chevron-right"></i></div>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
  });

    $('.carharu-carousel-cars').slick({
        centerMode: true,
        centerPadding: '10px',
        slidesToShow: 2,
        autoplay: true,
        autoplaySpeed: 10000,
        prevArrow: '<div class="prev"><i class="fas fa-chevron-left"></i></div>',
        nextArrow: '<div class="next"><i class="fas fa-chevron-right"></i></div>',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '10px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '10px',
                    slidesToShow: 1
                }
            }
        ]
    });
});



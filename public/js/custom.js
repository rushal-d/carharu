$(document).ready(function(){
  /*main slider top*/
  $('.your-class').slick({
      centerMode: false,
      infinite: false,
      centerPadding: '10px',
      slidesToShow: 5,
      autoplay: true,
      prevArrow: '<div class="prev"><i class="fas fa-chevron-left"></i></div>',
      nextArrow: '<div class="next"><i class="fas fa-chevron-right"></i></div>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 3
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
});



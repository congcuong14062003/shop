$(document).ready(function () {
    $('.slideshow').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: false,
        infinite: true,
    });

    $('.next').click(function () {
        $('.slideshow').slick('slickNext');
    });

    $('.prev').click(function () {
        $('.slideshow').slick('slickPrev');
    });
});

$(document).ready(function () {
  $('.carousel').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      dots: false,
      arrows: false,
      infinite: true,
  });

  $('.next.next-items').click(function () {
      $('.carousel').slick('slickNext');
  });

  $('.prev.prev-items').click(function () {
      $('.carousel').slick('slickPrev');
  });
});





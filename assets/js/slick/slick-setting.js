$(document).ready(function() {	
$('.single-item').slick({
	autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    infinite: false,
    speed: 1000,
    fade: true,
    cssEase: 'linear'
});   
});  
	
$(document).ready(function() {
$('.one-time').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true
});
});

$(document).ready(function() {
$('.multiple-items').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3
});
});

$(document).ready(function() {
$('.variable-width').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true
});
});

$(document).ready(function() {
$('.fade').slick({
  dots: true,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear'
});
});

$('.autoplay').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
});

$(document).ready(function() {
$('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 5,

   arrows: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
});
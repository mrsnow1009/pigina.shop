var _screen_width = window.innerWidth;

$(document).ready(function () {

});

/******************************
  MINI CART
******************************/
$(document).ready(function () {
	$('.show-cart-click').click(function (){
		$('#cart-drawer').toggleClass('show');
	});
});

/******************************
  TESTIMONIAL
******************************/
var swiper = new Swiper(".webTestimonial", {
	slidesPerView: 1,
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
        1024: {
          	slidesPerView: 2,
          	spaceBetween: 50,
        },
    }
});


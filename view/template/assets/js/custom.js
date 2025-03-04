var _screen_width = window.innerWidth;
/* start - validate form */
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})();
/* end - validate form */

$(document).ready(function () {

});

/******************************
  MINI CART
******************************/
$(document).ready(function () {
	$('.show-cart-click').click(function (){
		$('#cart-drawer').toggleClass('show');
	});

	/* start - button quanlity - minus and plus */
	var _quanlity = $('#quantity-input').val();
	if (_quanlity === undefined) {
		_quanlity = 1;
	}else{
		_quanlity = parseInt(_quanlity);
	};
	$(document).on('click','#quantity-minus', function (){
		if (_quanlity > 1) _quanlity -= 1;
		$('#quantity-input').val(_quanlity);
	});
	$(document).on('click','#quantity-plus', function (){
		_quanlity += 1;
		$('#quantity-input').val(_quanlity);
	});
	$(document).on('keyup','#quantity-input', function (){
		_quanlityIsNaN = parseInt($(this).val());
		if (isNaN(_quanlityIsNaN) !== true) _quanlity = _quanlityIsNaN;
		else $(this).val(_quanlity);
	});
	/* end - button quanlity - minus and plus */
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


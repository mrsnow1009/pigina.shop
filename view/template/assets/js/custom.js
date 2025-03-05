var _screen_width = window.innerWidth;

$(document).ready(function () {

});

/******************************
  VALIDATE FORM
******************************/
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

/******************************
  MINI CART
******************************/
$(document).ready(function () {
	$('.show-cart-click').click(function (){
		$('#cart-drawer').toggleClass('show');
	});
});

/******************************
  PRODUCT DETAIL - button quanlity - minus and plus
******************************/
$(document).ready(function () {
	var _quantity = $('#quantity-input').val();
	if (_quantity === undefined) {
		_quantity = 1;
	}else{
		_quantity = parseInt(_quantity);
	};
	$(document).on('click','#quantity-minus', function (){
		if (_quantity > 1) _quantity -= 1;
		$('#quantity-input').val(_quantity);
	});
	$(document).on('click','#quantity-plus', function (){
		_quantity += 1;
		$('#quantity-input').val(_quantity);
	});
	$(document).on('keyup','#quantity-input', function (){
		_quantityIsNaN = parseInt($(this).val());
		if (isNaN(_quantityIsNaN) !== true) _quantity = _quantityIsNaN;
		else $(this).val(_quantity);
	});
});

/******************************
  CART - button quanlity - minus and plus
******************************/
function increaseQuantityProduct(idProduct){
	var _quantity = parseInt($('#quantity-input-' + idProduct).val());
	$('#quantity-input-' + idProduct).val(_quantity + 1);
}
function decreaseQuantityProduct(idProduct){
	var _quantity = parseInt($('#quantity-input-' + idProduct).val());
	if(_quantity > 1){
		$('#quantity-input-' + idProduct).val(_quantity - 1);
	}
}
function enterQuantityProduct(idProduct){
	_quantityIsNaN = parseInt($('#quantity-input-' + idProduct).val());
	if (isNaN(_quantityIsNaN) !== true) $('#quantity-input-' + idProduct).val(_quantityIsNaN);
	else $('#quantity-input-' + idProduct).val(1);
}

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


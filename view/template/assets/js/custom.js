const myCarousel_banner = document.getElementById('carousel-banner');
if (myCarousel_banner != null) {
  // const myCarousel_banner_text = document.getElementById('carousel-banner-text');
  myCarousel_banner.addEventListener('slide.bs.carousel', event => {
    // $('.text-trig').removeClass('active');
    // $('.text-trig[data-slide="'+event.to+'"]').addClass('active');
    $('#carousel-banner-text').carousel(event.to);
  });
};
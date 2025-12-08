/**
 * File theme.js.
 *
 * Handles theme-specific JavaScript.
 */

( function() {
    // Testimonial Carousel
    if ( document.querySelector('.testimonial-slider') ) {
        var testimonialSlider = new Swiper('.testimonial-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
            },
        });
    }

    // Animate on Scroll
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
    });
} )();

/**
 * File theme.js.
 *
 * Handles theme-specific JavaScript.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Testimonial Carousel
    if ( document.querySelector('.testimonial-slider') ) {
        new Swiper('.testimonial-slider', {
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
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
        });
    }

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item h3');
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentElement;
            parent.classList.toggle('active');
        });
    });

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const siteNavigation = document.getElementById('site-navigation');
    if (menuToggle && siteNavigation) {
        menuToggle.addEventListener('click', () => {
            siteNavigation.classList.toggle('toggled');
            const isExpanded = siteNavigation.classList.contains('toggled');
            menuToggle.setAttribute('aria-expanded', isExpanded);
        });
    }
});

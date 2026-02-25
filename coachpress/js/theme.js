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
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                }
            },
        });
    }

    // Animate on Scroll (AOS)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 120,
        });
    }

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item h3');
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentElement;
            const wasActive = parent.classList.contains('active');

            // Close other items
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));

            if (!wasActive) {
                parent.classList.add('active');
            }
        });
    });

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            document.body.classList.toggle('mobile-menu-open');
            menuToggle.classList.toggle('toggled');
            const isExpanded = document.body.classList.contains('mobile-menu-open');
            menuToggle.setAttribute('aria-expanded', isExpanded);
        });
    }

    // Smooth Scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (document.body.classList.contains('mobile-menu-open')) {
                    document.body.classList.remove('mobile-menu-open');
                    menuToggle.classList.remove('toggled');
                }
            }
        });
    });
});

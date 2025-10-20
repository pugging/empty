/**
 * Main JavaScript functionality for Portfolio Pro theme
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Scroll animations
        function animateOnScroll() {
            const elements = $('.animate-on-scroll');

            elements.each(function() {
                const elementTop = $(this).offset().top;
                const elementBottom = elementTop + $(this).outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animated');
                }
            });
        }

        // Run on page load
        animateOnScroll();

        // Run on scroll
        $(window).on('scroll', function() {
            animateOnScroll();
        });

        // Portfolio filter functionality (if needed in the future)
        $('.portfolio-filter').on('click', 'button', function() {
            const filterValue = $(this).attr('data-filter');

            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            if (filterValue === '*') {
                $('.portfolio-item').fadeIn(300);
            } else {
                $('.portfolio-item').hide();
                $(filterValue).fadeIn(300);
            }
        });

        // Contact form handling
        $('.contact-form').on('submit', function(e) {
            const form = $(this);
            const submitButton = form.find('button[type="submit"]');
            const originalText = submitButton.text();

            // Disable button and show loading state
            submitButton.prop('disabled', true).text('Sending...');

            // Form will submit normally to admin-post.php
            // You could add additional client-side validation here if needed
        });

        // Smooth reveal for hero content
        $('.hero-content > *').each(function(i) {
            $(this).css('animation-delay', (i * 0.2) + 's');
        });

        // Parallax effect for hero section
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();
            $('.hero-section').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
        });

        // Add loading animation to images
        $('img').on('load', function() {
            $(this).addClass('loaded');
        });

        // Lazy loading for images (basic implementation)
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');
                        if (src) {
                            img.setAttribute('src', src);
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        // Portfolio item hover effects
        $('.portfolio-item').on('mouseenter', function() {
            $(this).find('.portfolio-image').css('transform', 'scale(1.1)');
        }).on('mouseleave', function() {
            $(this).find('.portfolio-image').css('transform', 'scale(1)');
        });

        // Add ripple effect to buttons
        $('.btn').on('click', function(e) {
            const button = $(this);
            const ripple = $('<span class="ripple"></span>');

            const diameter = Math.max(button.outerWidth(), button.outerHeight());
            const radius = diameter / 2;

            ripple.css({
                width: diameter,
                height: diameter,
                left: e.pageX - button.offset().left - radius,
                top: e.pageY - button.offset().top - radius
            });

            button.append(ripple);

            setTimeout(function() {
                ripple.remove();
            }, 600);
        });

        // Back to top button
        const backToTop = $('<button class="back-to-top" aria-label="Back to top"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg></button>');
        $('body').append(backToTop);

        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                backToTop.addClass('visible');
            } else {
                backToTop.removeClass('visible');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });

        // Form validation
        $('input, textarea').on('blur', function() {
            const field = $(this);
            if (field.prop('required') && field.val() === '') {
                field.addClass('error');
            } else {
                field.removeClass('error');
            }
        });

        // Add CSS for back to top button dynamically
        const style = $('<style>.back-to-top{position:fixed;bottom:2rem;right:2rem;width:50px;height:50px;background:var(--gradient-primary);border:none;border-radius:50%;color:white;cursor:pointer;opacity:0;visibility:hidden;transition:all 0.3s;z-index:999;box-shadow:var(--shadow-lg)}.back-to-top.visible{opacity:1;visibility:visible}.back-to-top:hover{transform:translateY(-5px);box-shadow:var(--shadow-xl)}.ripple{position:absolute;border-radius:50%;background:rgba(255,255,255,0.6);transform:scale(0);animation:ripple-animation 0.6s ease-out}@keyframes ripple-animation{to{transform:scale(4);opacity:0}}</style>');
        $('head').append(style);

        // Console message for developers
        console.log('%c Portfolio Pro Theme ', 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px 20px; font-size: 16px; font-weight: bold;');
        console.log('Made with ❤️ by Portfolio Pro Team');

    });

    // Window load events
    $(window).on('load', function() {
        // Remove any loading classes
        $('body').addClass('loaded');

        // Trigger scroll animations on load
        $(window).trigger('scroll');
    });

})(jQuery);

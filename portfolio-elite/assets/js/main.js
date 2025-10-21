/**
 * Main JavaScript
 * Portfolio Elite Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Portfolio filter
        $('.filter-btn').on('click', function() {
            const filter = $(this).data('filter');

            // Update active state
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Filter portfolio items
            if (filter === '*') {
                $('.portfolio-card').fadeIn(300);
            } else {
                $('.portfolio-card').hide();
                $(filter).fadeIn(300);
            }

            // Re-trigger scroll animations
            $(window).trigger('scroll');
        });

        // Contact form submission
        $('.contact-form').on('submit', function(e) {
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.find('span').text();

            // Disable button and show loading
            submitBtn.prop('disabled', true);
            submitBtn.find('span').text('Sending...');

            // Form will submit normally
        });

        // Lazy load images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');
                        if (src) {
                            img.setAttribute('src', src);
                            img.removeAttribute('data-src');
                            img.classList.add('loaded');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        // Add loading state to images
        $('img').on('load', function() {
            $(this).addClass('loaded');
        });

        // Scroll reveal animations (fallback if GSAP not loaded)
        if (typeof gsap === 'undefined') {
            $(window).on('scroll', function() {
                $('.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-scale').each(function() {
                    const elementTop = $(this).offset().top;
                    const elementBottom = elementTop + $(this).outerHeight();
                    const viewportTop = $(window).scrollTop();
                    const viewportBottom = viewportTop + $(window).height();

                    if (elementBottom > viewportTop && elementTop < viewportBottom) {
                        $(this).addClass('animated');
                    }
                });
            });

            // Trigger on load
            $(window).trigger('scroll');
        }

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

        // Parallax scroll effect
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();

            $('.parallax-bg').each(function() {
                const speed = $(this).data('speed') || 0.5;
                $(this).css('transform', 'translateY(' + (scrolled * speed) + 'px)');
            });

            $('.parallax-element').each(function() {
                const speed = $(this).data('speed') || 0.3;
                $(this).css('transform', 'translateY(' + (scrolled * speed) + 'px)');
            });
        });

        // Console branding
        console.log('%c Portfolio Elite Theme ', 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px 20px; font-size: 16px; font-weight: bold;');
        console.log('%c Made with ❤️ by Portfolio Elite Team ', 'color: #667eea; font-size: 12px;');

    });

    // Window load events
    $(window).on('load', function() {
        $('body').addClass('loaded');
    });

})(jQuery);

// CSS for ripple effect
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s ease-out;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

.animate-fade-in,
.animate-slide-left,
.animate-slide-right,
.animate-scale {
    opacity: 0;
    transition: all 0.8s ease-out;
}

.animate-fade-in.animated {
    opacity: 1;
}

.animate-slide-left {
    transform: translateX(-50px);
}

.animate-slide-left.animated {
    opacity: 1;
    transform: translateX(0);
}

.animate-slide-right {
    transform: translateX(50px);
}

.animate-slide-right.animated {
    opacity: 1;
    transform: translateX(0);
}

.animate-scale {
    transform: scale(0.8);
}

.animate-scale.animated {
    opacity: 1;
    transform: scale(1);
}

img {
    opacity: 0;
    transition: opacity 0.3s ease;
}

img.loaded {
    opacity: 1;
}
`;
document.head.appendChild(rippleStyle);

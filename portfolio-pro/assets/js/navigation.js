/**
 * Navigation functionality for Portfolio Pro theme
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Mobile menu toggle
        const menuToggle = $('.menu-toggle');
        const mainNavigation = $('.main-navigation');
        const body = $('body');

        menuToggle.on('click', function() {
            const expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !expanded);
            mainNavigation.toggleClass('active');
            body.toggleClass('menu-open');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.site-header').length) {
                if (mainNavigation.hasClass('active')) {
                    mainNavigation.removeClass('active');
                    menuToggle.attr('aria-expanded', 'false');
                    body.removeClass('menu-open');
                }
            }
        });

        // Close mobile menu on window resize
        $(window).on('resize', function() {
            if ($(window).width() > 768) {
                mainNavigation.removeClass('active');
                menuToggle.attr('aria-expanded', 'false');
                body.removeClass('menu-open');
            }
        });

        // Smooth scrolling for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function(e) {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                if (target.length) {
                    e.preventDefault();

                    // Close mobile menu if open
                    if (mainNavigation.hasClass('active')) {
                        mainNavigation.removeClass('active');
                        menuToggle.attr('aria-expanded', 'false');
                        body.removeClass('menu-open');
                    }

                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800, 'swing');
                }
            }
        });

        // Header scroll effect
        const header = $('.site-header');
        let lastScroll = 0;

        $(window).on('scroll', function() {
            const currentScroll = $(this).scrollTop();

            // Add/remove scrolled class
            if (currentScroll > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }

            // Hide/show header on scroll
            if (currentScroll > lastScroll && currentScroll > 200) {
                // Scrolling down
                header.css('transform', 'translateY(-100%)');
            } else {
                // Scrolling up
                header.css('transform', 'translateY(0)');
            }

            lastScroll = currentScroll;
        });

        // Active menu item highlighting
        const sections = $('section[id]');
        const navLinks = $('.main-navigation a[href*="#"]');

        $(window).on('scroll', function() {
            let current = '';
            const scrollPos = $(window).scrollTop() + 150;

            sections.each(function() {
                const sectionTop = $(this).offset().top;
                const sectionHeight = $(this).outerHeight();

                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    current = $(this).attr('id');
                }
            });

            navLinks.each(function() {
                $(this).removeClass('active');
                const href = $(this).attr('href');
                if (href && href.includes('#' + current)) {
                    $(this).addClass('active');
                }
            });
        });

        // Keyboard navigation
        mainNavigation.find('a').on('keydown', function(e) {
            // Tab navigation
            if (e.keyCode === 9) {
                const focusableElements = mainNavigation.find('a:visible');
                const firstElement = focusableElements.first();
                const lastElement = focusableElements.last();

                if (e.shiftKey) {
                    // Shift + Tab
                    if ($(this).is(firstElement)) {
                        e.preventDefault();
                        lastElement.focus();
                    }
                } else {
                    // Tab
                    if ($(this).is(lastElement)) {
                        e.preventDefault();
                        firstElement.focus();
                    }
                }
            }

            // Escape key to close mobile menu
            if (e.keyCode === 27 && mainNavigation.hasClass('active')) {
                mainNavigation.removeClass('active');
                menuToggle.attr('aria-expanded', 'false').focus();
                body.removeClass('menu-open');
            }
        });
    });

})(jQuery);

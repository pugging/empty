/**
 * Navigation functionality
 * Portfolio Elite Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Mobile menu toggle
        const menuToggle = $('.menu-toggle');
        const mainNav = $('.main-navigation');
        const body = $('body');

        menuToggle.on('click', function() {
            const expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !expanded);
            $(this).toggleClass('active');
            mainNav.toggleClass('active');
            body.toggleClass('menu-open');
        });

        // Close menu on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length && mainNav.hasClass('active')) {
                mainNav.removeClass('active');
                menuToggle.removeClass('active').attr('aria-expanded', 'false');
                body.removeClass('menu-open');
            }
        });

        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const href = $(this).attr('href');
            if (href === '#') return;

            const target = $(href);
            if (target.length) {
                e.preventDefault();

                // Close mobile menu
                if (mainNav.hasClass('active')) {
                    mainNav.removeClass('active');
                    menuToggle.removeClass('active').attr('aria-expanded', 'false');
                    body.removeClass('menu-open');
                }

                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'swing');
            }
        });

        // Header scroll effect
        const header = $('.site-header');
        let lastScroll = 0;

        $(window).on('scroll', function() {
            const currentScroll = $(this).scrollTop();

            // Add scrolled class
            if (currentScroll > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }

            // Hide header on scroll down, show on scroll up
            if (currentScroll > lastScroll && currentScroll > 200) {
                header.css('transform', 'translateY(-100%)');
            } else {
                header.css('transform', 'translateY(0)');
            }

            lastScroll = currentScroll;
        });

        // Active menu item on scroll
        const sections = $('section[id]');
        const navLinks = $('.main-navigation a[href^="#"]');

        $(window).on('scroll', function() {
            const scrollPos = $(window).scrollTop() + 150;
            let current = '';

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

        // Back to top button
        $('.btn-back-top').on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 800);
        });

        // Theme toggle (light/dark mode)
        $('.theme-toggle').on('click', function() {
            $('body').toggleClass('light-mode');
            $('.sun-icon, .moon-icon').toggle();

            // Save preference
            const isLightMode = $('body').hasClass('light-mode');
            localStorage.setItem('theme', isLightMode ? 'light' : 'dark');
        });

        // Load saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'light') {
            $('body').addClass('light-mode');
            $('.sun-icon').hide();
            $('.moon-icon').show();
        }

    });

})(jQuery);

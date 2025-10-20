/**
 * Theme Customizer enhancements for a better user experience.
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // Site title and description.
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-logo a').text(to);
        });
    });

    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Primary color
    wp.customize('portfolio_pro_primary_color', function(value) {
        value.bind(function(to) {
            $('body').append('<style>:root { --primary-color: ' + to + '; }</style>');
        });
    });

    // Secondary color
    wp.customize('portfolio_pro_secondary_color', function(value) {
        value.bind(function(to) {
            $('body').append('<style>:root { --secondary-color: ' + to + '; }</style>');
        });
    });

    // Hero title
    wp.customize('portfolio_pro_hero_title', function(value) {
        value.bind(function(to) {
            $('.hero-title .gradient-text').text(to);
        });
    });

    // Hero subtitle
    wp.customize('portfolio_pro_hero_subtitle', function(value) {
        value.bind(function(to) {
            $('.hero-subtitle').text(to);
        });
    });

    // Hero description
    wp.customize('portfolio_pro_hero_description', function(value) {
        value.bind(function(to) {
            $('.hero-description').text(to);
        });
    });

})(jQuery);

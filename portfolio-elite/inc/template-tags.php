<?php
/**
 * Custom template tags
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

if ( ! function_exists( 'portfolio_elite_posted_on' ) ) :
    function portfolio_elite_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        printf( '<span class="posted-on">%s</span>', $time_string );
    }
endif;

if ( ! function_exists( 'portfolio_elite_posted_by' ) ) :
    function portfolio_elite_posted_by() {
        printf( '<span class="byline">%s</span>',
            '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
        );
    }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;

<?php
/**
 * Custom template tags for this theme
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

if ( ! function_exists( 'portfolio_pro_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function portfolio_pro_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'portfolio-pro' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'portfolio_pro_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function portfolio_pro_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'portfolio-pro' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if ( ! function_exists( 'portfolio_pro_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function portfolio_pro_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'portfolio-pro' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'portfolio-pro' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'portfolio-pro' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'portfolio-pro' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'portfolio-pro' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'portfolio-pro' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if ( ! function_exists( 'portfolio_pro_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     */
    function portfolio_pro_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>

            <?php
        endif;
    }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Shim for sites older than 5.2.
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;

if ( ! function_exists( 'portfolio_pro_get_portfolio_categories' ) ) :
    /**
     * Get portfolio categories for filtering
     */
    function portfolio_pro_get_portfolio_categories() {
        $terms = get_terms(
            array(
                'taxonomy'   => 'portfolio_category',
                'hide_empty' => true,
            )
        );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            return $terms;
        }

        return array();
    }
endif;

if ( ! function_exists( 'portfolio_pro_social_links' ) ) :
    /**
     * Display social media links
     */
    function portfolio_pro_social_links() {
        $social_networks = array(
            'facebook'  => __( 'Facebook', 'portfolio-pro' ),
            'twitter'   => __( 'Twitter', 'portfolio-pro' ),
            'linkedin'  => __( 'LinkedIn', 'portfolio-pro' ),
            'github'    => __( 'GitHub', 'portfolio-pro' ),
            'instagram' => __( 'Instagram', 'portfolio-pro' ),
            'dribbble'  => __( 'Dribbble', 'portfolio-pro' ),
        );

        foreach ( $social_networks as $network => $label ) {
            $url = get_theme_mod( 'portfolio_pro_' . $network );
            if ( $url ) {
                printf(
                    '<a href="%s" class="social-link" aria-label="%s" target="_blank" rel="noopener noreferrer">%s</a>',
                    esc_url( $url ),
                    esc_attr( $label ),
                    portfolio_pro_get_social_icon( $network )
                );
            }
        }
    }
endif;

if ( ! function_exists( 'portfolio_pro_get_social_icon' ) ) :
    /**
     * Get SVG icon for social network
     */
    function portfolio_pro_get_social_icon( $network ) {
        $icons = array(
            'facebook'  => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
            'twitter'   => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>',
            'linkedin'  => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
            'github'    => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>',
            'instagram' => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>',
            'dribbble'  => '<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.375 0 0 5.375 0 12s5.375 12 12 12 12-5.375 12-12S18.625 0 12 0zm9.75 12c0 1.297-.281 2.531-.781 3.656-.672-1.234-2.016-2.531-4.094-3.594.141-.328.266-.672.391-1.016 2.297.766 4.172 1.453 4.484 1.954zM12 21.75c-1.313 0-2.547-.281-3.672-.766.563-1.828 1.547-4.031 3.094-6.281 1.734.984 3.047 2.344 3.75 3.938-.656.719-1.547 1.359-2.578 1.828-.188.047-.391.078-.594.109V21.75zm8.484-3.422c-.547-1.406-1.734-2.859-3.281-3.984.703-1.031 1.406-2.203 1.969-3.359 1.641.797 2.766 1.875 3.281 2.953-.656 1.734-1.969 3.234-3.969 4.391zm-5.906-7.734c-1.125.438-2.344.703-3.578.703-1.234 0-2.453-.266-3.578-.703-.656 1.594-1.125 3.234-1.359 4.875-.797-.422-1.547-.953-2.203-1.594.422-1.359 1.078-2.625 1.875-3.797C5.625 8.625 6.531 7.5 7.594 6.563c1.359-.844 2.922-1.313 4.594-1.313s3.234.469 4.594 1.313c1.063.938 1.969 2.063 2.625 3.422.797 1.172 1.453 2.438 1.875 3.797-.656.641-1.406 1.172-2.203 1.594-.234-1.641-.703-3.281-1.359-4.875zM8.297 5.297c-.937.703-1.781 1.547-2.484 2.531C4.922 8.891 4.219 10.125 3.75 11.438c-.328-.516-.609-1.063-.844-1.641-.141-.422-.234-.859-.281-1.297.047-.984.281-1.922.703-2.797 1.078-1.5 2.766-2.531 4.719-2.953.094.188.188.375.25.547zM3.75 12c0-.281.016-.563.047-.844.469-1.5 1.234-2.906 2.297-4.078 1.172-1.313 2.734-2.297 4.5-2.797.188-.047.375-.078.563-.109C10.5 3.891 9.891 3.656 9.281 3.469c-1.547.516-2.906 1.5-3.891 2.766-.797 1.047-1.359 2.281-1.594 3.609-.047.391-.047.797-.047 1.156zm13.594-7.453c-.703.328-1.453.578-2.25.75.375-.375.703-.797 1.031-1.234.359-.469.656-.969.906-1.484.094.281.188.563.266.859.047.375.047.75.047 1.109zm-3.094.516c-.781.188-1.594.297-2.422.297s-1.641-.109-2.422-.297c.797-.469 1.688-.75 2.625-.75s1.828.281 2.625.75h-.406zM8.719 2.344c-.375.469-.797.891-1.234 1.266-.797-.172-1.547-.422-2.25-.75 0-.359 0-.719.047-1.078.078-.297.172-.578.281-.859.25.516.531 1.016.891 1.484.094.094.188.188.266.281v.656z"/></svg>',
        );

        return isset( $icons[ $network ] ) ? $icons[ $network ] : '';
    }
endif;

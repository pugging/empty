<?php
/**
 * The footer for Portfolio Elite theme
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */
?>

    </div><!-- #content -->

    <!-- Premium Footer -->
    <footer id="colophon" class="site-footer">
        <!-- Animated Background Gradient -->
        <div class="footer-gradient"></div>

        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
            <div class="footer-widgets animate-fade-in">
                <div class="footer-container">
                    <div class="footer-grid">
                        <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                            <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
                                <div class="footer-column">
                                    <?php dynamic_sidebar( 'footer-' . $i ); ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <div class="footer-container">
                <div class="footer-bottom-content">
                    <div class="footer-info">
                        <p class="copyright">
                            <?php
                            printf(
                                esc_html__( '© %1$s %2$s. All rights reserved.', 'portfolio-elite' ),
                                date_i18n( 'Y' ),
                                get_bloginfo( 'name' )
                            );
                            ?>
                        </p>
                        <p class="powered-by">
                            <?php
                            printf(
                                esc_html__( 'Powered by %s', 'portfolio-elite' ),
                                '<a href="https://wordpress.org" target="_blank" rel="noopener">WordPress</a>'
                            );
                            ?>
                        </p>
                    </div>

                    <div class="footer-social">
                        <a href="#" class="social-link glass" aria-label="Facebook">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link glass" aria-label="Twitter">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link glass" aria-label="LinkedIn">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="social-link glass" aria-label="GitHub">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                            </svg>
                        </a>
                    </div>

                    <div class="back-to-top">
                        <button class="btn-back-top glass" aria-label="<?php esc_attr_e( 'Back to top', 'portfolio-elite' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<style>
.site-footer {
    position: relative;
    background: var(--color-dark-900);
    padding: var(--space-20) 0 var(--space-8);
    margin-top: var(--space-32);
    overflow: hidden;
}

.footer-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gradient-aurora);
}

.footer-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--space-8);
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-12);
}

.footer-column {
    opacity: 0;
    animation: fadeInUp var(--duration-700) ease-out forwards;
}

.footer-column:nth-child(1) { animation-delay: 100ms; }
.footer-column:nth-child(2) { animation-delay: 200ms; }
.footer-column:nth-child(3) { animation-delay: 300ms; }
.footer-column:nth-child(4) { animation-delay: 400ms; }

.footer-bottom {
    margin-top: var(--space-16);
    padding-top: var(--space-8);
    border-top: 1px solid var(--glass-border);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-6);
}

.footer-info {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.copyright,
.powered-by {
    font-size: var(--text-sm);
    color: var(--color-dark-500);
    margin: 0;
}

.powered-by a {
    color: var(--color-primary-400);
    text-decoration: none;
    transition: color var(--transition-base);
}

.powered-by a:hover {
    color: var(--color-primary-300);
}

.footer-social {
    display: flex;
    gap: var(--space-3);
}

.social-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-dark-400);
    border-radius: var(--radius-full);
    transition: all var(--transition-base);
}

.social-link:hover {
    color: white;
    background: var(--gradient-purple);
    border-color: transparent;
    transform: translateY(-3px);
    box-shadow: var(--shadow-glow-purple);
}

.btn-back-top {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-full);
    border: none;
    cursor: pointer;
    transition: all var(--transition-base);
}

.btn-back-top:hover {
    background: var(--gradient-purple);
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: var(--space-8);
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-info {
        order: 2;
    }

    .footer-social {
        order: 1;
        justify-content: center;
    }

    .back-to-top {
        order: 3;
    }
}
</style>

</body>
</html>

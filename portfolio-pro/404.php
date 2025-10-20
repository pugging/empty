<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( '404', 'portfolio-pro' ); ?></h1>
                <p class="error-subtitle"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'portfolio-pro' ); ?></p>
            </header>

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching or return to the homepage?', 'portfolio-pro' ); ?></p>

                <div class="error-404-actions">
                    <?php get_search_form(); ?>

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Back to Homepage', 'portfolio-pro' ); ?>
                    </a>
                </div>

                <?php
                // Show recent portfolio items
                $portfolio_query = new WP_Query( array(
                    'post_type'      => 'portfolio',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ) );

                if ( $portfolio_query->have_posts() ) :
                    ?>
                    <div class="recent-portfolio">
                        <h2><?php esc_html_e( 'Check out my recent work:', 'portfolio-pro' ); ?></h2>
                        <div class="portfolio-grid">
                            <?php
                            while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
                                ?>
                                <article class="portfolio-item">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'portfolio-thumbnail', array( 'class' => 'portfolio-image' ) ); ?>
                                    <?php endif; ?>
                                    <div class="portfolio-overlay">
                                        <h3 class="portfolio-title"><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="portfolio-link" aria-label="<?php the_title_attribute(); ?>"></a>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<style>
.error-404 {
    text-align: center;
    padding: var(--spacing-xl) 0;
}

.error-404 .page-title {
    font-size: clamp(6rem, 15vw, 12rem);
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: var(--spacing-sm);
}

.error-subtitle {
    font-size: clamp(1.5rem, 3vw, 2rem);
    color: var(--text-secondary);
    margin-bottom: var(--spacing-lg);
}

.error-404-actions {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
    align-items: center;
    margin: var(--spacing-lg) 0;
}

.error-404-actions .search-form {
    max-width: 500px;
    width: 100%;
}

.recent-portfolio {
    margin-top: var(--spacing-xl);
}

.recent-portfolio h2 {
    margin-bottom: var(--spacing-lg);
}
</style>

<?php
get_footer();

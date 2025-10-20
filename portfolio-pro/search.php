<?php
/**
 * The template for displaying search results pages
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query. */
                    esc_html__( 'Search Results for: %s', 'portfolio-pro' ),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>

        <?php if ( have_posts() ) : ?>

            <div class="search-results">
                <?php
                while ( have_posts() ) :
                    the_post();

                    $post_type = get_post_type();
                    if ( $post_type === 'portfolio' ) :
                        ?>
                        <article class="search-result portfolio-result">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="result-content">
                                <span class="result-type"><?php esc_html_e( 'Portfolio', 'portfolio-pro' ); ?></span>
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="result-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    <?php else : ?>
                        <article class="search-result post-result">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="result-content">
                                <span class="result-type"><?php echo esc_html( get_post_type() ); ?></span>
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="result-meta">
                                    <span><?php echo get_the_date(); ?></span>
                                </div>
                                <div class="result-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    <?php
                    endif;
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation(
                array(
                    'prev_text' => __( '&larr; Older results', 'portfolio-pro' ),
                    'next_text' => __( 'Newer results &rarr;', 'portfolio-pro' ),
                )
            );

        else :
            ?>
            <div class="no-results">
                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'portfolio-pro' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
.search-results {
    margin-top: var(--spacing-lg);
}

.search-result {
    display: flex;
    gap: var(--spacing-md);
    background: var(--bg-secondary);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.05);
    margin-bottom: var(--spacing-md);
    transition: all var(--transition-base);
}

.search-result:hover {
    border-color: rgba(99, 102, 241, 0.3);
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.result-thumbnail {
    flex-shrink: 0;
}

.result-thumbnail img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: var(--border-radius-md);
}

.result-content {
    flex-grow: 1;
}

.result-type {
    display: inline-block;
    background: rgba(99, 102, 241, 0.2);
    color: var(--primary-light);
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: var(--spacing-sm);
}

.result-title a {
    color: var(--text-primary);
    transition: color var(--transition-base);
}

.result-title a:hover {
    color: var(--primary-light);
}

.result-meta {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: var(--spacing-sm);
}

.result-excerpt {
    color: var(--text-secondary);
}

@media (max-width: 768px) {
    .search-result {
        flex-direction: column;
    }

    .result-thumbnail img {
        width: 100%;
        height: auto;
    }
}
</style>

<?php
get_footer();

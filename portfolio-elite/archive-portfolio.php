<?php
/**
 * Portfolio Archive Template
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <div class="page-header-section parallax-bg">
        <div class="container">
            <div class="page-header-content animate-fade-in">
                <h1 class="page-title gradient-text">
                    <?php
                    if ( is_tax() ) {
                        single_term_title();
                    } else {
                        esc_html_e( 'Portfolio', 'portfolio-elite' );
                    }
                    ?>
                </h1>
                <?php
                if ( is_tax() ) {
                    $term_description = term_description();
                    if ( $term_description ) {
                        echo '<div class="page-description">' . wp_kses_post( $term_description ) . '</div>';
                    }
                } else {
                    ?>
                    <p class="page-description"><?php esc_html_e( 'Explore our creative work and innovative solutions', 'portfolio-elite' ); ?></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Portfolio Grid Section -->
    <section class="portfolio-section">
        <div class="container">

            <!-- Portfolio Filter -->
            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="*"><?php esc_html_e( 'All', 'portfolio-elite' ); ?></button>
                <?php
                $categories = get_terms( array(
                    'taxonomy' => 'portfolio_category',
                    'hide_empty' => true,
                ) );

                if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $active_class = ( is_tax( 'portfolio_category', $category->slug ) ) ? ' active' : '';
                        printf(
                            '<button class="filter-btn%s" data-filter=".%s">%s</button>',
                            esc_attr( $active_class ),
                            esc_attr( $category->slug ),
                            esc_html( $category->name )
                        );
                    }
                }
                ?>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="portfolio-grid">
                    <?php
                    while ( have_posts() ) : the_post();
                        $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
                        $term_classes = '';
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $term_classes = implode( ' ', wp_list_pluck( $terms, 'slug' ) );
                        }
                        ?>
                        <article class="portfolio-card card-3d <?php echo esc_attr( $term_classes ); ?>">
                            <div class="portfolio-card-image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'portfolio-large' ); ?>
                                <?php else : ?>
                                    <div class="placeholder-image" style="background: var(--gradient-purple); height: 400px;"></div>
                                <?php endif; ?>
                            </div>

                            <div class="portfolio-card-content">
                                <?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
                                    <span class="portfolio-category"><?php echo esc_html( $terms[0]->name ); ?></span>
                                <?php endif; ?>

                                <h3 class="portfolio-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <p class="portfolio-card-description"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>

                                <div class="portfolio-card-meta">
                                    <?php
                                    $client = get_post_meta( get_the_ID(), '_portfolio_client', true );
                                    $date = get_post_meta( get_the_ID(), '_portfolio_date', true );

                                    if ( $date ) :
                                        ?>
                                        <div class="portfolio-meta-item">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span><?php echo esc_html( $date ); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $client ) : ?>
                                        <div class="portfolio-meta-item">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span><?php echo esc_html( $client ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php
                                $technologies = get_post_meta( get_the_ID(), '_portfolio_technologies', true );
                                if ( $technologies ) :
                                    ?>
                                    <div class="portfolio-tech-tags">
                                        <?php
                                        $tech_array = array_map( 'trim', explode( ',', $technologies ) );
                                        foreach ( array_slice( $tech_array, 0, 3 ) as $tech ) :
                                            ?>
                                            <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="portfolio-card-actions">
                                <a href="<?php the_permalink(); ?>" class="card-action-btn" aria-label="<?php esc_attr_e( 'View Project Details', 'portfolio-elite' ); ?>">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '← Previous', 'portfolio-elite' ),
                    'next_text' => __( 'Next →', 'portfolio-elite' ),
                ) );

            else :
                ?>
                <div class="portfolio-empty glass">
                    <div class="empty-icon">
                        <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <h2 class="empty-title"><?php esc_html_e( 'No Portfolio Items Found', 'portfolio-elite' ); ?></h2>
                    <p class="empty-text"><?php esc_html_e( 'There are no portfolio items to display at the moment.', 'portfolio-elite' ); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<style>
.page-header-section {
    padding: var(--space-32) 0 var(--space-16);
    text-align: center;
    background: linear-gradient(180deg, rgba(102, 126, 234, 0.05), transparent);
}

.page-header-content {
    max-width: 800px;
    margin: 0 auto;
}

.page-title {
    font-size: clamp(2.5rem, 6vw, 5rem);
    margin-bottom: var(--space-4);
}

.page-description {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: var(--color-dark-400);
}

.portfolio-empty {
    text-align: center;
    padding: var(--space-24);
    border-radius: var(--radius-2xl);
    margin: var(--space-16) auto;
    max-width: 600px;
}

.empty-icon {
    margin-bottom: var(--space-6);
    color: var(--color-dark-700);
}

.empty-title {
    font-size: var(--text-3xl);
    margin-bottom: var(--space-4);
}

.empty-text {
    color: var(--color-dark-500);
    font-size: var(--text-lg);
}

.pagination {
    display: flex;
    justify-content: center;
    gap: var(--space-2);
    margin-top: var(--space-16);
}

.page-numbers {
    padding: var(--space-3) var(--space-5);
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-md);
    color: var(--color-dark-300);
    text-decoration: none;
    transition: all var(--transition-base);
}

.page-numbers:hover,
.page-numbers.current {
    background: var(--gradient-purple);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
}
</style>

<?php
get_footer();

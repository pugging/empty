<?php
/**
 * The main template file
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>

            <header class="page-header animate-fade-in">
                <?php if ( is_home() && ! is_front_page() ) : ?>
                    <h1 class="page-title gradient-text"><?php single_post_title(); ?></h1>
                <?php endif; ?>
            </header>

            <div class="posts-grid animate-stagger">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post stagger-item glass' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="entry-header">
                                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

                                <div class="entry-meta">
                                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                                    <span class="byline"><?php the_author(); ?></span>
                                </div>
                            </header>

                            <div class="entry-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more btn btn-glass">
                                    <?php esc_html_e( 'Read More', 'portfolio-elite' ); ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </footer>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '← Previous', 'portfolio-elite' ),
                'next_text' => __( 'Next →', 'portfolio-elite' ),
            ) );

        else :
            ?>
            <section class="no-results glass animate-fade-in">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'portfolio-elite' ); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e( 'It seems we can't find what you're looking for.', 'portfolio-elite' ); ?></p>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

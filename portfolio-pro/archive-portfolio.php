<?php
/**
 * The template for displaying portfolio archives
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header>

        <?php if ( have_posts() ) : ?>

            <div class="portfolio-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article class="portfolio-item animate-on-scroll">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'portfolio-thumbnail', array( 'class' => 'portfolio-image' ) ); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="portfolio-image">
                        <?php endif; ?>

                        <div class="portfolio-overlay">
                            <h3 class="portfolio-title"><?php the_title(); ?></h3>
                            <?php
                            $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
                            if ( $terms && ! is_wp_error( $terms ) ) :
                                $term = array_shift( $terms );
                                ?>
                                <span class="portfolio-category"><?php echo esc_html( $term->name ); ?></span>
                            <?php endif; ?>
                            <p class="portfolio-description"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="portfolio-link" aria-label="<?php the_title_attribute(); ?>"></a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&larr; Previous', 'portfolio-pro' ),
                    'next_text' => __( 'Next &rarr;', 'portfolio-pro' ),
                )
            );

        else :
            ?>
            <p><?php esc_html_e( 'No portfolio items found.', 'portfolio-pro' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

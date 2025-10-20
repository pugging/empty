<?php
/**
 * The template for displaying single portfolio items
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single' ); ?>>
            <div class="container">
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <div class="portfolio-meta">
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                            $term_list = array();
                            foreach ( $terms as $term ) {
                                $term_list[] = '<span class="portfolio-category">' . esc_html( $term->name ) . '</span>';
                            }
                            echo implode( ', ', $term_list );
                        endif;
                        ?>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="portfolio-featured-image">
                        <?php the_post_thumbnail( 'portfolio-large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="portfolio-details-grid">
                    <div class="portfolio-main-content">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <aside class="portfolio-sidebar">
                        <div class="portfolio-info-box">
                            <h3><?php esc_html_e( 'Project Details', 'portfolio-pro' ); ?></h3>

                            <?php
                            $client = get_post_meta( get_the_ID(), '_portfolio_client', true );
                            $date = get_post_meta( get_the_ID(), '_portfolio_date', true );
                            $technologies = get_post_meta( get_the_ID(), '_portfolio_technologies', true );
                            $project_url = get_post_meta( get_the_ID(), '_portfolio_project_url', true );
                            ?>

                            <?php if ( $client ) : ?>
                                <div class="detail-item">
                                    <strong><?php esc_html_e( 'Client:', 'portfolio-pro' ); ?></strong>
                                    <span><?php echo esc_html( $client ); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ( $date ) : ?>
                                <div class="detail-item">
                                    <strong><?php esc_html_e( 'Date:', 'portfolio-pro' ); ?></strong>
                                    <span><?php echo esc_html( $date ); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ( $technologies ) : ?>
                                <div class="detail-item">
                                    <strong><?php esc_html_e( 'Technologies:', 'portfolio-pro' ); ?></strong>
                                    <div class="technologies-list">
                                        <?php
                                        $tech_array = array_map( 'trim', explode( ',', $technologies ) );
                                        foreach ( $tech_array as $tech ) :
                                            ?>
                                            <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( $project_url ) : ?>
                                <div class="detail-item">
                                    <a href="<?php echo esc_url( $project_url ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                                        <?php esc_html_e( 'View Live Project', 'portfolio-pro' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </aside>
                </div>

                <nav class="portfolio-navigation">
                    <div class="nav-previous">
                        <?php
                        $prev_post = get_previous_post();
                        if ( $prev_post ) :
                            ?>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                <span class="nav-label"><?php esc_html_e( 'Previous Project', 'portfolio-pro' ); ?></span>
                                <span class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="nav-grid">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>">
                            <?php esc_html_e( 'All Projects', 'portfolio-pro' ); ?>
                        </a>
                    </div>

                    <div class="nav-next">
                        <?php
                        $next_post = get_next_post();
                        if ( $next_post ) :
                            ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                <span class="nav-label"><?php esc_html_e( 'Next Project', 'portfolio-pro' ); ?></span>
                                <span class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </article>

        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();

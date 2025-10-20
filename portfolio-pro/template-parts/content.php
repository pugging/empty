<?php
/**
 * Template part for displaying posts
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium_large' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>

        <div class="entry-meta">
            <span class="posted-on">
                <?php echo get_the_date(); ?>
            </span>
            <span class="byline">
                <?php esc_html_e( 'by', 'portfolio-pro' ); ?> <?php the_author(); ?>
            </span>
        </div>
    </header>

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content();
        else :
            the_excerpt();
        endif;
        ?>
    </div>

    <?php if ( ! is_singular() ) : ?>
        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e( 'Read More', 'portfolio-pro' ); ?>
            </a>
        </footer>
    <?php endif; ?>
</article>

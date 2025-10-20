<?php
/**
 * The main template file
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                if ( is_home() && ! is_front_page() ) :
                    ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php
                endif;
                ?>
            </header>

            <div class="posts-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation(
                array(
                    'prev_text' => __( 'Older posts', 'portfolio-pro' ),
                    'next_text' => __( 'Newer posts', 'portfolio-pro' ),
                )
            );

        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </div>
</main>

<?php
get_footer();

<?php
/**
 * The front page template
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <?php esc_html_e( 'Hi, I\'m ', 'portfolio-pro' ); ?>
                <span class="gradient-text"><?php bloginfo( 'name' ); ?></span>
            </h1>
            <p class="hero-subtitle">
                <?php
                $tagline = get_bloginfo( 'description' );
                echo $tagline ? esc_html( $tagline ) : esc_html__( 'Creative Professional & Designer', 'portfolio-pro' );
                ?>
            </p>
            <p class="hero-description">
                <?php esc_html_e( 'I craft beautiful, functional, and user-centered digital experiences. Specializing in modern web design, brand identity, and creative solutions that make an impact.', 'portfolio-pro' ); ?>
            </p>
            <div class="cta-buttons">
                <a href="#portfolio" class="btn btn-primary">
                    <?php esc_html_e( 'View My Work', 'portfolio-pro' ); ?>
                </a>
                <a href="#contact" class="btn btn-secondary">
                    <?php esc_html_e( 'Get In Touch', 'portfolio-pro' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio-section">
        <div class="section-title">
            <h2><?php esc_html_e( 'Featured Projects', 'portfolio-pro' ); ?></h2>
            <p><?php esc_html_e( 'Check out some of my recent work', 'portfolio-pro' ); ?></p>
        </div>

        <div class="portfolio-grid">
            <?php
            $portfolio_query = new WP_Query( array(
                'post_type'      => 'portfolio',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            if ( $portfolio_query->have_posts() ) :
                while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
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
                wp_reset_postdata();
            else :
                ?>
                <p><?php esc_html_e( 'No portfolio items found. Add some from the WordPress admin panel.', 'portfolio-pro' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="about-content">
            <div class="about-image">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-placeholder.jpg' ); ?>" alt="<?php esc_attr_e( 'About Me', 'portfolio-pro' ); ?>">
            </div>
            <div class="about-text">
                <h2><?php esc_html_e( 'About Me', 'portfolio-pro' ); ?></h2>
                <p><?php esc_html_e( 'I\'m a passionate designer and developer with over 5 years of experience creating beautiful, functional websites and digital experiences. My work combines creative thinking with technical expertise to deliver solutions that not only look great but perform exceptionally.', 'portfolio-pro' ); ?></p>
                <p><?php esc_html_e( 'I believe in clean code, intuitive user experiences, and designs that tell a story. Every project is an opportunity to push boundaries and create something remarkable.', 'portfolio-pro' ); ?></p>

                <h3><?php esc_html_e( 'Skills & Technologies', 'portfolio-pro' ); ?></h3>
                <div class="skills-grid">
                    <?php
                    $skills = array( 'UI/UX Design', 'Web Development', 'Branding', 'WordPress', 'React', 'JavaScript', 'CSS/SASS', 'Figma' );
                    foreach ( $skills as $skill ) :
                        ?>
                        <div class="skill-item"><?php echo esc_html( $skill ); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="section-title">
            <h2><?php esc_html_e( 'Get In Touch', 'portfolio-pro' ); ?></h2>
            <p><?php esc_html_e( 'Have a project in mind? Let\'s work together!', 'portfolio-pro' ); ?></p>
        </div>

        <form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="portfolio_contact_form">
            <?php wp_nonce_field( 'portfolio_contact_form_nonce', 'portfolio_contact_nonce' ); ?>

            <div class="form-group">
                <label for="contact_name"><?php esc_html_e( 'Your Name', 'portfolio-pro' ); ?></label>
                <input type="text" id="contact_name" name="contact_name" required>
            </div>

            <div class="form-group">
                <label for="contact_email"><?php esc_html_e( 'Your Email', 'portfolio-pro' ); ?></label>
                <input type="email" id="contact_email" name="contact_email" required>
            </div>

            <div class="form-group">
                <label for="contact_subject"><?php esc_html_e( 'Subject', 'portfolio-pro' ); ?></label>
                <input type="text" id="contact_subject" name="contact_subject" required>
            </div>

            <div class="form-group">
                <label for="contact_message"><?php esc_html_e( 'Message', 'portfolio-pro' ); ?></label>
                <textarea id="contact_message" name="contact_message" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Send Message', 'portfolio-pro' ); ?></button>
        </form>
    </section>

</main>

<?php
get_footer();

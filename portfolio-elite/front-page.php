<?php
/**
 * The front page template
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section with Advanced Animations -->
    <section class="hero-section parallax-bg">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge glass animate-scale">
                    <span class="badge-dot"></span>
                    <?php esc_html_e( 'Available for Projects', 'portfolio-elite' ); ?>
                </div>

                <h1 class="hero-title text-reveal">
                    <?php esc_html_e( 'Creative', 'portfolio-elite' ); ?>
                    <span class="gradient-text glow-text"><?php bloginfo( 'name' ); ?></span>
                </h1>

                <p class="hero-subtitle">
                    <?php
                    $tagline = get_bloginfo( 'description' );
                    echo $tagline ? esc_html( $tagline ) : esc_html__( 'Premium Designer & Developer', 'portfolio-elite' );
                    ?>
                </p>

                <p class="hero-description">
                    <?php esc_html_e( 'Transforming ideas into stunning digital experiences. Specialized in modern web design, brand identity, and innovative solutions that drive results.', 'portfolio-elite' ); ?>
                </p>

                <div class="cta-buttons">
                    <a href="#portfolio" class="btn btn-primary btn-magnetic">
                        <span><?php esc_html_e( 'View Work', 'portfolio-elite' ); ?></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="#contact" class="btn btn-glass btn-magnetic">
                        <span><?php esc_html_e( 'Get in Touch', 'portfolio-elite' ); ?></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Animated Decorations -->
            <div class="hero-decoration hero-decoration-1 parallax-element" data-speed="0.3"></div>
            <div class="hero-decoration hero-decoration-2 parallax-element" data-speed="0.5"></div>
            <div class="hero-decoration hero-decoration-3 parallax-element" data-speed="0.4"></div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="scroll-line"></div>
            <span><?php esc_html_e( 'Scroll', 'portfolio-elite' ); ?></span>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio-section">
        <div class="container">
            <header class="section-header animate-fade-in">
                <h2 class="section-title gradient-text"><?php esc_html_e( 'Featured Projects', 'portfolio-elite' ); ?></h2>
                <p class="section-subtitle"><?php esc_html_e( 'Explore my latest work and creative solutions', 'portfolio-elite' ); ?></p>
            </header>

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
                        printf(
                            '<button class="filter-btn" data-filter=".%s">%s</button>',
                            esc_attr( $category->slug ),
                            esc_html( $category->name )
                        );
                    }
                }
                ?>
            </div>

            <!-- Portfolio Grid -->
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
                                    <div class="placeholder-image" style="background: var(--gradient-purple);"></div>
                                <?php endif; ?>
                            </div>

                            <div class="portfolio-card-content">
                                <?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
                                    <span class="portfolio-category"><?php echo esc_html( $terms[0]->name ); ?></span>
                                <?php endif; ?>

                                <h3 class="portfolio-card-title"><?php the_title(); ?></h3>

                                <p class="portfolio-card-description"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>

                                <div class="portfolio-card-meta">
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
                            </div>

                            <div class="portfolio-card-actions">
                                <a href="<?php the_permalink(); ?>" class="card-action-btn" aria-label="<?php esc_attr_e( 'View Details', 'portfolio-elite' ); ?>">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="portfolio-empty">
                        <p><?php esc_html_e( 'No portfolio items found. Add some from the admin panel.', 'portfolio-elite' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section parallax-bg" style="background: linear-gradient(180deg, transparent 0%, rgba(102, 126, 234, 0.05) 50%, transparent 100%);">
        <div class="container">
            <div class="stats-grid animate-stagger">
                <div class="stat-card glass stagger-item">
                    <div class="stat-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <div class="stat-number counter-number" data-target="150">0</div>
                    <div class="stat-label"><?php esc_html_e( 'Projects Completed', 'portfolio-elite' ); ?></div>
                </div>

                <div class="stat-card glass stagger-item">
                    <div class="stat-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-number counter-number" data-target="85">0</div>
                    <div class="stat-label"><?php esc_html_e( 'Happy Clients', 'portfolio-elite' ); ?></div>
                </div>

                <div class="stat-card glass stagger-item">
                    <div class="stat-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <div class="stat-number counter-number" data-target="24">0</div>
                    <div class="stat-label"><?php esc_html_e( 'Awards Won', 'portfolio-elite' ); ?></div>
                </div>

                <div class="stat-card glass stagger-item">
                    <div class="stat-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="stat-number counter-number" data-target="5">0</div>
                    <div class="stat-label"><?php esc_html_e( 'Years Experience', 'portfolio-elite' ); ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <header class="section-header animate-fade-in">
                <h2 class="section-title gradient-text"><?php esc_html_e( 'Let\'s Work Together', 'portfolio-elite' ); ?></h2>
                <p class="section-subtitle"><?php esc_html_e( 'Have a project in mind? Let\'s create something amazing', 'portfolio-elite' ); ?></p>
            </header>

            <div class="contact-content animate-fade-in">
                <form class="contact-form glass" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <input type="hidden" name="action" value="portfolio_elite_contact">
                    <?php wp_nonce_field( 'portfolio_elite_contact_nonce', 'contact_nonce' ); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_name"><?php esc_html_e( 'Your Name', 'portfolio-elite' ); ?></label>
                            <input type="text" id="contact_name" name="contact_name" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_email"><?php esc_html_e( 'Your Email', 'portfolio-elite' ); ?></label>
                            <input type="email" id="contact_email" name="contact_email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact_subject"><?php esc_html_e( 'Subject', 'portfolio-elite' ); ?></label>
                        <input type="text" id="contact_subject" name="contact_subject" required>
                    </div>

                    <div class="form-group">
                        <label for="contact_message"><?php esc_html_e( 'Message', 'portfolio-elite' ); ?></label>
                        <textarea id="contact_message" name="contact_message" rows="6" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-magnetic">
                        <span><?php esc_html_e( 'Send Message', 'portfolio-elite' ); ?></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

</main>

<style>
/* Hero Section */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: var(--space-20) var(--space-8);
}

.hero-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    margin-bottom: var(--space-6);
    border-radius: var(--radius-full);
    font-size: var(--text-sm);
    font-weight: 600;
}

.badge-dot {
    width: 8px;
    height: 8px;
    background: var(--color-emerald-500);
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

.hero-title {
    font-size: clamp(3rem, 8vw, 7rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: var(--space-6);
}

.hero-subtitle {
    font-size: clamp(1.5rem, 3vw, 2.5rem);
    color: var(--color-dark-300);
    margin-bottom: var(--space-8);
}

.hero-description {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: var(--color-dark-400);
    max-width: 700px;
    margin: 0 auto var(--space-12);
    line-height: 1.8;
}

.cta-buttons {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    flex-wrap: wrap;
}

.hero-decoration {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    pointer-events: none;
}

.hero-decoration-1 {
    width: 600px;
    height: 600px;
    background: var(--gradient-purple);
    top: -200px;
    right: -200px;
}

.hero-decoration-2 {
    width: 500px;
    height: 500px;
    background: var(--gradient-pink);
    bottom: -150px;
    left: -150px;
}

.hero-decoration-3 {
    width: 400px;
    height: 400px;
    background: var(--gradient-cyan);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.scroll-indicator {
    position: absolute;
    bottom: var(--space-8);
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
    color: var(--color-dark-400);
    font-size: var(--text-sm);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.scroll-line {
    width: 2px;
    height: 60px;
    background: linear-gradient(to bottom, var(--color-primary-500), transparent);
    animation: scrollDown 2s ease-in-out infinite;
}

@keyframes scrollDown {
    0%, 100% { transform: translateY(0); opacity: 1; }
    50% { transform: translateY(20px); opacity: 0.5; }
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: var(--space-16);
}

.section-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: var(--space-4);
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.5rem);
    color: var(--color-dark-400);
}

/* Stats Section */
.stats-section {
    padding: var(--space-24) 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-8);
}

.stat-card {
    text-align: center;
    padding: var(--space-10);
    border-radius: var(--radius-2xl);
    transition: all var(--transition-base);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-2xl);
}

.stat-icon {
    margin-bottom: var(--space-4);
    color: var(--color-primary-400);
}

.stat-icon svg {
    width: 40px;
    height: 40px;
}

.stat-number {
    font-family: var(--font-display);
    font-size: var(--text-6xl);
    font-weight: 800;
    background: var(--gradient-aurora);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: var(--space-2);
}

.stat-label {
    font-size: var(--text-sm);
    color: var(--color-dark-400);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Contact Section */
.contact-section {
    padding: var(--space-24) 0;
}

.contact-form {
    max-width: 800px;
    margin: 0 auto;
    padding: var(--space-10);
    border-radius: var(--radius-2xl);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-6);
}

.form-group {
    margin-bottom: var(--space-6);
}

.form-group label {
    display: block;
    margin-bottom: var(--space-2);
    font-weight: 600;
    color: var(--color-dark-200);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: var(--space-4);
    background: var(--color-dark-800);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
    color: var(--color-dark-50);
    font-family: var(--font-primary);
    font-size: var(--text-base);
    transition: all var(--transition-base);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary-500);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.form-group textarea {
    resize: vertical;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .hero-decoration {
        display: none;
    }
}
</style>

<?php
get_footer();

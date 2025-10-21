<?php
/**
 * Single Portfolio Template with PDF Viewer
 *
 * @package Portfolio_Elite
 * @since 2.0.0
 */

get_header();
?>

<main id="primary" class="site-main portfolio-single">
    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Hero Section -->
            <div class="portfolio-hero parallax-bg">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="portfolio-hero-image">
                        <?php the_post_thumbnail( 'portfolio-hero' ); ?>
                        <div class="hero-overlay"></div>
                    </div>
                <?php endif; ?>

                <div class="container">
                    <div class="portfolio-hero-content animate-fade-in">
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                            ?>
                            <span class="portfolio-category glass"><?php echo esc_html( $terms[0]->name ); ?></span>
                        <?php endif; ?>

                        <h1 class="portfolio-title gradient-text"><?php the_title(); ?></h1>

                        <?php if ( has_excerpt() ) : ?>
                            <p class="portfolio-excerpt"><?php the_excerpt(); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Project Details Grid -->
            <div class="portfolio-details-section">
                <div class="container">
                    <div class="portfolio-grid-layout">

                        <!-- Main Content -->
                        <div class="portfolio-main-content animate-fade-in">
                            <div class="glass content-card">
                                <h2 class="content-title"><?php esc_html_e( 'Project Overview', 'portfolio-elite' ); ?></h2>
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar with Project Info -->
                        <aside class="portfolio-sidebar animate-slide-right">
                            <div class="glass sidebar-card">
                                <h3 class="sidebar-title"><?php esc_html_e( 'Project Details', 'portfolio-elite' ); ?></h3>

                                <div class="project-meta">
                                    <?php
                                    $client = get_post_meta( get_the_ID(), '_portfolio_client', true );
                                    $url = get_post_meta( get_the_ID(), '_portfolio_url', true );
                                    $date = get_post_meta( get_the_ID(), '_portfolio_date', true );
                                    $duration = get_post_meta( get_the_ID(), '_portfolio_duration', true );
                                    $team_size = get_post_meta( get_the_ID(), '_portfolio_team_size', true );
                                    ?>

                                    <?php if ( $client ) : ?>
                                        <div class="meta-item">
                                            <span class="meta-label"><?php esc_html_e( 'Client', 'portfolio-elite' ); ?></span>
                                            <span class="meta-value"><?php echo esc_html( $client ); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $date ) : ?>
                                        <div class="meta-item">
                                            <span class="meta-label"><?php esc_html_e( 'Date', 'portfolio-elite' ); ?></span>
                                            <span class="meta-value"><?php echo esc_html( $date ); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $duration ) : ?>
                                        <div class="meta-item">
                                            <span class="meta-label"><?php esc_html_e( 'Duration', 'portfolio-elite' ); ?></span>
                                            <span class="meta-value"><?php echo esc_html( $duration ); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $team_size ) : ?>
                                        <div class="meta-item">
                                            <span class="meta-label"><?php esc_html_e( 'Team Size', 'portfolio-elite' ); ?></span>
                                            <span class="meta-value"><?php echo esc_html( $team_size ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php
                                $technologies = get_post_meta( get_the_ID(), '_portfolio_technologies', true );
                                if ( $technologies ) :
                                    ?>
                                    <div class="technologies-section">
                                        <h4 class="tech-title"><?php esc_html_e( 'Technologies Used', 'portfolio-elite' ); ?></h4>
                                        <div class="tech-tags">
                                            <?php
                                            $tech_array = array_map( 'trim', explode( ',', $technologies ) );
                                            foreach ( $tech_array as $tech ) :
                                                ?>
                                                <span class="tech-tag"><?php echo esc_html( $tech ); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $url ) : ?>
                                    <a href="<?php echo esc_url( $url ); ?>" class="btn btn-primary btn-magnetic" target="_blank" rel="noopener">
                                        <span><?php esc_html_e( 'View Live Project', 'portfolio-elite' ); ?></span>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>

            <!-- PDF Reports Section -->
            <?php
            $pdf_files = get_post_meta( get_the_ID(), '_portfolio_pdf_files', true );
            if ( ! empty( $pdf_files ) && is_array( $pdf_files ) ) :
                ?>
                <div class="project-reports">
                    <div class="container">
                        <header class="section-header animate-fade-in">
                            <h2 class="section-title gradient-text"><?php esc_html_e( 'Project Reports & Documentation', 'portfolio-elite' ); ?></h2>
                            <p class="section-subtitle"><?php esc_html_e( 'Explore detailed reports, analytics, and project documentation', 'portfolio-elite' ); ?></p>
                        </header>

                        <div class="pdf-grid">
                            <?php foreach ( $pdf_files as $index => $pdf ) : ?>
                                <?php if ( ! empty( $pdf['url'] ) ) : ?>
                                    <div class="pdf-card animate-fade-in" data-pdf-url="<?php echo esc_url( $pdf['url'] ); ?>" data-pdf-title="<?php echo esc_attr( $pdf['title'] ?? 'Document' ); ?>">
                                        <div class="pdf-thumbnail">
                                            <div class="pdf-thumbnail-placeholder">
                                                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                                    <polyline points="10 9 9 9 8 9"></polyline>
                                                </svg>
                                            </div>
                                            <div class="pdf-thumbnail-overlay">
                                                <button class="pdf-view-btn" onclick="openPDFViewer('<?php echo esc_js( $pdf['url'] ); ?>', '<?php echo esc_js( $pdf['title'] ?? 'Document' ); ?>')">
                                                    <?php esc_html_e( 'View PDF', 'portfolio-elite' ); ?>
                                                </button>
                                            </div>
                                            <span class="pdf-type-badge">PDF</span>
                                        </div>

                                        <div class="pdf-info">
                                            <h3 class="pdf-title"><?php echo esc_html( $pdf['title'] ?? 'Document ' . ( $index + 1 ) ); ?></h3>
                                            <?php if ( ! empty( $pdf['description'] ) ) : ?>
                                                <p class="pdf-description"><?php echo esc_html( $pdf['description'] ); ?></p>
                                            <?php endif; ?>

                                            <div class="pdf-meta">
                                                <div class="pdf-meta-item">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                    </svg>
                                                    <span>PDF</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Navigation -->
            <div class="portfolio-navigation">
                <div class="container">
                    <div class="nav-grid">
                        <div class="nav-item nav-prev">
                            <?php
                            $prev_post = get_previous_post();
                            if ( $prev_post ) :
                                ?>
                                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="nav-link glass">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                    <div class="nav-content">
                                        <span class="nav-label"><?php esc_html_e( 'Previous Project', 'portfolio-elite' ); ?></span>
                                        <span class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="nav-item nav-all">
                            <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="nav-link glass">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                <span><?php esc_html_e( 'All Projects', 'portfolio-elite' ); ?></span>
                            </a>
                        </div>

                        <div class="nav-item nav-next">
                            <?php
                            $next_post = get_next_post();
                            if ( $next_post ) :
                                ?>
                                <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="nav-link glass">
                                    <div class="nav-content">
                                        <span class="nav-label"><?php esc_html_e( 'Next Project', 'portfolio-elite' ); ?></span>
                                        <span class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                                    </div>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </article>

    <?php endwhile; ?>
</main>

<!-- PDF Modal Viewer -->
<div id="pdf-modal" class="pdf-modal">
    <div class="pdf-modal-content">
        <div class="pdf-modal-header">
            <h3 class="pdf-modal-title"></h3>
            <button class="pdf-modal-close" onclick="closePDFViewer()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="pdf-modal-body">
            <iframe class="pdf-iframe" frameborder="0"></iframe>
        </div>
    </div>
</div>

<script>
function openPDFViewer(url, title) {
    const modal = document.getElementById('pdf-modal');
    const iframe = modal.querySelector('.pdf-iframe');
    const titleElement = modal.querySelector('.pdf-modal-title');

    titleElement.textContent = title;
    iframe.src = url;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePDFViewer() {
    const modal = document.getElementById('pdf-modal');
    const iframe = modal.querySelector('.pdf-iframe');

    modal.classList.remove('active');
    iframe.src = '';
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePDFViewer();
    }
});

// Close on backdrop click
document.getElementById('pdf-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePDFViewer();
    }
});
</script>

<style>
/* Portfolio Single Styles */
.portfolio-hero {
    position: relative;
    padding: var(--space-32) 0 var(--space-20);
    min-height: 60vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.portfolio-hero-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.portfolio-hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(2, 6, 23, 0.8), var(--color-dark-950));
}

.portfolio-hero-content {
    position: relative;
    z-index: 1;
    text-align: center;
}

.portfolio-title {
    font-size: clamp(2.5rem, 6vw, 5rem);
    margin: var(--space-6) 0;
}

.portfolio-excerpt {
    font-size: clamp(1rem, 2vw, 1.5rem);
    color: var(--color-dark-300);
    max-width: 800px;
    margin: 0 auto;
}

.portfolio-details-section {
    padding: var(--space-20) 0;
}

.portfolio-grid-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: var(--space-8);
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--space-8);
}

.content-card,
.sidebar-card {
    padding: var(--space-8);
    border-radius: var(--radius-2xl);
}

.content-title,
.sidebar-title {
    font-size: var(--text-2xl);
    margin-bottom: var(--space-6);
    padding-bottom: var(--space-4);
    border-bottom: 2px solid var(--glass-border);
}

.project-meta {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
    margin-bottom: var(--space-8);
}

.meta-item {
    display: flex;
    justify-content: space-between;
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--glass-border);
}

.meta-label {
    color: var(--color-dark-400);
    font-weight: 600;
}

.meta-value {
    color: var(--color-dark-200);
}

.technologies-section {
    margin-bottom: var(--space-8);
}

.tech-title {
    font-size: var(--text-lg);
    margin-bottom: var(--space-4);
}

.portfolio-navigation {
    padding: var(--space-16) 0;
    background: linear-gradient(180deg, transparent, rgba(102, 126, 234, 0.05), transparent);
}

.nav-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: var(--space-6);
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--space-8);
}

.nav-link {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-6);
    border-radius: var(--radius-xl);
    transition: all var(--transition-base);
}

.nav-link:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.nav-content {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.nav-label {
    font-size: var(--text-xs);
    color: var(--color-dark-500);
    text-transform: uppercase;
}

.nav-title {
    font-size: var(--text-base);
    font-weight: 600;
    color: var(--color-dark-100);
}

.nav-next .nav-content {
    align-items: flex-end;
    text-align: right;
}

@media (max-width: 1024px) {
    .portfolio-grid-layout {
        grid-template-columns: 1fr;
    }

    .nav-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
get_footer();

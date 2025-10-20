<?php
/**
 * Custom search form
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'portfolio-pro' ); ?></span>
        <input type="search"
               class="search-field"
               placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'portfolio-pro' ); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               required />
    </label>
    <button type="submit" class="search-submit btn btn-primary">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="search-submit-text"><?php echo esc_html_x( 'Search', 'submit button', 'portfolio-pro' ); ?></span>
    </button>
</form>

<style>
.search-form {
    display: flex;
    gap: 0.5rem;
    max-width: 100%;
}

.search-form label {
    flex: 1;
    margin: 0;
}

.search-field {
    width: 100%;
    padding: 0.875rem;
    background: var(--bg-tertiary);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius-sm);
    color: var(--text-primary);
    font-family: var(--font-primary);
    transition: all var(--transition-base);
}

.search-field:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.search-submit {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    white-space: nowrap;
}

.search-submit svg {
    width: 20px;
    height: 20px;
}

@media (max-width: 480px) {
    .search-submit-text {
        display: none;
    }

    .search-submit {
        padding: 0.875rem;
    }
}
</style>

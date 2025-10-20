<?php
/**
 * The template for displaying comments
 *
 * @package Portfolio_Pro
 * @since 1.0.0
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'portfolio-pro' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'portfolio-pro' ) ),
                    number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 64,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'portfolio-pro' ); ?></p>
            <?php
        endif;

    endif;

    comment_form(
        array(
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
            'class_form'         => 'comment-form',
            'class_submit'       => 'btn btn-primary',
        )
    );
    ?>

</div>

<style>
.comments-area {
    background: var(--bg-secondary);
    padding: var(--spacing-lg);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.05);
    margin-top: var(--spacing-lg);
}

.comments-title {
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-sm);
    border-bottom: 2px solid var(--primary-color);
}

.comment-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.comment-list .comment {
    margin-bottom: var(--spacing-md);
    padding: var(--spacing-md);
    background: var(--bg-tertiary);
    border-radius: var(--border-radius-md);
}

.comment-author img {
    border-radius: 50%;
    float: left;
    margin-right: var(--spacing-sm);
}

.comment-meta {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: var(--spacing-sm);
}

.comment-content {
    clear: both;
    padding-top: var(--spacing-sm);
}

.comment-reply-link {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: rgba(99, 102, 241, 0.2);
    color: var(--primary-light);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: all var(--transition-base);
}

.comment-reply-link:hover {
    background: rgba(99, 102, 241, 0.3);
    transform: translateY(-2px);
}

.comment-form {
    margin-top: var(--spacing-lg);
}

.comment-form-comment,
.comment-form-author,
.comment-form-email,
.comment-form-url {
    margin-bottom: var(--spacing-md);
}

.comment-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
    font-weight: 500;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"],
.comment-form textarea {
    width: 100%;
    padding: 0.875rem;
    background: var(--bg-tertiary);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius-sm);
    color: var(--text-primary);
    font-family: var(--font-primary);
    transition: all var(--transition-base);
}

.comment-form input:focus,
.comment-form textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.comment-form textarea {
    min-height: 150px;
    resize: vertical;
}

.no-comments {
    padding: var(--spacing-md);
    background: rgba(245, 158, 11, 0.1);
    border-left: 4px solid var(--accent-color);
    border-radius: var(--border-radius-sm);
    color: var(--text-secondary);
}
</style>

<?php
/**
 * Template part for displaying posts.
 *
 * @package ardentops
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                ardentops_posted_on();
                ardentops_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) :
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ardentops'),
                        [
                            'span' => [
                                'class' => [],
                            ],
                        ]
                    ),
                    get_the_title()
                )
            );

            wp_link_pages([
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'ardentops'),
                'after'  => '</div>',
            ]);
        else :
            the_excerpt();
        endif;
        ?>
    </div>

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <?php
            $categories_list = get_the_category_list(esc_html__(', ', 'ardentops'));
            if ($categories_list) {
                printf(
                    '<span class="cat-links">' . esc_html__('Posted in %1$s', 'ardentops') . '</span>',
                    $categories_list
                );
            }

            $tags_list = get_the_tag_list('', esc_html__(', ', 'ardentops'));
            if ($tags_list) {
                printf(
                    '<span class="tags-links">' . esc_html__('Tagged %1$s', 'ardentops') . '</span>',
                    $tags_list
                );
            }
            ?>
        </footer>
    <?php endif; ?>
</article>

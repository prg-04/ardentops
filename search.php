<?php
/**
 * Search results template.
 *
 * @package ardentops
 */
get_header(); ?>

<main id="main" class="site-main">
    <?php if (have_posts()) : ?>
        <header class="page-header">
            <h1>
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'ardentops'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'search'); ?>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <?php get_template_part('template-parts/content', 'none'); ?>
    <?php endif; ?>
</main>

<?php get_footer();

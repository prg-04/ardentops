<?php
/**
 * Archive template.
 *
 * @package ardentops
 */
get_header(); ?>

<main id="main" class="site-main">
    <header class="archive-header">
        <?php the_archive_title('<h1>', '</h1>'); ?>
        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
    </header>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-content"><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile; else : ?>
        <p><?php esc_html_e('No posts found.', 'ardentops'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer();

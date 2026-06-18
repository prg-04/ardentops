<?php
/**
 * 404 template.
 *
 * @package ardentops
 */
get_header(); ?>

<main id="main" class="site-main">
    <section class="error-404">
        <h1><?php esc_html_e('Page Not Found', 'ardentops'); ?></h1>
        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'ardentops'); ?></p>
        <?php get_search_form(); ?>
    </section>
</main>

<?php get_footer();

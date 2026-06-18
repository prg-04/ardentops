<?php
/**
 * ArdentOps — Theme Functions
 *
 * @package ardentops
 * @since   1.0.0
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

// ── Theme setup ─────────────────────────────────────────────────
add_action('after_setup_theme', 'ardentops_setup');

function ardentops_setup(): void {
    load_theme_textdomain('ardentops', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'ardentops'),
        'footer'  => esc_html__('Footer Menu', 'ardentops'),
    ]);
}

// ── Enqueue assets ───────────────────────────────────────────────
add_action('wp_enqueue_scripts', 'ardentops_enqueue');

function ardentops_enqueue(): void {
    $theme   = wp_get_theme();
    $version = $theme->get('Version');

    wp_enqueue_style(
        'ardentops-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $version
    );

    wp_enqueue_script(
        'ardentops-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $version,
        true
    );
}

// ── Content Width ────────────────────────────────────────────────
add_action('after_setup_theme', 'ardentops_content_width', 0);

function ardentops_content_width(): void {
    $GLOBALS['content_width'] = apply_filters('ardentops_content_width', 1200);
}

// ── Widgets ──────────────────────────────────────────────────────
add_action('widgets_init', 'ardentops_widgets_init');

function ardentops_widgets_init(): void {
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'ardentops'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'ardentops'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Footer Widgets', 'ardentops'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add footer widgets here.', 'ardentops'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ]);
}

// ── Custom Functions ─────────────────────────────────────────────
function ardentops_excerpt_length($length): int {
    return 40;
}
add_filter('excerpt_length', 'ardentops_excerpt_length');

function ardentops_excerpt_more($more): string {
    return '&hellip;';
}
add_filter('excerpt_more', 'ardentops_excerpt_more');

function ardentops_pingback_header(): void {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'ardentops_pingback_header');

function ardentops_posted_on(): void {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    printf(
        '<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
        esc_html__('Posted on', 'ardentops'),
        esc_url(get_permalink()),
        $time_string
    );
}

function ardentops_posted_by(): void {
    printf(
        '<span class="byline"> %1$s<span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
        esc_html__('by', 'ardentops'),
        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
        esc_html(get_the_author())
    );
}

// ── Includes ─────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/helpers.php';

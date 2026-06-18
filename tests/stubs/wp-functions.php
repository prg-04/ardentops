<?php
/**
 * WordPress function stubs for static analysis and IDE support.
 *
 * These stubs silence "Call to unknown function" warnings in IDEs and
 * static analysis tools when working outside a WordPress context.
 * They are NEVER loaded at runtime in production — WordPress provides
 * the real implementations.
 *
 * @package ardentops
 * @noinspection ALL
 */

if (!function_exists('__')) {
    /**
     * @param string $text
     * @param string $domain
     * @return string
     */
    function __($text, $domain = 'default') { return $text; }
}

if (!function_exists('_e')) {
    function _e($text, $domain = 'default') { echo $text; }
}

if (!function_exists('_n')) {
    function _n($single, $plural, $number, $domain = 'default') { return $number === 1 ? $single : $plural; }
}

if (!function_exists('_x')) {
    function _x($text, $context, $domain = 'default') { return $text; }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text) { return $text; }
}

if (!function_exists('esc_attr_e')) {
    function esc_attr_e($text, $domain = 'default') { echo $text; }
}

if (!function_exists('esc_html')) {
    function esc_html($text) { return $text; }
}

if (!function_exists('esc_html__')) {
    function esc_html__($text, $domain = 'default') { return $text; }
}

if (!function_exists('esc_html_e')) {
    function esc_html_e($text, $domain = 'default') { echo $text; }
}

if (!function_exists('esc_url')) {
    function esc_url($url, $protocols = null, $context = 'display') { return $url; }
}

if (!function_exists('esc_url_raw')) {
    function esc_url_raw($url, $protocols = null) { return $url; }
}

if (!function_exists('esc_js')) {
    function esc_js($text) { return $text; }
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $accepted_args = 1) { return true; }
}

if (!function_exists('add_filter')) {
    function add_filter($hook, $callback, $priority = 10, $accepted_args = 1) { return true; }
}

if (!function_exists('apply_filters')) {
    function apply_filters($hook, $value, ...$args) { return $value; }
}

if (!function_exists('add_theme_support')) {
    function add_theme_support($feature, ...$args) { return true; }
}

if (!function_exists('register_nav_menus')) {
    function register_nav_menus($locations = []) { return true; }
}

if (!function_exists('register_sidebar')) {
    function register_sidebar($args = []) { return true; }
}

if (!function_exists('dynamic_sidebar')) {
    function dynamic_sidebar($index = 'sidebar-1') { return true; }
}

if (!function_exists('is_active_sidebar')) {
    function is_active_sidebar($index = 'sidebar-1') { return false; }
}

if (!function_exists('load_theme_textdomain')) {
    function load_theme_textdomain($domain, $path = false) { return true; }
}

if (!function_exists('wp_enqueue_style')) {
    function wp_enqueue_style($handle, $src = '', $deps = [], $ver = false, $media = 'all') {}
}

if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle, $src = '', $deps = [], $ver = false, $in_footer = false) {}
}

if (!function_exists('wp_get_theme')) {
    /**
     * @return WP_Theme|stdClass
     */
    function wp_get_theme($stylesheet = null, $theme_root = null) {
        return new stdClass();
    }
}

if (!function_exists('get_template_directory')) {
    function get_template_directory() { return ''; }
}

if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri() { return ''; }
}

if (!function_exists('wp_head')) {
    function wp_head() {}
}

if (!function_exists('wp_footer')) {
    function wp_footer() {}
}

if (!function_exists('wp_body_open')) {
    function wp_body_open() {}
}

if (!function_exists('body_class')) {
    function body_class($class = '') { return []; }
}

if (!function_exists('post_class')) {
    function post_class($class = '', $post_id = null) { return []; }
}

if (!function_exists('the_title')) {
    function the_title($before = '', $after = '', $echo = true) { return ''; }
}

if (!function_exists('the_content')) {
    function the_content($more_link_text = null, $strip_teaser = false) {}
}

if (!function_exists('the_excerpt')) {
    function the_excerpt() {}
}

if (!function_exists('the_permalink')) {
    function the_permalink() { echo ''; }
}

if (!function_exists('the_post')) {
    function the_post() {}
}

if (!function_exists('the_ID')) {
    function the_ID() { echo 0; }
}

if (!function_exists('the_post_thumbnail')) {
    function the_post_thumbnail($size = 'post-thumbnail', $attr = []) { echo ''; }
}

if (!function_exists('the_archive_title')) {
    function the_archive_title($before = '', $after = '') {}
}

if (!function_exists('the_archive_description')) {
    function the_archive_description($before = '', $after = '') {}
}

if (!function_exists('the_search_query')) {
    function the_search_query() { echo ''; }
}

if (!function_exists('get_search_query')) {
    function get_search_query($escaped = true) { return ''; }
}

if (!function_exists('get_permalink')) {
    function get_permalink($post = null) { return ''; }
}

if (!function_exists('get_the_title')) {
    function get_the_title($post = null) { return ''; }
}

if (!function_exists('get_the_ID')) {
    function get_the_ID() { return 0; }
}

if (!function_exists('get_the_date')) {
    function get_the_date($format = '', $post = null) { return ''; }
}

if (!function_exists('get_the_time')) {
    function get_the_time($format = 'U', $post = null) { return 0; }
}

if (!function_exists('get_the_modified_date')) {
    function get_the_modified_date($format = '', $post = null) { return ''; }
}

if (!function_exists('get_the_modified_time')) {
    function get_the_modified_time($format = 'U', $post = null) { return 0; }
}

if (!function_exists('get_the_author')) {
    function get_the_author($post = null) { return ''; }
}

if (!function_exists('get_the_author_meta')) {
    function get_the_author_meta($field = '', $user_id = false) { return ''; }
}

if (!function_exists('get_author_posts_url')) {
    function get_author_posts_url($author_id, $author_nicename = '') { return ''; }
}

if (!function_exists('get_the_category_list')) {
    function get_the_category_list($separator = '', $parents = '', $post_id = false) { return ''; }
}

if (!function_exists('get_the_tag_list')) {
    function get_the_tag_list($before = '', $sep = '', $after = '', $post_id = null) { return ''; }
}

if (!function_exists('get_post_type')) {
    function get_post_type($post = null) { return 'post'; }
}

if (!function_exists('has_post_thumbnail')) {
    function has_post_thumbnail($post = null) { return false; }
}

if (!function_exists('is_singular')) {
    function is_singular($post_types = '') { return false; }
}

if (!function_exists('is_search')) {
    function is_search() { return false; }
}

if (!function_exists('in_the_loop')) {
    function in_the_loop() { return true; }
}

if (!function_exists('have_posts')) {
    function have_posts() { return false; }
}

if (!function_exists('have_comments')) {
    function have_comments() { return false; }
}

if (!function_exists('comments_open')) {
    function comments_open($post_id = null) { return false; }
}

if (!function_exists('post_password_required')) {
    function post_password_required($post = null) { return false; }
}

if (!function_exists('get_comments_number')) {
    function get_comments_number($post_id = 0) { return 0; }
}

if (!function_exists('wp_list_comments')) {
    function wp_list_comments($args = [], $comments = null) {}
}

if (!function_exists('comment_form')) {
    function comment_form($args = [], $post_id = null) {}
}

if (!function_exists('comments_template')) {
    function comments_template($file = '/comments.php', $separate_comments = false) {}
}

if (!function_exists('the_comments_navigation')) {
    function the_comments_navigation($args = []) {}
}

if (!function_exists('get_search_form')) {
    function get_search_form($echo = true) { return ''; }
}

if (!function_exists('the_posts_navigation')) {
    function the_posts_navigation($args = []) {}
}

if (!function_exists('get_sidebar')) {
    function get_sidebar($name = null) {}
}

if (!function_exists('get_header')) {
    function get_header($name = null) {}
}

if (!function_exists('get_footer')) {
    function get_footer($name = null) {}
}

if (!function_exists('get_template_part')) {
    function get_template_part($slug, $name = null, $args = []) {}
}

if (!function_exists('wp_nav_menu')) {
    function wp_nav_menu($args = []) { return false; }
}

if (!function_exists('home_url')) {
    function home_url($path = '', $scheme = null) { return '/'; }
}

if (!function_exists('bloginfo')) {
    function bloginfo($show = '') { echo ''; }
}

if (!function_exists('get_bloginfo')) {
    function get_bloginfo($show = '', $filter = 'display') { return ''; }
}

if (!function_exists('language_attributes')) {
    function language_attributes($doctype = 'html') { echo 'lang="en-US"'; }
}

if (!function_exists('wp_kses')) {
    function wp_kses($string, $allowed_html, $allowed_protocols = []) { return $string; }
}

if (!function_exists('wp_kses_post')) {
    function wp_kses_post($data) { return $data; }
}

if (!function_exists('wp_link_pages')) {
    function wp_link_pages($args = []) { echo ''; }
}

if (!function_exists('pings_open')) {
    function pings_open($post_id = null) { return false; }
}

if (!function_exists('wp_die')) {
    function wp_die($message = '', $title = '', $args = []) { exit; }
}

if (!function_exists('comments_number')) {
    function comments_number($zero = false, $one = false, $more = false, $post_id = null) { echo ''; }
}

if (!function_exists('get_the_post_thumbnail')) {
    function get_the_post_thumbnail($post = null, $size = 'post-thumbnail', $attr = []) { return ''; }
}

<?php
/**
 * Theme helper functions.
 *
 * @package ardentops
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get the content width for the theme.
 *
 * @return int Content width in pixels.
 */
function ardentops_content_width(): int {
    return (int) apply_filters('ardentops_content_width', 1200);
}

/**
 * Get the primary navigation menu arguments.
 *
 * @return array<string, mixed> Menu registration arguments.
 */
function ardentops_nav_menu_args(): array {
    return [
        'theme_location' => 'primary',
        'menu_class'     => 'primary-menu',
        'container'      => 'nav',
        'container_class' => 'primary-nav',
        'fallback_cb'    => false,
    ];
}

/**
 * Get the footer navigation menu arguments.
 *
 * @return array<string, mixed> Menu registration arguments.
 */
function ardentops_footer_menu_args(): array {
    return [
        'theme_location' => 'footer',
        'menu_class'     => 'footer-menu',
        'container'      => 'nav',
        'container_class' => 'footer-nav',
        'depth'          => 1,
        'fallback_cb'    => false,
    ];
}

<?php
/**
 * Footer template.
 *
 * @package ardentops
 */
?>
<footer class="site-footer">
    <div class="site-footer__inner">
        <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?></p>
        <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false]); ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

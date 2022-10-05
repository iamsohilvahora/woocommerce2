<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woocommerce
 */
?>
	<footer>
		<div class="container">
			<p class="text-center"><?php echo get_theme_mod('set_copyright', 'Set copyright here'); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <ul id="sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
            <?php dynamic_sidebar('footer-1'); ?>
        </ul>
    <?php } ?>
<?php wp_footer(); ?>
</body>
</html>
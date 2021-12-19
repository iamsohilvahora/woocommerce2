<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woocommerce
 */

get_header();


echo "index a";
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		<div id="products-new-arrivals">
			<h3>New Arrivals</h3>
			<?php
				$set_new_limit = get_theme_mod('set_new_limit');
				$set_new_column = get_theme_mod('set_new_column');

			?>

			<?php echo do_shortcode('[products limit="'.$set_new_limit.'" columns="'.$set_new_column.'" orderby="date" class="new-arrivals"]'); ?>
		</div>

		<div id="products-popularity">
			<h3>Popularity</h3>
			<?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity"]'); ?>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();

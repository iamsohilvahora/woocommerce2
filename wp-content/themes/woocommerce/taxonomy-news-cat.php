<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woocommerce
 */

echo "ggggggggggg";
get_header();
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

$args =  array(
		 		'post_status' => 'publish',
				'post_type' => 'news',
				'posts_per_page' => -1,
				// 'is_paged' => true,
				// 'paged' => $paged,
				'tax_query' => array(
				    array(
				      'taxonomy'=> 'news-cat',
				      'field' => 'term_id',
				      'terms' => $term_id ,
				      //'include_children' => true,  // set true if you want post of its child category also
				      'oparator' => 'IN'
				    ))
				);
			// the query
			$wp_query = new WP_Query( $args ); 

?>

	<main id="primary" class="site-main">

		<?php if ( $wp_query->have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'news' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

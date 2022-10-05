<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woocommerce
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title><?php echo bloginfo('title'); ?></title>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
	    <?php if (has_custom_logo()) :
				the_custom_logo();
			else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif; ?>

	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	        <?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container' =>false,
					'items_wrap' => '<ul class="navbar-nav ml-auto">%3$s</ul>'
				)
			);
			?>

			<?php if(class_exists('WooCommerce')): ?>
				<?php if(is_user_logged_in()): ?>
					<a href="<?php echo get_the_permalink(get_option("woocommerce_myaccount_page_id")); ?>" class="btn btn-primary" style="margin-right: 10px;">My Account</a>

					<a href="<?php echo wp_logout_url(get_the_permalink(get_option("woocommerce_myaccount_page_id"))); ?>" class="btn btn-danger" style="margin-right: 10px;">Logout</a>
				<?php else: ?>
					<a href="<?php echo get_the_permalink(get_option("woocommerce_myaccount_page_id")); ?>" class="btn btn-primary" style="margin-right: 10px;">Login/Register</a>
				<?php endif; ?>		

				<a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-primary">
				Cart (<span class="items-count">
					<?php echo WC()->cart->get_cart_contents_count();
					echo " - ";
				    echo WC()->cart->get_cart_total(); 
				    ?></span>) 
				</a>
			<?php endif; ?>

			<form action="<?php echo home_url('/'); ?>">
			<?php
				wc_product_dropdown_categories(array(
					'parent' => 0,
					'value_field' => 'slug',
					// 'exclude' => '18,22',
				));
			?>
				<input type="text" name="s" />
				<input type="hidden" name="post_type" value="product" />
				<input type="submit" value="Product">
			</form>
			<?php // echo do_shortcode('[a_simple_example]'); ?>	     
	    </div>
	  </div>
	</nav>
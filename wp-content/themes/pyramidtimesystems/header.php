<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pyramidtimesystems
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pyramidtimesystems' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="page-header-container clear">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$pyramidtimesystems_description = get_bloginfo( 'description', 'display' );
				if ( $pyramidtimesystems_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $pyramidtimesystems_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pyramidtimesystems' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<?php 
				// echo do_shortcode('[menu_search_shortcode]'); 
				// get_search_form();
				global $wp_query;
			?>

				<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
					<label>
						<span class="screen-reader-text">Search for:</span>
						<?php 
							wc_product_dropdown_categories(array(
			                    'orderby'    => 'id',
			                    'order'      => 'desc',
			                    'hide_empty' => false,
			                   	'parent' => 38,
			                    'hierarchical' => false,		
			                    'show_count' => 0,
								'show_uncategorized' => false,
								'show_option_all'   => 'All',
								'show_option_none'   => '',
								'selected' => isset($wp_query->query_vars['product_cat']) ? $wp_query->query_vars['product_cat'] : '',
								'id' => '',
      							'option_none_value'  => 0,
      							'value_field'        => 'term_id',
      							'taxonomy'           => 'product_cat',
      							'name'               => 'product_cat',
      							'class'              => 'dropdown_product_cat',
			                )); 
						?>
						<input type="search" class="search-field" placeholder="Search …" value="<?php echo get_search_query(); ?>" name="s" required>
						<input type="hidden" name="post_type" value="product">
					</label>
					<input type="submit" class="search-submit" value="Search">
				</form>
				<!-- ssndfckns -->

					<form role="search" method="get" action="">
				        <div class="search-bar-select hidden-sm hidden-xs">
				            <select name="product_cat">
				                <option value="0" class="search-bar-select-text">All</option>
				                <?php 
				                // $args = array(
				                //    'taxonomy' => 'product_cat',
				                //    'name' => 'product_cat',
				                //    'value_field' => 'id',
				                //    'class' => ''
				                // );
				                // wp_dropdown_categories($args);

				                $orderby = 'id';
				                $order = 'asc';
				                $hide_empty = false;
				                $category_id = 453;
				                $cat_args = array(
				                    'orderby'    => $orderby,
				                    'order'      => $order,
				                    'hide_empty' => $hide_empty,
				                   	'parent' => $category_id,
				                    'hierarchical' => true,		                    
				                );
				                 
				                $product_categories = get_terms('product_cat', $cat_args);
				                 
				                foreach($product_categories as $key => $category){
				                	if($category->name != "Uncategorized"){
				                		echo '<option value="'.$category->term_id.'" class="search-bar-select-text">'.$category->name.'</option>';
				                	}
				                } 
				                ?>
				            </select>
				        </div>
				        <div class="search-bar-input">
				            <input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search entire store here..." required />
				        </div>
				        <!-- <input type="hidden" name="post_type" value="product" /> -->
				        <div class="search-bar-btn">
				            <button type="submit"><i class="fa fa-search"></i></button>
				        </div>
				    </form>

			<?php //echo do_shortcode('[woocommerce_product_filter]'); ?>
		</div>
	</header><!-- #masthead -->

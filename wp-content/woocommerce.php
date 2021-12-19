<?php
/********************** WooCommerce Customization ******************/
// add theme support for woocommerce
	add_theme_support("woocommerce", array(
		//"thumbnail_image_width" => 150,
		//"single_image_width" => 200,
		"product_grid"=> array( 
			"default_columns" => 10,
			"min_columns" => 2,
			"max_columns" => 3
		)
	));

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 60,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// display custom logo - 
		the_custom_logo();

// Product thumbnail effect support (single-product.php)
	add_theme_support("wc-product-gallery-zoom");
	add_theme_support("wc-product-gallery-lightbox");
	add_theme_support("wc-product-gallery-slider");

/********************** archive-product.php ************************/
// remove action hooks
	// remove taxonomy archive description (archive-product.php)
	remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description');
	// remove sidebar (archive-product.php)
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

// add html and css using hooks (archive-product.php)
	function open_container_div_class(){
		echo '<div class="container"><div class="row">';
	}

	function close_container_div_class(){
		echo '</div></div>';
	}

	add_action("woocommerce_before_main_content", "open_container_div_class", 5);
	add_action("woocommerce_after_main_content", "close_container_div_class", 5);

// add custom html and css in shop page only (archive-product.php)
	function load_template_layout(){
		if(is_shop()){
			// col-sm-4 => sidebar
			// col-sm-8 => product grid

			//add sidebar grid
			function open_sidebar_column(){
				echo '<div class="col-md-4">';
			}
			function close_sidebar_column(){
				echo '</div>';
			}
			// add product grid
			function open_product_column(){
				echo '<div class="col-md-8">';
			}
			function close_product_column(){
					echo '</div>';
			}
			add_action("woocommerce_before_main_content", "open_sidebar_column", 6);
			add_action("woocommerce_before_main_content", "woocommerce_get_sidebar", 7);
			add_action("woocommerce_before_main_content", "close_sidebar_column", 8);

			add_action("woocommerce_before_main_content", "open_product_column", 9);
			add_action("woocommerce_before_main_content", "close_product_column", 10);
		}
	}
	add_action("template_redirect", "load_template_layout");

// show or remove page title (e.g. Shop) (archive-product.php)
	function show_remove_page_title($val){
		$val = false;
		return $val;
	}
	add_filter("woocommerce_show_page_title","show_remove_page_title");

// add product description after product title (archive-product.php)
	add_action("woocommerce_after_shop_loop_item_title", "the_excerpt");
// remove breadcrumb, result count, sort ordering (archive-product.php)
	remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb",20);
	remove_action("woocommerce_before_shop_loop", "woocommerce_result_count",20);
	remove_action("woocommerce_before_shop_loop", "woocommerce_catalog_ordering",30);

// We can give custom class-name to loop like price, add to cart button in loop folder file

// check condition if woocommerce plugin is activated or not then include file
	if(class_exists('woocommerce')){
		require get_template_directory() .'/woocommerce.php';
	} 

/********************** single-product.php ************************/
// customize single product page using single-product.php file and use file of single-product folder and add html,css to file.

/********************** Cart Page ************************/
// There is no template for cart page

// Search - Show cart items woocommerce
?>
	<a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-primary">
	Cart (<span class="items-count">
		<?php echo WC()->cart->get_cart_contents_count();
		echo " - ";
	    echo WC()->cart->get_cart_total(); 
	    ?></span>) 
	</a>
<?php
	/**
	 * Show cart contents / total Ajax
	 */
	function woocommerce_header_add_to_cart_fragment($fragments){
		global $woocommerce;
		ob_start();
		?>
		<span class="items-count"><?php echo WC()->cart->get_cart_contents_count();
				echo " - ";
				echo WC()->cart->get_cart_total();
		?></span>
		<?php
		$fragments['span.items-count'] = ob_get_clean();
		return $fragments;
	}
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

// Show my account and register/login link
	if(class_exists('WooCommerce')): ?>
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
	<?php endif;

// We use shortcode in woocommerce (e.g. product)

/********************** Checkout Page ************************/
// There is no template for checkout page

/**************************************************************/
	/*** Change number or products per row to 4 ***/
	add_filter('loop_shop_columns', 'loop_columns', 999);
	if (!function_exists('loop_columns')){
		function loop_columns(){
			$row = get_option('wc_number_of_products_per_row') ? get_option('wc_number_of_products_per_row') : 4;	return $row; // 4 products per row
		}
	}

	/*** Change number of products that are displayed per page(shop page) ***/
	add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);
	function new_loop_shop_per_page($cols){
	  // $cols contains the current number of products per page based on the value stored on Options –> Reading
	  // Return the number of products you wanna show per page.
	  $cols = get_option('wc_number_of_products_per_page') ? get_option('wc_number_of_products_per_page') : 12;
	  //$cols = 12;
	  return $cols;
	}

	/*** Display category image on category archive ***/
	add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
	function woocommerce_category_image(){
	    if(is_product_category()){
		    global $wp_query;
		    $cat = $wp_query->get_queried_object();
		    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
		    $image = wp_get_attachment_url($thumbnail_id);
		    if($image){
			    echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
			}
		}
	}

/*********************** Single product page *******************/
	// Custom tabs (remove or add new tab)
	// remove_action("woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs",10);
	if(!function_exists('my_custom_tabs_function')){
		add_filter('woocommerce_product_tabs', 'my_custom_tabs_function');

		function my_custom_tabs_function($tabs){
			// print_r($tabs);
			unset($tabs['reviews']);

			$tabs['video'] = array(
				'title'=> 'Video',
				'priority' => 30,
				'callback' => 'my_tab_video_function'
			);
			return $tabs;
		}

		function my_tab_video_function(){
			echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/3aNY0OiNPZQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
	}

	/*** Change number of related products output ***/ 
	add_filter('woocommerce_output_related_products_args', 'my_custom_related_product_function');

	function my_custom_related_product_function($args){
		$args = array(
			'posts_per_page' => 3,
			'columns' => 3,
			'orderby' => 'rand'
		);
		return $args;
	}

	// Change default placeholder image (Shop page)
	add_filter('woocommerce_placeholder_img_src', 'my_default_placeholder_image');

	function my_default_placeholder_image($img){
		return 'http://lorempixel.com/310/220/food/';
	}

	// WooCommerce cart additional fees
	add_action( 'woocommerce_cart_calculate_fees', 'my_additional_fees_country_based');
	
	function my_additional_fees_country_based(){
		global $woocommerce;
	    if(is_admin() && !defined('DOING_AJAX'))
	    	return;

	    $price = 1;
	    $fee_country = array('IN', 'PK', 'US');
	    $customer_country = $woocommerce->customer->get_shipping_country();
	    if(in_array($customer_country, $fee_country))
	    	$woocommerce->cart->add_fee('Additional Fee: ', $price, true);
	}

	// Product featured video
	// Single product page
	if(!function_exists('woocommerce_get_product_video')){
		add_filter('woocommerce_single_product_image_thumbnail_html', 'woocommerce_get_product_video');
		function woocommerce_get_product_video($html){
			$featured_video = get_field('featured_video', get_the_ID());
			if(!empty(trim($featured_video))){
				return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$featured_video.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			}
			else{
				return $html;
			}
		}
	}

	// Product archive Page
	function woocommerce_get_product_thumbnail($size='shop_catalog',$deprecated1=0,$deprecated2=0){
		global $post;

		$featured_video = get_field('featured_video', get_the_ID());
		if(!empty(trim($featured_video))){
			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$featured_video.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		else{
			$props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
			return get_the_post_thumbnail($post->ID, $image_size, array(
				'title' => $props['title'],
				'alt' => $props['alt']
			));
		}
	}





?>
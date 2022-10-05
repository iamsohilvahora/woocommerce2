<?php
/********************************************************************************************/
/*********************************** taxonomy archive page **********************************/
// WooCommerce support in theme
function pyramidtimesystems_wc_setup(){
	// add_theme_support("woocommerce");
	
	add_theme_support("woocommerce", array(
			// "thumbnail_image_width" => 150,
			// "single_image_width" => 150,
		));
	
	add_theme_support( 'wc-product-gallery-lightbox');
	add_theme_support("wc-product-gallery-slider");
	add_theme_support("wc-product-gallery-zoom");
}
add_action('after_setup_theme', 'pyramidtimesystems_wc_setup' ,100);

// Remove taxonomy archive description
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description');

// function wc_load_custom_hook_function_code(){
// 	wp_enqueue_script('pyramidtimesystems-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, false);
// 	// if(is_search()){
// 	// 	// Remove taxonomy archive description
// 	// 	// remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description');

// 	// 	wp_enqueue_script('pyramidtimesystems-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, false);

// 	// }
// }
// add_action('template_redirect', 'wc_load_custom_hook_function_code');

/*******************************************************************************************/
/*********************************** Product archive page **********************************/
// 3-1-22
// remove Woocommerce sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
// add_action('woocommerce_sidebar', 'add_viewed_product_content', 11);
// add_action('woocommerce_after_shop_loop', 'woocommerce_get_sidebar_content', 11);
// function woocommerce_get_sidebar_content(){
// 	echo "<p>hello</p>";
// }

// function add_viewed_product_content(){
	// echo "Product Sidebar";
	// echo do_shortcode('[woocommerce_recently_viewed_products]');
// }

// add_action("woocommerce_after_main_content", "open_sidebar_column", 11);

function wc_load_custom_hook_function_code(){
	// wp_enqueue_script('pyramidtimesystems-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, false);
		// wp_enqueue_script('pyramidtimesystems-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, false);
	// archive product page or search page
	if(is_search() || is_shop()){
		// start main wrapper
		// add_action('woocommerce_before_main_content', 'main_wrapper_start', 9);
		add_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

		// product loop start wrapper
		add_action('woocommerce_before_shop_loop', 'product_wrapper_start', 11);
		add_action('woocommerce_after_shop_loop', 'product_wrapper_end', 11);

		// display sidebar after product loop
		add_action('woocommerce_after_shop_loop', 'sidebar_wrapper_start', 12);
		add_action('woocommerce_after_shop_loop', 'woocommerce_get_sidebar', 13);
		add_action('woocommerce_after_shop_loop', 'woocommerce_get_product_wishlist', 14);

		// product loop end wrapper
		add_action('woocommerce_after_shop_loop', 'product_wrapper_end', 15);

		// end main wrapper
		// add_action('woocommerce_after_main_content', 'main_wrapper_end', 11);
		// add_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_action('woocommerce_after_main_content', 'product_wrapper_end', 10);
	}

	// if(is_cart()){
	// 	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	// }

	// product detail page
	if(is_single()){
		add_action('woocommerce_shop_loop_item_title', 'wc_start_related_product_wrapper', 9);
		add_action('woocommerce_after_shop_loop_item_title', 'wc_end_related_product_wrapper', 11);
		add_action('woocommerce_before_shop_loop_item', 'wc_show_related_product_checkbox', 9);
	}

	// cart page
	if(is_cart()){
		add_filter('woocommerce_product_cross_sells_products_heading', 'wc_product_cross_sells_products_heading');

	}

}
add_action('template_redirect', 'wc_load_custom_hook_function_code');

function woocommerce_output_content_wrapper(){
		echo '<div class="main-content-wrap">';
}

function woocommerce_output_content_wrapper_end(){
  	echo '</div>';
}

function product_wrapper_start(){
	  echo '<div class="two_col">';
	  echo '<div class="left-bar">';
}

function product_wrapper_end(){
  echo '</div>';
  // echo '<div class="clearfix"></div>';
}

function woocommerce_get_product_wishlist(){
	echo do_shortcode('[ti_wishlistsview]');
}

function sidebar_wrapper_start(){
	echo '<div class="right-bar">';
}

// function main_wrapper_end(){
//   echo '</div>';
// }	

// add_action("woocommerce_after_main_content", "open_sidebar_column", 11);
// add_action("woocommerce_after_main_content", "add_viewed_product_content", 12);
// add_action("woocommerce_after_main_content", "close_sidebar_column", 13);

// function open_sidebar_column(){
// 		echo '<div class="archive_product_sidebar">';
// }
// function close_sidebar_column(){
// 		echo '</div>';
// }

// 3-1-22
// Add product short description after product title
function product_short_description(){
	the_excerpt();
}
add_action('woocommerce_after_shop_loop_item_title', 'product_short_description', 4);

// Remove add to cart button 
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Add shop Now button after product price
function woocommerce_shop_now_button(){
	global $product;
	echo '<a href="'.get_permalink($product->ID).'">Shop Now <i class="fa fa-chevron-circle-right"></i></a>';
}
add_action('woocommerce_after_shop_loop_item', 'woocommerce_shop_now_button', 10);

// Remove result count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove catalog ordering
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Restrict product search to redirect on single page
function wc_remove_search_redirect(){
    return false;	 	 
}
add_filter('woocommerce_redirect_single_search_result', 'wc_remove_search_redirect', 10);

// 5-1-22
// add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
// 	return array(
// 		'width'  => 250,
// 		'height' => 250,
// 		'crop'   => 1,
// 	);
// } );

/************************************************************************************/
/************************************ Single Product Page ***************************/
// Show product title in mobile above image in single product page
function wc_template_single_title(){
	global $product;

	echo '<div class="mobile_product_title">'.$product->get_title().'</div>';
} 
add_action('woocommerce_before_single_product_summary', 'wc_template_single_title', 9);


// Show product is in stock or not in single product page
function show_product_stock_availabity(){
	global $product;
	$stock = $product->get_stock_quantity();

	if($product->is_in_stock() && $product->managing_stock()){
		echo '<div class="product_in_stock">IN STOCK</div>';
	} 
	else{
		echo '<div class="product_out_of_stock">OUT OF STOCK</div>';
	}
}
add_action('woocommerce_single_product_summary', 'show_product_stock_availabity', 11);

// Show contact number in single product page after add to cart button
function wc_show_contact_number(){
	echo '<div class="phone-order">
	    	<a href="tel:8884797264"><i class="fa fa-phone" aria-hidden="true"></i>888-479-7264</a>
	      </div>';
}
add_action('woocommerce_single_product_summary', 'wc_show_contact_number', 31);

// Hide the "In stock" message on single product page.
function woocommerce_hide_stock_message($html, $product){
	if($product->is_in_stock()){
		return '';
	}
	return $html;
}
add_filter('woocommerce_get_stock_html', 'woocommerce_hide_stock_message', 10, 2);

// Remove woocommerce single product meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Add wishlist in single product page
function wc_show_product_wishlist(){
	echo "<div class='wc_wishlist_share_wrapper'>";
	echo do_shortcode('[ti_wishlists_addtowishlist]');
}
add_action('woocommerce_single_product_summary', 'wc_show_product_wishlist', 31);

// close wishlist social share wrapper
function wc_close_wishlist_share_wrapper(){
	echo "</div>";
}
add_action('woocommerce_single_product_summary', 'wc_close_wishlist_share_wrapper', 61);

// Remove related product from single product page
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// customize product data tabs of single product page
function load_single_product_data_tabs($tabs){
	global $product;
	// print_r($tabs);
	// unset($tabs['additional_information']);
	// Description
	$tabs['description']['title'] = "Description";

	// Specs
	$tabs['additional_information']['title'] = "Specs";
	$tabs['additional_information']['priority'] = 11;
	$tabs['additional_information']['callback'] = "func_display_product_specs";

	// Accessories
	$tabs['accessories']['title'] = "Accessories";
	$tabs['accessories']['priority'] = 12;
	// $tabs['accessories']['callback'] = "func_accessories_template";
	$tabs['accessories']['callback'] = "woocommerce_output_related_products";

	// Downloads
	$tabs['downloads']['title'] = "Downloads";
	$tabs['downloads']['priority'] = 13;
	$tabs['downloads']['callback'] = "func_download_template";

	return $tabs;
}
add_filter('woocommerce_product_tabs' ,'load_single_product_data_tabs');

/**
 * load Product Data area of Edit Product page 
 */
require get_template_directory().'/inc/product-custom-tab.php';

/**
 * load product data tabs of single product page
 */
require get_template_directory().'/inc/product-tab.php';

// Customer also viewed section
add_action('woocommerce_after_single_product_summary', 'get_recently_viewed_product', 21);
function get_recently_viewed_product(){
	dynamic_sidebar('recent_view_product');
}

// add hidden field for related product in single product page
add_action('woocommerce_before_add_to_cart_quantity', 'get_hidden_related_products_field', 29);

function get_hidden_related_products_field($product){
	global $product;
	?>
	<div class="no-display">
		<input type="hidden" name="main_product" value="<?php echo $product->get_id(); ?>">
		<input type="hidden" name="related_product_list" id="related-products-field" value="">
	</div>

<?php }

// show related product checkbox inside product list in single product page
function wc_show_related_product_checkbox(){
	global $product;
	$product_id = $product->get_id();

	echo '<input type="checkbox" class="checkbox related-checkbox" id="related-checkbox'.$product_id.'" name="related_product_value[]" value="'.$product_id.'">';
}

// show start div above related product title in single product page
function wc_start_related_product_wrapper(){
	echo '<div class="related_product_wrapper">';
}

// show end div after price in single product page
function wc_end_related_product_wrapper(){
	echo "</div>";
}

/********************************************************************************************/
/************************************ Cart Page *********************************************/
// Show cart title and proceed to checkout button above cart product table
function wc_show_cart_title(){
	echo '<div class="cart-page-title checkout-button">
	    	<h1>Shopping Cart</h1>';
}
add_action('woocommerce_before_cart', 'wc_show_cart_title', 7);

add_action('woocommerce_before_cart', 'woocommerce_button_proceed_to_checkout', 8);
function wc_close_title_checkout_wrapper(){
	echo "</div>";
}
add_action('woocommerce_before_cart', 'wc_close_title_checkout_wrapper' ,9);

// add shipping content besides cart product table
function  wc_show_shipping_content(){
	echo "<p>We ship our products to the continental US, Puerto Rico, and Canada only. For shipments to Puerto Rico, please choose either FedEx International or UPS Worldwide Express Saver. Delivery times are subject to product availability at the time of purchase. Orders placed after 12pm EST will be processed the next business day with the exception of TimeTrax Version 5 software and upgrade purchases.</p>";
}
add_action('woocommerce_before_cart_collaterals', 'wc_show_shipping_content', 2);
// add_action('woocommerce_cart_contents', 'wc_show_shipping_content', 11);

// show coupon form in cart page
function display_coupon_form_above_proceed_checkout(){
     if(wc_coupons_enabled()){ ?>
     <form class="woocommerce-cart-form" id="discount-coupon-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post" autocomplete="off">
         <div class="discount">
             <h2>Discount Codes</h2>
             <div class="discount-form">
                 <label for="coupon_code">Discount Codes</label>
                 <input type="hidden" name="remove" id="remove-coupon" value="0">
                 <div class="field-wrapper">
     	            <input class="input-text" type="text" id="coupon_code" name="coupon_code" value="">
     	            
     	            <div class="validation-advice" id="advice-required-entry-coupon_code" style="">This is a required field.</div>
     	           
     	            <?php do_action('woocommerce_cart_coupon'); ?>
     	  
     				<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>" id="apply_coupon_button"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
     			
     				<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                 </div>
             </div>
         </div>
     </form>

     <?php }
}
// add_action( 'woocommerce_before_cart_collaterals', 'display_coupon_form_above_proceed_checkout', 2 );

// check for empty-cart get param to clear the cart
add_action('init', 'wc_empty_cart_action');
function wc_empty_cart_action(){
  // global $woocommerce;
	// $woocommerce->cart->empty_cart(); 
	
	if(isset($_GET['empty_cart']) && 'yes' === $_GET['empty_cart']){
		WC()->cart->empty_cart();

		$referer = wp_get_referer() ? esc_url(remove_query_arg('empty_cart')) : wc_get_cart_url();
		wp_safe_redirect($referer);
	}
}

// remove default empty cart message
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );

// add custom empty cart message in cart page
function wc_cart_is_empty_message(){ ?>
	<div class="col-main">
			<div class="page-title">
    			<h1>Shopping Cart is Empty</h1>
			</div>
			<div class="cart-empty">
            	<p>You have no items in your shopping cart.</p>
    			<p>Click <a href="<?php echo get_site_url(); ?>">here</a> to continue shopping.</p>
    		</div>
        </div> 
<?php } 
add_action('woocommerce_cart_is_empty', 'wc_cart_is_empty_message', 11);

// display cross sells product heading in cart page
function wc_product_cross_sells_products_heading(){
	echo "<h2>Based on your selection, you may be interested in the following items:</h2>";
}

// display cusom add to cart message in cart page
add_filter('wc_add_to_cart_message_html', function($string, $product_id = 0){
	$start = strpos( $string, '<a href=' ) ?: 0;
	$end = strpos( $string, '</a>', $start ) ?: 0;
	return substr( $string, $end ) ?: $string;
});

// local project work
// add product title above images
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 9);

// Customize woocommerce shop page for variable product
function wc_template_loop_product_thumbnail(){
	global $post, $wp_query, $woocommerce, $attributes;

    $image_id = wc_get_product()->get_gallery_image_ids()[0] ; 

    // Change product thumbnail image on hover
    if($image_id){
        echo wp_get_attachment_image($image_id);
    } 
    else{  //assuming not all products have galleries set
        echo wp_get_attachment_image(wc_get_product()->get_image_id()) ; 
    }

    $product = wc_get_product($wp_query->post);

    $output = "";
    if( $product->is_type( 'variable' ) ) {
    	if($product->is_in_stock()){
    		$output .= '<span class="sizes">Available sizes: </span><br/>';

        	// get all variation of products 
        	$variations = $product->get_available_variations();
        
        	foreach($variations as $variation){
				$variation_id = $variation['variation_id'];
                $variation_obj = new WC_Product_variation($variation_id);
                $stock = $variation_obj->get_stock_quantity();
               
                $dummy = $variation_obj->get_variation_attributes();

                if((is_int($stock) || ctype_digit($stock)) && (int)$stock > 0){
                    $output .= '<a class="availSize" href="'.get_permalink($post->ID).'?size='.$dummy['attribute_pa_size'].'&product_id='.$post->ID.'" data-size="10" data-product_id="101"><span>' . strtoupper($dummy['attribute_pa_size']) . '</span></a><br />';
                } 
                else{
                    $output .= '<a class="unavailSize" style="color: red;"><span>' . strtoupper($dummy['attribute_pa_size']) . '</span></a><br />';
                }
			}
			$output .= "<div class='wc_wishlist_share_wrapper'>";
		    $output .= do_shortcode('[ti_wishlists_addtowishlist]');
			$output .= "</div>";	
    	}
	}
    echo $output;
}
add_action('woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_thumbnail', 10); 

// Limit woocommerce product quantity input in woocommerce
function woocommerce_quantity_input($args = array(), $product = null, $echo = true){
	if(is_null($product)){
		$product = $GLOBALS['product'];
	}

	$defaults = array(
	  'input_id' => uniqid('quantity_'),
	  'input_name' => 'quantity',
	  'input_value' => '1',
	  'classes' => apply_filters('woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product),
	  'max_value' => apply_filters('woocommerce_quantity_input_max', -1, $product),
	  'min_value' => apply_filters('woocommerce_quantity_input_min', 0, $product),
	  'step' => apply_filters('woocommerce_quantity_input_step', 1, $product),
	  'pattern' => apply_filters('woocommerce_quantity_input_pattern', has_filter('woocommerce_stock_amount', 'intval') ? '[0-9]*' : ''),
	  'inputmode' => apply_filters('woocommerce_quantity_input_inputmode', has_filter('woocommerce_stock_amount', 'intval') ? 'numeric' : ''),
	  'product_name' => $product ? $product->get_title() : '',
	);

	$args = apply_filters('woocommerce_quantity_input_args', wp_parse_args($args, $defaults), $product);

	// 15-3-22
	// get placed order quantity details
	global $post;
	$product_id = $post->ID;

	$customer = wp_get_current_user();

	// Get all customer orders
	$customer_orders = get_posts(array(
	    'numberposts' => -1,
	    'meta_key' => '_customer_user',
	    'orderby' => 'date',
	    'order' => 'DESC',
	    'meta_value' => get_current_user_id(),
	    'post_type' => wc_get_order_types(),
	    'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('wc-processing'),
	));

	$Order_Array = [];
	$order_data = [];
    foreach($customer_orders as $customer_order){
        $orderq = wc_get_order($customer_order);

		foreach($orderq->get_items() as $item_id => $item){
			if($item->get_product_id() == $product_id){
				$order_data[] = [
					"order_id" => $item->get_order_id(),
					"product_id" => $item->get_product_id(),
					"product_name" => $item->get_name(),
					"quantity" => $item->get_quantity(),
				];
			}
		}
    }

    $count_order_data = count($order_data);
    if($count_order_data == 1){
    	$order_id = $order_data[0]['order_id'];
		$product_quantity = $order_data[0]['quantity'];

		// $max_product_quantity = 1;
    }
    else{
    	// $max_product_quantity = 2;	
    }

    if(!empty($order_id)){
    	$order = wc_get_order($order_id);
    }
    
    if(!empty($order)){
	    $ordered_date_time = $order->get_date_created()->date_i18n('Y-m-d H:i:s');
	    $Ordered_date_time_second = strtotime($ordered_date_time);

	    $new_date_time = date('Y-m-d H:i:s',strtotime('+24 hours',strtotime($ordered_date_time)));
	    $new_date_time_second = strtotime($new_date_time);

	    $current_date_time = date('Y-m-d H:i:s');
	    $current_date_time_second = strtotime($current_date_time);
    }

    $max_product_quantity = 2;
	if(!empty($product_quantity)){
	   	if($product_quantity == 1){
	   		// echo "You can order maximum of 2 product";
	   		$max_product_quantity = 1;
	   	}
	   	else if($product_quantity == 2){
	   		if($current_date_time_second < $new_date_time_second ){
	   			// echo "You cannot order this product, because you try to exceed maximum limit of 2, so you can order after 24 hour.";
	   			
	   			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	   			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	   		}
	   		else{
	   			// echo "You can order maximum of 2 product";
	   			$max_product_quantity = 2;
	   		}
	   	}
    }
	// 15-3-22


	// Apply sanity to min/max args - min cannot be lower than 0.
	$args['min_value'] = max( $args['min_value'], 0 );
	// Note: change 2 to whatever you like
	$args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : $max_product_quantity;

	// Max cannot be lower than min if defined.
	if('' !== $args['max_value'] && $args['max_value'] < $args['min_value']){
		$args['max_value'] = $args['min_value'];
	}

	$options = '';
	for($count = $args['min_value'];$count <= $args['max_value'];$count = $count + $args['step']){
		// Cart item quantity defined?
		if('' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value']){
			$selected = 'selected';      
		} 
		else $selected = '';

		$options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
	}
	 
	$string = '<div class="quantity"><span>Qty</span><select name="' . $args['input_name'] . '">' . $options . '</select></div>';

	if($echo){
		echo $string;
	} 
	else{
		return $string;
	}
}

// /*
// * Changing the minimum quantity to 1 for all the WooCommerce products
// */

// function woocommerce_quantity_input_min_callback( $min, $product ) {
// 	$min = 1;  
// 	return $min;
// }
// add_filter( 'woocommerce_quantity_input_min', 'woocommerce_quantity_input_min_callback', 10, 2 );

// /*
// * Changing the maximum quantity to 2 for all the WooCommerce products
// */

// function woocommerce_quantity_input_max_callback( $max, $product ) {
// 	$max = 2;  
// 	return $max;
// }
// add_filter( 'woocommerce_quantity_input_max', 'woocommerce_quantity_input_max_callback', 10, 2 );

// Get placed order information in product detail page
function wc_get_placed_order_info(){
	global $post;
	$product_id = $post->ID;

	$customer = wp_get_current_user();

	// Get all customer orders
	$customer_orders = get_posts(array(
	    'numberposts' => -1,
	    'meta_key' => '_customer_user',
	    'orderby' => 'date',
	    'order' => 'DESC',
	    'meta_value' => get_current_user_id(),
	    'post_type' => wc_get_order_types(),
	    'post_status' => array_keys(wc_get_order_statuses()), 
	    'post_status' => array('wc-processing', 'wc-completed'),
	));

	$Order_Array = [];
	$order_data = [];
    foreach($customer_orders as $customer_order){
        $orderq = wc_get_order($customer_order);

		foreach($orderq->get_items() as $item_id => $item){
			// echo "<pre>";
   //      	print_r($item);

			if($item->get_product_id() == $product_id){
				$order_data[] = [
					"order_id" => $item->get_order_id(),
					"product_id" => $item->get_product_id(),
					"product_name" => $item->get_name(),
					"quantity" => $item->get_quantity(),
				];
			}
		}
    }

    $count_order_data = count($order_data);

    // echo "<br />";
    // echo "<pre>";
    // print_r($order_data);
    // echo "<br />";
    // echo $count_order_data;
    // echo "<br />";

    if($count_order_data == 1){
    	$order_id = $order_data[0]['order_id'];
		$product_quantity = $order_data[0]['quantity'];
    }
    else if($count_order_data == 2){
    	$order_id = $order_data[0]['order_id'];
    	// $product_quantity = $order_data[1]['quantity'];
    	$product_quantity = 2;
    }
    
    // echo $order_id;
    if(!empty($order_id)){
    	$order = wc_get_order($order_id);
    }
    
    if(!empty($order)){
	    $ordered_date_time = $order->get_date_created()->date_i18n('Y-m-d H:i:s');
	    $Ordered_date_time_second = strtotime($ordered_date_time);

	    $new_date_time = date('Y-m-d H:i:s',strtotime('+24 hours',strtotime($ordered_date_time)));
	    $new_date_time_second = strtotime($new_date_time);

	    $current_date_time = date('Y-m-d H:i:s');
	    $current_date_time_second = strtotime($current_date_time);
    }

	if(!empty($product_quantity)){
	   	if($product_quantity == 1){
	   		echo "You can order maximum of 2 product";
	   	}
	   	else if($product_quantity == 2){
	   		if($current_date_time_second < $new_date_time_second ){
	   			echo "You cannot order this product, because you try to exceed maximum limit of 2, so you can order after 24 hour.";
	   			
	   			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	   			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	   		}
	   		else{
	   			echo "You can order maximum of 2 product";
	   		}
	   	}
    }
}

add_action('woocommerce_single_product_summary', 'wc_get_placed_order_info', 29);
?>
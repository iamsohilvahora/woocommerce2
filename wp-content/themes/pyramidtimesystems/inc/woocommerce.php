<?php
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

	echo "<pre>";
	print_r($customer_orders);
	echo "</pre>";
	

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
<?php 
// remove sidebar action 
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

//add div woocommerce_before_main_content (archove-product.php)
function open_container_div_class(){
	echo '<div class="container"><div class="row">';
}

function close_container_div_class(){
	echo '</div></div>';
}

add_action("woocommerce_before_main_content", "open_container_div_class", 5);
add_action("woocommerce_after_main_content", "close_container_div_class", 5);

function load_template_layout(){
	if(is_shop()){
		//col-sm-4 => sidebar
		//col-sm-8 => product grid

		//add sidebar grid
		function open_sidebar_column(){
			echo '<div class="col-md-4">';
		}

		function close_sidebar_column(){
			echo '</div>';
		}

		//add product grid
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

//remove page title (e.g. Shop)
function show_page_title($val){
	$val = false;
	return $val;
}

add_filter("woocommerce_show_page_title", "show_page_title");

// add description after product title 
// add_action("woocommerce_after_shop_loop_item_title", "the_excerpt");

//remove breadcrumb (Home / Shop)
remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb",20);
remove_action("woocommerce_before_shop_loop", "woocommerce_result_count",20);
remove_action("woocommerce_before_shop_loop", "woocommerce_catalog_ordering",30);




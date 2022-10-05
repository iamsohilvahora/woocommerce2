<?php
/**
 * pyramidtimesystems functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pyramidtimesystems
 */

if(!defined('_S_VERSION')){
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
define('RECAPTCHA_SITE_KEY', '6Ldg9Q0iAAAAAAGWdWdD8hYpDw0_UssMQztjzeWv');
define('RECAPTCHA_SECRET_KEY', '6Ldg9Q0iAAAAAG3C0wv7pVTEGSBLgNO2no7ZkJNp' );


if ( ! function_exists( 'pyramidtimesystems_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pyramidtimesystems_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pyramidtimesystems, use a find and replace
		 * to change 'pyramidtimesystems' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pyramidtimesystems', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'pyramidtimesystems' ),
				'menu-2' => esc_html__( 'Secondary', 'pyramidtimesystems' ),
				'menu-3' => esc_html__( 'About Us', 'pyramidtimesystems' ),
				'menu-4' => esc_html__( 'News Type', 'pyramidtimesystems' ),
				'menu-5' => esc_html__( 'Resources', 'pyramidtimesystems' ),
				'menu-6' => esc_html__( 'Social Icons', 'pyramidtimesystems' ),
				'menu-7' => esc_html__( 'Industry Applications', 'pyramidtimesystems' ),
				'menu-8' => esc_html__( 'Support', 'pyramidtimesystems' ),
			),
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pyramidtimesystems_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		add_theme_support( 'woocommerce' );
	}
endif;
add_action( 'after_setup_theme', 'pyramidtimesystems_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pyramidtimesystems_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pyramidtimesystems_content_width', 640 );
}
add_action( 'after_setup_theme', 'pyramidtimesystems_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pyramidtimesystems_widgets_init() {
	// Register sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pyramidtimesystems' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pyramidtimesystems' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Register Footer 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'pyramidtimesystems' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pyramidtimesystems' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Register Footer 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'pyramidtimesystems' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pyramidtimesystems' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Register Footer 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'pyramidtimesystems' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'pyramidtimesystems' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


}
add_action( 'widgets_init', 'pyramidtimesystems_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pyramidtimesystems_scripts() {
	wp_enqueue_style( 'pyramidtimesystems-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pyramidtimesystems-style', 'rtl', 'replace' );

	wp_enqueue_script( 'pyramidtimesystems-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'pyramidtimesystems-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	wp_localize_script('pyramidtimesystems-main', 'pyramid', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php'), 
		'sitekey' => RECAPTCHA_SITE_KEY,
	)); 
	// google recaptcha
	wp_enqueue_script( 'pyramidtimesystems-google-recaptcha', "https://www.google.com/recaptcha/api.js?render=".RECAPTCHA_SITE_KEY, array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pyramidtimesystems_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/***********************************************************************************/
/*********************************** Load assets ***********************************/
function wp_load_assets(){
	wp_enqueue_style( 'google-font', "https://fonts.googleapis.com/css?family=Oswald", array(), '1.0' );
	wp_enqueue_style( 'font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css", array(), '4.5.0' );
	     

	// wp_enqueue_script( 'pyramidtimesystems-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );	
}
add_action('wp_enqueue_scripts', 'wp_load_assets');

// Year shortcode
function year_shortcode(){
	$year = date('Y');
	return $year;
}
add_shortcode ('year', 'year_shortcode');

// Header cart menu and search
function wp_menu_serach_shortcode_func(){
	wp_nav_menu(
		array(
			'theme_location' => 'menu-2',
			'menu_id'        => 'secondary-menu',
		)
	);

?>
	<form role="search" method="get" action="<?php echo get_permalink( wc_get_page_id( 'shop' ) );?>">
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

		                $orderby = 'name';
		                $order = 'asc';
		                $hide_empty = false ;
		                $cat_args = array(
		                    'orderby'    => $orderby,
		                    'order'      => $order,
		                    'hide_empty' => $hide_empty,
		                    'parent' => 0,
		                    'hierarchical' => true,		                    
							'hide_empty'   => false



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
 
	


<?php
}


/**
 *  Load all woocommerce hooks 
 */
require get_template_directory().'/inc/woocommerce2.php';

// add_shortcode('menu_search_shortcode', 'wp_menu_serach_shortcode_func');

// advanced search functionality
// function advanced_search_query($query) {
//     if($query->is_search()) {
//         // category terms search.
//         if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
// 			echo "asdfg";
// 			// echo "<br />";
// 			// echo $_GET['product_cat']; 

//             $query->set('tax_query', array(array(
//                 'taxonomy' => 'product_cat',
//                 'field' => 'term_id',
//                 'terms' => $_GET['product_cat'],
//             	'operator' => 'IN'
//             	)
//             ));
//         }    
//     }

//     // echo "<pre>";
//     // print_r($query);
//     return $query;
// }
// add_action('pre_get_posts', 'advanced_search_query', 1000);


// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '300' );

// define the actions for hooks
// add_action("wp_ajax_selected_variable_products", "selected_variable_products");
// add_action("wp_ajax_nopriv_selected_variable_products", "selected_variable_products");

// function selected_variable_products(){
// 	print_r($_POST['data']);
	
// 	if(isset($_POST['data'])){
// 		$variable_product =  $_POST['data'];

// 		echo $variable_product['size']." - ".$variable_product['product_id'];

//         // die;
// 	}
// }

// function max_title_length( $title ) {
// 	$max = 10;
// 	if(strlen($title) > $max){
// 		return substr( $title, 0, $max ). " &hellip;";
// 	} 
// 	else{
// 		return $title;
// 	}
// }
// add_filter( 'the_title', 'max_title_length');

// Enqueue style and script for admin panel 
function pyramid_admin_script(){
	wp_enqueue_script( 'pyramidtimesystems-admin', get_template_directory_uri() . '/js/admin.js', array(), _S_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'pyramid_admin_script' );

// Set character limit for post title and post content
function wp_insert_post_func($post){
	// If post status is trash then do nothing
	if($post->post_status == 'trash' || $post->post_status == 'inherit') return;

	// verify this is not an auto save routine. 
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	// Get post title and post content
	$title = $post->post_title;
	$content = $post->post_content;

	// echo "<br />";
	// echo $post_id;
	// echo "<br />";
	// echo $title;
	// echo "<br />";
	// echo $content;

	// wp_die(__('vcvc characters.'));
	
	// get character length of post title and post content
	// $title_length = strlen(trim($title));
	// $content_length = strlen(trim(strip_tags($content)));

	// // check if post title is not empty 
	// if(!empty(trim($title))){
	// 	if($title_length > 300){ // maximum of 300 characters
	//     	wp_die(__('Your post title length is maximum 300 characters.'));
	// 	}
	// }
	
	// // check if post content is not empty
	// if(!empty(trim($content))){
	// 	if($content_length <= 300){ // minimum of 300 characters
	// 	    wp_die(__('Your post content length is minimum 300 characters.'));
	// 	}
	// }
}
// add_action('publish_post', 'wp_post_max_letter_count', 1);
// add_action('save_post', 'wp_insert_post_func',10, 2);


/**  
 * add js script to footer 
 */
function wp_footer_script_code_func(){
?>
<!-- Google map js api -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0N_W6XGNLvCVl4VSuSMFUWYQk93Yb_1g&callback=initMap"></script> -->

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0N_W6XGNLvCVl4VSuSMFUWYQk93Yb_1g&libraries=places"> -->

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0N_W6XGNLvCVl4VSuSMFUWYQk93Yb_1g&libraries=places" async defer></script> -->

<?php
};
// add_action('wp_footer', 'wp_footer_script_code_func');

function wc_checkout_enqueue_scripts(){
    if(function_exists('is_checkout') && is_checkout()){
        // My Key
        $api_key = "AIzaSyD0N_W6XGNLvCVl4VSuSMFUWYQk93Yb_1g";
        
        // Another key 
        // $api_key = "AIzaSyBIWSqJ5-3D-UviE0ZLO4U6AjhVcn58y4g";
        // $url = "https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initAutocomplete"
        //         async defer";
        $url = "https://maps.googleapis.com/maps/api/js?key=$api_key&libraries=places";
        // $url = "https://maps.googleapis.com/maps/api/js?key=$api_key&sensor=false&libraries=places";
        // $url = "http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-AU";

        wp_enqueue_script('google-maps-js', $url);            
    }
}
add_action('wp_enqueue_scripts', 'wc_checkout_enqueue_scripts');

// General setting acf for option page
if(function_exists('acf_add_options_page')){
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// action and function for add product data
add_action('wp_ajax_add_product_data', 'wc_add_product_data');
add_action('wp_ajax_nopriv_add_product_data', 'wc_add_product_data');

// action and function for edit product data
add_action('wp_ajax_edit_product_data', 'wc_edit_product_data');
add_action('wp_ajax_nopriv_edit_product_data', 'wc_edit_product_data');

// action and function for delete product data
add_action('wp_ajax_delete_customer_product', 'wc_delete_customer_product_func');
add_action('wp_ajax_nopriv_delete_customer_product', 'wc_delete_customer_product_func');


function wc_add_product_data(){
	if($_POST['action'] == 'add_product_data'){
		$site_url = get_site_url(); // get site url
		
		$product_images = []; // empty array

		$product_name = $_POST['proname'];
		$product_desc = $_POST['prodesc'];
		$product_price = $_POST['proprice'];
		$product_cat = $_POST['procat'];

		// Get categories
		if(!empty($product_cat)){
			for($cat=0;$cat<count($product_cat);$cat++){
				$product_category[]['id'] = $product_cat[$cat];
			}
		}

		// Get attributes
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if(!empty($attribute_taxonomies)):
			$i = 0;
			foreach($attribute_taxonomies as $tax):
				foreach($_POST as $key => $value){
					if($key == $tax->attribute_name ){
						if(!empty($_POST[$tax->attribute_name][0])){
							$product_attr[$i]['name'] = $tax->attribute_name;
							$product_attr[$i]['options'][] = $_POST[$tax->attribute_name][0];
						}
						$i++;
					}
				}
			endforeach;
		endif;

		// Upload product featured image
		if(!empty($_FILES['productFeaturedImg']['name'])){
			$wordpress_upload_dir = wp_upload_dir();
			// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2022/06, for multisite works good as well
			// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
			$i = 1; // number of tries when the file with the same name is already exists

			$productFeaturedImg = $_FILES['productFeaturedImg'];
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $productFeaturedImg['name'];
			$new_file_mime = mime_content_type($productFeaturedImg['tmp_name']);

			while(file_exists($new_file_path)){
				$i++;
				$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $productFeaturedImg['name'];
			}

			$product_image_file_path = "";
			if(move_uploaded_file($productFeaturedImg['tmp_name'], $new_file_path)){
				$upload_id = wp_insert_attachment(array(
					'guid'           => $new_file_path, 
					'post_mime_type' => $new_file_mime,
					'post_title'     => preg_replace( '/\.[^.]+$/', '', $productFeaturedImg['name'] ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				), $new_file_path);

				// wp_generate_attachment_metadata() won't work if you do not include this file
				require_once(ABSPATH . 'wp-admin/includes/image.php');

				// Generate and save the attachment metas into the database
				wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));

				// Show the uploaded file in browser
				// wp_redirect($wordpress_upload_dir['url'] . '/' . basename($new_file_path));
				$product_image_file_path = $wordpress_upload_dir['url'] . '/' . basename($new_file_path); // uploaded image
				
				$product_images[]['src'] = $product_image_file_path; 
			}
		}

		// Upload product gallery
		if(!empty($_FILES['productGallery']['name'][0])){
	        $files = $_FILES['productGallery'];

	        foreach ($files['name'] as $key => $value){
	            if($files['error'][$key] == 1){ continue; }  // Check for error

	            if ($files['name'][$key]){
	                $file = array(
	                'name' => $files['name'][$key],
	                'type' => $files['type'][$key],
	                'tmp_name' => $files['tmp_name'][$key],
	                'error' => $files['error'][$key],
	                'size' => $files['size'][$key]
	                );
	            }
	            $_FILES = array("muti_files" => $file);
	            $i=1;

				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/media.php');

                foreach($_FILES as $file => $array){
                    	// if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) continue;
                        if($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();
                        
                        $attachment_id = media_handle_upload($file, $post_id);
                        $vv .= $attachment_id . ",";
                        $i++;

                        $product_images[]['src'] = wp_get_attachment_image_src($attachment_id, 'medium')[0];
                }
                update_post_meta($post_id, '_product_image_gallery',  $vv);
			}
		}

		// $client_key = "ck_64dc9790e0686fec661acbb2672473263433af33";
		// $client_secret = "cs_ba33d56a42e0dafcc4c2504fb0037f5ac32c699c";
		$user = "pyramidtimesystems";
		$pass = "pyramidtimesystems@123";

		// Insert product details
		$api_response = wp_remote_post("{$site_url}/wp-json/wc/v3/products", array(
		 	'headers' => array(
				'Authorization' => 'Basic ' . base64_encode("{$user}:{$pass}")
			),
			'body' => array(
				'name' => $product_name, // product title
				'status' => get_field('select_customer_status', 'options'), // product status
				'short_description' => $product_desc,
				'regular_price' => $product_price, // product price
				'categories' => $product_category,
				'attributes' => $product_attr,
				"images" => $product_images,
			)
		));
		$body = json_decode($api_response['body']);
		if(wp_remote_retrieve_response_message($api_response) === 'Created'){
			// Update author for product
			$arg = array(
		    	'ID' => $body->id,
		    	'post_author' => get_current_user_id(),
			);
			wp_update_post($arg);

			echo json_encode(array(
				'status' => true,
				'message' => "The product has been created",
			));
			exit;
		}
	}
} 

function wc_edit_product_data(){
	if($_POST['action'] == 'edit_product_data'){
		$site_url = get_site_url(); // get site url

		$product_images = []; // empty array

		$product_id = $_POST['product_id'];
		$product_name = $_POST['proname'];
		$product_desc = $_POST['prodesc'];
		$product_price = $_POST['proprice'];
		$product_cat = $_POST['procat'];

		// Get categories
		if(!empty($product_cat)){
			for($cat=0;$cat<count($product_cat);$cat++){
				$product_category[]['id'] = $product_cat[$cat];
			}
		}

		// Get attributes
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if(!empty($attribute_taxonomies)):
			$i = 0;
			foreach($attribute_taxonomies as $tax):
				foreach($_POST as $key => $value){
					if($key == $tax->attribute_name ){
						if(!empty($_POST[$tax->attribute_name][0])){
							$product_attr[$i]['name'] = $tax->attribute_name;
							$product_attr[$i]['options'][] = $_POST[$tax->attribute_name][0];
						}
						$i++;
					}
				}
			endforeach;
		endif;

		// Upload product featured image
		if(!empty($_FILES['productFeaturedImg']['name'])){
			$wordpress_upload_dir = wp_upload_dir();
			// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2022/06, for multisite works good as well
			// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
			$i = 1; // number of tries when the file with the same name is already exists

			$productFeaturedImg = $_FILES['productFeaturedImg'];
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $productFeaturedImg['name'];
			$new_file_mime = mime_content_type($productFeaturedImg['tmp_name']);

			while(file_exists($new_file_path)){
				$i++;
				$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $productFeaturedImg['name'];
			}

			$product_image_file_path = "";
			if(move_uploaded_file($productFeaturedImg['tmp_name'], $new_file_path)){
				$upload_id = wp_insert_attachment(array(
					'guid'           => $new_file_path, 
					'post_mime_type' => $new_file_mime,
					'post_title'     => preg_replace( '/\.[^.]+$/', '', $productFeaturedImg['name'] ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				), $new_file_path);

				// wp_generate_attachment_metadata() won't work if you do not include this file
				require_once(ABSPATH . 'wp-admin/includes/image.php');

				// Generate and save the attachment metas into the database
				wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));

				// Show the uploaded file in browser
				// wp_redirect($wordpress_upload_dir['url'] . '/' . basename($new_file_path));
				$product_image_file_path = $wordpress_upload_dir['url'] . '/' . basename($new_file_path); // uploaded image
		
				$product_images[]['src'] = $product_image_file_path;
			}
		}
		else{
			$img_src = get_the_post_thumbnail_url($product_id);
			$product_images[]['src'] = $img_src;
		}

		// Upload product gallery
		if(!empty($_FILES['productGallery']['name'][0])){
	        $files = $_FILES['productGallery'];

	        foreach ($files['name'] as $key => $value){
	            if($files['error'][$key] == 1){ continue; }  // Check for error

	            if ($files['name'][$key]){
	                $file = array(
	                'name' => $files['name'][$key],
	                'type' => $files['type'][$key],
	                'tmp_name' => $files['tmp_name'][$key],
	                'error' => $files['error'][$key],
	                'size' => $files['size'][$key]
	                );
	            }
	            $_FILES = array("muti_files" => $file);
	            $i=1;

				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	            foreach ($_FILES as $file => $array) {
	                  // if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) continue;
	                  if($_FILES[$file]['error'] !== UPLOAD_ERR_OK) __return_false();

	                    $attachment_id = media_handle_upload($file, $post_id);
	                    $vv .= $attachment_id . ",";
	                    $i++;

	                    $product_images[]['src'] = wp_get_attachment_image_src($attachment_id, 'medium')[0];
	            }
	            update_post_meta($post_id, '_product_image_gallery',  $vv);
			}
		}
		else{
			$product = wc_get_product($product_id);
			$attachment_ids = $product->get_gallery_image_ids();

			foreach($attachment_ids as $attachment_id){
				$gallery_src = wp_get_attachment_url($attachment_id);
				$product_images[]['src'] = $gallery_src;
			}
		}

		// $client_key = "ck_64dc9790e0686fec661acbb2672473263433af33";
		// $client_secret = "cs_ba33d56a42e0dafcc4c2504fb0037f5ac32c699c";
		$user = "pyramidtimesystems";
		$pass = "pyramidtimesystems@123";

		// Update product details
		$api_response = wp_remote_post("{$site_url}/wp-json/wc/v3/products/{$product_id}", array(
			'method'    => 'PUT',
		 	'headers' => array(
				'Authorization' => 'Basic ' . base64_encode("{$user}:{$pass}")
			),
			'body' => array(
				'name' => $product_name, // product title
				'short_description' => $product_desc,
				'regular_price' => $product_price, // product price
				'categories' => $product_category,
				'attributes' => $product_attr,
				"images" => $product_images,
			)
		));

		$body = json_decode($api_response['body']);
		if(wp_remote_retrieve_response_message($api_response) === 'OK'){
			echo json_encode(array(
				'status' => true,
				'message' => "The product has been updated",
			));
			exit;
		}
	}
}

function wc_delete_customer_product_func(){
	if($_POST['action'] == 'delete_customer_product'){
		$site_url = get_site_url(); // get site url
		$product_id = $_POST['product_id']; // get product id

		$user = "pyramidtimesystems";
		$pass = "pyramidtimesystems@123";

		$api_response = wp_remote_post("{$site_url}/wp-json/wc/v3/products/{$product_id}", array(
			// ?force=true
			'method'    => 'DELETE',
		 	'headers' => array(
				'Authorization' => 'Basic ' . base64_encode("{$user}:{$pass}")
			),
		));

		$body = json_decode( $api_response['body'] );

		if(wp_remote_retrieve_response_message( $api_response ) === 'OK') {
			echo json_encode(array(
				'status' => true,
				'message' => "The product has been removed",
			));
			exit;
		}
		else{
			echo json_encode(array(
				'status' => false,
				'message' => "There is an error to remove product",
			));
			exit;	
		}
	}
}

// 20-6-22
// add product author on product list
function prefix_add_author_woocommerce(){
	add_post_type_support('product', 'author');
}
add_action('after_setup_theme', 'prefix_add_author_woocommerce');

// add account menu items
function wc_account_menu_items_func($menu_links){
	$menu_links = array_slice($menu_links, 0, 5, true)
	+ array('product-list' => 'Show Product List')
	+ array('add-product-form' => 'Customer Product Form')
	+ array_slice($menu_links, 5, NULL, true);
	return $menu_links;
}
add_filter('woocommerce_account_menu_items', 'wc_account_menu_items_func');

/*
 * Register Permalink Endpoint
*/
function wc_add_endpoint_func(){
	add_rewrite_endpoint('product-list', EP_PAGES);
	add_rewrite_endpoint('add-product-form', EP_PAGES);
	add_rewrite_endpoint('edit-product-form', EP_PAGES);
}
add_action('init', 'wc_add_endpoint_func');

/*
 * Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
*/
// Display customer product form
function wc_customer_product_form_func(){ ?> 
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<form method="post" class="product_form" enctype='multipart/form-data'>
				<div><h4>Add Product</h4></div>
				<div>
					<div><label>Product Name</label></div>
					<div><input type="text" name="proname" class="product_name" id="product_name" required /></div>
				</div>
				<div>
					<div><label>Product Description</label></div>
					<div><textarea name="prodesc" class="product_desc" id="product_desc" required></textarea></div>
				</div>
				<div>
					<div><label>Product Price</label></div>
					<div><input type="text" name="proprice" class="product_price" id="product_price" required /></div>
				</div>

				<div>
					<div><label>Select Product Categories</label></div>
					<div>
				  	<?php
						$taxonomy     = 'product_cat';
						$orderby      = 'name';  
						$show_count   = 0;      // 1 for yes, 0 for no
						$pad_counts   = 0;      // 1 for yes, 0 for no
						$hierarchical = 1;      // 1 for yes, 0 for no  
						$title        = '';  
						$empty        = 0;

						$args = array(
							'taxonomy'     => $taxonomy,
							'orderby'      => $orderby,
							'show_count'   => $show_count,
							'pad_counts'   => $pad_counts,
							'hierarchical' => $hierarchical,
							'title_li'     => $title,
							'hide_empty'   => $empty
						);
						$all_categories = get_categories($args);
						foreach ($all_categories as $cat){
							if($cat->category_parent == 0){
								$category_id = $cat->term_id; 

							 	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$category_id}' />".' '.$cat->name;
							 	echo "<br />";

								$args2 = array(
									'taxonomy'     => $taxonomy,
									'child_of'     => 0,
									'parent'       => $category_id,
									'orderby'      => $orderby,
									'show_count'   => $show_count,
									'pad_counts'   => $pad_counts,
									'hierarchical' => $hierarchical,
									'title_li'     => $title,
									'hide_empty'   => $empty
								);
							 	$sub_cats = get_categories($args2);
							 	if($sub_cats){
							    	foreach($sub_cats as $sub_category){
							        	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$sub_category->term_id}' />".' '."<b>$sub_category->name</b>";
							        	echo "<br />";
							     	}   
							 	}
							}       
						}
				    ?>
					</div>
				</div>

				<?php
				$attribute_taxonomies = wc_get_attribute_taxonomies();
				$taxonomy_terms = array();
				if(!empty($attribute_taxonomies)): ?>
				<div>
				    <?php
				  	foreach($attribute_taxonomies as $tax): ?>
						<div>
							<div><label>Select <?php echo $tax->attribute_name; ?> Attributes</label></div>
							<?php 
							if(taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))): ?>
							<div>
								<?php
								echo "<select name='{$tax->attribute_name}[]'>";
								echo "<option value=''>Select Attribute Value</option>";
							    $taxonomy_terms = get_terms(wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name');
							    foreach($taxonomy_terms as $term){
									echo "<option value='{$term->name}'>$term->name</option>";
							    }
								echo "</select>";
							?>
							</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<div>
				  <div><label>Uplaod Product Featured Image</label></div>
				  <div><input type="file" name="productFeaturedImg" id="fileToUpload" accept="image/*" required></div>
				</div>

				<div>
				  <div><label>Uplaod Product Gallery</label></div>
				  <div><input type="file" name="productGallery[]" id="galleryToUpload" accept="image/*" multiple required></div>
				</div>

				<input type="submit" value="Submit" class="product_submit" id="add_product" />
			</form>
		</main>
	</div>
<?php }
add_action('woocommerce_account_add-product-form_endpoint', 'wc_customer_product_form_func');


// Show list of product which is added by customer (author)
function wc_show_customer_product_list_func(){ 
	$author = (current_user_can('administrator')) ? '' : get_current_user_id();
	$status = (current_user_can('administrator')) ? 'any' : 'publish';
	$customer_access = get_field('choose_customer_access', 'options');

	$args = array(
	    'post_type' => 'product',
	    'post_status' => $status,
	    'posts_per_page' => -1,
	    'author' => $author,
	);
	$loop = new WP_Query($args);

	if($loop->have_posts()): ?>
		<h2>List of Customer's Product</h2>
		<table>
			<tr>
				<th>Id</th>
				<th>Product Name</th>
				<th>Product Price</th>
				<?php if(current_user_can('administrator')): ?>
					<th>Action</th>
				<?php elseif($customer_access): ?>
					<th>Action</th>
				<?php endif; ?>

				<?php if(current_user_can('administrator')): ?>
					<th>Author</th> 
				<?php endif; ?>
				<th>Status</th>
			</tr>
			<?php 
			$i=1;
			while($loop->have_posts()) : $loop->the_post(); 
				// Get $product object from product ID  
				$product = wc_get_product(get_the_id()); ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $product->get_name(); ?></td>
				<td><?php echo $product->get_price(); ?></td>
				<?php if(current_user_can('administrator')): ?>
					<td><a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>edit-product-form/?id=<?php echo get_the_id(); ?>" data-id="<?php echo get_the_id(); ?>" class="edit_product">Edit</a> 
				| <a href="javascript:void(0)" data-id="<?php echo get_the_id(); ?>" class="delete_product">Delete</a></td>
				<?php elseif($customer_access): ?>
					<td><a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>edit-product-form/?id=<?php echo get_the_id(); ?>" data-id="<?php echo get_the_id(); ?>" class="edit_product">Edit</a> 
									| <a href="javascript:void(0)" data-id="<?php echo get_the_id(); ?>" class="delete_product">Delete</a></td>
				<?php endif; ?>
				<?php if(current_user_can('administrator')): ?>
					<td><?php echo get_the_author(); ?></td>
				<?php endif; ?>
				<td><?php echo get_post_status(); ?></td>
			</tr>
			<?php endwhile; ?>
		</table>
	<?php
	else:
		echo __('No products found', 'textdomain');
    endif;    
	wp_reset_postdata();
 ?>

<?php }
add_action('woocommerce_account_product-list_endpoint', 'wc_show_customer_product_list_func');

function wc_edit_customer_product_list_func(){
	// Get product ids.
	if(isset($_GET['id'])){
		$product_id = $_GET['id'];
		$product = wc_get_product($product_id);
	}

	$author = (current_user_can('administrator')) ? '' : get_current_user_id();
	$status = (current_user_can('administrator')) ? true : ($product->get_status() == 'publish' ? true : false);
	$customer_access = get_field('choose_customer_access', 'options');
	$edit_access = (current_user_can('administrator')) ? true : ($customer_access == 1 ? true : false);
	$args = array(
	    'return' => 'ids',
	    'limit' => -1,
	    'author' => $author,
	);
	$product_ids = wc_get_products($args);  // get product id of current customer

	if(in_array($product_id, $product_ids) && $status && $edit_access){ 
		$product = wc_get_product($product_id); ?>
		<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<form method="post" class="edit_product_form" enctype='multipart/form-data'>
				<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
				<div><h4>Edit Product</h4></div>
				<div>
					<div><label>Product Name</label></div>
					<div><input type="text" name="proname" class="product_name" value="<?php echo $product->get_title(); ?>" required /></div>
				</div>
				<div>
					<div><label>Product Description</label></div>
					<div><textarea name="prodesc" class="product_desc" required><?php echo $product->get_short_description(); ?></textarea></div>
				</div>
				<div>
					<div><label>Product Price</label></div>
					<div><input type="text" name="proprice" class="product_price" id="new_product_price" value="<?php echo $product->get_price(); ?>" required /></div>
				</div>

				<div>
					<?php
						$product_cats_ids = wc_get_product_term_ids( $product->get_id(), 'product_cat' ); ?>
					<div><label>Select Product Categories</label></div>
					<div>
				  	<?php
						$taxonomy     = 'product_cat';
						$orderby      = 'name';  
						$show_count   = 0;      // 1 for yes, 0 for no
						$pad_counts   = 0;      // 1 for yes, 0 for no
						$hierarchical = 1;      // 1 for yes, 0 for no  
						$title        = '';  
						$empty        = 0;

						$args = array(
							'taxonomy'     => $taxonomy,
							'orderby'      => $orderby,
							'show_count'   => $show_count,
							'pad_counts'   => $pad_counts,
							'hierarchical' => $hierarchical,
							'title_li'     => $title,
							'hide_empty'   => $empty
						);
						$all_categories = get_categories($args);
						foreach ($all_categories as $cat){
							if($cat->category_parent == 0){
								$category_id = $cat->term_id; 
								$checked = in_array($category_id, $product_cats_ids) ? 'checked' : '';

							 	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$category_id}' {$checked} />".' '.$cat->name;
							 	echo "<br />";

								$args2 = array(
									'taxonomy'     => $taxonomy,
									'child_of'     => 0,
									'parent'       => $category_id,
									'orderby'      => $orderby,
									'show_count'   => $show_count,
									'pad_counts'   => $pad_counts,
									'hierarchical' => $hierarchical,
									'title_li'     => $title,
									'hide_empty'   => $empty
								);
							 	$sub_cats = get_categories($args2);
							 	if($sub_cats){
							    	foreach($sub_cats as $sub_category){
							    		$checked = in_array($sub_category->term_id, $product_cats_ids) ? 'checked' : '';
							        	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$sub_category->term_id}' {$checked} />".' '."<b>$sub_category->name</b>";
							        	echo "<br />";
							     	}   
							 	}
							}       
						}
				    ?>
					</div>
				</div>

				<?php
				$attribute_taxonomies = wc_get_attribute_taxonomies();
				$taxonomy_terms = array();
				$product_attributes = $product->get_attributes(); // get attribute of selected product

				if(!empty($attribute_taxonomies)): ?>
				<div>
				    <?php
				  	foreach($attribute_taxonomies as $tax): ?>
						<div>
							<div><label>Select <?php echo $tax->attribute_name; ?> Attributes</label></div>
							<?php 
							if(taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))): ?>
							<div>
								<?php
								echo "<select name='{$tax->attribute_name}[]'>";
								echo "<option value=''>Select Attribute Value</option>";
							    $taxonomy_terms = get_terms(wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name');
							    foreach($taxonomy_terms as $term){
							    	$selected = ($product_attributes[$tax->attribute_name]['options']['0'] == $term->name) ? 'selected' : '';
									echo "<option value='{$term->name}' {$selected}>$term->name</option>";
							    }
								echo "</select>";
							?>
							</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<div>
				  <div><label>Uplaod New Product Featured Image</label></div>
				  <div>
				  	<input type="file" name="productFeaturedImg" id="newFileToUpload" accept="image/*">
				  	
				  	<?php if(!empty(wp_get_attachment_url($product->get_image_id()))): ?>
				  	<img width="120" height="120" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" />
				  	<?php endif; ?>

				  </div>

				</div>

				<div>
				  <div><label>Uplaod New Product Gallery</label></div>
				  <div>
				  	<input type="file" name="productGallery[]" id="newProductGallery" accept="image/*" multiple>
				  	<?php
				  	$attachment_ids = $product->get_gallery_image_ids();

				  	if(!empty($attachment_ids)):
				  		foreach($attachment_ids as $attachment_id){
				  	    	echo "<img width='120' height='120' src='".wp_get_attachment_url($attachment_id)."' />";
						}
					endif;
				  ?>
				  </div>
				</div>
				<input type="submit" value="Update" class="product_submit" id="edit_product" />
			</form>
		</main>
	</div>

	<?php }
	else{
		echo "Unauthorize user access";
	}

}
add_action('woocommerce_account_edit-product-form_endpoint', 'wc_edit_customer_product_list_func');

// echo 'customer access is :'. get_field('choose_customer_access', 'options');

// 20-6-22

// 8-7-22
add_filter('ep_autosuggest_default_selectors', '__return_empty_string');

add_filter('ep_formatted_args', function($formatted_args){
		if(!empty($_GET['s'])){
			foreach(['post_title', 'post_excerpt', 'author_name', 'post_content', 'terms.post_tag.name', 'terms.category.name'] as $field){
				$formatted_args['highlight']['fields'][$field] = [
					'pre_tags'  => ['<strong style="background:red;">'],
					'post_tags' => ['</strong>'],
					'type'      => 'plain',
				];	
			}
		}
		return $formatted_args;
	}
);
// 8-7-22

// 11-7-22
// query log
function wp_load_elastic_search_query_func($query){
	echo "<pre>";
	print_r($query);
	echo "</pre>";
}
// add_action('ep_add_query_log', 'wp_load_elastic_search_query_func');

function ep_log_ep_after_send_dynamic_bulk_request( $result, $body, $documents, $min_buffer_size, $max_buffer_size, $current_buffer_size, $request_time ) {
	error_log( 'count( $body ): ' . count( $body ) );
	error_log( 'count( $documents ): ' . count( $documents ) );
	error_log( '$min_buffer_size: ' . $min_buffer_size );
	error_log( '$max_buffer_size: ' . $max_buffer_size );
	error_log( '$current_buffer_size: ' . $current_buffer_size );
	error_log( 'Current request size: ' . mb_strlen( implode( '', $body ) ) );
	error_log( 'ES Time: ' . ( is_array( $result ) && isset( $result['took'] ) ? $result['took'] / 1000 : '?' ) );
	error_log( 'Request Time: ' . $request_time );
	error_log( '==============================================' );

	if ( is_wp_error( $result ) ) {
		error_log( $result->get_error_code() . ' - ' . $result->get_error_message() );
		error_log( '==============================================' );

		if ( count( $body ) === 1 ) {
			error_log( 'ONE POST TOO BIG' );
			error_log( '==============================================' );
		} elseif ( mb_strlen( implode( '', $body ) ) === $min_buffer_size ) {
			error_log( 'THIS REALLY FAILED' );
			error_log( '==============================================' );
		}
	}
}
add_action( 'ep_after_send_dynamic_bulk_request', 'ep_log_ep_after_send_dynamic_bulk_request', 10, 7 );


/**
 * Called in the end of the batch processing.
 *
 * @param array $results  Array of results sent.
 * @param int   $requests Number of all requests sent.
 * @return void
 */
function ep_log_ep_after_send_dynamic_bulk_requests( $results, $requests ) {
	error_log( '' );
	error_log( '# of requests: ' . $requests );
	error_log( '==============================================' );
}
add_action( 'ep_after_send_dynamic_bulk_requests', 'ep_log_ep_after_send_dynamic_bulk_requests', 10, 2 );

// disable fuzziness in the search
function themeslug_deactivate_ep_fuzziness($fuzz){
    return 0;
}
add_filter('ep_fuzziness_arg', 'themeslug_deactivate_ep_fuzziness');

function wp_load_ep_language_func($ep_language){
	$ep_language = "GJ";
	return $ep_language;
}
// add_filter( 'ep_default_language', 'wp_load_ep_language_func');

function load_prepared_meta_func($prepared_meta, $post){
	echo "<pre>";
	print_r($prepared_meta);	
	echo "</pre>";	
}
add_filter('ep_prepared_post_meta','load_prepared_meta_func', 10, 2);
// 11-7-22

// 16-8-22
/**
 * Custom elementor widget.
 */
function wp_load_elementor_widget_func(){
	if(did_action('elementor/loaded')){
		require get_template_directory() . '/inc/elementor_posts_widget.php'; // get posts widget
		require get_template_directory() . '/inc/elementor_wpcf7_widget.php'; // get wpcf7 widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ElementorPostsWidget());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ElementorWPCF7Widget());
	}
}
add_action('init', 'wp_load_elementor_widget_func');
// 16-8-22
// 17-8-22
/**
 * register cpt and taxonomy
 */
require get_template_directory(). '/inc/custom_posts_type.php';

// Add the custom columns to the projects post type
function set_custom_edit_projects_columns($columns){
	$columns = array(
		// 'cb' => $columns['cb'],
		'title' => __('Title'),
		'shortcode' => __('Shortcode'),
		'taxonomy' => __('Taxonomy'),
		'thumbnail' => __('Thumbnail'),
		'author' => __('Author'),
		'date' => __('Date'),
	);
    return $columns;
}
add_filter('manage_projects_posts_columns', 'set_custom_edit_projects_columns');

// Add the data to the custom columns for the projects post type:
function custom_projects_column($column, $post_id){
    switch($column){
        case 'taxonomy':
            echo get_the_term_list($post_id , 'project-type' , '' , ' - ' , '' );
            break;
        case 'thumbnail':
            echo get_the_post_thumbnail($post_id, array(32, 32)); 
            break;
        case 'shortcode':    
            echo "[show-project id='{$post_id}' title='".get_the_title($post_id)."']"; 
            break;
    }
}
add_action('manage_projects_posts_custom_column', 'custom_projects_column', 10, 2);

// add shortcode for display projects type
function wp_show_project_type_func($atts){
    $atts = shortcode_atts(
        array(
            'id' => '1',
            'title' => 'default title',
        ), $atts, 'show-project');
    return 'id: '.esc_html($atts['id']).' - title: '.esc_html($atts['title']);
}
add_shortcode('show-project', 'wp_show_project_type_func');
// 17-8-22
// 18-8-22
// Make a Column Sortable
function wp_sortable_projects_column($columns){
    $columns['taxonomy'] = 'Taxonomy';
    $columns['author'] = 'Author';
    //To make a column 'un-sortable' remove it from the array
    unset($columns['date']);
    return $columns;
}
add_filter('manage_edit-projects_sortable_columns', 'wp_sortable_projects_column');

function projects_taxonomy_orderby($query){
    if(!is_admin())
        return;
    $orderby = $query->get('orderby');

    if('taxonomy' == $orderby){
        $query->set('meta_key','taxonomy');
        $query->set('orderby','meta_value'); // "meta_value_num" is used for numeric sorting
                                             // "meta_value"     is used for Alphabetically sort.
        // We can use any query params which used in WP_Query.
    }
}
add_action('pre_get_posts', 'projects_taxonomy_orderby');

/**
 * register required and recommended plugin.
 */
require get_template_directory(). '/inc/required-plugins.php';
// 18-8-22

// 22-8-22

/**
 * register custom wp widget
 */
require get_template_directory() . '/inc/custom-wp-widget.php';
require get_template_directory() . '/inc/custom-category-widget.php';
function wp_register_custom_widget(){
	register_widget('demo_widget');
	register_widget('Category_List_Widget');
}
add_action('widgets_init', 'wp_register_custom_widget');

// Load wp list table class
require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');

// load bulk delete option for wp list table 
// require get_template_directory() . '/inc/wp_list_table_bulk_delete_example.php';
// function load_wp_text_domain(){
// 	load_theme_textdomain('pyramidtimesystems', get_template_directory() . '/languages');
// }
// add_action( 'after_setup_theme', 'load_wp_text_domain' );
// 22-8-22

// 19-9-22
// verify contact form 7 data
function save_contact_form_7_data(){
	// Server side validation
	function isValid(){
	   // This is the most basic validation for demo purposes. Replace this with your own server side validation
	   if($_POST['your-name'] != "" && $_POST['your-email'] != "" && $_POST['your-subject'] != "" && $_POST['your-message'] != ""){
	   	   return true;
	   }
	   else{
	       return false;
	   }
	}
	// email validation
	function emailValidation($email) {
	    $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
	    $email = strtolower($email);
	    return preg_match($regex, $email);
	}

	$error_output = '';
	$success_output = '';
	// Execute if all field fulfill all condition
	if(isValid()){
		if(emailValidation($_POST['your-email'])){
    		// Build POST request to get the reCAPTCHA v3 score from Google
			$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			$recaptcha_secret = RECAPTCHA_SECRET_KEY; // Insert your secret key here
			$recaptcha_response = $_POST['recaptcha_response'];
			 
			// Make the POST request
			$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

			// Converts it into a PHP object
			$data = json_decode($recaptcha);
			if($data->success == true && $data->action == "contact_form7_submission"){
		   		$success_output = "Your message sent successfully";	
		   		$data = "<div>
		   			Name:". $_POST['your-name'] ."<br/>
		   			Email:". $_POST['your-email'] ."<br/>
		   			Subject:". $_POST['your-subject'] ."<br/>
		   			Message:". $_POST['your-message'] ."<br/>
		   		</div>";
			}
		}
		else{
    		$error_output = "Please enter valid email address";
    		$data = "";
		}
	}else{
	   // Server side validation failed
	   $error_output = "Please fill all the required fields";
	   $data = "";
	}
	
	$output = array(
	   'error'     =>  $error_output,
	   'success'   =>  $success_output,
	   'data' => $data,
	);
	// Output needs to be in JSON format
	echo json_encode($output);
	exit;

}
add_action("wp_ajax_save_contact_form_7_data", "save_contact_form_7_data");
add_action("wp_ajax_nopriv_save_contact_form_7_data", "save_contact_form_7_data");


// Save contact form 7 data 
function save_form($wpcf7){
    global $wpdb;

    $submission = WPCF7_Submission::get_instance();

    $posted_data = $submission->get_posted_data();
    
    $uploaded_files = $submission->uploaded_files();
    // print_r($posted_data);
    echo "<br />";
    print_r($uploaded_files);
    echo "<br />";


    // print_r($_FILES["bytes_file"]);
    echo "<br />";
    var_dump($_FILES["bytes_file"]);
    exit;
}
// remove_all_filters('wpcf7_before_send_mail');
// remove_filter('wpcf7_skip_mail');
add_action('wpcf7_mail_sent', 'save_form');
// 19-9-22
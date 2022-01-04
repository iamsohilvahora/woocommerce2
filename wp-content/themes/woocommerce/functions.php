<?php
/**
 * woocommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woocommerce
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'woocommerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function woocommerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on woocommerce, use a find and replace
		 * to change 'woocommerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'woocommerce', get_template_directory() . '/languages' );

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


		/********* WooCommerce Customization *************/	
		add_theme_support("woocommerce", array(
			//"thumbnail_image_width" => 150,
			//"single_image_width" => 200,
			"product_grid"=> array( 
				"default_columns" => 10,
				"min_columns" => 2,
				"max_columns" => 3
			)
		));

		//product thumbnail effect support (single-product.php)
		add_theme_support("wc-product-gallery-zoom");
		add_theme_support("wc-product-gallery-lightbox");
		add_theme_support("wc-product-gallery-slider");

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 60,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'woocommerce'),
				'menu-2' => esc_html__( 'Secondary', 'woocommerce'),
				'menu-3' => esc_html__( 'About', 'woocommerce'),
				'menu-4' => esc_html__( 'About-us', 'woocommerce'),
				'menu-5' => esc_html__( 'About-us', 'woocommerce'),
				'menu-6' => esc_html__( 'Support', 'woocommerce'),
				'menu-7' => esc_html__( 'Support (Footer)', 'woocommerce'),
				'menu-8' => esc_html__( 'Support-Footer', 'woocommerce')
			)
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
				'woocommerce_custom_background_args',
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
		

		
	}
endif;
add_action( 'after_setup_theme', 'woocommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woocommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woocommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'woocommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woocommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'woocommerce' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'woocommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'woocommerce' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'woocommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'woocommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function woocommerce_scripts() {
	wp_enqueue_style( 'woocommerce-style', get_stylesheet_uri(), array(), "1.0", "all");

	wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom.css', array(), "1.0", "all");

	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), "1.0", "all");

	wp_style_add_data( 'woocommerce-style', 'rtl', 'replace' );

	wp_enqueue_script( 'woocommerce-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array("jquery"),"1.0", "all");
	
	wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array("jquery"),"1.0", "all");



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woocommerce_scripts' );

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


/************* WooCommerce Customization ****************/
//add classes to navbar list and a element
function add_custom_class_to_li($classes, $item, $args){
	$classes[] = "nav-item";
	return $classes;
}

function add_custom_class_anchor_link($classes, $item, $args){
	$classes['class'] = "nav-link";
	return $classes;
}

add_filter("nav_menu_css_class", "add_custom_class_to_li", 1, 3);
add_filter("nav_menu_link_attributes", "add_custom_class_anchor_link", 1, 3);

// include_once('include/general_function.php'); 
include get_template_directory().'/include/general_function.php'; 

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
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

/************** Theme customization setting **********************/
function wp_theme_load_customizer($wp_customize){
	//Customizer code

	//add section
	$wp_customize->add_section('sec_copyright', array(
		'title' => 'Copyright Section',
		'description' => 'This is a copyright section'
	));

	//add setting/field
	$wp_customize->add_setting('set_copyright', array(
		'type' => 'theme_mod',
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('set_copyright', array(
		'label' => 'Copyright',
		'description' => 'Please fill the copyright text',
		'section' => 'sec_copyright',
		'type' => 'text',
	));

	/***** section of new arrivals / popularity for control limit and columns *******/
	$wp_customize->add_section('sec_product_panel', array(
		'title' => 'Product panel limit & columns',
		'description' => 'This is a product panel section'
	));

	//add setting and control for new arrival limit
	$wp_customize->add_setting('set_new_limit', array(
		'type' => 'theme_mod',
		'default' => '',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('set_new_limit', array(
		'label' => 'New Arrival Product Limit',
		'description' => 'Please provide limit of new arrivals',
		'section' => 'sec_product_panel',
		'type' => 'number',
	));

	//add setting and control for new arrival column
	$wp_customize->add_setting('set_new_column', array(
		'type' => 'theme_mod',
		'default' => '',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('set_new_column', array(
		'label' => 'New Arrival Product Column',
		'description' => 'Please provide column of new arrivals',
		'section' => 'sec_product_panel',
		'type' => 'number',
	));
}
add_action('customize_register', 'wp_theme_load_customizer');

/* Change number or products per row to 4 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		$row = get_option('wc_number_of_products_per_row') ? get_option('wc_number_of_products_per_row') : 4;


		//return 4; // 4 products per row
		return $row; // 4 products per row
	}
}

/* Change number of products that are displayed per page (shop page) */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = get_option('wc_number_of_products_per_page') ? get_option('wc_number_of_products_per_page') : 12;

  //$cols = 12;
  return $cols;
}

/**
 * Create the section beneath the products tab
 **/
add_filter( 'woocommerce_get_sections_products', 'wc_customize_add_section', 10, 2 );
function wc_customize_add_section( $sections ) {	
	$sections['wc_customizer_shop'] = __( 'Customize Shop Page', 'woocommerce' );
	return $sections;
}

/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_products', 'wc_customize_all_settings', 10, 2 );
function wc_customize_all_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if($current_section == 'wc_customizer_shop'){
		$settings_wc_customize = array();
		// Add Title to the Settings
		$settings_wc_customize[] = array( 'name' => __( 'WC Shop Page Settings', 'text-domain' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Shop Page', 'text-domain' ), 'id' => 'wc_product_customizer' );
		// Add first text field option
		$settings_wc_customize[] = array(
			'name'     => __( 'Products per row', 'text-domain' ),
			'desc_tip' => __( 'This will change number of products on shop page', 'text-domain' ),
			'id'       => 'wc_number_of_products_per_row',
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Type the number', 'text-domain' ),
		);
		// Add second text field option
		$settings_wc_customize[] = array(
			'name'     => __( 'Products per page', 'text-domain' ),
			'desc_tip' => __( 'This will change number of products on shop page', 'text-domain' ),
			'id'       => 'wc_number_of_products_per_page',
			'type'     => 'text',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Type the number', 'text-domain' ),
		);

		//single page related products (show/hide)
		$settings_wc_customize[] = array(
			'name'     => __( 'Show / hide related products', 'text-domain' ),
			'desc_tip' => __( 'Show / hide related products on single page', 'text-domain' ),
			'id'       => 'wc_show_hide_related_products',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Hide related products', 'text-domain' ),
		);
		
		$settings_wc_customize[] = array( 'type' => 'sectionend', 'id' => 'wc_customizer_shop' );
		return $settings_wc_customize;
	/**
	 * If not, return the standard settings
	 **/
	}else{
		return $settings;
	}
}

/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
		}
	}
}

//Custom Shortcodes
if(!function_exists('my_shortcode_function')):
	add_shortcode('my_shortcode_1', 'my_shortcode_function');

	function my_shortcode_function(){
		return "<p>This is a first shortcode.</p>";
	}
endif;	

if(!function_exists('my_attr_shortcode_function')):
	add_shortcode('my_image_shortcode', 'my_attr_shortcode_function');
	function my_attr_shortcode_function($args){
		$atts = shortcode_atts(array('img'=>'http://lorempixel.com/400/200'), $args,'my_image_shortcode' );

		return "<img src='" .$atts['img']."'/>";	
	}
endif;	

if(!function_exists('content_shortcode_function')):
	add_shortcode('my_content_shortcode', 'content_shortcode_function');
	function content_shortcode_function($args, $content=""){
		$arg = shortcode_atts(array('h1'=>false), $args, 'my_content_shortcode');

		if($arg['h1'] == false){
			return $content;
		}else{
			return "<h1>".$content."</h1>";
		}
	}
endif;	

//Custom tabs(content-single-product.php)

//remove_action("woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs",10);

if(!function_exists('my_custom_tabs_function')){
	add_filter( 'woocommerce_product_tabs', 'my_custom_tabs_function');

	function my_custom_tabs_function($tabs){
		unset($tabs['reviews']);

		$tabs['video'] =  array(
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

//Related products(content-single-product.php)
add_filter('woocommerce_output_related_products_args', 'my_custom_related_product_function');

function my_custom_related_product_function($args){
	$args = array(
		'posts_per_page' => 3,
		'columns'=> 3,
		'orderby' => 'rand'
	);
	return $args;
}

add_action('woocommerce_after_single_product_summary', 'my_related_products_custom_function', 15);

// Show /hide related products (woocommerce->setting>products>customize shop page)
function my_related_products_custom_function(){
	$check = get_option('wc_show_hide_related_products', false);
	if(isset($check) && $check == 'yes'){
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	}
}

// Change default placeholder image (shop page)
add_filter('woocommerce_placeholder_img_src', 'my_default_placeholder_image');

function my_default_placeholder_image($img){
	return 'https://picsum.photos/seed/picsum/200/300';
}

// Custom wp admin bar menu render
if ( !function_exists('add_custom_admin_bar_menu') ) {
 
    add_action( 'wp_before_admin_bar_render', 'add_custom_admin_bar_menu');
 
    function add_custom_admin_bar_menu()
 
    {
        global $wp_admin_bar;
 
        $args = [
            'id' => 'custom_admin_bar_menu_id', // id must be unique
            'title' => 'Custom Menu', // title for display in admin bar
            'href' => 'http://add-your-link-here.com', // link for the achor tag
 
            // meta for link e.g: class, target, and custom data attributes etc
            'meta' => [ 
                'class' => 'custom_class', // your custom class
            ],
        ];
        $wp_admin_bar->add_menu($args);
 
        $args_submenu_1 = [
            'id' => 'cusotm-sub-menu-1',
            'title' => 'Sub menu-1',
            'parent' => 'custom_admin_bar_menu_id', // add parent id in which you want to add sub menu
            'href' => 'http://add-your-link-here.com',
            'meta' => [
                'class' => 'custom_sub_menu_class',
            ],
        ];
        $wp_admin_bar->add_menu($args_submenu_1);
 
        $args_submenu_2 = [
            'id' => 'cusotm-sub-menu-2',
            'title' => 'Sub menu-2',
            'parent' => 'custom_admin_bar_menu_id', // add parent id in which you want to add sub menu
            'href' => 'http://add-your-link-here.com',
            'meta' => [
                'class' => 'custom_sub_menu_class',
            ],
        ];
        $wp_admin_bar->add_menu($args_submenu_2);    
    }
}

// Wp logout action
add_action('wp_logout', 'redirect_user_after_logout');

function redirect_user_after_logout(){
	wp_redirect(home_url());
	exit();
}

//Woocommerce cart additional fees
// add_action( 'woocommerce_cart_calculate_fees', 'add_additional_fees');
// function add_additional_fees() {
// 	global $woocommerce;
//     if ( is_admin() && ! defined( 'DOING_AJAX' ) )
//     	return;

//     $price = 2;
//     $woocommerce->cart->add_fee('Additional Fee', $price, true);
// }

add_action( 'woocommerce_cart_calculate_fees', 'my_additional_fees_country_based');
function my_additional_fees_country_based(){
	global $woocommerce;
    if(is_admin() && !defined('DOING_AJAX'))
    	return;

    $price = 1;
	//$woocommerce->cart->add_fee('Additional Fee', $price, true);

    $fee_country = array('IN', 'PK', 'US');
    $customer_country = $woocommerce->customer->get_shipping_country();
    if(in_array($customer_country, $fee_country))
    	$woocommerce->cart->add_fee('Additional Fee: ', $price, true);
}

// Product featured video
// Single page
if(!function_exists('woocommerce_get_product_video')){
	add_filter('woocommerce_single_product_image_thumbnail_html', 'woocommerce_get_product_video');
	function woocommerce_get_product_video($html){
		$featured_video = get_field('featured_video', get_the_ID());
		if(!empty(trim($featured_video))){
			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$featured_video.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}else{
			return $html;
		}
	}
}

//Product Page
function woocommerce_get_product_thumbnail($size='shop_catalog', $deprecated1=0, $deprecated2=0){
	global $post;

	$featured_video = get_field('featured_video', get_the_ID());
	if(!empty(trim($featured_video))){
			return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$featured_video.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	}else{
		$props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
		return get_the_post_thumbnail($post->ID, $image_size, array(
			'title' => $props['title'],
			'alt' => $props['alt']
		));
	}
}

// Change footer text in wordpress panel
add_filter('admin_footer_text', 'change_footer_text');
function change_footer_text($text){
	return 'Created by Sohil Vahora';
}

// Customize admin dashboard
add_action('wp_dashboard_setup', 'custom_dashboard_widget');

function custom_dashboard_widget(){
	wp_add_dashboard_widget('custom_id', 'Contact Us for Help', 'custom_dashboard_info_widget', null, null);
}

function custom_dashboard_info_widget(){
	echo 'Contact us for any help, we are always for you.';
}

// Enable shortcode inside wp widget area
add_filter('widget_text', 'do_shortcode');

/*** Add svg/ webp to allowed media types  ***/
function wpdocs_add_webp( $wp_get_mime_types ) {
    $wp_get_mime_types['webp'] = 'image/webp';
    $wp_get_mime_types['svg'] = 'image/svg+xml';
    return $wp_get_mime_types;
}
add_filter('mime_types', 'wpdocs_add_webp');

// admin dashboard notice
add_action('admin_notices', 'custom_admin_notices');

function custom_admin_notices(){ ?>
	<div class="notice notice-info is-dismissible">
		<h4>Contact us for help</h4>
		<p>For any help don't hesitate to contact.</p>
	</div>
<?php } 

/********** CPT ******************/
require get_template_directory().'/include/type-movies.php';
require get_template_directory().'/include/type-news.php';

function screen_contextual_help_tab(){
	$screen = get_current_screen();
	if($screen->post_type !== 'movies')
		return;
	$args = [
			'id' => 'unique_movie_id',
			'title' => 'Movies Help',
			'content' => '<h2>This is a custom help for movies.</h2>'
		];
	$screen->add_help_tab($args);
}
add_action('admin_head', 'screen_contextual_help_tab');


// Remove taxonomy archive description
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description');
?>

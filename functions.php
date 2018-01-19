<?php

if ( ! function_exists( 'base_theme_setup' ) ) :
function base_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'base_theme' ),
		'home_buttons' => esc_html__( 'Home Page Buttons', 'base_theme' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'base_theme_setup' );

function base_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'base_theme_content_width', 1200 );
}
add_action( 'after_setup_theme', 'base_theme_content_width', 0 );


function base_theme_widgets_init() {
	register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'primary-sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'base_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function base_theme_scripts() {
	$version = '20180119';
	$url = get_site_url();

	wp_enqueue_style( 'base_theme-style', get_template_directory_uri() . '/css/style.css', array(), $version );
	wp_enqueue_style( 'longhornphp-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Lora:400,700' );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'mailchimp-embed', '//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css' );

	if ( strpos( $url, '.dev' ) !== false && file_exists( get_template_directory() . '/hot' ) ) {
		wp_enqueue_script( 'base_theme-main', '//localhost:8080/js/build/bundle.js', array( 'jquery' ), $version, true );
	} else {
		wp_enqueue_script( 'base_theme-main', get_template_directory_uri() . '/js/build/bundle.js', array( 'jquery' ), $version, true );
	}
}
add_action( 'wp_enqueue_scripts', 'base_theme_scripts' );

function lphp_menu_social_icons($items, $args) {
	$items = str_replace('>Facebook<', '><i class="fa fa-facebook" aria-hidden="true"></i><', $items);
	$items = str_replace('>Twitter<', '><i class="fa fa-twitter" aria-hidden="true"></i><', $items);
	return $items;
}
add_filter( 'wp_nav_menu_items', 'lphp_menu_social_icons', 10, 2 );

function lphp_acf_init() {
	acf_add_options_page([
		'page_title' => 'Theme Options',
		'autoload' => true,
	]);
}
add_action( 'acf/init', 'lphp_acf_init' );

function lphp_get_sponsorship_tier_query($tier = '') {
	if (!$tier) {
		return null;
	}

	return [
		'posts_per_page' => 999,
		'post_type' => 'sponsor',
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' => [[
			'taxonomy' => 'sponsorship_tier',
			'field' => 'slug',
			'terms' => $tier
		]]
	];
}

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

function allow_svg_uploads($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

add_filter( 'wpseo_metabox_prio', 'lower_yoast_priority' );
function lower_yoast_priority() {
	return 'low';
}

add_action( 'after_setup_theme', 'lphp_add_image_sizes' );
function lphp_add_image_sizes() {
	add_image_size( 'lphp-large-square', 600, 600, true );
	add_image_size( 'lphp-medium-square', 300, 300, true );
}

add_filter( 'gallery_style', 'lphp_add_gallery_classes');
function lphp_add_gallery_classes( $output ) {
	$output = str_replace('gallery-columns-5', 'gallery-columns-5 d-flex justify-content-start justify-content-lg-between flex-wrap', $output);
	return $output;
}

/**
 * Bootstrap menu walker
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

require get_template_directory() . '/inc/acf-customizations.php';

require get_template_directory() . '/inc/sponsor-post-type.php';

require get_template_directory() . '/inc/speaker-post-type.php';

require get_template_directory() . '/inc/session-post-type.php';

require get_template_directory() . '/inc/invoice-post-type.php';

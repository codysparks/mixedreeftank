<?php
/**
 * Mixed Reef Tank functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mixed_Reef_Tank
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mixed_reef_tank_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Mixed Reef Tank, use a find and replace
		* to change 'mixed-reef-tank' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mixed-reef-tank', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'mixed-reef-tank' ),
			'menu-2' => esc_html__( 'Footer 1', 'footer-1-mixed-reef-tank' ),
			'menu-3' => esc_html__( 'Footer 2', 'footer-2-mixed-reef-tank' ),
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
			'mixed_reef_tank_custom_background_args',
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
}
add_action( 'after_setup_theme', 'mixed_reef_tank_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mixed_reef_tank_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mixed_reef_tank_content_width', 640 );
}
add_action( 'after_setup_theme', 'mixed_reef_tank_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mixed_reef_tank_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mixed-reef-tank' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mixed-reef-tank' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mixed_reef_tank_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mixed_reef_tank_scripts() {
	/** Normalize */
	wp_enqueue_style( 'mixed-reef-tank-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mixed-reef-tank-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mixed-reef-tank-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Custon styles */
	wp_enqueue_style('global', get_theme_file_uri('/styles/css/global.css'), array(), filemtime(get_template_directory() .'/styles/css/global.css'));

	// Home page
	if(is_front_page()) {
		wp_enqueue_style('front_page', get_theme_file_uri('/styles/css/front-page.css'), array(), filemtime(get_template_directory() .'/styles/css/front-page.css'));
	}

	// Category page
	if(is_archive() || is_search()) {
		wp_enqueue_style('category', get_theme_file_uri('/styles/css/category-page.css'), array(), filemtime(get_template_directory() .'/styles/css/category-page.css'));
	}

	// Blog post
	if(is_single()) {
		wp_enqueue_style('category', get_theme_file_uri('/styles/css/blog-page.css'), array(), filemtime(get_template_directory() .'/styles/css/blog-page.css'));
	}

	// Content page
	if(is_page() && !is_front_page()) {
		wp_enqueue_style('content', get_theme_file_uri('/styles/css/content-page.css'), array(), filemtime(get_template_directory() .'/styles/css/content-page.css'));
	}
}
add_action( 'wp_enqueue_scripts', 'mixed_reef_tank_scripts' );

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


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
	   return $data;
	}
  
	$filetype = wp_check_filetype( $filename, $mimes );
  
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
  }
  add_action( 'admin_head', 'fix_svg' );

// Remove 'Category:' verbiage
function prefix_category_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'prefix_category_title' );

// Rank Math module always on bottom of page
add_filter( 'rank_math/metabox/priority', function( $priority ) {
	return 'low';
});
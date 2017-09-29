<?php

namespace Dessertstorm;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action( 'after_setup_theme', function() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Heisenberg, use a find and replace
	 * to change 'heisenberg' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dessertstorm', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'heisenberg' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'heisenberg_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    /**
	* Add theme support for Portfolio Custom Post Type.
	*/
	add_theme_support( 'jetpack-portfolio' );

	/* Declare WooCommerce support */
    add_theme_support( 'woocommerce' );

	/*
	 * Enable supoprt for custom logo
	 * See https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 300,
		'width'       => 300,
		'flex-height' => false,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Register menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'dessertstorm' ),
	) );

} );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action( 'after_setup_theme', function () {
	$GLOBALS['content_width'] = apply_filters( '_dessertstorm_content_width', 640 );
}, 0 );


/**
 * Enqueue styles.
 */
add_action( 'wp_enqueue_scripts', function () {

	// Enqueue our stylesheet
	$handle = 'dessertstorm_styles';
	$src =  get_template_directory_uri() . '/assets/dist/css/app.min.css';
	$deps = '';
	$ver = filemtime( get_template_directory() . '/assets/dist/css/app.min.css');
	$media = '';
	wp_enqueue_style( $handle, $src, $deps, $ver, $media );

	wp_enqueue_style( 'dessertstorm_web_fonts', get_stylesheet_directory_uri() . '/assets/dist/css/web-fonts.css', '', '1.0' );
	wp_enqueue_style( 'fontawesome_styles', get_stylesheet_directory_uri() . '/assets/dist/css/font-awesome.css', '', '9' );
	wp_enqueue_style( 'home_styles', get_stylesheet_directory_uri() . '/style.css', '', '9' );

} );


/**
 * Enqueue scripts.
 */
add_action( 'wp_enqueue_scripts', function () {

	// Add Foundation JS to footer
	wp_enqueue_script( 'foundation-js',
		get_template_directory_uri() . '/assets/dist/js/foundation.js',
		array( 'jquery' ), '6.2.1', true
	);

	//Add underscore JS library
	wp_enqueue_script( 'underscore-js', 
		get_template_directory_uri() . '/node_modules/underscore/underscore-min.js', 
		array( 'jquery' ), '1.8.3', true 
	);

	// Add our concatenated JS file after Foundation
	$handle = 'dessertstorm_appjs';
	$src =  get_template_directory_uri() . '/assets/dist/js/app.js';
	$deps = array( 'jquery' );
	$ver = filemtime( get_template_directory() . '/assets/dist/js/app.js');
	$in_footer = true;
	wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );


add_filter( 'wp_nav_menu', function ( $menu ){
	$menu = str_replace('current-menu-item', 'current-menu-item active', $menu);
	return $menu;
}, 10, 2 );


/*******************************************************************************
* Custom login styles for the theme. Sass file is located in ./assets/login.scss
* and is spit out to ./assets/dist/css/login.css by gulp. Functions are here so
* that you can move it wherever works best for your project.
*******************************************************************************/

// Load the CSS
add_action( 'login_enqueue_scripts', function() {
	wp_enqueue_style( 'dessertstorm_login_css', get_template_directory_uri() .
	'/assets/dist/css/login.css', false );
} );


// Change header link to our site instead of wordpress.org
add_filter( 'login_headerurl', function() {
	return get_bloginfo( 'url' );
} );


// Change logo title in from WordPress to our site name
add_filter( 'login_headertitle', function() {
	return get_bloginfo( 'name' );
});


//Custom feedback after Jetpack form submission
add_filter( 'grunion_contact_form_success_message', function($message ) {
 
	ob_start();

?>
	<p class="jetpack-override-sent">Message Sent!<br/>
	Thanks</p>

<?php

	return ob_get_clean();// or $message for default notice
 
} );

/*
 * Adds the Excerpt field to Pages, so that we can define what displays in search results mainly. 
 * Without this, content within shortcodes will not get rendered in search results, which can be 
 * all content if we're using shortcodes for page layout
 *  
 */
add_action( 'init', function () {
     add_post_type_support( 'page', 'excerpt' );
} );
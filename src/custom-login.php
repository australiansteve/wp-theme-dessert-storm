<?php
/**
 * Custom login styles for the theme. Sass file is located in ./assets/login.scss
 * and is spit out to ./assets/dist/css/login.css by gulp. Functions are here so
 * that you can move it wherever works best for your project.
 */

namespace Dessertstorm;

/**
 * Load the CSS
 */
add_action( 'login_enqueue_scripts', function() {
	wp_enqueue_style( 'heisenberg_login_css', get_template_directory_uri() . '/assets/dist/css/login.min.css' );
	
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $image[0];?>);
        }
    </style>
	<?php
} );

/**
 * Change header link to our site instead of wordpress.org
 */
add_filter( 'login_headerurl', function() {
	return get_bloginfo( 'url' );
} );

/**
 * Change logo title in from WordPress to our site name
 */
add_filter( 'login_headertitle', function() {
	return get_bloginfo( 'name' );
} );
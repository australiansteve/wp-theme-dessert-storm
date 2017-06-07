<?php
/**
 * Jetpack Compatibility File.
 *
 * @link http://jetpack.me/
 *
 * @package Dessertstorm
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function dessertstorm_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'dessertstorm_infinite_scroll_render',
		'footer'    => 'page',
	) );
} 
add_action( 'after_setup_theme', 'dessertstorm_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function dessertstorm_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'page-templates/content', get_post_format() );
	}
}

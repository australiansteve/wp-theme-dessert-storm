<?php

namespace Dessertstorm;

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	$min_ext = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Add Foundation JS to footer
	wp_enqueue_script(
		'foundation-js',
		DESSERTSTORM_URL . "/assets/dist/js/foundation{$min_ext}.js",
		[ 'jquery' ],
		'6.3.1',
		true
	);

	// Add our main app js file
	wp_enqueue_script(
		'heisenberg_appjs',
		DESSERTSTORM_URL . "/assets/dist/js/app{$min_ext}.js",
		[ 'jquery' ],
		DESSERTSTORM_VERSION,
		true
	);

	// Add comment script on single posts with comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style(
		'heisenberg_styles',
		DESSERTSTORM_URL . '/assets/dist/css/app.min.css',
		[],
		DESSERTSTORM_VERSION,
		''
	);
} );

<?php

namespace Dessertstorm;

/**
 * Register widget area.
 */
add_action( 'widgets_init', function() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'heisenberg' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Register sidebars
	$sidebars = get_theme_mod('austeve_general_sections', 0);
    for ( $s = 0; $s < $sidebars; $s++ ) {
    	//Get widget widths

        register_sidebar( array(
            'name'          => 'Front page content '.($s+1),
            'id'            => 'austeve_content_'.($s+1),
            'before_widget' => '<div class="small-12 columns">',
            'after_widget'  => '</div>',
            'before_title'  => '',
            'after_title'   => '',
        ) );
    }
    
} );
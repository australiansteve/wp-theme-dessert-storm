<?php
/**
 * Dessertstorm Theme Customizer.
 *
 * @package Dessertstorm
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dessertstorm_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//All our sections, settings, and controls will be added here
   	$wp_customize->add_setting( 'austeve_general_sections' );
   	$wp_customize->add_setting( 'austeve_background_image' );
   	$wp_customize->add_setting( 'austeve_background_opacity' );

	$wp_customize->add_section( 'dessertstorm_bg_section' , array(
	    'title'       => __( 'Background', 'dessertstorm' ),
	    'priority'    => 30,
	    'description' => 'Upload a background image',
	) );

	//Front page content sections
	$wp_customize->add_control( 
   		'austeve_general_sections', 
		array(
			'label'    => __( 'Number of content sections', 'dessertstorm' ),
			'section'  => 'static_front_page',
			'settings' => 'austeve_general_sections',
			'type'     => 'text',
		)
	);

	//Background Image
   	$wp_customize->add_control( 
   		new WP_Customize_Image_Control( 
   			$wp_customize, 
   			'austeve_background_image', 
   			array(
			    'label'    => __( 'Image:', 'dessertstorm' ),
			    'section'  => 'dessertstorm_bg_section',
			    'settings' => 'austeve_background_image',
			) 
		) 
	);

   	//Background opacity
   	$wp_customize->add_control( 
   		'austeve_background_opacity', 
		array(
			'label'    => __( 'Opacity', 'dessertstorm' ),
			'section'  => 'dessertstorm_bg_section',
			'settings' => 'austeve_background_opacity',
			'type'     => 'text',
		)
	);


}
add_action( 'customize_register', 'dessertstorm_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dessertstorm_customize_preview_js() {
	wp_enqueue_script( 'dessertstorm_customizer', get_template_directory_uri().'/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'dessertstorm_customize_preview_js' );

/**
 * Live CSS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dessertstorm_customize_css()
{
    ?>
        <style type="text/css">
            #bgImage { 
             	background-image: url(<?php echo get_theme_mod('austeve_background_image', ''); ?>);
             	opacity: <?php echo get_theme_mod('austeve_background_opacity', '1.0'); ?>;
            }
        </style>
    <?php
}
add_action( 'wp_head', 'dessertstorm_customize_css');

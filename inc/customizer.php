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


	$sections = get_theme_mod('austeve_general_sections', 0);

	for ($s = 0; $s < $sections; $s++) {
		
		//Add a section
		$wp_customize->add_section( 'dessertstorm_content_section_'.$s , array(
		    'title'       => __( 'Content section '.($s+1), 'dessertstorm' ),
		    'priority'    => 200,
		    'description' => 'Content section '.($s+1),
		) );

		//Add settings
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_style' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_page' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_sidebar' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_sidebar_small' );

	   	//Add a top-level control
	   	$wp_customize->add_control(
		    new WP_Customize_ContentStyle_Control(
		        $wp_customize,
		        'dessertstorm_content_'.$s.'_style',
		        array(
					'label' 	=> __( 'Content', 'dessertstorm' ),
					'section' 	=> 'dessertstorm_content_section_'.$s,
					'settings' 	=> 'dessertstorm_content_'.$s.'_style',
					'choices' 	=> array(
						'page' 		=> 'Page',
						'sidebar' 	=> 'Sidebar',
					),
					'content_section' => $s,
		        )
		    )
		);

		$section_style = get_theme_mod('dessertstorm_content_'.$s.'_style');

		//Add a page selector control
	   	$wp_customize->add_control(
		    new WP_Customize_Page_Control(
		        $wp_customize,
		        'dessertstorm_content_'.$s.'_page',
		        array(
					'label' 	=> __( 'Page', 'dessertstorm' ),
					'section' 	=> 'dessertstorm_content_section_'.$s,
					'settings' 	=> 'dessertstorm_content_'.$s.'_page',
					'content_section' => $s,
		        )
		    )
		);

		//Add a sidebar selector control
	   	$wp_customize->add_control(
		    new WP_Customize_Sidebar_Control(
		        $wp_customize,
		        'dessertstorm_content_'.$s.'_sidebar',
		        array(
					'label' 	=> __( 'Sidebar', 'dessertstorm' ),
					'section' 	=> 'dessertstorm_content_section_'.$s,
					'settings' 	=> 'dessertstorm_content_'.$s.'_sidebar',
					'description' 	=> __('Ensure your sidebar is populated with at least one widget first', 'dessertstorm' ),
					'content_section' => $s,
		        )
		    )
		);

	   	$selected_sidebar = get_theme_mod('dessertstorm_content_'.$s.'_sidebar');
	   	global $sidebars_widgets;
		$count = ($selected_sidebar) ? count($sidebars_widgets[strtolower($selected_sidebar)]) : 0;

		//Add a widget sizing control (small)
	   	$wp_customize->add_control(
		    new WP_Customize_WidgetSize_Control(
		        $wp_customize,
		        'dessertstorm_content_'.$s.'_sidebar_small',
		        array(
					'label' 	=> __( 'Widget sizes', 'dessertstorm' ),
					'section' 	=> 'dessertstorm_content_section_'.$s,
					'settings' 	=> 'dessertstorm_content_'.$s.'_sidebar_small',
					'description' 	=> __('Widget sizes on small screens', 'dessertstorm' ),
					'screen_size' => 'small',
					'num_widgets' => $count, 
		        )
		    )
		);
	}
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


if( class_exists( 'WP_Customize_Control' ) ):
	class WP_Customize_ContentStyle_Control extends WP_Customize_Control {
		public $type = 'style_radio';
		public $content_section;
 
		public function render_content() {

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

				<select <?php $this->link(); ?>>
					<option value="0" <?php echo selected( $this->value(), get_the_ID() )?>>Select content style...</option>
					<?php foreach ( $this->choices as $key => $value ) { 
						echo "<option " . selected( $this->value(), $key ) . " value='" . $key . "'>" . ucwords( $value ) . "</option>";
							} 
					?>
				</select>
				<script>
				
				function hideAll(s) {
					jQuery('#customize-control-dessertstorm_content_'+s+'_page, #customize-control-dessertstorm_content_'+s+'_sidebar, #customize-control-dessertstorm_content_'+s+'_sidebar_small' ).hide();
				}

				jQuery(function($){
					var s = '<?php echo $this->content_section; ?>';
					var v = '<?php echo $this->value(); ?>';

					hideAll(s);

					$('#customize-control-dessertstorm_content_'+s+'_'+v ).show();

					if (v == 'sidebar')
					{
						$('#customize-control-dessertstorm_content_'+s+'_'+v+'_small' ).show();
					}
					
					$('#customize-control-dessertstorm_content_'+s+'_style select').change(function() {
						hideAll(s);
						$('#customize-control-dessertstorm_content_'+s+'_'+this.value ).show();

						if (this.value == 'sidebar')
						{
							$('#customize-control-dessertstorm_content_'+s+'_'+this.value+'_small' ).show();
						}
					});
				});

				</script>
			</label>
		<?php
		}
	}

	class WP_Customize_Page_Control extends WP_Customize_Control {
		public $type = 'page_dropdown';
		public $content_section;
 
		public function render_content() {

		$pages = new WP_Query( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'orderby'     => 'title',
			'order'       => 'ASC'
		));

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<option value="0" <?php echo selected( $this->value(), get_the_ID() )?>>Select page...</option>
					<?php 
					while( $pages->have_posts() ) {
						$pages->the_post();
						echo "<option " . selected( $this->value(), get_the_ID() ) . " value='" . get_the_ID() . "'>" . the_title( '', '', false ) . "</option>";
					}
					?>
				</select>
			</label>
		<?php
		}
	}

	class WP_Customize_Sidebar_Control extends WP_Customize_Control {
		public $type = 'sidebar_dropdown';
		public $content_section;
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<select <?php $this->link(); ?>>
					<option value="0" <?php echo selected( $this->value(), get_the_ID() )?>>Select sidebar...</option>
				<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
					echo "<option " . selected( $this->value(), ucwords($sidebar['id']) ) . " value='" . ucwords( $sidebar['id'] ) . "'>" . ucwords( $sidebar['name'] ) . "</option>";
						} 
				?>
				</select>
				
				<script>
				</script>
			</label>
		<?php
		}
	}

	class WP_Customize_WidgetSize_Control extends WP_Customize_Control {
		public $type = 'widgetsize_dropdown';
		public $screen_size;
		public $num_widgets;
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<p><?php echo esc_html( $this->screen_size ); ?>-<?php echo esc_html( $this->num_widgets ); ?></p>
			</label>
		<?php
		}
	}
endif;

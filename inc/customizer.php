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
   	$wp_customize->add_setting( 'austeve_background_fixed' );
   	$wp_customize->add_setting( 'austeve_backgrounds' );
   	$wp_customize->add_setting( 'austeve_menu_layout' );

	$wp_customize->add_section( 'dessertstorm_bg_section' , array(
	    'title'       => __( 'Background', 'dessertstorm' ),
	    'priority'    => 30,
	    'description' => 'Upload a background image',
	) );

	$wp_customize->add_section( 'dessertstorm_menu_section' , array(
	    'title'       => __( 'Menu layout', 'dessertstorm' ),
	    'priority'    => 30,
	    'description' => 'Choose desired menu layout',
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

   	//Background fixed/scrolling
   	$wp_customize->add_control(
	    new WP_Customize_Dropdown_Control(
	        $wp_customize,
	        'austeve_background_fixed',
	        array(
				'label' 	=> __( 'Fixed/Scrolling?', 'dessertstorm' ),
				'description' => __( 'Should the background image be fixed, or scroll with the content (Image #1 will be repeated vertically)', 'dessertstorm' ),
				'section' 	=> 'dessertstorm_bg_section',
				'settings' 	=> 'austeve_background_fixed',
				'choices' 	=> array(
					'fixed' 	=> 'Fixed',
					'scroll' 	=> 'Scrolling',
				)
	        )
	    )
	);

	//Backgrounds
	$wp_customize->add_control( 
   		'austeve_backgrounds', 
		array(
			'label'    => __( 'Number of background images', 'dessertstorm' ),
			'section'  => 'dessertstorm_bg_section',
			'settings' => 'austeve_backgrounds',
			'type'     => 'text',
		)
	);

	$backgrounds = get_theme_mod('austeve_backgrounds', 0);

	for ($b = 0; $b < $backgrounds; $b++) {

   		$wp_customize->add_setting( 'austeve_background_image_'.($b+1) );
   		$wp_customize->add_setting( 'austeve_background_opacity_'.($b+1) );

		//Background Image
	   	$wp_customize->add_control( 
	   		new WP_Customize_Image_Control( 
	   			$wp_customize, 
	   			'austeve_background_image_'.($b+1), 
	   			array(
				    'label'    => __( 'Image #'.($b+1).':', 'dessertstorm' ),
				    'section'  => 'dessertstorm_bg_section',
				    'settings' => 'austeve_background_image_'.($b+1),
				) 
			) 
		);

	   	//Background opacity
	   	$wp_customize->add_control( 
	   		'austeve_background_opacity_'.($b+1), 
			array(
				'label'    => __( '#'.($b+1).' opacity', 'dessertstorm' ),
				'section'  => 'dessertstorm_bg_section',
				'settings' => 'austeve_background_opacity_'.($b+1),
				'type'     => 'text',
			)
		);

	}

   	//Menu layouts
   	$wp_customize->add_control(
	    new WP_Customize_Dropdown_Control(
	        $wp_customize,
	        'austeve_menu_layout',
	        array(
				'label' 	=> __( 'Layout', 'dessertstorm' ),
				'section' 	=> 'dessertstorm_menu_section',
				'settings' 	=> 'austeve_menu_layout',
				'choices' 	=> array(
					'topbar-right' 	=> 'Top-bar Right',
					'none' 	=> 'None',
				)
	        )
	    )
	);


	$sections = get_theme_mod('austeve_general_sections', 0);

	for ($s = 0; $s < $sections; $s++) {
		
		//Get section name
		$sectionName = get_theme_mod('dessertstorm_content_'.$s.'_name', null);
		if (!$sectionName)
		{
			$sectionName = '#'.($s+1);
		}

		//Add a section
		$wp_customize->add_section( 'dessertstorm_content_section_'.$s , array(
		    'title'       => __( 'Section: '.$sectionName, 'dessertstorm' ),
		    'priority'    => 200,
		) );

		//Add settings
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_name' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_style' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_page' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_sidebar' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_bgImage' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_bgColour' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_bgOpacity' );
   		$wp_customize->add_setting( 'dessertstorm_content_'.$s.'_bgForSmall', 
   			array (
				'default'  => true
			) 
   		);

   		//Section ID control
		$wp_customize->add_control( 
	   		'dessertstorm_content_'.$s.'_name', 
			array(
				'label'    => __( 'Section Name', 'dessertstorm' ),
				'section'  => 'dessertstorm_content_section_'.$s,
				'settings' => 'dessertstorm_content_'.$s.'_name',
				'type'     => 'text',
			)
		);

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
						'none' 	=> 'No content (spacing only)',
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

		//Section background image
	   	$wp_customize->add_control( 
	   		new WP_Customize_Image_Control( 
	   			$wp_customize, 
	   			'dessertstorm_content_'.$s.'_bgImage', 
	   			array(
				    'label'    => __( 'Background image:', 'dessertstorm' ),
				    'section'  => 'dessertstorm_content_section_'.$s,
				    'settings' => 'dessertstorm_content_'.$s.'_bgImage',
				) 
			) 
		);

	   	//Section background colour
	   	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
				$wp_customize, 
				'dessertstorm_content_'.$s.'_bgColour', 
				array(
					'label'      => __( 'Background colour:', 'dessertstorm' ),
					'section'    => 'dessertstorm_content_section_'.$s,
					'settings'   => 'dessertstorm_content_'.$s.'_bgColour',
				) 
			) 
		);

	   	//Section background opacity
	   	$wp_customize->add_control( 
	   		'dessertstorm_content_'.$s.'_bgOpacity', 
			array(
				'label'    => __( 'Background opacity', 'dessertstorm' ),
				'section'  => 'dessertstorm_content_section_'.$s,
				'settings' => 'dessertstorm_content_'.$s.'_bgOpacity',
				'type'     => 'text',
			)
		);

	   	//Section background image for small screens
	   	$wp_customize->add_control( 
	   		'dessertstorm_content_'.$s.'_bgForSmall', 
			array(
				'label'    => __( 'Display background image for small screens', 'dessertstorm' ),
				'section'  => 'dessertstorm_content_section_'.$s,
				'settings' => 'dessertstorm_content_'.$s.'_bgForSmall',
				'type'     => 'checkbox',
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
            <?php
            $backgrounds = get_theme_mod('austeve_backgrounds', 0);

			for ($b = 0; $b < $backgrounds; $b++) {
				echo "#bgImage".($b+1)." {";
				echo "background-image: url(".get_theme_mod('austeve_background_image_'.($b+1), '').");";
				echo "opacity: ".get_theme_mod('austeve_background_opacity_'.($b+1), '1.0').";";
            	echo "}";
			}
            
			$sections = get_theme_mod('austeve_general_sections', 0);

			for ($s = 0; $s < $sections; $s++) {

            	echo ".section-".$s." .content-background-div { ";
            	echo "    background-color: ".get_theme_mod('dessertstorm_content_'.$s.'_bgColour', '').";";
            	echo "    opacity: ".get_theme_mod('dessertstorm_content_'.$s.'_bgOpacity', '1.0').";";
            	echo "}";

            	echo ".section-".$s." .content-background-image { ";
            	echo "    background-image: url(".get_theme_mod('dessertstorm_content_'.$s.'_bgImage', '').");";
            	echo "}";
        	}
            ?>
        </style>
    <?php
}
add_action( 'wp_head', 'dessertstorm_customize_css');


if( class_exists( 'WP_Customize_Control' ) ):
	class WP_Customize_Dropdown_Control extends WP_Customize_Control {
		public $type = 'style_radio';
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

				<select <?php $this->link(); ?>>
					<option value="0" <?php echo selected( $this->value(), get_the_ID() )?>>Select menu layout...</option>
					<?php foreach ( $this->choices as $key => $value ) { 
						echo "<option " . selected( $this->value(), $key ) . " value='" . $key . "'>" . ucwords( $value ) . "</option>";
							} 
					?>
				</select>				
			</label>
		<?php
		}
	}

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
						echo "<option " . selected( $this->value(), $key ) . " value='" . $key . "'>" . $value . "</option>";
							} 
					?>
				</select>
				<script>
				
				function hideAll(s) {
					jQuery('#customize-control-dessertstorm_content_'+s+'_page, #customize-control-dessertstorm_content_'+s+'_sidebar' ).hide();
				}

				jQuery(function($){
					var s = '<?php echo $this->content_section; ?>';
					var v = '<?php echo $this->value(); ?>';

					hideAll(s);

					$('#customize-control-dessertstorm_content_'+s+'_'+v ).show();
					
					$('#customize-control-dessertstorm_content_'+s+'_style select').change(function() {
						hideAll(s);
						$('#customize-control-dessertstorm_content_'+s+'_'+this.value ).show();

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
			'order'       => 'ASC',
			'posts_per_page' => -1
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

endif;
?>
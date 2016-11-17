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

	$wp_customize->add_section( 'dessertstorm_footer_section' , array(
	    'title'       => __( 'Footer', 'dessertstorm' ),
	    'priority'    => 40,
	    'description' => 'Customize the footer',
	) );

	$wp_customize->add_section( 'dessertstorm_fonts_colours' , array(
	    'title'      	=> __('Fonts & Colours','dessertstorm'),
	    'description'	=> __('Font & colour customizations.','dessertstorm'),
	    'priority'   	=> 30,
	) );

	/* Logo max sizes */
   	$wp_customize->add_setting( 'dessertstorm_logo_maxheight' );
   	$wp_customize->add_control(
		new WP_Customize_FoundationSize_Control( 
			$wp_customize, 
			'dessertstorm_logo_maxheight', 
			array(
				'label'      => __( 'Logo max height', 'dessertstorm' ),
				'section'    => 'title_tagline',
				'settings'   => 'dessertstorm_logo_maxheight',
				'default_value' => '100%'
			) 
		) 
	);

   	$wp_customize->add_setting( 'dessertstorm_logo_maxwidth' );
   	$wp_customize->add_control(
		new WP_Customize_FoundationSize_Control( 
			$wp_customize, 
			'dessertstorm_logo_maxwidth', 
			array(
				'label'      => __( 'Logo max width', 'dessertstorm' ),
				'section'    => 'title_tagline',
				'settings'   => 'dessertstorm_logo_maxwidth',
				'default_value' => '100%'
			) 
		) 
	);

	/* Font family */
	$wp_customize->add_setting( 'font_family' , array(
	    'default'     => 'Helvetica, Roboto, Arial, sans-serif',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 'font_family', array(
			'label'    => __( 'Base font', 'dessertstorm' ),
			'section'  => 'dessertstorm_fonts_colours',
			'settings' => 'font_family',
			'type'     => 'select',
			'choices'  => array(
				'Helvetica Neue, Helvetica, Roboto, Arial, sans-serif'  => 'Helvetica Neue',
				'\'Neou Thin\', Helvetica, Roboto, Arial, sans-serif' => 'Neou (thin)',
				'\'Neou Bold\', Helvetica, Roboto, Arial, sans-serif' => 'Neou (thick)',
				'\'Fairfield Light\', Times, Serif' => 'Fairfield Light',
				'\'Times New Roman\', Times, Serif' => 'Times New Roman',
				'\'Avenir Light\', Arial, sans-serif' => 'Avenir Light',
			),
	) );

	$wp_customize->get_setting( 'font_family' )->transport = 'postMessage';

	/* Header background colour */
	$wp_customize->add_setting( 'header_background_color' , array(
	    'default'     => '#FFFFFF',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'        => __( 'Header colour', 'dessertstorm' ),
		'section'    => 'dessertstorm_fonts_colours',
		'settings'   => 'header_background_color',
	) ) );

	$wp_customize->get_setting( 'header_background_color' )->transport = 'postMessage';

	/* Header text colour */
	$wp_customize->add_setting( 'header_text_color' , array(
	    'default'     => '#00FF77',
	    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label'        => __( 'Header Text colour', 'dessertstorm' ),
		'section'    => 'dessertstorm_fonts_colours',
		'settings'   => 'header_text_color',
	) ) );

	$wp_customize->get_setting( 'header_text_color' )->transport = 'postMessage';

	#region Footer settings
	//Background colour
   	$wp_customize->add_setting( 'dessertstorm_footer_bgColour' );
	$wp_customize->add_control(
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'dessertstorm_footer_bgColour', 
			array(
				'label'      => __( 'Background colour:', 'dessertstorm' ),
				'section'    => 'dessertstorm_footer_section',
				'settings'   => 'dessertstorm_footer_bgColour',
			) 
		) 
	);

   	//Background opacity
   	$wp_customize->add_setting( 'dessertstorm_footer_bgOpacity' );
   	$wp_customize->add_control( 
   		'dessertstorm_footer_bgOpacity', 
		array(
			'label'    => __( 'Background opacity', 'dessertstorm' ),
			'section'  => 'dessertstorm_footer_section',
			'settings' => 'dessertstorm_footer_bgOpacity',
			'type'     => 'text',
		)
	);
	//Text colour
   	$wp_customize->add_setting( 'dessertstorm_footer_textColour' );
	$wp_customize->add_control(
		new WP_Customize_Color_Control( 
			$wp_customize, 
			'dessertstorm_footer_textColour', 
			array(
				'label'      => __( 'Text colour:', 'dessertstorm' ),
				'section'    => 'dessertstorm_footer_section',
				'settings'   => 'dessertstorm_footer_textColour',
			) 
		) 
	);

   	//Text opacity
   	$wp_customize->add_setting( 'dessertstorm_footer_textOpacity' );
   	$wp_customize->add_control( 
   		'dessertstorm_footer_textOpacity', 
		array(
			'label'    => __( 'Text opacity', 'dessertstorm' ),
			'section'  => 'dessertstorm_footer_section',
			'settings' => 'dessertstorm_footer_textOpacity',
			'type'     => 'text',
		)
	);

	//Alignment
   	$wp_customize->add_setting( 'dessertstorm_footer_textAlign' );
	$wp_customize->add_control(
	    new WP_Customize_Dropdown_Control(
	        $wp_customize,
	        'dessertstorm_footer_textAlign',
	        array(
				'label' 	=> __( 'Alignment', 'dessertstorm' ),
				'section' 	=> 'dessertstorm_footer_section',
				'settings' 	=> 'dessertstorm_footer_textAlign',
				'help_text'	=> 'Select alignment...',
				'choices' 	=> array(
					'left' 	=> 'Left',
					'center' 	=> 'Center',
					'right' 	=> 'Right',
					'justify' 	=> 'Justify',
				)
	        )
	    )
	);

	//Content
   	$wp_customize->add_setting( 'dessertstorm_footer_content' );
	$wp_customize->add_control(
	    new WP_Customize_Textarea_Control(
	        $wp_customize,
	        'dessertstorm_footer_content',
	        array(
				'label' 	=> __( 'Content', 'dessertstorm' ),
				'section' 	=> 'dessertstorm_footer_section',
				'settings' 	=> 'dessertstorm_footer_content',
				'default_value' => 'Website by: <a class="fa fa-copyright" href="http://weavercrawford.com">'.date("Y").' Weaver Crawford Creative</a>'
	        )
	    )
	);


	#endregion

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
				'help_text'  => 'Select style',
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
				'help_text'  => 'Select menu layout...',
				'choices' 	=> array(
					'topbar-right' 	=> 'Top-bar Right',
					'centered-single' 	=> 'Centered Single Menu',
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
	//Logo max sizes
	$maxheights = json_decode(get_theme_mod('dessertstorm_logo_maxheight'), true);
	$maxwidths = json_decode(get_theme_mod('dessertstorm_logo_maxwidth'), true);
        	
    ?>
        <style type="text/css">

            body, h1, h2, h3, h4, h5, h6, a, .menu-item a, .title-bar-title, #colophon { 
				font-family: <?php echo get_theme_mod('font_family', 'Helvetica Neue, Helvetica, Roboto, Arial, sans-serif'); ?>;
			}
			
            @media only screen and (max-width: 40em) { 
            	
             	.primary-navigation {
				    border-left: 1px solid <?php echo get_theme_mod('header_text_color', '#FFFFFF'); ?>;
				    border-right: 1px solid <?php echo get_theme_mod('header_text_color', '#FFFFFF'); ?>;
             	}

             	.primary-navigation ul li {
				    border-bottom: 1px solid <?php echo get_theme_mod('header_text_color', '#FFFFFF'); ?>;
				}

             	#small-menu-container .is-accordion-submenu-parent > a {
             		background:<?php echo get_theme_mod('header_text_color', '#FFFFFF'); ?>;
        	  		color:<?php echo get_theme_mod('header_background_color', '#000000'); ?>;  
             	}

			}

            .site-title a, .title-bar li a:not(.button), .title-bar li a:not(.button):hover { 
        	  	color:<?php echo get_theme_mod('header_text_color', '#000000'); ?>; 
            }

            #colophon button[type="submit"] {
            	background: <?php echo get_theme_mod('header_text_color', '#FFFFFF'); ?>;
            	color: <?php echo get_theme_mod('header_background_color', '#000000'); ?>;
            }

        	img.custom-logo {
        		max-height: <?php echo $maxheights['small']; ?>;
        		max-width: <?php echo $maxwidths['small']; ?>;;
        	}
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
            	echo "    transform: translate3d(0, 0, 0);"; /* Required for the background to display in the right plane on Safari */
            	echo "}";

            	echo ".section-".$s." .content-background-image { ";
            	echo "    background-image: url(".get_theme_mod('dessertstorm_content_'.$s.'_bgImage', '').");";
            	echo "}";
        	}

        	$footerBgColour = (get_theme_mod('dessertstorm_footer_bgColour', 'transparent') === '' ? 'transparent' : get_theme_mod('dessertstorm_footer_bgColour'));
			$footerTextColour_hex = (get_theme_mod('dessertstorm_footer_textColour', '#000000') === '' ? '#000000' : get_theme_mod('dessertstorm_footer_textColour') );
			list($ftc_r, $ftc_g, $ftc_b) = sscanf($footerTextColour_hex, "#%02x%02x%02x");
			
            echo "#colophon {";
        	echo "    background-color: ".$footerBgColour.";";
        	echo "    opacity: ".get_theme_mod('dessertstorm_footer_bgOpacity', '1.0').";";
        	echo "    color: rgba($ftc_r, $ftc_g, $ftc_b, ".get_theme_mod('dessertstorm_footer_textOpacity', '1.0').");";
        	echo "    text-align: ".get_theme_mod('dessertstorm_footer_textAlign', 'center').";";
        	echo "}";

            echo "#colophon a{";
        	echo "    color: rgba($ftc_r, $ftc_g, $ftc_b, ".get_theme_mod('dessertstorm_footer_textOpacity', '1.0').");";
        	echo "}";
        	?>

        </style>
        <style>

            @media only screen and (min-width: 40em) { 
	        	img.custom-logo {
	        		max-height: <?php echo $maxheights['medium']; ?>;
	        		max-width: <?php echo $maxwidths['medium']; ?>;;
	        	}
            }

            @media only screen and (min-width: 64em) { 
	        	img.custom-logo {
	        		max-height: <?php echo $maxheights['large']; ?>;
	        		max-width: <?php echo $maxwidths['large']; ?>;;
	        	}
            }
        </style>
    <?php
}
add_action( 'wp_head', 'dessertstorm_customize_css');


if( class_exists( 'WP_Customize_Control' ) ):

	class WP_Customize_FoundationSize_Control extends WP_Customize_Control {
	    public $type = 'foundationsize';
		public $default_value;
	 
	    public function render_content() {
	    	$sizes = ($this->value() == '') ? $this->default_value : $this->value();
	    	$id = strtolower( esc_html( $this->label ));
	    	$id = str_replace(" ", "-", $id);

	        ?>
	        <label>
		        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        </label>
	        <div style="text-align: right">
		        Small: <input type="text" id='<?php echo $id; ?>-small' class='<?php echo $id; ?>' value="<?php echo json_decode($sizes, true)['small']; ?>" style="width: 50%"/><br/>
		        Medium: <input type="text" id='<?php echo $id; ?>-medium' class='<?php echo $id; ?>' value="<?php echo json_decode($sizes, true)['medium']; ?>" style="width: 50%"/><br/>
		        Large: <input type="text" id='<?php echo $id; ?>-large' class='<?php echo $id; ?>' value="<?php echo json_decode($sizes, true)['large']; ?>" style="width: 50%"/>
		        <input <?php $this->link(); ?> type="hidden" id='<?php echo $id; ?>' value="<?php echo $sizes; ?>"/>
	        </div>
	        <script>
				
				jQuery( ".<?php echo $id; ?>" ).change(function() {

					var newSizesArray = {
						small: jQuery( "#<?php echo $id; ?>-small" ).attr("value"), 
						medium: jQuery( "#<?php echo $id; ?>-medium" ).attr("value"), 
						large: jQuery( "#<?php echo $id; ?>-large" ).attr("value")
					};

				  	jQuery( "#<?php echo $id; ?>" ).attr("value", JSON.stringify(newSizesArray))
					jQuery( "#<?php echo $id; ?>" ).change();
				});

			</script>

	        <?php
	    }
	}

	class WP_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
		public $default_value;
	 
	    public function render_content() {
	    	$content = ($this->value() == '') ? $this->default_value : $this->value();
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $content ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	class WP_Customize_Dropdown_Control extends WP_Customize_Control {
		public $type = 'style_radio';
		public $help_text;
 
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

				<select <?php $this->link(); ?>>
					<option value="0" <?php echo selected( $this->value(), get_the_ID() )?>><?php echo $this->help_text; ?></option>
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
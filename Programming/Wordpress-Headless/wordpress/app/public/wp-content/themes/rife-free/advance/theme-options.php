<?php

function apollo13framework_setup_theme_options() {
	global $apollo13framework_a13;

	//get all cursors
	$cursors = array(
		'christmas.png'         => 'christmas.png',
		'empty_black.png'       => 'empty_black.png',
		'empty_black_white.png' => 'empty_black_white.png',
		'superior_cursor.png'   => 'superior_cursor.png'
	);
	$apollo13framework_a13->set_settings_set( 'cursors', $cursors );

	//get all menu effects
	$menu_effects = array(
		'none'      => esc_html__( 'None', 'rife-free' ),
		'ferdinand' => 'ferdinand'
	);
	$apollo13framework_a13->set_settings_set( 'menu_effects', $menu_effects );

	//get all custom sidebars
	$header_sidebars = $apollo13framework_a13->get_option( 'custom_sidebars' );
	if ( ! is_array( $header_sidebars ) ) {
		$header_sidebars = array();
	}
	//create 2 arrays for different purpose
	$header_sidebars            = array_merge( array( 'off' => esc_html__( 'Off', 'rife-free' ) ), $header_sidebars );
	$header_sidebars_off_global = array_merge( array( 'G' => esc_html__( 'Global settings', 'rife-free' ) ), $header_sidebars );
	//re-indexing these arrays
	array_unshift( $header_sidebars, null );
	unset( $header_sidebars[0] );
	array_unshift( $header_sidebars_off_global, null );
	unset( $header_sidebars_off_global[0] );
	$apollo13framework_a13->set_settings_set( 'header_sidebars', $header_sidebars );
	$apollo13framework_a13->set_settings_set( 'header_sidebars_off_global', $header_sidebars_off_global );

	$on_off = array(
		'on'  => esc_html__( 'Enable', 'rife-free' ),
		'off' => esc_html__( 'Disable', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'on_off', $on_off );

	$font_weights = array(
		'100'    => esc_html__( '100', 'rife-free' ),
		'200'    => esc_html__( '200', 'rife-free' ),
		'300'    => esc_html__( '300', 'rife-free' ),
		'normal' => esc_html__( 'Normal 400', 'rife-free' ),
		'500'    => esc_html__( '500', 'rife-free' ),
		'600'    => esc_html__( '600', 'rife-free' ),
		'bold'   => esc_html__( 'Bold 700', 'rife-free' ),
		'800'    => esc_html__( '800', 'rife-free' ),
		'900'    => esc_html__( '900', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'font_weights', $font_weights );

	$font_transforms = array(
		'none'      => esc_html__( 'None', 'rife-free' ),
		'uppercase' => esc_html__( 'Uppercase', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'font_transforms', $font_transforms );

	$text_align = array(
		'left'   => esc_html__( 'Left', 'rife-free' ),
		'center' => esc_html__( 'Center', 'rife-free' ),
		'right'  => esc_html__( 'Right', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'text_align', $text_align );

	$image_fit = array(
		'cover'    => esc_html__( 'Cover', 'rife-free' ),
		'contain'  => esc_html__( 'Contain', 'rife-free' ),
		'fitV'     => esc_html__( 'Fit Vertically', 'rife-free' ),
		'fitH'     => esc_html__( 'Fit Horizontally', 'rife-free' ),
		'center'   => esc_html__( 'Just center', 'rife-free' ),
		'repeat'   => esc_html__( 'Repeat', 'rife-free' ),
		'repeat-x' => esc_html__( 'Repeat X', 'rife-free' ),
		'repeat-y' => esc_html__( 'Repeat Y', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'image_fit', $image_fit );

	$content_layouts = array(
		'center'        => esc_html__( 'Center fixed width', 'rife-free' ),
		'left'          => esc_html__( 'Left fixed width', 'rife-free' ),
		'left_padding'  => esc_html__( 'Left fixed width + padding', 'rife-free' ),
		'right'         => esc_html__( 'Right fixed width', 'rife-free' ),
		'right_padding' => esc_html__( 'Right fixed width + padding', 'rife-free' ),
		'full_fixed'    => esc_html__( 'Full width + fixed content', 'rife-free' ),
		'full_padding'  => esc_html__( 'Full width + padding', 'rife-free' ),
		'full'          => esc_html__( 'Full width', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'content_layouts', $content_layouts );

	$parallax_types = array(
		"tb"   => esc_html__( 'top to bottom', 'rife-free' ),
		"bt"   => esc_html__( 'bottom to top', 'rife-free' ),
		"lr"   => esc_html__( 'left to right', 'rife-free' ),
		"rl"   => esc_html__( 'right to left', 'rife-free' ),
		"tlbr" => esc_html__( 'top-left to bottom-right', 'rife-free' ),
		"trbl" => esc_html__( 'top-right to bottom-left', 'rife-free' ),
		"bltr" => esc_html__( 'bottom-left to top-right', 'rife-free' ),
		"brtl" => esc_html__( 'bottom-right to top-left', 'rife-free' ),
	);

	$content_under_header = array(
		'content' => esc_html__( 'Yes, hide the content', 'rife-free' ),
		'title'   => esc_html__( 'Yes, hide the content and add top padding to the outside title bar.', 'rife-free' ),
		'off'     => esc_html__( 'Turn it off', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'content_under_header', $content_under_header );

	$social_colors = array(
		'black'            => esc_html__( 'Black', 'rife-free' ),
		'color'            => esc_html__( 'Color', 'rife-free' ),
		'white'            => esc_html__( 'White', 'rife-free' ),
		'semi-transparent' => esc_html__( 'Semi transparent', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'social_colors', $social_colors );

	$bricks_hover = array(
		'cross'      => esc_html__( 'Show cross', 'rife-free' ),
		'drop'       => esc_html__( 'Drop', 'rife-free' ),
		'shift'      => esc_html__( 'Shift', 'rife-free' ),
		'pop'        => esc_html__( 'Pop text', 'rife-free' ),
		'border'     => esc_html__( 'Border', 'rife-free' ),
		'scale-down' => esc_html__( 'Scale down', 'rife-free' ),
		'none'       => esc_html__( 'None', 'rife-free' ),
	);
	$apollo13framework_a13->set_settings_set( 'bricks_hover', $bricks_hover );

	//tags allowed in descriptions
	$valid_tags = array(
		'a'      => array(
			'href' => array(),
		),
		'br'     => array(),
		'code'   => array(),
		'em'     => array(),
		'strong' => array(),
	);
	$apollo13framework_a13->set_settings_set( 'valid_tags', $valid_tags );

	$rp_tab = '<a href="' . esc_url( admin_url( 'themes.php?page=apollo13_pages&amp;subpage=rife_pro' ) ) . '">Rife Pro</a>';

	/*
	 *
	 * ---> START SECTIONS
	 *
	 */

//GENERAL SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'General settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_general_settings',
		'icon'     => 'el el-adjust-alt',
		'priority' => 3,
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Front page', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_general_front_page',
		'icon'       => 'fa fa-home',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'fp_variant',
				'type'        => 'select',
				'title'       => esc_html__( 'What to show on the front page?', 'rife-free' ),
				/* translators: %s: URL */
				'description' => sprintf( wp_kses( __( 'If you choose <strong>Page</strong> then make sure that in <a href="%s">WordPress Homepage Settings</a> you have selected <strong>A static page</strong>, that you wish to use as the front page.', 'rife-free' ), $valid_tags ), 'javascript:wp.customize.section( \'static_front_page\' ).focus();' ),
				'options'     => array(
					'page'         => esc_html__( 'Page', 'rife-free' ),
					'blog'         => esc_html__( 'Blog', 'rife-free' ),
					'single_album' => esc_html__( 'Single album', 'rife-free' ),
					'albums_list'  => esc_html__( 'Albums list', 'rife-free' ),
					'single_work'  => esc_html__( 'Single work', 'rife-free' ),
					'works_list'   => esc_html__( 'Works list', 'rife-free' ),
				),
				'default'     => 'page',

			),
			array(
				'id'       => 'fp_album',
				'type'     => 'wp_dropdown_albums',
				'title'    => esc_html__( 'Select album to use as the front page', 'rife-free' ),
				'required' => array( 'fp_variant', '=', 'single_album' ),

			),
			array(
				'id'       => 'fp_work',
				'type'     => 'wp_dropdown_works',
				'title'    => esc_html__( 'Select work to use as the front page', 'rife-free' ),
				'required' => array( 'fp_variant', '=', 'single_work' ),

			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'General layout', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_main_settings',
		'icon'       => 'fa fa-wrench',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'appearance_body_image',
				'type'    => 'image',
				'title'   => esc_html__( 'Background image', 'rife-free' ),
				'partial' => array(
					'selector'            => '.page-background',
					'container_inclusive' => true,
					'settings'            => array(
						'appearance_body_image',
						'appearance_body_image_fit',
						'appearance_body_bg_color',
					),
					'render_callback'     => 'apollo13framework_page_background',
				),
			),
			array(
				'id'      => 'appearance_body_image_fit',
				'type'    => 'select',
				'title'   => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options' => $image_fit,
				'default' => 'cover',
				'partial' => true,
			),
			array(
				'id'      => 'appearance_body_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '#999999',
				'partial' => true,
			),
			array(
				'id'          => 'layout_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Layout', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Layout boxed & framed are available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'full' => esc_html__( 'Full width', 'rife-free' ),
				),
				'default'     => 'full',
			),
			array(
				'id'      => 'custom_cursor',
				'type'    => 'radio',
				'title'   => esc_html__( 'Mouse cursor', 'rife-free' ),
				'options' => array(
					'default' => esc_html__( 'Normal', 'rife-free' ),
					'select'  => esc_html__( 'Predefined', 'rife-free' ),
					'custom'  => esc_html__( 'Custom', 'rife-free' ),
				),
				'default' => 'default',
				'js'      => true,
			),
			array(
				'id'       => 'cursor_select',
				'type'     => 'select',
				'title'    => esc_html__( 'Cursor', 'rife-free' ),
				'options'  => $cursors,
				'default'  => 'empty_black_white.png',
				'required' => array( 'custom_cursor', '=', 'select' ),
				'js'       => true,
			),
			array(
				'id'       => 'cursor_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Custom cursor image', 'rife-free' ),
				'required' => array( 'custom_cursor', '=', 'custom' ),
				'js'       => true,
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Page preloader', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_page_preloader',
		'icon'       => 'fa fa-spinner',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'preloader',
				'type'        => 'radio',
				'title'       => esc_html__( 'Page preloader', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'js'          => true,
			),
			array(
				'id'          => 'preloader_hide_event',
				'type'        => 'radio',
				'title'       => esc_html__( 'Hide event', 'rife-free' ),
				'description' => wp_kses( __( '<strong>On load</strong> is called when the whole site, with all the images, is loaded, which can take a lot of time on heavier sites, and even more time on mobile devices. Also,  it can sometimes hang and never hide the preloader, when there is a problem with some resource. <br /><strong>On DOM ready</strong> is called when the whole HTML with CSS is loaded, so after the preloader is hidden, you can still see the loading of images. This is a much safer option.', 'rife-free' ), $valid_tags ),
				'options'     => array(
					'ready' => esc_html__( 'On DOM ready', 'rife-free' ),
					'load'  => esc_html__( 'On load', 'rife-free' ),
				),
				'default'     => 'ready',
				'required'    => array( 'preloader', '=', 'on' ),
				'js'          => true,
			),
			array(
				'id'       => 'preloader_bg_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'preloader', '=', 'on' ),
				'partial'  => array(
					'selector'            => '#preloader',
					'container_inclusive' => true,
					'settings'            => array(
						'preloader_bg_image',
						'preloader_bg_image_fit',
						'preloader_bg_color',
						'preloader_type',
						'preloader_color',
					),
					'render_callback'     => 'apollo13framework_page_preloader',
				),
			),
			array(
				'id'       => 'preloader_bg_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'preloader', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'preloader_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'preloader', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'preloader_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Type', 'rife-free' ),
				'options'  => array(
					'none'              => esc_html__( 'none', 'rife-free' ),
					'atom'              => esc_html__( 'Atom', 'rife-free' ),
					'flash'             => esc_html__( 'Flash', 'rife-free' ),
					'indicator'         => esc_html__( 'Indicator', 'rife-free' ),
					'radar'             => esc_html__( 'Radar', 'rife-free' ),
					'circle_illusion'   => esc_html__( 'Circle Illusion', 'rife-free' ),
					'square_of_squares' => esc_html__( 'Square of squares', 'rife-free' ),
					'plus_minus'        => esc_html__( 'Plus minus', 'rife-free' ),
					'hand'              => esc_html__( 'Hand', 'rife-free' ),
					'blurry'            => esc_html__( 'Blurry', 'rife-free' ),
					'arcs'              => esc_html__( 'Arcs', 'rife-free' ),
					'tetromino'         => esc_html__( 'Tetromino', 'rife-free' ),
					'infinity'          => esc_html__( 'Infinity', 'rife-free' ),
					'cloud_circle'      => esc_html__( 'Cloud circle', 'rife-free' ),
					'dots'              => esc_html__( 'Dots', 'rife-free' ),
					'jet_pack_man'      => esc_html__( 'Jet-Pack-Man', 'rife-free' ),
					'circle'            => 'Circle'
				),
				'default'  => 'flash',
				'required' => array( 'preloader', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'preloader_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Animation color', 'rife-free' ),
				'required' => array(
					array( 'preloader', '=', 'on' ),
					array( 'preloader_type', '!=', 'tetromino' ),
					array( 'preloader_type', '!=', 'blurry' ),
					array( 'preloader_type', '!=', 'square_of_squares' ),
					array( 'preloader_type', '!=', 'circle_illusion' ),
				),
				'default'  => '',
				'partial'  => true,
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Theme Header', 'rife-free' ),
		'desc'       => esc_html__( 'Theme header is a place where you usually find the logo of your site, main menu, and a few other elements.', 'rife-free' ),
		'id'         => 'subsection_header',
		'icon'       => 'fa fa-ellipsis-h',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'header_switch',
				'type'    => 'radio',
				'title'   => esc_html__( 'Theme Header', 'rife-free' ),
				'description' => esc_html__( 'If you do not plan to use theme header or want to replace it with something else, just disable it here.', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			)
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Footer', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_footer',
		'icon'       => 'fa fa-ellipsis-h',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'footer_switch',
				'type'    => 'radio',
				'title'   => esc_html__( 'Footer', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
				'partial'     => array(
					'selector'            => '#footer',
					'container_inclusive' => true,
					'settings'            => array(
						'footer_switch',
						'footer_widgets_columns',
						'footer_text',
						'footer_privacy_link',
						'footer_content_width',
						'footer_content_style',
						'footer_bg_color',
						'footer_lower_bg_color',
						'footer_lower_bg_color',
						'footer_widgets_color',
						'footer_separator',
						'footer_separator_color',
						'footer_font_size',
						'footer_widgets_font_size',
						'footer_font_color',
						'footer_link_color',
						'footer_hover_color',
					),
					'render_callback'     => 'apollo13framework_theme_footer',
				),
			),
			array(
				'id'       => 'footer_widgets_columns',
				'type'     => 'select',
				'title'    => esc_html__( 'Widgets columns number', 'rife-free' ),
				'options'  => array(
					'1' => esc_html__( '1', 'rife-free' ),
					'2' => esc_html__( '2', 'rife-free' ),
					'3' => esc_html__( '3', 'rife-free' ),
					'4' => esc_html__( '4', 'rife-free' ),
					'5' => esc_html__( '5', 'rife-free' ),
				),
				'default'  => '3',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'          => 'footer_text',
				'type'        => 'textarea',
				'title'       => esc_html__( 'Content', 'rife-free' ),
				'description' => esc_html__( 'You can use HTML here.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => true,
			),
			array(
				'id'          => 'footer_privacy_link',
				'type'        => 'radio',
				'title'       => esc_html__( 'Privacy Policy Link', 'rife-free' ),
				'description' => esc_html__( 'Since WordPress 4.9.6 there is an option to set Privacy Policy page. If you enable this option it will display a link to it in the footer after footer content.', 'rife-free' ).' <a href="'.esc_url( admin_url( 'privacy.php' ) ).'">'.esc_html__( 'Here you can set your Privacy Policy page', 'rife-free' ).'</a>',
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => true,
			),
			array(
				'id'          => 'footer_socials',
				'type'        => 'radio',
				'title'       => esc_html__( 'Social icons', 'rife-free' ),
				/* translators: %s: URL */
				'description' => sprintf( wp_kses( __( 'If you need to edit social links go to <a href="%s">Social icons</a> settings.', 'rife-free' ), $valid_tags ), 'javascript:wp.customize.section( \'section_social\' ).focus();' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => array(
					'selector'            => '.f-links',
					'container_inclusive' => true,
					'settings'            => array(
						'footer_socials',
						'footer_socials_color',
						'footer_socials_color_hover',
					),
					'render_callback'     => 'footer_socials'
				),
			),
			array(
				'id'       => 'footer_socials_color',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'color',
				'required' => array(
					array( 'footer_switch', '=', 'on' ),
					array( 'footer_socials', '=', 'on' ),
				),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_socials_color_hover',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'semi-transparent',
				'required' => array(
					array( 'footer_switch', '=', 'on' ),
					array( 'footer_socials', '=', 'on' ),
				),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_content_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'narrow' => esc_html__( 'Narrow', 'rife-free' ),
					'full'   => esc_html__( 'Full width', 'rife-free' ),
				),
				'default'  => 'narrow',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_content_style',
				'type'     => 'radio',
				'title'    => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Style', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_lower_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Lower part', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'desc'     => esc_html__( 'If you want to have a different color in the lower part than in the footer widgets.', 'rife-free' ),
				'default'  => '',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_widgets_color',
				'type'     => 'radio',
				'title'    => esc_html__( 'Widgets colors', 'rife-free' ),
				'desc'     => esc_html__( 'Depending on what background you have set up, choose proper option.', 'rife-free' ),
				'options'  => array(
					'dark-sidebar'  => esc_html__( 'On dark', 'rife-free' ),
					'light-sidebar' => esc_html__( 'On light', 'rife-free' ),
				),
				'default'  => 'dark-sidebar',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_separator',
				'type'     => 'radio',
				'title'    => esc_html__( 'Separator between widgets and footer content', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_separator_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Separator', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'footer_switch', '=', 'on' ),
					array( 'footer_separator', '=', 'on' ),
				),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Lower part', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'default'  => 10,
				'min'      => 10,
				'max'      => 30,
				'step'     => 1,
				'unit'     => 'px',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'       => 'footer_widgets_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Widgets part', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'default'  => 10,
				'min'      => 10,
				'max'      => 30,
				'step'     => 1,
				'unit'     => 'px',
				'required' => array( 'footer_switch', '=', 'on' ),
				'partial'  => true,
			),
			array(
				'id'          => 'footer_font_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Lower part', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Does not work for footer widgets.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => true,
			),
			array(
				'id'          => 'footer_link_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Lower part', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Does not work for footer widgets.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => true,
			),
			array(
				'id'          => 'footer_hover_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Lower part', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => esc_html__( 'Does not work for footer widgets.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'footer_switch', '=', 'on' ),
				'partial'     => true,
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Hidden sidebar', 'rife-free' ),
		'desc'       => esc_html__( 'It is active only if it contains active widgets. After activation, displays the opening button in the header.', 'rife-free' ),
		'id'         => 'subsection_hidden_sidebar',
		'icon'       => 'fa fa-columns',
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'hidden_sidebar_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'hidden_sidebar_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'default' => 10,
				'min'     => 5,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'px',
			),
			array(
				'id'          => 'hidden_sidebar_widgets_color',
				'type'        => 'radio',
				'title'       => esc_html__( 'Widgets colors', 'rife-free' ),
				'description' => esc_html__( 'Depending on what background you have set up, choose proper option.', 'rife-free' ),
				'options'     => array(
					'dark-sidebar'  => esc_html__( 'On dark', 'rife-free' ),
					'light-sidebar' => esc_html__( 'On light', 'rife-free' ),
				),
				'default'     => 'dark-sidebar',
			),
			array(
				'id'      => 'hidden_sidebar_side',
				'type'    => 'radio',
				'title'   => esc_html__( 'Side', 'rife-free' ),
				'options' => array(
					'left'  => esc_html__( 'Left', 'rife-free' ),
					'right' => esc_html__( 'Right', 'rife-free' ),
				),
				'default' => 'left',
			),
			array(
				'id'      => 'hidden_sidebar_effect',
				'type'    => 'select',
				'title'   => esc_html__( 'Opening effect', 'rife-free' ),
				'options' => array(
					'1' => esc_html__( 'Slide in on top', 'rife-free' ),
					'2' => esc_html__( 'Reveal', 'rife-free' ),
					'3' => esc_html__( 'Push', 'rife-free' ),
					'4' => esc_html__( 'Slide along', 'rife-free' ),
					'5' => esc_html__( 'Reverse slide out', 'rife-free' ),
					'6' => esc_html__( 'Fall down', 'rife-free' ),
				),
				'default' => '2',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Fonts settings', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_fonts_settings',
		'icon'       => 'fa fa-font',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'nav_menu_fonts',
				'type'        => 'font',
				'title'       => esc_html__( 'Font for main navigation menu and overlay menu:', 'rife-free' ),
				'default'     => array(
					'font-family'    => '-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif',
					'word-spacing'   => 'normal',
					'letter-spacing' => 'normal'
				),
			),
			array(
				'id'          => 'titles_fonts',
				'type'        => 'font',
				'title'       => esc_html__( 'Font for Titles/Headings:', 'rife-free' ),
				'default'     => array(
					'font-family'    => '-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif',
					'word-spacing'   => 'normal',
					'letter-spacing' => 'normal'
				),
			),
			array(
				'id'          => 'normal_fonts',
				'type'        => 'font',
				'title'       => esc_html__( 'Font for normal(content) text:', 'rife-free' ),
				'default'     => array(
					'font-family'    => '-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif',
					'word-spacing'   => 'normal',
					'letter-spacing' => 'normal'
				),
			),
			array(
				'id'      => 'logo_fonts',
				'type'    => 'font',
				'title'   => esc_html__( 'Font for text logo:', 'rife-free' ),
				'default' => array(
					'font-family'    => '-apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif',
					'word-spacing'   => 'normal',
					'letter-spacing' => 'normal'
				),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Headings', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_heading_styles',
		'icon'       => 'fa fa-header',
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'headings_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'headings_color_hover',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'headings_weight',
				'type'    => 'select',
				'title'   => esc_html__( 'Font weight', 'rife-free' ),
				'options' => $font_weights,
				'default' => 'bold',
			),
			array(
				'id'      => 'headings_transform',
				'type'    => 'radio',
				'title'   => esc_html__( 'Text transform', 'rife-free' ),
				'options' => $font_transforms,
				'default' => 'uppercase',
			),
			array(
				'id'      => 'page_title_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Main titles', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'default' => 36,
				'min'     => 10,
				'step'    => 1,
				'max'     => 60,
				'unit'    => 'px',
			),
			array(
				'id'          => 'page_title_font_size_768',
				'type'        => 'slider',
				'title'       => esc_html__( 'Main titles', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ). ' - ' .esc_html__( 'on mobile devices', 'rife-free' ),
				'description' => esc_html__( 'It will be used on devices less than 768 pixels wide.', 'rife-free' ),
				'min'         => 10,
				'max'         => 60,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 32,
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Content', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_content_styles',
		'icon'       => 'fa fa-align-left',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'content_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Background color', 'rife-free' ),
				'description' => esc_html__( 'It will change the default white background color that is set under content on pages, blog, posts, works, and albums.', 'rife-free' ),
				'default'     => '#ffffff',
			),
			array(
				'id'      => 'content_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ),
				'default' => '#000000',
			),
			array(
				'id'      => 'content_link_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'content_link_color_hover',
				'type'    => 'color',
				'title'   => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'content_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'default' => 16,
				'min'     => 10,
				'step'    => 1,
				'max'     => 30,
				'unit'    => 'px',
			),
			array(
				'id'          => 'first_paragraph',
				'type'        => 'radio',
				'title'       => esc_html__( 'First paragraph', 'rife-free' ). ' : ' .esc_html__( 'Highlight', 'rife-free' ),
				'description' => esc_html__( 'If enabled, it highlights(font size and color) the first paragraph in the content(blog, post, page).', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'       => 'first_paragraph_color',
				'type'     => 'color',
				'title'    => esc_html__( 'First paragraph', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'first_paragraph', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Social icons', 'rife-free' ),
		'desc'       => esc_html__( 'These icons will be used in various places across theme if you decide to activate them.', 'rife-free' ),
		'id'         => 'section_social',
		'icon'       => 'fa fa-facebook-official',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'socials_variant',
				'type'    => 'radio',
				'title'   => esc_html__( 'Type of icons', 'rife-free' ),
				'options' => array(
					'squares'    => esc_html__( 'Squares', 'rife-free' ),
					'circles'    => esc_html__( 'Circles', 'rife-free' ),
					'icons-only' => esc_html__( 'Only icons', 'rife-free' ),
				),
				'default' => 'squares',
			),
			array(
				'id'          => 'social_services',
				'type'        => 'socials',
				'title'       => esc_html__( 'Links', 'rife-free' ),
				'description' => esc_html__( 'Drag and drop to change order of icons. Only filled links will show up as social icons.', 'rife-free' ),
				'label'       => false,
				'options'     => $apollo13framework_a13->get_social_icons_list( 'names' ),
				'default'     => $apollo13framework_a13->get_social_icons_list( 'empty' )
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Lightbox settings', 'rife-free' ),
		'desc'       => esc_html__( 'If you wish to use some other plugin/script for images and items, you can switch off default theme lightbox. If you are planning to use different lightbox script instead, then you will have to do some extra work with scripting to make it work in every theme place.', 'rife-free' ),
		'id'         => 'subsection_lightbox',
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'apollo_lightbox',
				'type'        => 'radio',
				'title'       => esc_html__( 'Theme lightbox', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Detailed setting for lightGallery are available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'lightGallery' => esc_html__( 'Light Gallery', 'rife-free' ),
					'off'          => esc_html__( 'Disable', 'rife-free' ),
				),
				'default'     => 'lightGallery',
			),
			array(
				'id'          => 'lightbox_single_post',
				'type'        => 'radio',
				'title'       => esc_html__( 'Use theme lightbox for images in posts', 'rife-free' ),
				'description' => esc_html__( 'If enabled, the theme will use a lightbox to display images in the post content. To work properly, Images should link to "Media File".', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'apollo_lightbox', '=', 'lightGallery' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Widgets', 'rife-free' ),
		'id'         => 'subsection_widgets',
		'icon'       => 'fa fa-puzzle-piece',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'widgets_top_margin',
				'type'        => 'radio',
				'title'       => esc_html__( 'Top margin', 'rife-free' ),
				'description' => esc_html__( 'It only affects the widgets in the vertical sidebars.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'      => 'widget_title_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Main titles', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'min'     => 10,
				'max'     => 60,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 14,
			),
			array(
				'id'          => 'widget_font_size',
				'type'        => 'slider',
				'title'       => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'description' => esc_html__( 'It only affects the widgets in the vertical sidebars.', 'rife-free' ),
				'min'         => 5,
				'max'         => 30,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 12,
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'To top button', 'rife-free' ),
		'id'         => 'subsection_to_top',
		'icon'       => 'fa fa-chevron-up',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'to_top',
				'type'        => 'radio',
				'title'       => esc_html__( 'To top button', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'      => 'to_top_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '#524F51',
				'required' => array( 'to_top', '=', 'on' ),
			),
			array(
				'id'      => 'to_top_bg_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#000000',
				'required' => array( 'to_top', '=', 'on' ),
			),
			array(
				'id'      => 'to_top_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Icon', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'default' => '#cccccc',
				'required' => array( 'to_top', '=', 'on' ),
			),
			array(
				'id'      => 'to_top_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Icon', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#ffffff',
				'required' => array( 'to_top', '=', 'on' ),
			),
			array(
				'id'      => 'to_top_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Icon', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'min'     => 10,
				'step'    => 1,
				'max'     => 60,
				'unit'    => 'px',
				'default' => 13,
				'required' => array( 'to_top', '=', 'on' ),
			),
			array(
				'id'          => 'to_top_icon',
				'type'        => 'text',
				'title'       => esc_html__( 'Icon', 'rife-free' ),
				'default'     => 'chevron-up',
				'input_attrs' => array(
					'class' => 'a13-fa-icon',
				),
				'required' => array( 'to_top', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Buttons', 'rife-free' ),
		'desc'       => esc_html__( 'You can change here colors of buttons that submit forms. For shop buttons, go to the shop settings.', 'rife-free' ),
		'id'         => 'subsection_buttons',
		'icon'       => 'fa fa-arrow-down',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'button_submit_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '#524F51',
			),
			array(
				'id'      => 'button_submit_bg_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#000000',
			),
			array(
				'id'      => 'button_submit_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ),
				'default' => '#cccccc'
			),
			array(
				'id'      => 'button_submit_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#ffffff'
			),
			array(
				'id'      => 'button_submit_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 10,
				'max'     => 60,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 13,
			),
			array(
				'id'      => 'button_submit_weight',
				'type'    => 'select',
				'title'   => esc_html__( 'Font weight', 'rife-free' ),
				'options' => $font_weights,
				'default' => 'bold',
			),
			array(
				'id'      => 'button_submit_transform',
				'type'    => 'radio',
				'title'   => esc_html__( 'Text transform', 'rife-free' ),
				'options' => $font_transforms,
				'default' => 'uppercase',
			),
			array(
				'id'      => 'button_submit_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Padding', 'rife-free' ),
				'mode'    => 'padding',
				'sides'   => array( 'left', 'right' ),
				'units'   => array( 'px', 'em' ),
				'default' => array(
					'padding-left'  => '30px',
					'padding-right' => '30px',
					'units'         => 'px'
				),
			),
			array(
				'id'          => 'button_submit_radius',
				'type'        => 'slider',
				'title'       => esc_html__( 'Border radius', 'rife-free' ),
				'min'         => 0,
				'max'         => 20,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 20,
			),
		)
	) );

//HEADER SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Header settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_header_settings',
		'icon'     => 'el el-magic',
		'priority' => 6,
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Type, variant, background', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_header_type',
		'icon'       => 'fa fa-cogs',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'header_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Type', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Vertical header is available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'horizontal' => esc_html__( 'Horizontal', 'rife-free' ),
				),
				'default'     => 'horizontal',
			),
			array(
				'id'       => 'header_horizontal_sticky',
				'type'     => 'select',
				'title'    => esc_html__( 'Sticky version', 'rife-free' ),
				'options'  => array(
					'sticky-no-hiding'   => esc_html__( 'No hiding sticky', 'rife-free' ),
					'no-sticky no-fixed' => esc_html__( 'Disabled, show only default header(not fixed)', 'rife-free' ),
					'no-sticky'          => esc_html__( 'Disabled, show only default header fixed', 'rife-free' )
				),
				'default'  => 'sticky-no-hiding',
				'required' => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'          => 'header_horizontal_variant',
				'type'        => 'select',
				'title'       => esc_html__( 'Variant', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>More variants are available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'one_line'               => esc_html__( 'One line, logo on side', 'rife-free' ),
					'one_line_menu_centered' => esc_html__( 'One line, menu centered', 'rife-free' ),
				),
				'default'     => 'one_line',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'          => 'header_color_variants',
				'type'        => 'select',
				'title'       => esc_html__( 'Header color variants', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Light & dark variants are available in %s.</strong><br />', 'rife-free' ), $rp_tab ), $valid_tags ) . ' ' . esc_html__( 'If you want to use theme header color variants(light and dark variants) or the sticky header variant, then enable this option. Some settings of the header can then be overridden in color & sticky variants.', 'rife-free' ),
				'options'     => array(
					'sticky' => esc_html__( 'Turn on only for a sticky variant', 'rife-free' ),
					'off'    => esc_html__( 'Disable', 'rife-free' ),
				),
				'default'     => 'sticky',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'       => 'header_content_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Content width', 'rife-free' ),
				'options'  => array(
					'narrow' => esc_html__( 'Narrow', 'rife-free' ),
					'full'   => esc_html__( 'Full width', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'       => 'header_content_width_narrow_bg',
				'type'     => 'radio',
				'title'    => esc_html__( 'Narrow the entire header as well', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_content_width', '=', 'narrow' )
				),
			),
			array(
				'id'      => 'header_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '#ffffff',
			),
			array(
				'id'          => 'header_bg_hover_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => esc_html__( 'Useful in special cases, like when you make a transparent header.', 'rife-free' ),
				'default'     => '',
			),
			array(
				'id'       => 'header_border',
				'type'     => 'radio',
				'title'    => esc_html__( 'Bottom border', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'header_shadow',
				'type'    => 'radio',
				'title'   => esc_html__( 'Shadow', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'header_separators_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Separator and lines color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'          => 'header_socials',
				'type'        => 'radio',
				'title'       => esc_html__( 'Social icons', 'rife-free' ),
				/* translators: %s: URL */
				'description' => sprintf( wp_kses( __( 'If you need to edit social links go to <a href="%s">Social icons</a> settings.', 'rife-free' ), $valid_tags ), 'javascript:wp.customize.section( \'section_social\' ).focus();' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'       => 'header_socials_color',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'semi-transparent',
				'required' => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_socials', '=', 'on' ),
				)
			),
			array(
				'id'       => 'header_socials_color_hover',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'color',
				'required' => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_socials', '=', 'on' ),
				)
			),
			array(
				'id'          => 'header_socials_display_on_mobile',
				'type'        => 'radio',
				'title'       => esc_html__( 'Social icons', 'rife-free' ). ' - ' .esc_html__( 'Display it on mobiles', 'rife-free' ),
				'description' => esc_html__( 'Should it be displayed on devices less than 600 pixels wide.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'required'    => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_socials', '=', 'on' ),
				)
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Logo', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_logo',
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'logo_from_variants',
				'type'        => 'radio',
				'title'       => esc_html__( 'Use logos from header variants', 'rife-free' ),
				'description' => esc_html__( 'If you want to be able to change the logo in header color variants (light and dark variants) or in the sticky header variant, then enable this option.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_color_variants', '!=', 'off' ),
				)
			),
			array(
				'id'      => 'logo_type',
				'type'    => 'radio',
				'title'   => esc_html__( 'Type', 'rife-free' ),
				'options' => array(
					'image' => esc_html__( 'Image', 'rife-free' ),
					'text'  => esc_html__( 'Text', 'rife-free' ),
				),
				'default' => 'image',
			),
			array(
				'id'          => 'logo_image',
				'type'        => 'image',
				'title'       => esc_html__( 'Image', 'rife-free' ),
				'description' => esc_html__( 'Upload an image for logo.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'logo_type', '=', 'image' ),
			),
			array(
				'id'          => 'logo_image_high_dpi',
				'type'        => 'image',
				'title'       => esc_html__( 'Image for HIGH DPI screen', 'rife-free' ),
				'description' => esc_html__( 'For example Retina(iPhone/iPad) screen has HIGH DPI screen.', 'rife-free' ) . ' ' . esc_html__( 'Upload an image for logo.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'logo_type', '=', 'image' ),
			),
			array(
				'id'          => 'logo_image_max_desktop_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'Max width', 'rife-free' ). ' - ' .esc_html__( 'on desktop', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ) .' '. esc_html__( 'It works only on large screens(1025px wide or more).', 'rife-free' ),
				'min'         => 25,
				'step'        => 1,
				'max'         => 400,
				'unit'        => 'px',
				'default'     => 200,
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
					array( 'header_type', '=', 'horizontal' ),
				)
			),
			array(
				'id'          => 'logo_image_max_mobile_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'Max width', 'rife-free' ). ' - ' .esc_html__( 'on mobile devices', 'rife-free' ),
				'description' => esc_html__( 'It works only on mobile devices(1024px wide or less).', 'rife-free' ),
				'min'         => 25,
				'max'         => 250,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 200,
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
				)
			),
			array(
				'id'          => 'logo_image_height',
				'type'        => 'slider',
				'title'       => esc_html__( 'Height', 'rife-free' ),
				'description' => esc_html__( 'Leave empty if you do not need anything fancy', 'rife-free' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => '',
				'required'    => array( 'logo_type', '=', 'image' ),
			),
			array(
				'id'       => 'logo_image_normal_opacity',
				'type'     => 'slider',
				'title'    => esc_html__( 'Opacity', 'rife-free' ),
				'min'      => 0,
				'max'      => 1,
				'step'     => 0.01,
				'default'  => '1.00',
				'required' => array( 'logo_type', '=', 'image' ),
			),
			array(
				'id'       => 'logo_image_hover_opacity',
				'type'     => 'slider',
				'title'    => esc_html__( 'Opacity', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'min'      => 0,
				'max'      => 1,
				'step'     => 0.01,
				'default'  => '0.50',
				'required' => array( 'logo_type', '=', 'image' ),
			),
			array(
				'id'          => 'logo_text',
				'type'        => 'text',
				'title'       => esc_html__( 'Text', 'rife-free' ),
				'description' => wp_kses( __( 'If you use more than one word in the logo, you can use <code>&amp;nbsp;</code> instead of a white space, so the words will not break into many lines.', 'rife-free' ), $valid_tags ).
				                 /* translators: %s: Customizer JS URL */
				                 '<br />'.sprintf( wp_kses( __( 'If you want to change the font for logo go to <a href="%s">Font settings</a>.', 'rife-free' ), $valid_tags ), 'javascript:wp.customize.control( \''.A13FRAMEWORK_OPTIONS_NAME.'[logo_fonts]\' ).focus();' ),
				'default'     => get_bloginfo( 'name' ),
				'required'    => array( 'logo_type', '=', 'text' ),
			),
			array(
				'id'       => 'logo_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'logo_type', '=', 'text' ),
			),
			array(
				'id'       => 'logo_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => '',
				'required' => array( 'logo_type', '=', 'text' ),
			),
			array(
				'id'       => 'logo_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Font size', 'rife-free' ),
				'min'      => 10,
				'max'      => 60,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 26,
				'required' => array( 'logo_type', '=', 'text' ),
			),
			array(
				'id'       => 'logo_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'normal',
				'required' => array( 'logo_type', '=', 'text' ),
			),
			array(
				'id'          => 'logo_padding',
				'type'        => 'spacing',
				'title'       => esc_html__( 'Padding', 'rife-free' ). ' - ' .esc_html__( 'on desktop', 'rife-free' ),
				'description' => esc_html__( 'It works only on large screens(1025px wide or more).', 'rife-free' ),
				'mode'        => 'padding',
				'sides'       => array( 'top', 'bottom' ),
				'units'       => array( 'px', 'em' ),
				'default'     => array(
					'padding-top'    => '10px',
					'padding-bottom' => '10px',
					'units'          => 'px'
				)
			),
			array(
				'id'          => 'logo_padding_mobile',
				'type'        => 'spacing',
				'title'       => esc_html__( 'Padding', 'rife-free' ). ' - ' .esc_html__( 'on mobile devices', 'rife-free' ),
				'description' => esc_html__( 'It works only on mobile devices(1024px wide or less).', 'rife-free' ),
				'mode'        => 'padding',
				'sides'       => array( 'top', 'bottom' ),
				'units'       => array( 'px', 'em' ),
				'default'     => array(
					'padding-top'    => '10px',
					'padding-bottom' => '10px',
					'units'          => 'px'
				)
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Main Menu', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_header_menu',
		'icon'       => 'fa fa-bars',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'header_main_menu',
				'type'    => 'radio',
				'title'   => esc_html__( 'Main Menu', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'menu_hover_effect',
				'type'        => 'select',
				'title'       => esc_html__( 'Hover effect', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>More effects are available in %s.</strong><br />', 'rife-free' ), $rp_tab ), $valid_tags ) . ' ' . esc_html__( 'It works only for first level links.', 'rife-free' ),
				'options'     => $menu_effects,
				'default'     => 'ferdinand',
				'required'    => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'          => 'menu_close_mobile_menu_on_click',
				'type'        => 'radio',
				'title'       => esc_html__( 'Mobile menu', 'rife-free' ). ' : ' .esc_html__( 'Close menu after click', 'rife-free' ),
				'description' => esc_html__( 'After turning on the mobile menu will be closed after clicking the link menu. This option is good for "one page" sites. For traditional websites, it is recommended to disable this option.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'          => 'menu_allow_mobile_menu',
				'type'        => 'radio',
				'title'       => esc_html__( 'Allow for the mobile menu', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ) .' '. esc_html__( 'If you disable this then menu will not switch to mobile menu. You should consider disabling this option only if you have a clean header with a short menu.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'required'    => array(
					array( 'header_main_menu', '=', 'on' ),
					array( 'header_type', '=', 'horizontal' ),
				)
			),
			array(
				'id'      => 'header_mobile_menu_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Mobile menu', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default' => '#ffffff',
				'required'    => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'menu_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Font size', 'rife-free' ),
				'min'      => 10,
				'max'      => 30,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 14,
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'menu_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'menu_hover_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'          => 'menu_hover_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'description' => esc_html__( 'It works only for first level links.', 'rife-free' ),
				'default'     => '#000000',
				'required'    => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'menu_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'normal',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'menu_transform',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text transform', 'rife-free' ),
				'options'  => $font_transforms,
				'default'  => 'uppercase',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default'  => '#ffffff',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_separator_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Mega-Menu separator color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_open_icons',
				'type'     => 'radio',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Opening/Closing icons', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'          => 'submenu_opener',
				'type'        => 'text',
				'title'       => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Opening icon', 'rife-free' ),
				'default'     => 'angle-down',
				'input_attrs' => array(
					'class' => 'a13-fa-icon',
				),
				'required'    => array(
					array( 'header_main_menu', '=', 'on' ),
					array( 'submenu_open_icons', '=', 'on' ),
				)

			),
			array(
				'id'          => 'submenu_closer',
				'type'        => 'text',
				'title'       => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Closing icon', 'rife-free' ),
				'default'     => 'angle-up',
				'input_attrs' => array(
					'class' => 'a13-fa-icon',
				),
				'required'    => array(
					array( 'header_main_menu', '=', 'on' ),
					array( 'submenu_open_icons', '=', 'on' ),
				)
			),
			array(
				'id'          => 'submenu_third_lvl_opener',
				'type'        => 'text',
				'title'       => esc_html__( 'Submenu 3rd level', 'rife-free' ). ' : ' .esc_html__( 'Opening icon', 'rife-free' ),
				'default'     => 'angle-right',
				'input_attrs' => array(
					'class' => 'a13-fa-icon',
				),
				'required'    => array(
					array( 'header_main_menu', '=', 'on' ),
					array( 'submenu_open_icons', '=', 'on' ),
				)

			),
			array(
				'id'          => 'submenu_third_lvl_closer',
				'type'        => 'text',
				'title'       => esc_html__( 'Submenu 3rd level', 'rife-free' ). ' : ' .esc_html__( 'Closing icon', 'rife-free' ),
				'default'     => 'angle-left',
				'input_attrs' => array(
					'class' => 'a13-fa-icon',
				),
				'required'    => array(
					array( 'header_main_menu', '=', 'on' ),
					array( 'submenu_open_icons', '=', 'on' ),
				)
			),
			array(
				'id'       => 'submenu_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'required' => array( 'header_main_menu', '=', 'on' ),
				'default'  => '#000000',
			),
			array(
				'id'       => 'submenu_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'default'  => '',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'min'      => 10,
				'max'      => 30,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 10,
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'bold',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
			array(
				'id'       => 'submenu_transform',
				'type'     => 'radio',
				'title'    => esc_html__( 'Submenu/Mega-Menu', 'rife-free' ). ' : ' .esc_html__( 'Text transform', 'rife-free' ),
				'options'  => $font_transforms,
				'default'  => 'uppercase',
				'required' => array( 'header_main_menu', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Sticky header', 'rife-free' ). ' - ' .esc_html__( 'Override normal settings', 'rife-free' ),
		'desc'       => esc_html__( 'Works only with the horizontal header.', 'rife-free' ) .' '. esc_html__( 'You can change some options here to modify the appearance of the sticky header(if it is enabled).', 'rife-free' ),
		'id'         => 'subsection_header_sticky',
		'icon'       => 'fa fa-thumb-tack',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'header_sticky_logo_image',
				'type'        => 'image',
				'title'       => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Image', 'rife-free' ),
				'description' => esc_html__( 'Upload an image for logo.', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
					array( 'logo_from_variants', '=', 'on' ),
				)
			),
			array(
				'id'          => 'header_sticky_logo_image_high_dpi',
				'type'        => 'image',
				'title'       => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Image for HIGH DPI screen', 'rife-free' ),
				'description' => esc_html__( 'For example Retina(iPhone/iPad) screen has HIGH DPI screen.', 'rife-free' ) . ' ' . esc_html__( 'Upload an image for logo.', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
					array( 'logo_from_variants', '=', 'on' ),
				)
			),
			array(
				'id'          => 'header_sticky_logo_image_max_desktop_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Max width', 'rife-free' ). ' - ' .esc_html__( 'on desktop', 'rife-free' ),
				'description' => esc_html__( 'It works only on large screens(1025px wide or more).', 'rife-free' ),
				'min'         => 25,
				'step'        => 1,
				'max'         => 400,
				'unit'        => 'px',
				'default'     => 200,
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
					array( 'header_type', '=', 'horizontal' ),
				)
			),
			array(
				'id'          => 'header_sticky_logo_image_max_mobile_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Max width', 'rife-free' ). ' - ' .esc_html__( 'on mobile devices', 'rife-free' ),
				'description' => esc_html__( 'It works only on mobile devices(1024px wide or less).', 'rife-free' ),
				'min'         => 25,
				'max'         => 250,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 200,
				'required'    => array(
					array( 'logo_type', '=', 'image' ),
					array( 'header_type', '=', 'horizontal' ),
				)
			),
			array(
				'id'      => 'header_sticky_logo_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Padding', 'rife-free' ). ' - ' .esc_html__( 'on desktop', 'rife-free' ),
				'description' => esc_html__( 'It works only on large screens(1025px wide or more).', 'rife-free' ),
				'mode'    => 'padding',
				'sides'   => array( 'top', 'bottom' ),
				'units'   => array( 'px', 'em' ),
				'default' => array(
					'padding-top'    => '10px',
					'padding-bottom' => '10px',
					'units'          => 'px'
				),
			),
			array(
				'id'          => 'header_sticky_logo_padding_mobile',
				'type'        => 'spacing',
				'title'       => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Padding', 'rife-free' ). ' - ' .esc_html__( 'on mobile devices', 'rife-free' ),
				'description' => esc_html__( 'It works only on mobile devices(1024px wide or less).', 'rife-free' ),
				'mode'        => 'padding',
				'sides'       => array( 'top', 'bottom' ),
				'units'       => array( 'px', 'em' ),
				'default'     => array(
					'padding-top'    => '10px',
					'padding-bottom' => '10px',
					'units'          => 'px'
				),
			),
			array(
				'id'       => 'header_sticky_logo_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'logo_type', '=', 'text' ),
					array( 'logo_from_variants', '=', 'on' ),
				)
			),
			array(
				'id'       => 'header_sticky_logo_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Logo', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'logo_type', '=', 'text' ),
					array( 'logo_from_variants', '=', 'on' ),
				)
			),
			array(
				'id'      => 'header_sticky_menu_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Main Menu', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'header_sticky_menu_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Main Menu', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'          => 'header_sticky_menu_hover_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Main Menu', 'rife-free' ). ' : ' .esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'description' => esc_html__( 'It works only for first level links.', 'rife-free' ),
				'default'     => 'rgba(0,0,0,0)',
			),
			array(
				'id'      => 'header_sticky_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'header_sticky_mobile_menu_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Mobile menu', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default' => '#ffffff',
			),
			array(
				'id'      => 'header_sticky_shadow',
				'type'    => 'radio',
				'title'   => esc_html__( 'Shadow', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'header_sticky_separators_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Header', 'rife-free' ). ' : ' .esc_html__( 'Separator and lines color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'          => 'header_sticky_tools_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Tools icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'description' => esc_html__( 'Basket, sidebar, menu and search icons. It is also color for the text of "Tools button".', 'rife-free' ),
				'default'     => '',
			),
			array(
				'id'          => 'header_sticky_tools_color_hover',
				'type'        => 'color',
				'title'       => esc_html__( 'Tools icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'description' => esc_html__( 'Basket, sidebar, menu and search icons. It is also color for the text of "Tools button".', 'rife-free' ),
				'default'     => '',
			),
			array(
				'id'       => 'header_sticky_button_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0)',
				'required' => array( 'header_button', '!=', '' ),
			),
			array(
				'id'       => 'header_sticky_button_bg_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0)',
				'required' => array( 'header_button', '!=', '' ),
			),
			array(
				'id'       => 'header_sticky_button_border_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Border color', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0.2)',
				'required' => array( 'header_button', '!=', '' ),
			),
			array(
				'id'       => 'header_sticky_button_border_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Border color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0.4)',
				'required' => array( 'header_button', '!=', '' ),
			),
			array(
				'id'       => 'header_sticky_socials_color',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'semi-transparent',
				'required' => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_socials', '=', 'on' ),
				)
			),
			array(
				'id'       => 'header_sticky_socials_color_hover',
				'type'     => 'select',
				'title'    => esc_html__( 'Social icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $social_colors,
				'default'  => 'color',
				'required' => array(
					array( 'header_type', '=', 'horizontal' ),
					array( 'header_socials', '=', 'on' ),
				)
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Tools icons', 'rife-free' ). ' - ' .esc_html__( 'General settings', 'rife-free' ),
		/* translators: %s: Rife Pro tab link */
		'desc'       => wp_kses( sprintf( __( '<strong>Settings for individual tools icons & animated icons are available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
		'id'         => 'subsection_header_tools',
		'icon'       => 'fa fa-ellipsis-h',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'header_tools_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Tools icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ),
				'description' => esc_html__( 'Basket, sidebar, menu and search icons. It is also color for the text of "Tools button".', 'rife-free' ),
				'default'     => '#000000',
			),
			array(
				'id'          => 'header_tools_color_hover',
				'type'        => 'color',
				'title'       => esc_html__( 'Tools icons', 'rife-free' ). ' : ' .esc_html__( 'Color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'description' => esc_html__( 'Basket, sidebar, menu and search icons. It is also color for the text of "Tools button".', 'rife-free' ),
				'default'     => '#000000',
			),
			array(
				'id'      => 'header_search',
				'type'    => 'radio',
				'title'   => esc_html_x( 'Search', 'tool', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'header_button',
				'type'        => 'text',
				'title'       => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Content', 'rife-free' ),
				'description' => esc_html__( 'If left empty then the button will not be displayed.', 'rife-free' ),
				'default'     => '',
				'partial' => array(
					'selector' => '.tools_button',
					'container_inclusive' => true,
					'settings' => array(
						'header_button',
						'header_button_link',
						'header_button_link_target',
						'header_button_font_size',
						'header_button_weight',
						'header_button_bg_color',
						'header_button_bg_color_hover',
						'header_button_border_color',
						'header_button_border_color_hover',
						'header_button_display_on_mobile',
					),
					'render_callback' => 'apollo13framework_header_button',
				)
			),
			array(
				'id'       => 'header_button_link',
				'type'     => 'text',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Link', 'rife-free' ),
				'default'  => '',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'          => 'header_button_link_target',
				'type'        => 'radio',
				'title'       => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Open link in new tab', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_font_size',
				'type'     => 'slider',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Font size', 'rife-free' ),
				'min'      => 5,
				'max'      => 30,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '12',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'normal',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0)',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_bg_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0)',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_border_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Border color', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0.2)',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'       => 'header_button_border_color_hover',
				'type'     => 'color',
				'title'    => esc_html__( 'Tools button', 'rife-free' ). ' : ' .esc_html__( 'Border color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default'  => 'rgba(0,0,0,0.4)',
				'required' => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
			array(
				'id'          => 'header_button_display_on_mobile',
				'type'        => 'radio',
				'title'       => esc_html__( 'Tools button', 'rife-free' ). ' - ' .esc_html__( 'Display it on mobiles', 'rife-free' ),
				'description' => esc_html__( 'Should it be displayed on devices less than 600 pixels wide.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'required'    => array( 'header_button', '!=', '' ),
				'partial'  => true,
			),
		)
	) );


//BLOG SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Blog settings', 'rife-free' ),
		'desc'     => esc_html__( 'Posts list refers to Blog, Search and Archives pages', 'rife-free' ),
		'id'       => 'section_blog_layout',
		'icon'     => 'fa fa-pencil',
		'priority' => 9,
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Background', 'rife-free' ),
		'id'         => 'subsection_blog_bg',
		'desc'       => esc_html__( 'This will be the default background for pages related to the blog.', 'rife-free' ),
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'blog_custom_background',
				'type'    => 'radio',
				'title'   => esc_html__( 'Custom background', 'rife-free' ),
				'options' => $on_off,
				'default' => 'off',
			),
			array(
				'id'       => 'blog_body_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'blog_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'blog_body_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'blog_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'blog_body_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'blog_custom_background', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Posts list', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_blog',
		'icon'       => 'fa fa-list',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'blog_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'blog_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'center',
			),
			array(
				'id'      => 'blog_content_padding',
				'type'    => 'select',
				'title'   => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Top/bottom padding', 'rife-free' ),
				'options' => array(
					'both'   => esc_html__( 'Both on', 'rife-free' ),
					'top'    => esc_html__( 'Only top', 'rife-free' ),
					'bottom' => esc_html__( 'Only bottom', 'rife-free' ),
					'off'    => esc_html__( 'Both off', 'rife-free' ),
				),
				'default' => 'off',
			),
			array(
				'id'      => 'blog_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'rife-free' ),
				'options' => array(
					'left-sidebar'  => esc_html__( 'Left', 'rife-free' ),
					'right-sidebar' => esc_html__( 'Right', 'rife-free' ),
					'off'           => esc_html__( 'Off', 'rife-free' ),
				),
				'default' => 'off',
			),
			array(
				'id'      => 'blog_post_look',
				'type'    => 'select',
				'title'   => esc_html__( 'Post look', 'rife-free' ),
				'options' => array(
					'vertical_no_padding' => esc_html__( 'Vertical no padding', 'rife-free' ),
					'vertical_padding'    => esc_html__( 'Vertical with padding', 'rife-free' ),
					'vertical_centered'   => esc_html__( 'Vertical centered', 'rife-free' ),
					'horizontal'          => esc_html__( 'Horizontal', 'rife-free' ),
				),
				'default' => 'vertical_padding',
			),
			array(
				'id'          => 'blog_layout_mode',
				'type'        => 'radio',
				'title'       => esc_html__( 'How to place items in rows', 'rife-free' ),
				'description' => esc_html__( 'If your items have different heights, you can start each row of items from a new line instead of the masonry style.', 'rife-free' ),
				'options'     => array(
					'packery' => esc_html__( 'Masonry', 'rife-free' ),
					'fitRows' => esc_html__( 'Each row from new line', 'rife-free' ),
				),
				'default'     => 'packery',
			),
			array(
				'id'          => 'blog_brick_columns',
				'type'        => 'slider',
				'title'       => esc_html__( 'Bricks columns', 'rife-free' ),
				'description' => esc_html__( 'It is a maximum number of columns displayed on larger devices. On smaller devices, it can be a lower number of columns.', 'rife-free' ),
				'min'         => 1,
				'max'         => 4,
				'step'        => 1,
				'unit'        => '',
				'default'     => 2,
				'required'    => array( 'blog_post_look', '!=', 'horizontal' ),
			),
			array(
				'id'          => 'blog_bricks_max_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'The maximum width of the brick layout', 'rife-free' ),
				'description' => esc_html__( 'Depending on the actual width of the screen, the available space for bricks may be smaller, but never greater than this number.', 'rife-free' ),
				'min'         => 200,
				'max'         => 2500,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 1920,
				'required'    => array( 'blog_post_look', '!=', 'horizontal' ),
			),
			array(
				'id'      => 'blog_brick_margin',
				'type'    => 'slider',
				'title'   => esc_html__( 'Brick margin', 'rife-free' ),
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 10,
			),
			array(
				'id'      => 'blog_lazy_load',
				'type'    => 'radio',
				'title'   => esc_html__( 'Lazy load', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'blog_lazy_load_mode',
				'type'     => 'radio',
				'title'    => esc_html__( 'Lazy load', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'options'  => array(
					'button' => esc_html__( 'By clicking button', 'rife-free' ),
					'auto'   => esc_html__( 'On scroll', 'rife-free' ),
				),
				'default'  => 'button',
				'required' => array( 'blog_lazy_load', '=', 'on' ),
			),
			array(
				'id'          => 'blog_read_more',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display "Read more" link', 'rife-free' ),
				'description' => esc_html__( 'Should "Read more" link be displayed after excerpts on blog list/search results.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'blog_excerpt_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Type of post excerpts', 'rife-free' ),
				'description' => wp_kses( __(
					'In the Manual mode, excerpts are used only if you add the "Read More Tag" (&lt;!--more--&gt;).<br /> In the Automatic mode, if you will not provide the "Read More Tag" or explicit excerpt, the content of the post will be truncated automatically.<br /> This setting only concerns blog list, archive list, search results.', 'rife-free' ), $valid_tags ),
				'options'     => array(
					'auto'   => esc_html__( 'Automatic', 'rife-free' ),
					'manual' => esc_html__( 'Manual', 'rife-free' ),
				),
				'default'     => 'auto',
			),
			array(
				'id'          => 'blog_excerpt_length',
				'type'        => 'slider',
				'title'       => esc_html__( 'Number of words to cut post', 'rife-free' ),
				'description' => esc_html__( 'After this many words post will be cut in the automatic mode.', 'rife-free' ),
				'min'         => 3,
				'max'         => 200,
				'step'        => 1,
				'unit'        => '',
				'default'     => 40,
				'required'    => array( 'blog_excerpt_type', '=', 'auto' ),
			),
			array(
				'id'          => 'blog_media',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display post Media', 'rife-free' ),
				'description' => esc_html__( 'You can set to not display post media(featured image/video/slider) inside of the post brick.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'blog_videos',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display of posts video', 'rife-free' ),
				'description' => esc_html__( 'You can set to display videos as featured image on posts list. This can speed up loading of pages with many posts(blog, archive, search results) when the videos are used.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'blog_date',
				'type'        => 'radio',
				'title'       => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Date of publish or last update', 'rife-free' ),
				'description' => esc_html__( 'You can\'t use both dates, because the Search Engine will not know which date is correct.', 'rife-free' ),
				'options'     => array(
					'on'      => esc_html__( 'Published', 'rife-free' ),
					'updated' => esc_html__( 'Updated', 'rife-free' ),
					'off'     => esc_html__( 'Disable', 'rife-free' ),
				),
				'default'     => 'on',
			),
			array(
				'id'      => 'blog_author',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Author', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'blog_comments',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Comments number', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'blog_cats',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Categories', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'blog_tags',
				'type'        => 'radio',
				'title'       => esc_html__( 'Tags', 'rife-free' ),
				'description' => esc_html__( 'Displays list of post tags under a post content.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Posts list', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_blog_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'blog_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'blog_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'centered',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'          => 'blog_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'blog_title', '=', 'on' ),
					array( 'blog_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'blog_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'blog_title', '=', 'on' ),
					array( 'blog_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'blog_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '#ffffff',
				'required'    => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'          => 'blog_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array( 'blog_title', '=', 'on' ),
			),
			array(
				'id'       => 'blog_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'blog_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single post', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_post',
		'icon'       => 'fa fa-pencil-square',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'post_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'post_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'center',
			),
			array(
				'id'      => 'post_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'rife-free' ),
				'options' => array(
					'left-sidebar'  => esc_html__( 'Left', 'rife-free' ),
					'right-sidebar' => esc_html__( 'Right', 'rife-free' ),
					'off'           => esc_html__( 'Off', 'rife-free' ),
				),
				'default' => 'right-sidebar',
			),
			array(
				'id'          => 'post_media',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display post Media', 'rife-free' ),
				'description' => esc_html__( 'You can set to not display post media(featured image/video/slider) inside of the post.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'post_author_info',
				'type'        => 'radio',
				'title'       => esc_html__( 'Author info', 'rife-free' ),
				'description' => esc_html__( 'Will show information about author below post content.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
			array(
				'id'          => 'post_date',
				'type'        => 'radio',
				'title'       => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Date of publish or last update', 'rife-free' ),
				'description' => esc_html__( 'You can\'t use both dates, because the Search Engine will not know which date is correct.', 'rife-free' ),
				'options'     => array(
					'on'      => esc_html__( 'Published', 'rife-free' ),
					'updated' => esc_html__( 'Updated', 'rife-free' ),
					'off'     => esc_html__( 'Disable', 'rife-free' ),
				),
				'default'     => 'on',
			),
			array(
				'id'      => 'post_author',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Author', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'post_comments',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Comments number', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'post_cats',
				'type'    => 'radio',
				'title'   => esc_html__( 'Post info', 'rife-free' ). ' : ' .esc_html__( 'Categories', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'post_tags',
				'type'        => 'radio',
				'title'       => esc_html__( 'Tags', 'rife-free' ),
				'description' => esc_html__( 'Displays list of post tags under a post content.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'post_navigation',
				'type'        => 'radio',
				'title'       => esc_html__( 'Posts navigation', 'rife-free' ),
				'description' => esc_html__( 'Links to next and prev post.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),

		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single post', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_post_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'post_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'post_title_bar_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Title position', 'rife-free' ),
				'options'  => array(
					'outside' => esc_html__( 'Before the content', 'rife-free' ),
					'inside'  => esc_html__( 'Inside the content', 'rife-free' ),
				),
				'default'  => 'inside',
				'required' => array( 'post_title', '=', 'on' ),
			),
			array(
				'id'       => 'post_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'post_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'post_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'post_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'post_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'default'  => 'off',
				'options'  => $on_off,
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'post_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
					array( 'post_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'post_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
					array( 'post_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'post_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'post_title', '=', 'on' ),
			),
			array(
				'id'       => 'post_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'post_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'post_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array(
					array( 'post_title', '=', 'on' ),
					array( 'post_title_bar_position', '!=', 'inside' ),
				)
			),
		)
	) );

//SHOP SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Shop(WooCommerce) settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_shop_general',
		'icon'     => 'fa fa-shopping-cart',
		'priority' => 12,
		'woocommerce_required' => true,//only visible with WooCommerce plugin being available
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Background', 'rife-free' ),
		'desc'       => esc_html__( 'These options will work for all shop pages - product list, single product and other.', 'rife-free' ),
		'id'         => 'subsection_shop_general',
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'shop_custom_background',
				'type'    => 'radio',
				'title'   => esc_html__( 'Custom background', 'rife-free' ),
				'options' => $on_off,
				'default' => 'off',
			),
			array(
				'id'       => 'shop_body_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'shop_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'shop_body_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'shop_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'shop_body_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'required' => array( 'shop_custom_background', '=', 'on' ),
				'default'  => '',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Products list', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_shop',
		'icon'       => 'fa fa-list',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'shop_search',
				'type'        => 'radio',
				'title'       => esc_html__( 'Search in products instead of pages', 'rife-free' ),
				'description' => esc_html__( 'It will change WordPress default search function to make shop search. So when this is activated search function in header or search widget will act as WooCommerece search widget.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
			array(
				'id'          => 'shop_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'shop_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'full',
			),
			array(
				'id'      => 'shop_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'rife-free' ),
				'options' => array(
					'left-sidebar'  => esc_html__( 'Left', 'rife-free' ),
					'right-sidebar' => esc_html__( 'Right', 'rife-free' ),
					'off'           => esc_html__( 'Off', 'rife-free' ),
				),
				'default' => 'left-sidebar',
			),
			array(
				'id'      => 'shop_products_variant',
				'type'    => 'radio',
				'title'   => esc_html__( 'Look of products on list', 'rife-free' ),
				'options' => array(
					'overlay' => esc_html__( 'Text as overlay', 'rife-free' ),
					'under'   => esc_html__( 'Text under photo', 'rife-free' ),
				),
				'default' => 'overlay',
			),
			array(
				'id'       => 'shop_products_subvariant',
				'type'     => 'select',
				'title'    => esc_html__( 'Look of products on list', 'rife-free' ),
				'options'  => array(
					'left'   => esc_html__( 'Texts to left', 'rife-free' ),
					'center' => esc_html__( 'Texts to center', 'rife-free' ),
					'right'  => esc_html__( 'Texts to right', 'rife-free' ),
				),
				'default'  => 'center',
				'required' => array( 'shop_products_variant', '=', 'under' ),
			),
			array(
				'id'      => 'shop_products_second_image',
				'type'    => 'radio',
				'title'   => esc_html__( 'Show second image of product on hover', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'shop_products_layout_mode',
				'type'        => 'radio',
				'title'       => esc_html__( 'How to place items in rows', 'rife-free' ),
				'description' => esc_html__( 'If your items have different heights, you can start each row of items from a new line instead of the masonry style.', 'rife-free' ),
				'options'     => array(
					'packery' => esc_html__( 'Masonry', 'rife-free' ),
					'fitRows' => esc_html__( 'Each row from new line', 'rife-free' ),
				),
				'default'     => 'packery',
			),
			array(
				'id'          => 'shop_products_columns',
				'type'        => 'slider',
				'title'       => esc_html__( 'Bricks columns', 'rife-free' ),
				'description' => esc_html__( 'It is a maximum number of columns displayed on larger devices. On smaller devices, it can be a lower number of columns.', 'rife-free' ),
				'min'         => 1,
				'max'         => 4,
				'step'        => 1,
				'unit'        => '',
				'default'     => 4,
			),
			array(
				'id'      => 'shop_products_per_page',
				'type'    => 'slider',
				'title'   => esc_html__( 'Items per page', 'rife-free' ),
				'min'     => 1,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'products',
				'default' => 12,
			),
			array(
				'id'      => 'shop_brick_margin',
				'type'    => 'slider',
				'title'   => esc_html__( 'Brick margin', 'rife-free' ),
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 20,
			),
			array(
				'id'      => 'shop_lazy_load',
				'type'    => 'radio',
				'title'   => esc_html__( 'Lazy load', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'shop_lazy_load_mode',
				'type'     => 'radio',
				'title'    => esc_html__( 'Lazy load', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'options'  => array(
					'button' => esc_html__( 'By clicking button', 'rife-free' ),
					'auto'   => esc_html__( 'On scroll', 'rife-free' ),
				),
				'default'  => 'auto',
				'required' => array( 'shop_lazy_load', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Products list', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_shop_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'shop_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'shop_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'          => 'shop_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'shop_title', '=', 'on' ),
					array( 'shop_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'shop_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'shop_title', '=', 'on' ),
					array( 'shop_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'shop_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'          => 'shop_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array( 'shop_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'shop_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single product', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_product',
		'icon'       => 'fa fa-pencil-square',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'product_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'product_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'full_fixed',
			),
			array(
				'id'      => 'product_sidebar',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar', 'rife-free' ),
				'options' => array(
					'left-sidebar'  => esc_html__( 'Left', 'rife-free' ),
					'right-sidebar' => esc_html__( 'Right', 'rife-free' ),
					'off'           => esc_html__( 'Off', 'rife-free' ),
				),
				'default' => 'left-sidebar',
			),
			array(
				'id'          => 'product_custom_thumbs',
				'type'        => 'radio',
				'title'       => esc_html__( 'Theme thumbnails', 'rife-free' ),
				'description' => esc_html__( 'If disabled it will display standard WooCommerce thumbnails.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'product_related_products',
				'type'        => 'radio',
				'title'       => esc_html__( 'Related products', 'rife-free' ),
				'description' => esc_html__( 'Should related products be displayed on single product page.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single product', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_product_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'product_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'product_title_bar_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Title position', 'rife-free' ),
				'options'  => array(
					'outside' => esc_html__( 'Before the content', 'rife-free' ),
					'inside'  => esc_html__( 'Inside the content', 'rife-free' ),
				),
				'default'  => 'inside',
				'required' => array( 'product_title', '=', 'on' ),
			),
			array(
				'id'       => 'product_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'product_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
					array( 'product_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'product_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
					array( 'product_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'product_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'product_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'product_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array(
					array( 'product_title', '=', 'on' ),
					array( 'product_title_bar_position', '!=', 'inside' ),
				)
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Other shop pages', 'rife-free' ),
		'desc'       => esc_html__( 'Settings for cart, checkout, order received and my account pages.', 'rife-free' ),
		'id'         => 'subsection_shop_no_major_pages',
		'icon'       => 'fa fa-cog',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'shop_no_major_pages_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'shop_no_major_pages_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'full_fixed',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'desc'       => esc_html__( 'Settings for cart, checkout, order received and my account pages.', 'rife-free' ),
		'title'      => esc_html__( 'Other shop pages', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'id'         => 'subsection_shop_no_major_pages_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'shop_no_major_pages_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'          => 'shop_no_major_pages_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'shop_no_major_pages_title', '=', 'on' ),
					array( 'shop_no_major_pages_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'shop_no_major_pages_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'shop_no_major_pages_title', '=', 'on' ),
					array( 'shop_no_major_pages_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'shop_no_major_pages_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'          => 'shop_no_major_pages_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
			array(
				'id'       => 'shop_no_major_pages_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'shop_no_major_pages_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Pop up basket', 'rife-free' ),
		'desc'       => esc_html__( 'When WooCommerce is activated, button opening this basket will appear in the header. There also have to be some active widgets in "Basket sidebar" for this.', 'rife-free' ),
		'id'         => 'subsection_basket_sidebars',
		'icon'       => 'fa fa-shopping-basket',
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'basket_sidebar_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '',
			),
			array(
				'id'      => 'basket_sidebar_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 5,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'px',
				'default' => '',
			),
			array(
				'id'          => 'basket_sidebar_widgets_color',
				'type'        => 'radio',
				'title'       => esc_html__( 'Widgets colors', 'rife-free' ),
				'description' => esc_html__( 'Depending on what background you have set up, choose proper option.', 'rife-free' ),
				'options'     => array(
					'dark-sidebar'  => esc_html__( 'On dark', 'rife-free' ),
					'light-sidebar' => esc_html__( 'On light', 'rife-free' ),
				),
				'default'     => 'light-sidebar',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Buttons', 'rife-free' ),
		'desc'       => esc_html__( 'You can change here the colors of buttons used in the shop. Alternative buttons colors are used in various places in the shop.', 'rife-free' ),
		'id'         => 'subsection_buttons_shop',
		'icon'       => 'fa fa-arrow-down',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'button_shop_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ),
				'default' => '#524F51',
			),
			array(
				'id'      => 'button_shop_bg_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#000000',
			),
			array(
				'id'      => 'button_shop_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ),
				'default' => '#cccccc'
			),
			array(
				'id'      => 'button_shop_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#ffffff'
			),
			array(
				'id'      => 'button_shop_alt_bg_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Alternative button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'default' => '#524F51',
			),
			array(
				'id'      => 'button_shop_alt_bg_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Alternative button', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#000000',
			),
			array(
				'id'      => 'button_shop_alt_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Alternative button', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default' => '#cccccc'
			),
			array(
				'id'      => 'button_shop_alt_hover_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Alternative button', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'default' => '#ffffff'
			),
			array(
				'id'      => 'button_shop_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 10,
				'max'     => 60,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 13,
			),
			array(
				'id'      => 'button_shop_weight',
				'type'    => 'select',
				'title'   => esc_html__( 'Font weight', 'rife-free' ),
				'options' => $font_weights,
				'default' => 'bold',
			),
			array(
				'id'      => 'button_shop_transform',
				'type'    => 'radio',
				'title'   => esc_html__( 'Text transform', 'rife-free' ),
				'options' => $font_transforms,
				'default' => 'uppercase',
			),
			array(
				'id'      => 'button_shop_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Padding', 'rife-free' ),
				'mode'    => 'padding',
				'sides'   => array( 'left', 'right' ),
				'units'   => array( 'px', 'em' ),
				'default' => array(
					'padding-left'  => '30px',
					'padding-right' => '30px',
					'units'         => 'px'
				),
			),
		)
	) );

//PAGE SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Page settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_page',
		'icon'     => 'el el-file-edit',
		'priority' => 15,
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single page', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_page',
		'icon'       => 'el el-file-edit',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'page_comments',
				'type'    => 'radio',
				'title'   => esc_html__( 'Comments', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'page_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'page_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'center',
			),
			array(
				'id'          => 'page_sidebar',
				'type'        => 'select',
				'title'       => esc_html__( 'Sidebar', 'rife-free' ),
				'description' => esc_html__( 'You can change it in each page settings.', 'rife-free' ),
				'options'     => array(
					'left-sidebar'          => esc_html__( 'Sidebar on the left', 'rife-free' ),
					'left-sidebar_and_nav'  => esc_html__( 'Children Navigation + sidebar on the left', 'rife-free' ),
					'left-nav'              => esc_html__( 'Only children Navigation on the left', 'rife-free' ),
					'right-sidebar'         => esc_html__( 'Sidebar on the right', 'rife-free' ),
					'right-sidebar_and_nav' => esc_html__( 'Children Navigation + sidebar on the right', 'rife-free' ),
					'right-nav'             => esc_html__( 'Only children Navigation on the right', 'rife-free' ),
					'off'                   => esc_html__( 'Off', 'rife-free' ),
				),
				'default'     => 'off',
			),
			array(
				'id'      => 'page_custom_background',
				'type'    => 'radio',
				'title'   => esc_html__( 'Custom background', 'rife-free' ),
				'options' => $on_off,
				'default' => 'off',
			),
			array(
				'id'       => 'page_body_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'page_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'page_body_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'page_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'page_body_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'required' => array( 'page_custom_background', '=', 'on' ),
				'default'  => '',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single page', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_page_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'page_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'page_title_bar_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Title position', 'rife-free' ),
				'options'  => array(
					'outside' => esc_html__( 'Before the content', 'rife-free' ),
					'inside'  => esc_html__( 'Inside the content', 'rife-free' ),
				),
				'default'  => 'outside',
				'required' => array( 'page_title', '=', 'on' ),
			),
			array(
				'id'       => 'page_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'page_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'page_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'page_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'page_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
					array( 'page_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'page_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
					array( 'page_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'page_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'page_title', '=', 'on' ),
			),
			array(
				'id'       => 'page_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'          => 'page_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'page_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => '40',
				'required' => array(
					array( 'page_title', '=', 'on' ),
					array( 'page_title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'id'       => 'page_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'page_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( '404 page template', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_404_page',
		'icon'       => 'fa fa-exclamation-triangle',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'page_404_template_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Type', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Setting custom page is available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'default' => esc_html__( 'Default', 'rife-free' ),
				),
				'default'     => 'default',
			),
			array(
				'id'       => 'page_404_bg_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Default but I want to change the background image', 'rife-free' ),
				'required' => array( 'page_404_template_type', '=', 'default' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Password protected page template', 'rife-free' ),
		'id'         => 'subsection_password_page',
		'icon'       => 'fa fa-lock',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'page_password_template_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Type', 'rife-free' ),
				/* translators: %s: Rife Pro tab link */
				'description' => wp_kses( sprintf( __( '<strong>Setting custom page is available in %s.</strong>', 'rife-free' ), $rp_tab ), $valid_tags ),
				'options'     => array(
					'default' => esc_html__( 'Default', 'rife-free' ),
				),
				'default'     => 'default',
			),
			array(
				'id'       => 'page_password_bg_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Default but I want to change the background image', 'rife-free' ),
				'required' => array( 'page_password_template_type', '=', 'default' ),
			),
		)
	) );

//WORKS SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Works settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_works',
		'icon'     => 'fa fa-cogs',
		'priority' => 18,
		'companion_required' => true,//only visible with companion plugin being available
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Background', 'rife-free' ),
		'desc'       => esc_html__( 'These will work for Works list and single work.', 'rife-free' ),
		'id'         => 'subsection_works_general',
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'works_custom_background',
				'type'    => 'radio',
				'title'   => esc_html__( 'Custom background', 'rife-free' ),
				'options' => $on_off,
				'default' => 'off',
			),
			array(
				'id'       => 'works_body_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'works_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'works_body_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'works_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'works_body_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'works_custom_background', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Works list', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_works_list',
		'icon'       => 'fa fa-list',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'works_list_page',
				'type'        => 'dropdown-pages',
				'title'       => esc_html__( 'Works list', 'rife-free' ). ' - ' .esc_html__( 'Main page', 'rife-free' ),
				'description' => esc_html__( 'This page will list all your works and also give the main title for "work category" pages.', 'rife-free' ),
			),
			array(
				'id'          => 'works_list_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'          => 'works_list_work_how_to_open',
				'type'        => 'radio',
				'title'       => esc_html__( 'How to open work', 'rife-free' ),
				'description' => esc_html__( '"In lightbox" will load work content dynamically with JavaScript. Cause of that use JavaScripts plugins is very limited in such works. If you need page builder elements, then use normal mode.', 'rife-free' ),
				'options'     => array(
					'normal'      => esc_html__( 'Normal', 'rife-free' ),
					'in-lightbox' => esc_html__( 'In lightbox', 'rife-free' ),
				),
				'default'     => 'normal',
			),
			array(
				'id'      => 'works_list_work_look',
				'type'    => 'radio',
				'title'   => esc_html__( 'Work look', 'rife-free' ),
				'options' => array(
					'overlay' => esc_html__( 'Title over photo', 'rife-free' ),
					'under'   => esc_html__( 'Title under photo', 'rife-free' ),
				),
				'default' => 'overlay',
			),
			array(
				'id'       => 'works_list_work_overlay_title_position',
				'type'     => 'select',
				'title'    => esc_html__( 'Texts position', 'rife-free' ),
				'options'  => array(
					'top_left'      => esc_html__( 'Top left', 'rife-free' ),
					'top_center'    => esc_html__( 'Top center', 'rife-free' ),
					'top_right'     => esc_html__( 'Top right', 'rife-free' ),
					'mid_left'      => esc_html__( 'Middle left', 'rife-free' ),
					'mid_center'    => esc_html__( 'Middle center', 'rife-free' ),
					'mid_right'     => esc_html__( 'Middle right', 'rife-free' ),
					'bottom_left'   => esc_html__( 'Bottom left', 'rife-free' ),
					'bottom_center' => esc_html__( 'Bottom center', 'rife-free' ),
					'bottom_right'  => esc_html__( 'Bottom right', 'rife-free' ),
				),
				'default'  => 'top_left',
				'required' => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'works_list_work_overlay_cover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'works_list_work_overlay_cover_hover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'          => 'works_list_work_overlay_gradient',
				'type'        => 'radio',
				'title'       => esc_html__( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'description' => esc_html__( 'Its main function is to make texts more visible', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'required'    => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'          => 'works_list_work_overlay_gradient_hover',
				'type'        => 'radio',
				'title'       => esc_html__( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => esc_html__( 'Its main function is to make texts more visible', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'works_list_work_overlay_texts',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'works_list_work_overlay_texts_hover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'works_list_work_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'works_list_work_under_title_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Texts position', 'rife-free' ),
				'options'  => $text_align,
				'default'  => 'left',
				'required' => array( 'works_list_work_look', '=', 'under' ),
			),
			array(
				'id'          => 'works_list_bricks_hover',
				'type'        => 'select',
				'title'       => esc_html__( 'Hover effect', 'rife-free' ),
				'options'     => $bricks_hover,
				'default'     => 'cross',
			),
			array(
				'id'      => 'works_list_items_per_page',
				'type'    => 'slider',
				'title'   => esc_html__( 'Items per page', 'rife-free' ),
				'min'     => 1,
				'max'     => 30,
				'step'    => 1,
				'unit'    => '',
				'default' => 12,
			),
			array(
				'id'          => 'works_list_layout_mode',
				'type'        => 'radio',
				'title'       => esc_html__( 'How to place items in rows', 'rife-free' ),
				'description' => esc_html__( 'If your items have different heights, you can start each row of items from a new line instead of the masonry style.', 'rife-free' ),
				'options'     => array(
					'packery' => esc_html__( 'Masonry', 'rife-free' ),
					'fitRows' => esc_html__( 'Each row from new line', 'rife-free' ),
				),
				'default'     => 'packery',
			),
			array(
				'id'          => 'works_list_brick_columns',
				'type'        => 'slider',
				'title'       => esc_html__( 'Bricks columns', 'rife-free' ),
				'description' => esc_html__( 'It is a maximum number of columns displayed on larger devices. On smaller devices, it can be a lower number of columns.', 'rife-free' ),
				'min'         => 1,
				'max'         => 4,
				'step'        => 1,
				'default'     => 3,
				'unit'        => '',
			),
			array(
				'id'          => 'works_list_bricks_max_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'The maximum width of the brick layout', 'rife-free' ),
				'description' => esc_html__( 'Depending on the actual width of the screen, the available space for bricks may be smaller, but never greater than this number.', 'rife-free' ),
				'min'         => 200,
				'max'         => 2500,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 2000,
			),
			array(
				'id'      => 'works_list_brick_margin',
				'type'    => 'slider',
				'title'   => esc_html__( 'Brick margin', 'rife-free' ),
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 10,
			),
			array(
				'id'      => 'works_list_bricks_proportions_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Choose the proportions of the bricks', 'rife-free' ),
				'options' => array(
					'0'    => esc_html__( 'Original size', 'rife-free' ),
					'1/1'  => esc_html__( '1:1', 'rife-free' ),
					'2/3'  => esc_html__( '2:3', 'rife-free' ),
					'3/2'  => esc_html__( '3:2', 'rife-free' ),
					'3/4'  => esc_html__( '3:4', 'rife-free' ),
					'4/3'  => esc_html__( '4:3', 'rife-free' ),
					'9/16' => esc_html__( '9:16', 'rife-free' ),
					'16/9' => esc_html__( '16:9', 'rife-free' ),
				),
				'default' => '0',
			),
			array(
				'id'      => 'works_list_lazy_load',
				'type'    => 'radio',
				'title'   => esc_html__( 'Lazy load', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'works_list_lazy_load_mode',
				'type'     => 'radio',
				'title'    => esc_html__( 'Lazy load', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'options'  => array(
					'button' => esc_html__( 'By clicking button', 'rife-free' ),
					'auto'   => esc_html__( 'On scroll', 'rife-free' ),
				),
				'default'  => 'button',
				'required' => array( 'works_list_lazy_load', '=', 'on' ),
			),
			array(
				'id'      => 'works_list_categories',
				'type'    => 'radio',
				'title'   => esc_html__( 'Work info', 'rife-free' ). ' : ' .esc_html__( 'Categories', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Works list', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_works_list_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'works_list_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'works_list_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'default'  => 'off',
				'options'  => $on_off,
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'          => 'works_list_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'works_list_title', '=', 'on' ),
					array( 'works_list_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'works_list_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'works_list_title', '=', 'on' ),
					array( 'works_list_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'works_list_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'          => 'works_list_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 40,
				'required' => array( 'works_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'works_list_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Works list', 'rife-free' ). ' - ' .esc_html__( 'Filter', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_works_list_filter',
		'icon'       => 'fa fa-filter',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'works_list_filter',
				'type'    => 'radio',
				'title'   => esc_html__( 'Filter', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'works_list_filter_padding',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Padding', 'rife-free' ),
				'mode'     => 'padding',
				'sides'    => array( 'top', 'bottom' ),
				'units'    => array( 'px', 'em' ),
				'default'  => array(
					'padding-top'    => '40px',
					'padding-bottom' => '40px',
					'units'          => 'px'
				),
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_hover_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'required' => array( 'works_list_filter', '=', 'on' ),
				'default'  => '#000000',
			),
			array(
				'id'      => 'works_list_filter_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 5,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'px',
				'default' => '',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'bold',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_transform',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text transform', 'rife-free' ),
				'options'  => $font_transforms,
				'default'  => 'uppercase',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'works_list_filter_text_align',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text align', 'rife-free' ),
				'options'  => $text_align,
				'default'  => 'center',
				'required' => array( 'works_list_filter', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single work', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_single_work',
		'icon'       => 'fa fa-th',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'work_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'work_content_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Content Layout', 'rife-free' ),
				'options' => $content_layouts,
				'default' => 'center',
			),
			array(
				'id'      => 'work_content_categories',
				'type'    => 'radio',
				'title'   => esc_html__( 'Categories in content', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'      => 'work_navigation',
				'type'    => 'radio',
				'title'   => esc_html__( 'Works navigation', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'work_navigate_by_categories',
				'type'        => 'radio',
				'title'       => esc_html__( 'Navigate by categories', 'rife-free' ),
				'description' => esc_html__( 'If enabled, navigation leads to the next/previous item in the same category. If disabled, it will navigate through items according to the order of the "publication date".', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'work_navigation', '=', 'on' ),
			),
			array(
				'id'          => 'work_similar_works',
				'type'        => 'radio',
				'title'       => esc_html__( 'Similar works', 'rife-free' ),
				'description' => esc_html__( 'Will display list(up to 3 items) of similar works at bottom of work content.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
			array(
				'id'          => 'work_bricks_thumb_video',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display thumbnails instead of video', 'rife-free' ),
				'description' => esc_html__( 'If enabled, the video will be displayed in the lightbox.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single work', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_single_work_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'work_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'work_title_bar_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Title position', 'rife-free' ),
				'options'  => array(
					'outside' => esc_html__( 'Before the content', 'rife-free' ),
//				'inside'  => esc_html__( 'Inside the content', 'rife-free' ), //for future if inside title will be also needed
				),
				'default'  => 'outside',
				'required' => array( 'work_title', '=', 'it_is_hidden' ),
				//way to make it hidden, but still have value, as we don't have "hidden" type of field
			),
			array(
				'id'       => 'work_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'default'  => 'off',
				'options'  => $on_off,
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'          => 'work_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'work_title', '=', 'on' ),
					array( 'work_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'work_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'work_title', '=', 'on' ),
					array( 'work_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'work_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'          => 'work_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 40,
				'required' => array( 'work_title', '=', 'on' ),
			),
			array(
				'id'       => 'work_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'work_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single work', 'rife-free' ). ' - ' .esc_html__( 'Slider', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_single_work_slider',
		'icon'       => 'fa fa-exchange',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'work_slider_autoplay',
				'type'        => 'radio',
				'title'       => esc_html__( 'Autoplay', 'rife-free' ),
				'description' => esc_html__( 'If autoplay is on, slider will run on page load.', 'rife-free' ). ' ' . esc_html__( 'Can be overridden in each work.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'work_slider_slide_interval',
				'type'        => 'slider',
				'title'       => esc_html__( 'Time between slides', 'rife-free' ),
				'description' => esc_html__( 'Global for all works.', 'rife-free' ),
				'min'         => 0,
				'max'         => 15000,
				'step'        => 1,
				'unit'        => 'ms',
				'default'     => 7000,
			),
			array(
				'id'          => 'work_slider_transition_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'Animation between slides.', 'rife-free' ),
				'options'     => array(
					'0' => esc_html__( 'None', 'rife-free' ),
					'1' => esc_html__( 'Fade', 'rife-free' ),
					'2' => esc_html__( 'Carousel', 'rife-free' ),
					'3' => esc_html__( 'Zooming', 'rife-free' ),
				),
				'default'     => '2',
			),
			array(
				'id'          => 'work_slider_transition_time',
				'type'        => 'slider',
				'title'       => esc_html__( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'Speed of transition.', 'rife-free' ) . ' ' . esc_html__( 'Global for all works.', 'rife-free' ),
				'min'         => 0,
				'step'        => 1,
				'max'         => 10000,
				'unit'        => 'ms',
				'default'     => 600,
			),
			array(
				'id'          => 'work_slider_thumbs',
				'type'        => 'radio',
				'title'       => esc_html__( 'Thumbnails', 'rife-free' ),
				'description' => esc_html__( 'Global for all works.', 'rife-free' ) . ' ' . esc_html__( 'Can be overridden in each work.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),

		)
	) );

//ALBUMS SETTINGS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Albums settings', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_albums',
		'icon'     => 'fa fa-picture-o',
		'priority' => 21,
		'companion_required' => true,//only visible with companion plugin being available
		'fields'   => array()
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Background', 'rife-free' ),
		'desc'       => esc_html__( 'These will work for Albums list and single album.', 'rife-free' ),
		'id'         => 'subsection_albums_general',
		'icon'       => 'fa fa-picture-o',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'albums_custom_background',
				'type'    => 'radio',
				'title'   => esc_html__( 'Custom background', 'rife-free' ),
				'options' => $on_off,
				'default' => 'off',
			),
			array(
				'id'       => 'albums_body_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'required' => array( 'albums_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'albums_body_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'cover',
				'required' => array( 'albums_custom_background', '=', 'on' ),
			),
			array(
				'id'       => 'albums_body_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'albums_custom_background', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Albums list', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_albums_list',
		'icon'       => 'fa fa-list',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'albums_list_page',
				'type'        => 'dropdown-pages',
				'title'       => esc_html__( 'Albums list', 'rife-free' ). ' - ' .esc_html__( 'Main page', 'rife-free' ),
				'description' => esc_html__( 'This page will list all your albums and also give the main title for "album category" pages.', 'rife-free' ),
			),
			array(
				'id'          => 'albums_list_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => $content_under_header,
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'      => 'albums_list_album_look',
				'type'    => 'radio',
				'title'   => esc_html__( 'Album look', 'rife-free' ),
				'options' => array(
					'overlay' => esc_html__( 'Title over photo', 'rife-free' ),
					'under'   => esc_html__( 'Title under photo', 'rife-free' ),
				),
				'default' => 'overlay',
			),
			array(
				'id'       => 'albums_list_album_overlay_title_position',
				'type'     => 'select',
				'title'    => esc_html__( 'Texts position', 'rife-free' ),
				'options'  => array(
					'top_left'      => esc_html__( 'Top left', 'rife-free' ),
					'top_center'    => esc_html__( 'Top center', 'rife-free' ),
					'top_right'     => esc_html__( 'Top right', 'rife-free' ),
					'mid_left'      => esc_html__( 'Middle left', 'rife-free' ),
					'mid_center'    => esc_html__( 'Middle center', 'rife-free' ),
					'mid_right'     => esc_html__( 'Middle right', 'rife-free' ),
					'bottom_left'   => esc_html__( 'Bottom left', 'rife-free' ),
					'bottom_center' => esc_html__( 'Bottom center', 'rife-free' ),
					'bottom_right'  => esc_html__( 'Bottom right', 'rife-free' ),
				),
				'default'  => 'top_left',
				'required' => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'albums_list_album_overlay_cover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'albums_list_album_overlay_cover_hover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'          => 'albums_list_album_overlay_gradient',
				'type'        => 'radio',
				'title'       => esc_html__( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'description' => esc_html__( 'Its main function is to make texts more visible', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
				'required'    => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'          => 'albums_list_album_overlay_gradient_hover',
				'type'        => 'radio',
				'title'       => esc_html__( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => esc_html__( 'Its main function is to make texts more visible', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'albums_list_album_overlay_texts',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'albums_list_album_overlay_texts_hover',
				'type'     => 'radio',
				'title'    => esc_html__( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'albums_list_album_look', '=', 'overlay' ),
			),
			array(
				'id'       => 'albums_list_album_under_title_position',
				'type'     => 'radio',
				'title'    => esc_html__( 'Texts position', 'rife-free' ),
				'options'  => $text_align,
				'default'  => 'left',
				'required' => array( 'albums_list_album_look', '=', 'under' ),
			),
			array(
				'id'          => 'albums_list_bricks_hover',
				'type'        => 'select',
				'title'       => esc_html__( 'Hover effect', 'rife-free' ),
				'options'     => $bricks_hover,
				'default'     => 'cross',
			),
			array(
				'id'      => 'albums_list_items_per_page',
				'type'    => 'slider',
				'title'   => esc_html__( 'Items per page', 'rife-free' ),
				'min'     => 1,
				'max'     => 30,
				'step'    => 1,
				'default' => 12,
				'unit'    => '',
			),
			array(
				'id'          => 'albums_list_layout_mode',
				'type'        => 'radio',
				'title'       => esc_html__( 'How to place items in rows', 'rife-free' ),
				'description' => esc_html__( 'If your items have different heights, you can start each row of items from a new line instead of the masonry style.', 'rife-free' ),
				'options'     => array(
					'packery' => esc_html__( 'Masonry', 'rife-free' ),
					'fitRows' => esc_html__( 'Each row from new line', 'rife-free' ),
				),
				'default'     => 'packery',
			),
			array(
				'id'          => 'albums_list_brick_columns',
				'type'        => 'slider',
				'title'       => esc_html__( 'Bricks columns', 'rife-free' ),
				'description' => esc_html__( 'It is a maximum number of columns displayed on larger devices. On smaller devices, it can be a lower number of columns.', 'rife-free' ),
				'min'         => 1,
				'max'         => 4,
				'step'        => 1,
				'default'     => 3,
				'unit'        => '',
			),
			array(
				'id'          => 'albums_list_bricks_max_width',
				'type'        => 'slider',
				'title'       => esc_html__( 'The maximum width of the brick layout', 'rife-free' ),
				'description' => esc_html__( 'Depending on the actual width of the screen, the available space for bricks may be smaller, but never greater than this number.', 'rife-free' ),
				'min'         => 200,
				'max'         => 2500,
				'step'        => 1,
				'unit'        => 'px',
				'default'     => 2000,
			),
			array(
				'id'      => 'albums_list_brick_margin',
				'type'    => 'slider',
				'title'   => esc_html__( 'Brick margin', 'rife-free' ),
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 10,
			),
			array(
				'id'      => 'albums_list_bricks_proportions_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Choose the proportions of the bricks', 'rife-free' ),
				'options' => array(
					'0'    => esc_html__( 'Original size', 'rife-free' ),
					'1/1'  => esc_html__( '1:1', 'rife-free' ),
					'2/3'  => esc_html__( '2:3', 'rife-free' ),
					'3/2'  => esc_html__( '3:2', 'rife-free' ),
					'3/4'  => esc_html__( '3:4', 'rife-free' ),
					'4/3'  => esc_html__( '4:3', 'rife-free' ),
					'9/16' => esc_html__( '9:16', 'rife-free' ),
					'16/9' => esc_html__( '16:9', 'rife-free' ),
				),
				'default' => '0',
			),
			array(
				'id'      => 'albums_list_lazy_load',
				'type'    => 'radio',
				'title'   => esc_html__( 'Lazy load', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'albums_list_lazy_load_mode',
				'type'     => 'radio',
				'title'    => esc_html__( 'Lazy load', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'options'  => array(
					'button' => esc_html__( 'By clicking button', 'rife-free' ),
					'auto'   => esc_html__( 'On scroll', 'rife-free' ),
				),
				'default'  => 'button',
				'required' => array( 'albums_list_lazy_load', '=', 'on' ),
			),
			array(
				'id'      => 'albums_list_categories',
				'type'    => 'radio',
				'title'   => esc_html__( 'Album meta: Categories', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Albums list', 'rife-free' ). ' - ' .esc_html__( 'Title bar', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_albums_list_title',
		'icon'       => 'fa fa-text-width',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'albums_list_title',
				'type'    => 'radio',
				'title'   => esc_html__( 'Title', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'albums_list_title_bar_variant',
				'type'     => 'radio',
				'title'    => esc_html__( 'Variant', 'rife-free' ),
				'options'  => array(
					'classic'  => esc_html__( 'Classic(to side)', 'rife-free' ),
					'centered' => esc_html__( 'Centered', 'rife-free' ),
				),
				'default'  => 'classic',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_width',
				'type'     => 'radio',
				'title'    => esc_html__( 'Width', 'rife-free' ),
				'options'  => array(
					'full'  => esc_html__( 'Full', 'rife-free' ),
					'boxed' => esc_html__( 'Boxed', 'rife-free' ),
				),
				'default'  => 'full',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_image',
				'type'     => 'image',
				'title'    => esc_html__( 'Background image', 'rife-free' ),
				'default'  => '',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_image_fit',
				'type'     => 'select',
				'title'    => esc_html__( 'How to fit the background image', 'rife-free' ),
				'options'  => $image_fit,
				'default'  => 'repeat',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_parallax',
				'type'     => 'radio',
				'title'    => esc_html__( 'Parallax', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'off',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'          => 'albums_list_title_bar_parallax_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'options'     => $parallax_types,
				'default'     => 'tb',
				'required'    => array(
					array( 'albums_list_title', '=', 'on' ),
					array( 'albums_list_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'albums_list_title_bar_parallax_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.01,
				'default'     => '1.00',
				'required'    => array(
					array( 'albums_list_title', '=', 'on' ),
					array( 'albums_list_title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'id'          => 'albums_list_title_bar_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Overlay color', 'rife-free' ),
				'description' => esc_html__( 'Will be placed above the image(if used)', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_title_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'          => 'albums_list_title_bar_color_1',
				'type'        => 'color',
				'title'       => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => esc_html__( 'Used in breadcrumbs.', 'rife-free' ),
				'default'     => '',
				'required'    => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_title_bar_space_width',
				'type'     => 'slider',
				'title'    => esc_html__( 'Top/bottom padding', 'rife-free' ),
				'min'      => 0,
				'max'      => 600,
				'step'     => 1,
				'unit'     => 'px',
				'default'  => 40,
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_breadcrumbs',
				'type'     => 'radio',
				'title'    => esc_html__( 'Breadcrumbs', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
				'required' => array( 'albums_list_title', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Albums list', 'rife-free' ). ' - ' .esc_html__( 'Filter', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_albums_list_filter',
		'icon'       => 'fa fa-filter',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'albums_list_filter',
				'type'    => 'radio',
				'title'   => esc_html__( 'Filter', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'albums_list_filter_padding',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Padding', 'rife-free' ),
				'mode'     => 'padding',
				'sides'    => array( 'top', 'bottom' ),
				'units'    => array( 'px', 'em' ),
				'default'  => array(
					'padding-top'    => '40px',
					'padding-bottom' => '40px',
					'units'          => 'px'
				),
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_hover_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'      => 'albums_list_filter_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 5,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'px',
				'default' => '',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'bold',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_transform',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text transform', 'rife-free' ),
				'options'  => $font_transforms,
				'default'  => 'uppercase',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
			array(
				'id'       => 'albums_list_filter_text_align',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text align', 'rife-free' ),
				'options'  => $text_align,
				'default'  => 'center',
				'required' => array( 'albums_list_filter', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single album', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_single_album',
		'icon'       => 'fa fa-th',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'album_content_under_header',
				'type'        => 'select',
				'title'       => esc_html__( 'Hide content under the header', 'rife-free' ),
				'description' => esc_html__( 'Works only with the horizontal header.', 'rife-free' ),
				'options'     => array(
					'content' => esc_html__( 'Yes, hide the content', 'rife-free' ),
					'off'     => esc_html__( 'Turn it off', 'rife-free' ),
				),
				'default'     => 'off',
				'required'    => array( 'header_type', '=', 'horizontal' ),
			),
			array(
				'id'       => 'album_content_title',
				'type'     => 'radio',
				'title'    => esc_html__( 'Title in content', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
			),
			array(
				'id'       => 'album_content_categories',
				'type'     => 'radio',
				'title'    => esc_html__( 'Categories in content', 'rife-free' ),
				'options'  => $on_off,
				'default'  => 'on',
			),
			array(
				'id'      => 'album_navigation',
				'type'    => 'radio',
				'title'   => esc_html__( 'Albums navigation', 'rife-free' ),
				'description' => esc_html__( 'Displayed in text content', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'album_navigate_by_categories',
				'type'        => 'radio',
				'title'       => esc_html__( 'Navigate by categories', 'rife-free' ),
				'description' => esc_html__( 'If enabled, navigation leads to the next/previous item in the same category. If disabled, it will navigate through items according to the order of the "publication date".', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
				'required'    => array( 'album_navigation', '!=', 'off' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single album', 'rife-free' ). ' - ' .esc_html__( 'Bricks', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_album_bricks',
		'icon'       => 'fa fa-th',
		'subsection' => true,
		'fields'     => array(

			array(
				'id'          => 'album_content',
				'type'        => 'select',
				'title'       => esc_html__( 'Content column', 'rife-free' ),
				'description' => esc_html__( 'This will display separate block with title and text about the album.', 'rife-free' ),
				'options'     => array(
					'left'  => esc_html__( 'Show on the left', 'rife-free' ),
					'right' => esc_html__( 'Show on the right', 'rife-free' ),
					'off'   => esc_html__( 'Do not display it', 'rife-free' ),
				),
				'default'     => 'right',
			),
			array(
				'id'          => 'album_bricks_thumb_video',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display thumbnails instead of video', 'rife-free' ),
				'description' => esc_html__( 'If enabled, the video will be displayed in the lightbox.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single album', 'rife-free' ). ' - ' .esc_html__( 'Bricks filter', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_album_bricks_filter',
		'icon'       => 'fa fa-filter',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'album_bricks_filter',
				'type'    => 'radio',
				'title'   => esc_html__( 'Filter', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'       => 'album_bricks_filter_padding',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Padding', 'rife-free' ),
				'mode'     => 'padding',
				'sides'    => array( 'top', 'bottom' ),
				'units'    => array( 'px', 'em' ),
				'default'  => array(
					'padding-top'    => '40px',
					'padding-bottom' => '40px',
					'units'          => 'px'
				),
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background color', 'rife-free' ),
				'default'  => '',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_hover_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Links', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ). ' - ' .esc_html__( 'on hover/active', 'rife-free' ),
				'default'  => '#000000',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'      => 'album_bricks_filter_font_size',
				'type'    => 'slider',
				'title'   => esc_html__( 'Font size', 'rife-free' ),
				'min'     => 5,
				'max'     => 30,
				'step'    => 1,
				'unit'    => 'px',
				'default' => '',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_weight',
				'type'     => 'select',
				'title'    => esc_html__( 'Font weight', 'rife-free' ),
				'options'  => $font_weights,
				'default'  => 'bold',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_transform',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text transform', 'rife-free' ),
				'options'  => $font_transforms,
				'default'  => 'uppercase',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
			array(
				'id'       => 'album_bricks_filter_text_align',
				'type'     => 'radio',
				'title'    => esc_html__( 'Text align', 'rife-free' ),
				'options'  => $text_align,
				'default'  => 'center',
				'required' => array( 'album_bricks_filter', '=', 'on' ),
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single album', 'rife-free' ). ' - ' .esc_html__( 'Slider', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_album_slider',
		'icon'       => 'fa fa-exchange',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'album_slider_autoplay',
				'type'        => 'radio',
				'title'       => esc_html__( 'Autoplay', 'rife-free' ),
				'description' => esc_html__( 'If autoplay is on, slider will run on page load.', 'rife-free' ). ' ' . esc_html__( 'Can be overridden in each album.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
			array(
				'id'          => 'album_slider_slide_interval',
				'type'        => 'slider',
				'title'       => esc_html__( 'Time between slides', 'rife-free' ),
				'description' => esc_html__( 'Global for all albums.', 'rife-free' ),
				'min'         => 0,
				'max'         => 15000,
				'step'        => 1,
				'unit'        => 'ms',
				'default'     => 7000,
			),
			array(
				'id'          => 'album_slider_transition_type',
				'type'        => 'select',
				'title'       => esc_html__( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Type', 'rife-free' ),
				'description' => esc_html__( 'Animation between slides.', 'rife-free' ),
				'options'     => array(
					'0' => esc_html__( 'None', 'rife-free' ),
					'1' => esc_html__( 'Fade', 'rife-free' ),
					'2' => esc_html__( 'Carousel', 'rife-free' ),
					'3' => esc_html__( 'Zooming', 'rife-free' ),
				),
				'default'     => '2',
			),
			array(
				'id'          => 'album_slider_transition_time',
				'type'        => 'slider',
				'title'       => esc_html__( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Speed', 'rife-free' ),
				'description' => esc_html__( 'Speed of transition.', 'rife-free' ) . ' ' . esc_html__( 'Global for all albums.', 'rife-free' ),
				'min'         => 0,
				'max'         => 10000,
				'step'        => 1,
				'unit'        => 'ms',
				'default'     => 600,
			),
			array(
				'id'          => 'album_slider_thumbs',
				'type'        => 'radio',
				'title'       => esc_html__( 'Thumbnails', 'rife-free' ),
				'description' => esc_html__( 'Can be overridden in each album.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),

		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Single album', 'rife-free' ). ' - ' .esc_html__( 'Social icons', 'rife-free' ),
		'desc'       => esc_html__( 'If you are using AddToAny plugin for sharing, then you should check these options.', 'rife-free' ),
		'id'         => 'subsection_album_socials',
		'icon'       => 'fa fa-facebook-official',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'album_social_icons',
				'type'    => 'radio',
				'title'   => esc_html__( 'Use social icons in albums', 'rife-free' ),
				'options' => $on_off,
				'default' => 'on',
			),
			array(
				'id'          => 'album_share_type',
				'type'        => 'radio',
				'title'       => esc_html__( 'Share a link to the album or to the attachment page', 'rife-free' ),
				'description' => esc_html__( 'When using the share plugin choose one way of sharing. More details in the documentation.', 'rife-free' ),
				'options'     => array(
					'album'           => esc_html__( 'Album', 'rife-free' ),
					'attachment_page' => esc_html__( 'Attachment page', 'rife-free' ),
				),
				'default'     => 'album',
				'required'    => array( 'album_social_icons', '=', 'on' ),
			),
		)
	) );

//MISCELLANEOUS
	$apollo13framework_a13->set_sections( array(
		'title'    => esc_html__( 'Miscellaneous', 'rife-free' ),
		'desc'     => '',
		'id'       => 'section_miscellaneous',
		'icon'     => 'fa fa-question',
		'priority' => 24,
		'fields'   => array(),
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Anchors', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_anchors',
		'icon'       => 'fa fa-external-link',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'anchors_in_bar',
				'type'        => 'radio',
				'title'       => esc_html__( 'Display anchors in address bar', 'rife-free' ),
				/* translators: %1$s: Link example, %2$s: Link example */
				'description' => sprintf( esc_html__( 'If disabled it will not show anchors, in the address bar of your browser, when they are clicked or entered. So address like %1$s will be displayed as %2$s.', 'rife-free' ), '<code>https://apollo13themes.com/rife/#downloads</code>', '<code>https://apollo13themes.com/rife/</code>' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
			array(
				'id'          => 'scroll_to_anchor',
				'type'        => 'radio',
				'title'       => esc_html__( 'Scroll to anchor handling', 'rife-free' ),
				'description' => esc_html__( 'If enabled it will scroll to anchor after it is clicked on the same page. It can, however, conflict with plugins that uses the same mechanism, and the page can scroll in a weird way. In such case disable this feature.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'on',
			),
		)
	) );

	$apollo13framework_a13->set_sections( array(
		'title'      => esc_html__( 'Writing effect', 'rife-free' ),
		'desc'       => '',
		'id'         => 'subsection_writing_effect',
		'icon'       => 'fa fa-pencil',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'writing_effect_mobile',
				'type'        => 'radio',
				'title'       => esc_html__( 'Writing effect', 'rife-free' ). ' - ' .esc_html__( 'on mobiles', 'rife-free' ),
				'description' => esc_html__( 'If disabled it will show all written lines as separate paragraphs on small devices(less than 600 pixels wide). It is good to disable it to save CPU of your user devices, and to remove "jumping screen" effect on smaller screens.', 'rife-free' ),
				'options'     => $on_off,
				'default'     => 'off',
			),
			array(
				'id'          => 'writing_effect_speed',
				'type'        => 'slider',
				'title'       => esc_html__( 'Writing effect', 'rife-free' ). ' : ' .esc_html__( 'Text write speed', 'rife-free' ),
				'description' => esc_html__( 'How many ms should pass between printing each character. Bigger value is slower writing.', 'rife-free' ),
				'default'     => 10,
				'min'         => 10,
				'max'         => 1000,
				'step'        => 1,
				'unit'        => 'ms',
			),
		)
	) );

	/*
 * <--- END SECTIONS
 */

	do_action( 'apollo13framework_additional_theme_options' );
}

apollo13framework_setup_theme_options();
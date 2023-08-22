<?php

function apollo13framework_meta_boxes_post() {
	$meta = array(
		/*
		 *
		 * Tab: Posts list
		 *
		 */
		'posts_list' => array(
			array(
				'name' => __('Posts list', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-list'
			),
			array(
				'name'        => __( 'Size of brick', 'rife-free' ),
				'description' => __( 'What should be the width of this post on the Posts list?', 'rife-free' ),
				'id'          => 'brick_ratio_x',
				'default'     => 1,
				'unit'        => '',
				'min'         => 1,
				'max'         => 4,
				'type'        => 'slider'
			),
		),


		/*
		 *
		 * Tab: Featured media
		 *
		 */
		'featured_media' => array(
			array(
				'name' => __('Featured media', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-star'
			),
			array(
				'name'        => __( 'Post media', 'rife-free' ),
				'description' => __( 'Choose between image, video and images slider. For the image use the Featured Image option. For the <strong>Images slider</strong> you need plugin the <a href="https://wordpress.org/plugins/featured-galleries/" target="_blank">Featured galleries</a>.', 'rife-free' ),
				'id'          => 'image_or_video',
				'default'     => 'post_image',
				'options'     => array(
					'post_image'  => __( 'Image', 'rife-free' ),
					'post_slider' => __( 'Images slider', 'rife-free' ),
				),
				'type'        => 'radio',
			),
			array(
				'name'        => __( 'Featured Image ', 'rife-free' ). ' : ' . __( 'Parallax', 'rife-free' ),
				'id'          => 'image_parallax',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'required'    => array( 'image_or_video', '=', 'post_image' ),
			),
			array(
				'name'     => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Area height', 'rife-free' ),
				'description' => __( 'This limits the height of the image so that the parallax can work.', 'rife-free' ),
				'id'       => 'image_parallax_height',
				'default'  => '260',
				'unit'     => 'px',
				'min'      => 100,
				'max'      => 600,
				'type'     => 'slider',
				'required' => array(
					array( 'image_or_video', '=', 'post_image' ),
					array( 'image_parallax', '=', 'on' ),
				)
			),
		),

		/*
		 *
		 * Tab: Header
		 *
		 */
		'header' => array(
			array(
				'name' => __('Header', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-cogs'
			),
			array(
				'name'          => __( 'Hide content under the header', 'rife-free' ),
				'description'   => __( 'Works only with the horizontal header.', 'rife-free' ),
				'id'            => 'content_under_header',
				'global_value'  => 'G',
				'default'       => 'G',
				'parent_option' => 'post_content_under_header',
				'type'          => 'select',
				'options'       => array(
					'G'       => __( 'Global settings', 'rife-free' ),
					'content' => __( 'Yes, hide the content', 'rife-free' ),
					'title'   => __( 'Yes, hide the content and add top padding to the outside title bar.', 'rife-free' ),
					'off'     => __( 'Turn it off', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Title bar
		 *
		 */
		'title_bar' => array(
			array(
				'name' => __('Title bar', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-text-width'
			),
			array(
				'name'        => __( 'Title bar', 'rife-free' ),
				'description' => __( 'You can use global settings or override them here', 'rife-free' ),
				'id'          => 'title_bar_settings',
				'default'     => 'global',
				'type'        => 'radio',
				'options'     => array(
					'global' => __( 'Global settings', 'rife-free' ),
					'custom' => __( 'Use custom settings', 'rife-free' ),
					'off'    => __( 'Turn it off', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Position', 'rife-free' ),
				'id'          => 'title_bar_position',
				'default'     => 'outside',
				'type'        => 'radio',
				'options'     => array(
					'outside' => __( 'Before the content', 'rife-free' ),
					'inside'  => __( 'Inside the content', 'rife-free' ),
				),
				'description' => __( 'To set the background image for the "Before the content" option, use the <strong>featured image</strong>.', 'rife-free' ),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
			array(
				'name'        => __( 'Variant', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_variant',
				'default'     => 'classic',
				'options'     => array(
					'classic'  => __( 'Classic(to side)', 'rife-free' ),
					'centered' => __( 'Centered', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Width', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_width',
				'default'     => 'full',
				'options'     => array(
					'full'  => __( 'Full', 'rife-free' ),
					'boxed' => __( 'Boxed', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => __( 'How to fit the background image', 'rife-free' ),
				'id'       => 'title_bar_image_fit',
				'default'  => 'repeat',
				'options'  => array(
					'cover'    => __( 'Cover', 'rife-free' ),
					'contain'  => __( 'Contain', 'rife-free' ),
					'fitV'     => __( 'Fit Vertically', 'rife-free' ),
					'fitH'     => __( 'Fit Horizontally', 'rife-free' ),
					'center'   => __( 'Just center', 'rife-free' ),
					'repeat'   => __( 'Repeat', 'rife-free' ),
					'repeat-x' => __( 'Repeat X', 'rife-free' ),
					'repeat-y' => __( 'Repeat Y', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_parallax',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Type', 'rife-free' ),
				'description' => __( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'id'          => 'title_bar_parallax_type',
				'default'     => 'tb',
				'options'     => array(
					"tb"   => __( 'top to bottom', 'rife-free' ),
					"bt"   => __( 'bottom to top', 'rife-free' ),
					"lr"   => __( 'left to right', 'rife-free' ),
					"rl"   => __( 'right to left', 'rife-free' ),
					"tlbr" => __( 'top-left to bottom-right', 'rife-free' ),
					"trbl" => __( 'top-right to bottom-left', 'rife-free' ),
					"bltr" => __( 'bottom-left to top-right', 'rife-free' ),
					"brtl" => __( 'bottom-right to top-left', 'rife-free' ),
				),
				'type'        => 'select',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Speed', 'rife-free' ),
				'description' => __( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'id'          => 'title_bar_parallax_speed',
				'default'     => '1.00',
				'type'        => 'text',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'description' => __( 'Will be placed above the image(if used)', 'rife-free' ),
				'id'          => 'title_bar_bg_color',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'id'       => 'title_bar_title_color',
				'default'  => '',
				'type'     => 'color',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => __( 'Used in breadcrumbs.', 'rife-free' ),
				'id'          => 'title_bar_color_1',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Top/bottom padding', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_space_width',
				'default'     => '40px',
				'unit'        => 'px',
				'min'         => 0,
				'max'         => 600,
				'type'        => 'slider',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Breadcrumbs', 'rife-free' ),
				'description' => '',
				'id'          => 'breadcrumbs',
				'default'     => 'on',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
		),

		/*
		 *
		 * Tab: Page background
		 *
		 */
		'background' => array(
			array(
				'name' => __('Page background', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-picture-o',
				'companion_required' => true
			),
		),
	);

	return apply_filters( 'apollo13framework_meta_boxes_post', $meta );
}



function apollo13framework_meta_boxes_page() {
	$sidebars = array_merge(
		array(
			'default' => __( 'Default for pages', 'rife-free' ),
		),
		apollo13framework_meta_get_user_sidebars()
	);

	$meta = array(
		/*
		 *
		 * Tab: Layout &amp; Sidebar
		 *
		 */
		'layout' => array(
			array(
				'name' => __('Layout &amp; Sidebar', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-wrench'
			),
			array(
				'name'          => __( 'Content Layout', 'rife-free' ),
				'id'            => 'content_layout',
				'default'       => 'global',
				'global_value'  => 'global',
				'parent_option' => 'page_content_layout',
				'type'          => 'select',
				'options'       => array(
					'global'        => __( 'Global settings', 'rife-free' ),
					'center'        => __( 'Center fixed width', 'rife-free' ),
					'left'          => __( 'Left fixed width', 'rife-free' ),
					'left_padding'  => __( 'Left fixed width + padding', 'rife-free' ),
					'right'         => __( 'Right fixed width', 'rife-free' ),
					'right_padding' => __( 'Right fixed width + padding', 'rife-free' ),
					'full_fixed'    => __( 'Full width + fixed content', 'rife-free' ),
					'full_padding'  => __( 'Full width + padding', 'rife-free' ),
					'full'          => __( 'Full width', 'rife-free' ),
				),
			),
			array(
				'name'        => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Top/bottom padding', 'rife-free' ),
				'id'          => 'content_padding',
				'default'     => 'both',
				'type'        => 'select',
				'options'     => array(
					'both'   => __( 'Both on', 'rife-free' ),
					'top'    => __( 'Only top', 'rife-free' ),
					'bottom' => __( 'Only bottom', 'rife-free' ),
					'off'    => __( 'Both off', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Left/right padding', 'rife-free' ),
				'id'          => 'content_side_padding',
				'default'     => 'both',
				'type'        => 'radio',
				'options'     => array(
					'both'   => __( 'Both on', 'rife-free' ),
					'off'    => __( 'Both off', 'rife-free' ),
				),
			),
			array(
				'name'          => __( 'Sidebar', 'rife-free' ),
				'id'            => 'widget_area',
				'global_value'  => 'G',
				'default'       => 'G',
				'parent_option' => 'page_sidebar',
				'options'       => array(
					'G'                     => __( 'Global settings', 'rife-free' ),
					'left-sidebar'          => __( 'Sidebar on the left', 'rife-free' ),
					'left-sidebar_and_nav'  => __( 'Children Navigation', 'rife-free' ) . ' + ' . __( 'Sidebar on the left', 'rife-free' ),
					/* translators: %s: Children Navigation */
					'left-nav'             => sprintf( __( 'Only %s on the left', 'rife-free' ), __( 'Children Navigation', 'rife-free' ) ),
					'right-sidebar'         => __( 'Sidebar on the right', 'rife-free' ),
					'right-sidebar_and_nav' => __( 'Children Navigation', 'rife-free' ) . ' + ' . __( 'Sidebar on the right', 'rife-free' ),
					/* translators: %s: Children Navigation */
					'right-nav'             => sprintf( __( 'Only %s on the right', 'rife-free' ), __( 'Children Navigation', 'rife-free' ) ),
					'off'                   => __( 'Off', 'rife-free' ),
				),
				'type'          => 'select',
			),
			array(
				'name'     => __( 'Sidebar to show', 'rife-free' ),
				'id'       => 'sidebar_to_show',
				'default'  => 'default',
				'options'  => $sidebars,
				'type'     => 'select',
				'required' => array( 'widget_area', '!=', 'off' ),
			),
		),

		/*
		 *
		 * Tab: Header
		 *
		 */
		'header' => array(
			array(
				'name' => __('Header', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-cogs'
			),
			array(
				'name'          => __( 'Hide content under the header', 'rife-free' ),
				'description'   => __( 'Works only with the horizontal header.', 'rife-free' ),
				'id'            => 'content_under_header',
				'global_value'  => 'G',
				'default'       => 'G',
				'parent_option' => 'page_content_under_header',
				'type'          => 'select',
				'options'       => array(
					'G'       => __( 'Global settings', 'rife-free' ),
					'content' => __( 'Yes, hide the content', 'rife-free' ),
					'title'   => __( 'Yes, hide the content and add top padding to the outside title bar.', 'rife-free' ),
					'off'     => __( 'Turn it off', 'rife-free' ),
				),
			),
			array(
				'name'          => __( 'Show header from the Nth row', 'rife-free' ),
				'description'   => __( 'Works only with the horizontal header.', 'rife-free' ). '<br />' . __( 'If you use Elementor or WPBakery Page Builder, then you can decide to show header after the content is scrolled to Nth row. Thanks to that you can have a clean welcome screen.', 'rife-free' ),
				'id'            => 'horizontal_header_show_header_at',
				'default'       => '0',
				'type'          => 'select',
				'options'       => array(
					'0' => __( 'Show always', 'rife-free' ),
					'1' => __( 'from 1st row', 'rife-free' ),
					'2' => __( 'from 2nd row', 'rife-free' ),
					'3' => __( 'from 3rd row', 'rife-free' ),
					'4' => __( 'from 4th row', 'rife-free' ),
					'5' => __( 'from 5th row', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Title bar
		 *
		 */
		'title_bar' => array(
			array(
				'name' => __('Title bar', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-text-width'
			),
			array(
				'name'        => __( 'Title bar', 'rife-free' ),
				'description' => __( 'You can use global settings or override them here', 'rife-free' ),
				'id'          => 'title_bar_settings',
				'default'     => 'global',
				'type'        => 'radio',
				'options'     => array(
					'global' => __( 'Global settings', 'rife-free' ),
					'custom' => __( 'Use custom settings', 'rife-free' ),
					'off'    => __( 'Turn it off', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Position', 'rife-free' ),
				'id'          => 'title_bar_position',
				'default'     => 'outside',
				'type'        => 'radio',
				'options'     => array(
					'outside' => __( 'Before the content', 'rife-free' ),
					'inside'  => __( 'Inside the content', 'rife-free' ),
				),
				'description' => __( 'To set the background image for the "Before the content" option, use the <strong>featured image</strong>.', 'rife-free' ),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
			array(
				'name'        => __( 'Variant', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_variant',
				'default'     => 'classic',
				'options'     => array(
					'classic'  => __( 'Classic(to side)', 'rife-free' ),
					'centered' => __( 'Centered', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Width', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_width',
				'default'     => 'full',
				'options'     => array(
					'full'  => __( 'Full', 'rife-free' ),
					'boxed' => __( 'Boxed', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => __( 'How to fit the background image', 'rife-free' ),
				'id'       => 'title_bar_image_fit',
				'default'  => 'repeat',
				'options'  => array(
					'cover'    => __( 'Cover', 'rife-free' ),
					'contain'  => __( 'Contain', 'rife-free' ),
					'fitV'     => __( 'Fit Vertically', 'rife-free' ),
					'fitH'     => __( 'Fit Horizontally', 'rife-free' ),
					'center'   => __( 'Just center', 'rife-free' ),
					'repeat'   => __( 'Repeat', 'rife-free' ),
					'repeat-x' => __( 'Repeat X', 'rife-free' ),
					'repeat-y' => __( 'Repeat Y', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_parallax',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Type', 'rife-free' ),
				'description' => __( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'id'          => 'title_bar_parallax_type',
				'default'     => 'tb',
				'options'     => array(
					"tb"   => __( 'top to bottom', 'rife-free' ),
					"bt"   => __( 'bottom to top', 'rife-free' ),
					"lr"   => __( 'left to right', 'rife-free' ),
					"rl"   => __( 'right to left', 'rife-free' ),
					"tlbr" => __( 'top-left to bottom-right', 'rife-free' ),
					"trbl" => __( 'top-right to bottom-left', 'rife-free' ),
					"bltr" => __( 'bottom-left to top-right', 'rife-free' ),
					"brtl" => __( 'bottom-right to top-left', 'rife-free' ),
				),
				'type'        => 'select',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Speed', 'rife-free' ),
				'description' => __( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'id'          => 'title_bar_parallax_speed',
				'default'     => '1.00',
				'type'        => 'text',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'description' => __( 'Will be placed above the image(if used)', 'rife-free' ),
				'id'          => 'title_bar_bg_color',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'id'       => 'title_bar_title_color',
				'default'  => '',
				'type'     => 'color',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => __( 'Used in breadcrumbs.', 'rife-free' ),
				'id'          => 'title_bar_color_1',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Top/bottom padding', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_space_width',
				'default'     => '40px',
				'unit'        => 'px',
				'min'         => 0,
				'max'         => 600,
				'type'        => 'slider',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Breadcrumbs', 'rife-free' ),
				'description' => '',
				'id'          => 'breadcrumbs',
				'default'     => 'on',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
		),

		/*
		 *
		 * Tab: Featured media
		 *
		 */
		'featured_media' => array(
			array(
				'name' => __('Featured media', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-star'
			),
			array(
				'name'        => __( 'Post media', 'rife-free' ),
				'description' => __( 'Choose between image, video and images slider. For the image use the Featured Image option. For the <strong>Images slider</strong> you need plugin the <a href="https://wordpress.org/plugins/featured-galleries/" target="_blank">Featured galleries</a>.', 'rife-free' ),
				'id'          => 'image_or_video',
				'default'     => 'post_image',
				'options'     => array(
					'post_image'  => __( 'Image', 'rife-free' ),
					'post_slider' => __( 'Images slider', 'rife-free' ),
				),
				'type'        => 'radio',
			),
			array(
				'name'        => __( 'Featured Image ', 'rife-free' ). ' : ' . __( 'Parallax', 'rife-free' ),
				'id'          => 'image_parallax',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'required'    => array( 'image_or_video', '=', 'post_image' ),
			),
			array(
				'name'     => esc_html__( 'Parallax', 'rife-free' ). ' : ' . esc_html__( 'Area height', 'rife-free' ),
				'description' => __( 'This limits the height of the image so that the parallax can work.', 'rife-free' ),
				'id'       => 'image_parallax_height',
				'default'  => '260',
				'unit'     => 'px',
				'min'      => 100,
				'max'      => 600,
				'type'     => 'slider',
				'required' => array(
					array( 'image_or_video', '=', 'post_image' ),
					array( 'image_parallax', '=', 'on' ),
				)
			),
		),

		/*
		 *
		 * Tab: Page background
		 *
		 */
		'background' => array(
			array(
				'name' => __('Page background', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-picture-o',
				'companion_required' => true
			),
		),

		/*
		 *
		 * Tab: Sticky one page mode
		 *
		 */
		'sticky_one_page' => array(
			array(
				'name' => __('Sticky One Page mode', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-anchor'
			),
			array(
				'name'        => __( 'Sticky One Page mode', 'rife-free' ),
				'description' => __( 'This works only when page is designed with WPBakery Page Builder. With this option enabled, the page will turn into a vertical slider to the full height of the browser window, and each row created in the WPBakery Page Builder is a single slide.', 'rife-free' ),
				'id'          => 'content_sticky_one_page',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
			),
			array(
				'name'     => __( 'Color of navigation bullets', 'rife-free' ),
				'id'       => 'content_sticky_one_page_bullet_color',
				'default'  => 'rgba(0,0,0,1)',
				'type'     => 'color',
				'required' => array(
					array( 'content_sticky_one_page', '=', 'on' )
				)
			),
			array(
				'name'        => __( 'Default bullets icon', 'rife-free' ),
				'id'          => 'content_sticky_one_page_bullet_icon',
				'default'     => '',
				'type'        => 'text',
				'input_class' => 'a13-fa-icon a13-full-class',
				'required'    => array(
					array( 'content_sticky_one_page', '=', 'on' )
				)
			),
		),
	);

	return apply_filters( 'apollo13framework_meta_boxes_page', $meta );
}



function apollo13framework_meta_boxes_album() {
	$meta = array(
		/*
		 *
		 * Tab: Albums list
		 *
		 */
		'albums_list' => array(
			array(
				'name' => __('Albums list', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-list'
			),
			array(
				'name'        => __( 'Size of brick', 'rife-free' ),
				'description' => __( 'What should be the width of this album on the Albums list?', 'rife-free' ),
				'id'          => 'brick_ratio_x',
				'default'     => 1,
				'unit'        => '',
				'min'         => 1,
				'max'         => 4,
				'type'        => 'slider'
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'id'          => 'cover_color',
				'description' => __( 'Works only when titles are displayed over images in the Albums list.', 'rife-free' ),
				'default'     => 'rgba(0,0,0, 0.7)',
				'type'        => 'color'
			),
			array(
				'name'        => __( 'Exclude from the Albums list page', 'rife-free' ),
				'description' => __( 'If enabled, then this Album will not be listed on the Albums list page, but you can still select it for the front page or in other places.', 'rife-free' ),
				'id'          => 'exclude_in_albums_list',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Album media
		 *
		 */
		'album_media' => array(
			array(
				'name' => __('Album media', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-th',
			),
			array(
				'name'        => __( 'Items order', 'rife-free' ),
				'description' => __( 'It will display your images/videos from the first to the last or in a different way.', 'rife-free' ),
				'id'          => 'order',
				'default'     => 'ASC',
				'options'     => array(
					'ASC'    => __( 'First on the list, first displayed', 'rife-free' ),
					'DESC'   => __( 'First on the list, last displayed', 'rife-free' ),
					'random' => __( 'Random', 'rife-free' ),
				),
				'type'        => 'select',
			),
			array(
				'name'        => __( 'Show title and description of album items', 'rife-free' ),
				'description' => __( 'If enabled, then it will affect displaying in bricks and slider option, and also in lightbox.', 'rife-free' ),
				'id'          => 'enable_desc',
				'default'     => 'on',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
			),
			array(
				'name'    => __( 'Show media in', 'rife-free' ),
				'description'   => __( 'Slider and Bricks work for both images and videos.', 'rife-free' ),
				'id'      => 'theme',
				'default' => 'bricks',
				'options' => array(
					'bricks' => __( 'Bricks', 'rife-free' ),
					'slider' => __( 'Slider', 'rife-free' ),
				),
				'type'    => 'radio',
			),
			array(
				'name'          => __( 'Content column', 'rife-free' ),
				'description'   => __( 'This will display separate block with title and text about the album.', 'rife-free' ),
				'id'            => 'album_content',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'album_content',
				'options'       => array(
					'G'     => __( 'Global settings', 'rife-free' ),
					'left'  => __( 'Show on the left', 'rife-free' ),
					'right' => __( 'Show on the right', 'rife-free' ),
					'off'   => __( 'Do not display it', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'        => __( 'Bricks columns', 'rife-free' ),
				'id'          => 'brick_columns',
				'default'     => '3',
				'unit'        => '',
				'min'         => 1,
				'max'         => 6,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'        => __( 'The maximum width of the brick layout', 'rife-free' ),
				'description' => __( 'Depending on the actual width of the screen, the available space for bricks may be smaller, but never greater than this number.', 'rife-free' ),
				'id'          => 'bricks_max_width',
				'default'     => '1920px',
				'unit'        => 'px',
				'min'         => 200,
				'max'         => 2500,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Brick margin', 'rife-free' ),
				'id'       => 'brick_margin',
				'default'  => '10px',
				'unit'     => 'px',
				'min'      => 0,
				'max'      => 100,
				'type'     => 'slider',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Choose the proportions of the bricks', 'rife-free' ),
				'description' => __( 'It works only for images. If you change the theme option, which is called "Display thumbnails instead of video", then for videos that have set a featured image, it will also work.', 'rife-free' ),
				'id'       => 'bricks_proportions_size',
				'default'  => '0',
				'options' => array(
					'0'    => __( 'Original size', 'rife-free' ),
					'1/1'  => __( '1:1', 'rife-free' ),
					'2/3'  => __( '2:3', 'rife-free' ),
					'3/2'  => __( '3:2', 'rife-free' ),
					'3/4'  => __( '3:4', 'rife-free' ),
					'4/3'  => __( '4:3', 'rife-free' ),
					'9/16' => __( '9:16', 'rife-free' ),
					'16/9' => __( '16:9', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_lightbox',
				'type'     => 'radio',
				'name'     => __( 'Open bricks to lightbox', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_lightbox_mobile',
				'type'        => 'radio',
				'name'        => __( 'Open bricks to lightbox', 'rife-free' ) . ' - ' . esc_html__( 'on mobiles', 'rife-free' ),
				'description' => __( 'Works on devices less than 600 pixels wide.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'on',
				'required'    => array(
					array( 'theme', '=', 'bricks' ),
					array( 'bricks_lightbox', '=', 'on' )
				),
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'description' => __( 'Leave empty to not set any background', 'rife-free' ),
				'id'          => 'slide_cover_color',
				'default'     => 'rgba(0,0,0, 0.7)',
				'type'        => 'color',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Hover effect', 'rife-free' ),
				'id'       => 'bricks_hover',
				'default'  => 'cross',
				'options'  => array(
					'cross'  => __( 'Show cross', 'rife-free' ),
					'drop'   => __( 'Drop', 'rife-free' ),
					'shift'  => __( 'Shift', 'rife-free' ),
					'pop'    => __( 'Pop', 'rife-free' ),
					'border' => __( 'Border', 'rife-free' ),
					'none'   => __( 'None', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_title_position',
				'type'     => 'select',
				'name'     => __( 'Texts position', 'rife-free' ),
				'options'  => array(
					'top_left'      => __( 'Top left', 'rife-free' ),
					'top_center'    => __( 'Top center', 'rife-free' ),
					'top_right'     => __( 'Top right', 'rife-free' ),
					'mid_left'      => __( 'Middle left', 'rife-free' ),
					'mid_center'    => __( 'Middle center', 'rife-free' ),
					'mid_right'     => __( 'Middle right', 'rife-free' ),
					'bottom_left'   => __( 'Bottom left', 'rife-free' ),
					'bottom_center' => __( 'Bottom center', 'rife-free' ),
					'bottom_right'  => __( 'Bottom right', 'rife-free' ),
				),
				'default'  => 'top_left',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_cover',
				'type'     => 'radio',
				'name'     => __( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_cover_hover',
				'type'     => 'radio',
				'name'     => __( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'off',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_overlay_gradient',
				'type'        => 'radio',
				'name'        => __( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'description' => __( 'The main use of this function is to make the texts more readable.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'on',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_overlay_gradient_hover',
				'type'        => 'radio',
				'name'        => __( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => __( 'The main use of this function is to make the texts more readable.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'off',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_texts',
				'type'     => 'radio',
				'name'     => __( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array(
					array( 'theme', '=', 'bricks' ),
					array( 'enable_desc', '=', 'on' )
				),
			),
			array(
				'id'       => 'bricks_overlay_texts_hover',
				'type'     => 'radio',
				'name'     => __( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array(
					array( 'theme', '=', 'bricks' ),
					array( 'enable_desc', '=', 'on' )
				),
			),
			array(
				'name'        => __( 'Fit images', 'rife-free' ),
				'description' => __( 'How pictures will fit in the area of the slider. <strong>Fit when needed</strong> is best suited for small images that should not be stretched to larger sizes, only to smaller ones (so that they are always completely visible).', 'rife-free' ),
				'id'          => 'fit_variant',
				'default'     => '0',
				'options'     => array(
					'0' => __( 'Fit always', 'rife-free' ),
					'1' => __( 'Fit landscape', 'rife-free' ),
					'2' => __( 'Fit portrait', 'rife-free' ),
					'3' => __( 'Fit when needed', 'rife-free' ),
					'4' => __( 'Cover the whole screen', 'rife-free' ),
				),
				'type'        => 'select',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Autoplay', 'rife-free' ),
				'description'   => __( 'If autoplay is on, slider will run on page load.', 'rife-free' ),
				'id'            => 'autoplay',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'album_slider_autoplay',
				'options'       => array(
					'G'   => __( 'Global settings', 'rife-free' ),
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Type', 'rife-free' ),
				'description'   => __( 'Animation between slides.', 'rife-free' ),
				'id'            => 'transition',
				'default'       => '-1',
				'global_value'  => '-1',
				'parent_option' => 'album_slider_transition_type',
				'options'       => array(
					'-1' => __( 'Global settings', 'rife-free' ),
					'0'  => __( 'None', 'rife-free' ),
					'1'  => __( 'Fade', 'rife-free' ),
					'2'  => __( 'Carousel', 'rife-free' ),
					'3'  => __( 'Zooming', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Zoom in %', 'rife-free' ),
				'description' => __( 'How big the zooming effect will be', 'rife-free' ),
				'id'          => 'ken_scale',
				'default'     => 120,
				'unit'        => '%',
				'min'         => 100,
				'max'         => 200,
				'type'        => 'slider',
				'required'    => array(
					array( 'theme', '=', 'slider' ),
					array( 'transition', '=', '3' ),
				)
			),
			array(
				'name'        => __( 'Gradient above photos', 'rife-free' ),
				'description' => __( 'Good for better readability of slide titles.', 'rife-free' ),
				'id'          => 'gradient',
				'default'     => 'on',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Title', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'description' => __( 'Leave empty to not set any background', 'rife-free' ),
				'id'          => 'slide_title_bg_color',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'enable_desc', '=', 'on' ),
					array( 'theme', '=', 'slider' )
				)
			),
			array(
				'name'     => __( 'Pattern above photos', 'rife-free' ),
				'id'       => 'pattern',
				'default'  => '0',
				'options'  => array(
					'0' => __( 'None', 'rife-free' ),
					'1' => __( 'Type 1', 'rife-free' ),
					'2' => __( 'Type 2', 'rife-free' ),
					'3' => __( 'Type 3', 'rife-free' ),
					'4' => __( 'Type 4', 'rife-free' ),
					'5' => __( 'Type 5', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Thumbnails', 'rife-free' ),
				'id'            => 'thumbs',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'album_slider_thumbs',
				'options'       => array(
					'G'   => __( 'Global settings', 'rife-free' ),
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Thumbnails', 'rife-free' ). ' : ' .esc_html__( 'Open', 'rife-free' ),
				'description' => __( 'If thumbnails are enabled, should they be open by default?', 'rife-free' ),
				'id'          => 'thumbs_on_load',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array( 'theme', '=', 'slider' ),
			),
		),

		/*
		 *
		 * Tab: Header
		 *
		 */
		'header' => array(
			array(
				'name' => __('Header', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-cogs'
			),
			array(
				'name'          => __( 'Hide content under the header', 'rife-free' ),
				'description'   => __( 'Works only with the horizontal header.', 'rife-free' ),
				'id'            => 'content_under_header',
				'global_value'  => 'G',
				'default'       => 'G',
				'parent_option' => 'album_content_under_header',
				'type'          => 'select',
				'options'       => array(
					'G'       => __( 'Global settings', 'rife-free' ),
					'content' => __( 'Yes, hide the content', 'rife-free' ),
					'off'     => __( 'Turn it off', 'rife-free' ),
				),
			),
		),
	);

	return apply_filters( 'apollo13framework_meta_boxes_album', $meta );
}



function apollo13framework_meta_boxes_images_manager() {
	return apply_filters( 'apollo13framework_meta_boxes_images_manager', array('images_manager' => array()) );
}



function apollo13framework_get_socials_array() {
	global $apollo13framework_a13;

	$tmp_arr = array();
	$socials = $apollo13framework_a13->get_social_icons_list();
	foreach ( $socials as $id => $social ) {
		array_push( $tmp_arr, array( 'name' => $social, 'id' => $id, 'type' => 'text' ) );
	}
	return $tmp_arr;
}



function apollo13framework_meta_boxes_people() {
	$meta =
		array(
			/*
			 *
			 * Tab: General
			 *
			 */
			'general' => array(
				array(
					'name' => __('General', 'rife-free'),
					'type' => 'fieldset',
					'tab'   => true,
					'icon'  => 'fa fa-wrench'
				),
				array(
						'name'        => __( 'Subtitle', 'rife-free' ),
						'description' => __( 'You can use HTML here.', 'rife-free' ),
						'id'          => 'subtitle',
						'default'     => '',
						'type'        => 'text'
				),
				array(
						'name'    => __( 'Testimonial', 'rife-free' ),
						'desc'    => '',
						'id'      => 'testimonial',
						'default' => '',
						'type'    => 'textarea'
				),
				array(
						'name'        => __( 'Overlay color', 'rife-free' ),
						'id'          => 'overlay_bg_color',
						'default'     => 'rgba(0,0,0,0.5)',
						'type'        => 'color'
				),
				array(
						'name'        => __( 'Overlay', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
						'id'          => 'overlay_font_color',
						'default'     => 'rgba(255,255,255,1)',
						'type'        => 'color'
				),
			),

			/*
			 *
			 * Tab: Socials
			 *
			 */
			'socials' => array_merge(
				array(
					array(
						'name' => __('Social icons', 'rife-free'),
						'type' => 'fieldset',
						'tab'   => true,
						'icon'  => 'fa fa-facebook-official'
					),
				),
				apollo13framework_get_socials_array()
			),
		);

	return $meta;
}



function apollo13framework_meta_boxes_work() {
	$meta = array(
		/*
		 *
		 * Tab: Works list
		 *
		 */
		'works_list' => array(
			array(
				'name' => __('Works list', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-list'
			),
			array(
				'name'        => __( 'Size of brick', 'rife-free' ),
				'description' => __( 'What should be the width of this work on the Works list?', 'rife-free' ),
				'id'          => 'brick_ratio_x',
				'default'     => 1,
				'unit'        => '',
				'min'         => 1,
				'max'         => 4,
				'type'        => 'slider'
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'id'          => 'cover_color',
				'description' => __( 'Works only when titles are displayed over images in the Works list.', 'rife-free' ),
				'default'     => 'rgba(0,0,0, 0.7)',
				'type'        => 'color'
			),
			array(
				'name'        => __( 'Exclude from the Works list page', 'rife-free' ),
				'description' => __( 'If enabled, then this Work will not be listed on the Works list page, but you can still select it for the front page or in other places.', 'rife-free' ),
				'id'          => 'exclude_in_works_list',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Work media
		 *
		 */
		'works_media' => array(
			array(
				'name' => __('Work media', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-th'
			),
			array(
				'name'        => __( 'Items order', 'rife-free' ),
				'description' => __( 'It will display your images/videos from the first to the last or in a different way.', 'rife-free' ),
				'id'          => 'order',
				'default'     => 'ASC',
				'options'     => array(
					'ASC'    => __( 'First on the list, first displayed', 'rife-free' ),
					'DESC'   => __( 'First on the list, last displayed', 'rife-free' ),
					'random' => __( 'Random', 'rife-free' ),
				),
				'type'        => 'select',
			),
			array(
				'name'        => __( 'Show title and description of work items', 'rife-free' ),
				'description' => __( 'If enabled, then it will affect displaying in bricks and slider option, and also in lightbox.', 'rife-free' ),
				'id'          => 'enable_desc',
				'default'     => 'off',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
			),
			array(
				'name'    => __( 'Show media in', 'rife-free' ),
				'id'      => 'theme',
				'default' => 'bricks',
				'options' => array(
					'bricks' => __( 'Bricks', 'rife-free' ),
					'slider' => __( 'Slider', 'rife-free' ),
					'off' => __( 'Do not display it', 'rife-free' ),
				),
				'type'    => 'radio',
			),
			array(
				'name'        => __( 'Bricks columns', 'rife-free' ),
				'id'          => 'brick_columns',
				'default'     => '3',
				'unit'        => '',
				'min'         => 1,
				'max'         => 6,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'        => __( 'The maximum width of the brick layout', 'rife-free' ),
				'description' => __( 'Depending on the actual width of the screen, the available space for bricks may be smaller, but never greater than this number.', 'rife-free' ),
				'id'          => 'bricks_max_width',
				'default'     => '1920px',
				'unit'        => 'px',
				'min'         => 200,
				'max'         => 2500,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Brick margin', 'rife-free' ),
				'id'       => 'brick_margin',
				'default'  => '0px',
				'unit'     => 'px',
				'min'      => 0,
				'max'      => 100,
				'type'     => 'slider',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Choose the proportions of the bricks', 'rife-free' ),
				'description' => __( 'It works only for images. If you change the theme option, which is called "Display thumbnails instead of video", then for videos that have set a featured image, it will also work.', 'rife-free' ),
				'id'       => 'bricks_proportions_size',
				'default'  => '0',
				'options' => array(
					'0'    => __( 'Original size', 'rife-free' ),
					'1/1'  => __( '1:1', 'rife-free' ),
					'2/3'  => __( '2:3', 'rife-free' ),
					'3/2'  => __( '3:2', 'rife-free' ),
					'3/4'  => __( '3:4', 'rife-free' ),
					'4/3'  => __( '4:3', 'rife-free' ),
					'9/16' => __( '9:16', 'rife-free' ),
					'16/9' => __( '16:9', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_lightbox',
				'type'     => 'radio',
				'name'     => __( 'Open bricks to lightbox', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_lightbox_mobile',
				'type'        => 'radio',
				'name'        => __( 'Open bricks to lightbox', 'rife-free' ) . ' - ' . esc_html__( 'on mobiles', 'rife-free' ),
				'description' => __( 'Works on devices less than 600 pixels wide.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'on',
				'required'    => array(
					array( 'theme', '=', 'bricks' ),
					array( 'bricks_lightbox', '=', 'on' )
				),
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'description' => __( 'Leave empty to not set any background', 'rife-free' ),
				'id'          => 'slide_cover_color',
				'default'     => 'rgba(0,0,0, 0.7)',
				'type'        => 'color',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'name'     => __( 'Hover effect', 'rife-free' ),
				'id'       => 'bricks_hover',
				'default'  => 'cross',
				'options'  => array(
					'cross'  => __( 'Show cross', 'rife-free' ),
					'drop'   => __( 'Drop', 'rife-free' ),
					'shift'  => __( 'Shift', 'rife-free' ),
					'pop'    => __( 'Pop', 'rife-free' ),
					'border' => __( 'Border', 'rife-free' ),
					'none'   => __( 'None', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_title_position',
				'type'     => 'select',
				'name'     => __( 'Texts position', 'rife-free' ),
				'options'  => array(
					'top_left'      => __( 'Top left', 'rife-free' ),
					'top_center'    => __( 'Top center', 'rife-free' ),
					'top_right'     => __( 'Top right', 'rife-free' ),
					'mid_left'      => __( 'Middle left', 'rife-free' ),
					'mid_center'    => __( 'Middle center', 'rife-free' ),
					'mid_right'     => __( 'Middle right', 'rife-free' ),
					'bottom_left'   => __( 'Bottom left', 'rife-free' ),
					'bottom_center' => __( 'Bottom center', 'rife-free' ),
					'bottom_right'  => __( 'Bottom right', 'rife-free' ),
				),
				'default'  => 'bottom_center',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_cover',
				'type'     => 'radio',
				'name'     => __( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'off',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_cover_hover',
				'type'     => 'radio',
				'name'     => __( 'Show overlay', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_overlay_gradient',
				'type'        => 'radio',
				'name'        => __( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'description' => __( 'The main use of this function is to make the texts more readable.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'off',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'          => 'bricks_overlay_gradient_hover',
				'type'        => 'radio',
				'name'        => __( 'Show gradient', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'description' => __( 'The main use of this function is to make the texts more readable.', 'rife-free' ),
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'     => 'off',
				'required'    => array( 'theme', '=', 'bricks' ),
			),
			array(
				'id'       => 'bricks_overlay_texts',
				'type'     => 'radio',
				'name'     => __( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'without hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'off',
				'required' => array(
					array( 'theme', '=', 'bricks' ),
					array( 'enable_desc', '=', 'on' )
				),
			),
			array(
				'id'       => 'bricks_overlay_texts_hover',
				'type'     => 'radio',
				'name'     => __( 'Show texts', 'rife-free' ). ' - ' .esc_html__( 'on hover', 'rife-free' ),
				'options'  => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'default'  => 'on',
				'required' => array(
					array( 'theme', '=', 'bricks' ),
					array( 'enable_desc', '=', 'on' )
				),
			),

			array(
				'name'          => __( 'Stretch the slider to the window height', 'rife-free' ),
				'id'            => 'slider_window_high',
				'default'     => 'off',
				'options'       => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'          => 'radio',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Slider - width proportion', 'rife-free' ),
				'id'          => 'slider_width_proportion',
				'default'     => '16',
				'unit'        => '',
				'min'         => 1,
				'max'         => 20,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Slider - height proportion', 'rife-free' ),
				'id'          => 'slider_height_proportion',
				'default'     => '9',
				'unit'        => '',
				'min'         => 1,
				'max'         => 20,
				'type'        => 'slider',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Fit images', 'rife-free' ),
				'description' => __( 'How pictures will fit in the area of the slider. <strong>Fit when needed</strong> is best suited for small images that should not be stretched to larger sizes, only to smaller ones (so that they are always completely visible).', 'rife-free' ),
				'id'          => 'fit_variant',
				'default'     => '4',
				'options'     => array(
					'0' => __( 'Fit always', 'rife-free' ),
					'1' => __( 'Fit landscape', 'rife-free' ),
					'2' => __( 'Fit portrait', 'rife-free' ),
					'3' => __( 'Fit when needed', 'rife-free' ),
					'4' => __( 'Cover the whole screen', 'rife-free' ),
				),
				'type'        => 'select',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Autoplay', 'rife-free' ),
				'description'   => __( 'If autoplay is on, slider will run on page load.', 'rife-free' ),
				'id'            => 'autoplay',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'work_slider_autoplay',
				'options'       => array(
					'G'   => __( 'Global settings', 'rife-free' ),
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Transition', 'rife-free' ). ' : ' .esc_html__( 'Type', 'rife-free' ),
				'description'   => __( 'Animation between slides.', 'rife-free' ),
				'id'            => 'transition',
				'default'       => '-1',
				'global_value'  => '-1',
				'parent_option' => 'work_slider_transition_type',
				'options'       => array(
					'-1' => __( 'Global settings', 'rife-free' ),
					'0'  => __( 'None', 'rife-free' ),
					'1'  => __( 'Fade', 'rife-free' ),
					'2'  => __( 'Carousel', 'rife-free' ),
					'3'  => __( 'Zooming', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Zoom in %', 'rife-free' ),
				'description' => __( 'How big the zooming effect will be', 'rife-free' ),
				'id'          => 'ken_scale',
				'default'     => 120,
				'unit'        => '%',
				'min'         => 100,
				'max'         => 200,
				'type'        => 'slider',
				'required'    => array(
					array( 'theme', '=', 'slider' ),
					array( 'transition', '=', '3' ),
				)
			),
			array(
				'name'        => __( 'Gradient above photos', 'rife-free' ),
				'description' => __( 'Good for better readability of slide titles.', 'rife-free' ),
				'id'          => 'gradient',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Title', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'description' => __( 'Leave empty to not set any background', 'rife-free' ),
				'id'          => 'slide_title_bg_color',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'enable_desc', '=', 'on' ),
					array( 'theme', '=', 'slider' )
				)
			),
			array(
				'name'     => __( 'Pattern above photos', 'rife-free' ),
				'id'       => 'pattern',
				'default'  => '0',
				'options'  => array(
					'0' => __( 'None', 'rife-free' ),
					'1' => __( 'Type 1', 'rife-free' ),
					'2' => __( 'Type 2', 'rife-free' ),
					'3' => __( 'Type 3', 'rife-free' ),
					'4' => __( 'Type 4', 'rife-free' ),
					'5' => __( 'Type 5', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'          => __( 'Thumbnails', 'rife-free' ),
				'id'            => 'thumbs',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'work_slider_thumbs',
				'options'       => array(
					'G'   => __( 'Global settings', 'rife-free' ),
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'          => 'select',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'        => __( 'Thumbnails', 'rife-free' ). ' : ' .esc_html__( 'Open', 'rife-free' ),
				'description' => __( 'If thumbnails are enabled, should they be open by default?', 'rife-free' ),
				'id'          => 'thumbs_on_load',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'     => __( 'Slider', 'rife-free' ). ' : ' .esc_html__( 'Background color', 'rife-free' ),
				'id'       => 'slider_bg_color',
				'default'  => '',
				'type'     => 'color',
				'required'      => array( 'theme', '=', 'slider' ),
			),
			array(
				'name'     => __( 'Media top margin', 'rife-free' ),
				'id'       => 'media_margin_top',
				'default'  => '0px',
				'unit'     => 'px',
				'min'      => 0,
				'max'      => 100,
				'type'     => 'slider',
				'required' => array( 'theme', '!=', 'off' ),
			),
			array(
				'name'     => __( 'Media bottom margin', 'rife-free' ),
				'id'       => 'media_margin_bottom',
				'default'  => '0px',
				'unit'     => 'px',
				'min'      => 0,
				'max'      => 100,
				'type'     => 'slider',
				'required' => array( 'theme', '!=', 'off' ),
			),
		),

		/*
		 *
		 * Tab: Layout
		 *
		 */
		'layout' => array(
			array(
				'name' => __('Layout', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-wrench'
			),
			array(
				'name'          => __( 'Content Layout', 'rife-free' ),
				'id'            => 'content_layout',
				'default'       => 'global',
				'global_value'  => 'global',
				'parent_option' => 'work_content_layout',
				'type'          => 'select',
				'options'       => array(
					'global'        => __( 'Global settings', 'rife-free' ),
					'center'        => __( 'Center fixed width', 'rife-free' ),
					'left'          => __( 'Left fixed width', 'rife-free' ),
					'left_padding'  => __( 'Left fixed width + padding', 'rife-free' ),
					'right'         => __( 'Right fixed width', 'rife-free' ),
					'right_padding' => __( 'Right fixed width + padding', 'rife-free' ),
					'full_fixed'    => __( 'Full width + fixed content', 'rife-free' ),
					'full_padding'  => __( 'Full width + padding', 'rife-free' ),
					'full'          => __( 'Full width', 'rife-free' ),
				),
			),
			array(
				'name'        => esc_html__( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Top/bottom padding', 'rife-free' ),
				'id'          => 'content_padding',
				'default'     => 'both',
				'type'        => 'select',
				'options'     => array(
					'both'   => __( 'Both on', 'rife-free' ),
					'top'    => __( 'Only top', 'rife-free' ),
					'bottom' => __( 'Only bottom', 'rife-free' ),
					'off'    => __( 'Both off', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Content', 'rife-free' ). ' : ' .esc_html__( 'Left/right padding', 'rife-free' ),
				'id'          => 'content_side_padding',
				'default'     => 'both',
				'type'        => 'radio',
				'options'     => array(
					'both'   => __( 'Both on', 'rife-free' ),
					'off'    => __( 'Both off', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Header
		 *
		 */
		'header' => array(
			array(
				'name' => __('Header', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-cogs'
			),
			array(
				'name'          => __( 'Hide content under the header', 'rife-free' ),
				'description'   => __( 'Works only with the horizontal header.', 'rife-free' ),
				'id'            => 'content_under_header',
				'global_value'  => 'G',
				'default'       => 'G',
				'parent_option' => 'work_content_under_header',
				'type'          => 'select',
				'options'       => array(
					'G'       => __( 'Global settings', 'rife-free' ),
					'content' => __( 'Yes, hide the content', 'rife-free' ),
					'title'   => __( 'Yes, hide the content and add top padding to the outside title bar.', 'rife-free' ),
					'off'     => __( 'Turn it off', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Title bar
		 *
		 */
		'title_bar' => array(
			array(
				'name' => __('Title bar', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-text-width'
			),
			array(
				'name'        => __( 'Title bar', 'rife-free' ),
				'description' => __( 'You can use global settings or override them here', 'rife-free' ),
				'id'          => 'title_bar_settings',
				'default'     => 'global',
				'type'        => 'radio',
				'options'     => array(
					'global' => __( 'Global settings', 'rife-free' ),
					'custom' => __( 'Use custom settings', 'rife-free' ),
					'off'    => __( 'Turn it off', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Position', 'rife-free' ),
				'id'          => 'title_bar_position',
				'default'     => 'outside',
				'type'        => 'hidden',//no switching in options, but we leave it as option so it will be future ready, and to not make exceptions for Works
				'options'     => array(
					'outside' => __( 'Before the content', 'rife-free' ),
					'inside'  => __( 'Inside the content', 'rife-free' ),
				),
				'description' => __( 'To set the background image for the "Before the content" option, use the <strong>featured image</strong>.', 'rife-free' ),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
			array(
				'name'        => __( 'Variant', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_variant',
				'default'     => 'classic',
				'options'     => array(
					'classic'  => __( 'Classic(to side)', 'rife-free' ),
					'centered' => __( 'Centered', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Width', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_width',
				'default'     => 'full',
				'options'     => array(
					'full'  => __( 'Full', 'rife-free' ),
					'boxed' => __( 'Boxed', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => __( 'How to fit the background image', 'rife-free' ),
				'id'       => 'title_bar_image_fit',
				'default'  => 'repeat',
				'options'  => array(
					'cover'    => __( 'Cover', 'rife-free' ),
					'contain'  => __( 'Contain', 'rife-free' ),
					'fitV'     => __( 'Fit Vertically', 'rife-free' ),
					'fitH'     => __( 'Fit Horizontally', 'rife-free' ),
					'center'   => __( 'Just center', 'rife-free' ),
					'repeat'   => __( 'Repeat', 'rife-free' ),
					'repeat-x' => __( 'Repeat X', 'rife-free' ),
					'repeat-y' => __( 'Repeat Y', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_parallax',
				'default'     => 'off',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'type'        => 'radio',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Type', 'rife-free' ),
				'description' => __( 'It defines how the image will scroll in the background while the page is scrolled down.', 'rife-free' ),
				'id'          => 'title_bar_parallax_type',
				'default'     => 'tb',
				'options'     => array(
					"tb"   => __( 'top to bottom', 'rife-free' ),
					"bt"   => __( 'bottom to top', 'rife-free' ),
					"lr"   => __( 'left to right', 'rife-free' ),
					"rl"   => __( 'right to left', 'rife-free' ),
					"tlbr" => __( 'top-left to bottom-right', 'rife-free' ),
					"trbl" => __( 'top-right to bottom-left', 'rife-free' ),
					"bltr" => __( 'bottom-left to top-right', 'rife-free' ),
					"brtl" => __( 'bottom-right to top-left', 'rife-free' ),
				),
				'type'        => 'select',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Parallax', 'rife-free' ). ' : ' . __( 'Speed', 'rife-free' ),
				'description' => __( 'It will be only used for the background that is repeated. If the background is set to not repeat this value will be ignored.', 'rife-free' ),
				'id'          => 'title_bar_parallax_speed',
				'default'     => '1.00',
				'type'        => 'text',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
					array( 'title_bar_parallax', '=', 'on' ),
				)
			),
			array(
				'name'        => __( 'Overlay color', 'rife-free' ),
				'description' => __( 'Will be placed above the image(if used)', 'rife-free' ),
				'id'          => 'title_bar_bg_color',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'     => esc_html__( 'Titles', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'id'       => 'title_bar_title_color',
				'default'  => '',
				'type'     => 'color',
				'required' => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => esc_html__( 'Other elements', 'rife-free' ). ' : ' .esc_html__( 'Text color', 'rife-free' ),
				'description' => __( 'Used in breadcrumbs.', 'rife-free' ),
				'id'          => 'title_bar_color_1',
				'default'     => '',
				'type'        => 'color',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Top/bottom padding', 'rife-free' ),
				'description' => '',
				'id'          => 'title_bar_space_width',
				'default'     => '40px',
				'unit'        => 'px',
				'min'         => 0,
				'max'         => 600,
				'type'        => 'slider',
				'required'    => array(
					array( 'title_bar_settings', '=', 'custom' ),
					array( 'title_bar_position', '!=', 'inside' ),
				)
			),
			array(
				'name'        => __( 'Breadcrumbs', 'rife-free' ),
				'description' => '',
				'id'          => 'breadcrumbs',
				'default'     => 'on',
				'type'        => 'radio',
				'options'     => array(
					'on'  => __( 'Enable', 'rife-free' ),
					'off' => __( 'Disable', 'rife-free' ),
				),
				'required'    => array( 'title_bar_settings', '=', 'custom' ),
			),
		),

		/*
		 *
		 * Tab: Content
		 *
		 */
		'content' => array(
			array(
				'name' => __('Content', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-align-left'
			),
			array(
				'name'          => __( 'Categories in content', 'rife-free' ),
				'id'            => 'content_categories',
				'default'       => 'G',
				'global_value'  => 'G',
				'parent_option' => 'work_content_categories',
				'type'          => 'radio',
				'options'       => array(
					'G'   => __( 'Global settings', 'rife-free' ),
					'on'  => __( 'On', 'rife-free' ),
					'off' => __( 'Off', 'rife-free' ),
				),
			),
		),

		/*
		 *
		 * Tab: Page background
		 *
		 */
		'background' => array(
			array(
				'name' => __('Page background', 'rife-free'),
				'type' => 'fieldset',
				'tab'   => true,
				'icon'  => 'fa fa-picture-o'
			),
			array(
				'name'        => __( 'Page background', 'rife-free' ),
				'id'          => 'page_bg_settings',
				'default'     => 'global',
				'type'        => 'radio',
				'options'     => array(
					'global' => __( 'Global settings', 'rife-free' ),
					'custom' => __( 'Use custom settings', 'rife-free' ),
				),
			),
			array(
				'name'        => __( 'Background image', 'rife-free' ),
				'id'          => 'page_image',
				'default'     => '',
				'button_text' => __( 'Upload Image', 'rife-free' ),
				'type'        => 'upload',
				'required'    => array( 'page_bg_settings', '=', 'custom' ),
			),
			array(
				'name'     => __( 'How to fit the background image', 'rife-free' ),
				'id'       => 'page_image_fit',
				'default'  => 'cover',
				'options'  => array(
					'cover'    => __( 'Cover', 'rife-free' ),
					'contain'  => __( 'Contain', 'rife-free' ),
					'fitV'     => __( 'Fit Vertically', 'rife-free' ),
					'fitH'     => __( 'Fit Horizontally', 'rife-free' ),
					'center'   => __( 'Just center', 'rife-free' ),
					'repeat'   => __( 'Repeat', 'rife-free' ),
					'repeat-x' => __( 'Repeat X', 'rife-free' ),
					'repeat-y' => __( 'Repeat Y', 'rife-free' ),
				),
				'type'     => 'select',
				'required' => array( 'page_bg_settings', '=', 'custom' ),
			),
			array(
				'name'     => __( 'Background color', 'rife-free' ),
				'id'       => 'page_bg_color',
				'default'  => '',
				'type'     => 'color',
				'required' => array( 'page_bg_settings', '=', 'custom' ),
			),
		)
	);

	return apply_filters( 'apollo13framework_meta_boxes_work', $meta );
}

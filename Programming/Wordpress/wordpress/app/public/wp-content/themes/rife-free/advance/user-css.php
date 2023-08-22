<?php
/* get CSS of all theme settings
 */
function apollo13framework_get_user_css($with_custom_css = true) {
	global $apollo13framework_a13;

	$box_shadow_on_rule = 'box-shadow: 0 0 12px rgba(0, 0, 0, 0.09);';

	/*
	 * body part
	 */
	$theme_borders_color   = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'theme_borders_color' ) );
	$boxed_layout_bg_color = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'boxed_layout_bg_color' ) );
	$headings_color        = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'headings_color' ) );
	$headings_color_hover  = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'headings_color_hover' ) );
	$headings_weight       = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'headings_weight' ) );
	$headings_transform    = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'headings_transform' ) );
	$cursor_css            = 'cursor: auto';
	$custom_cursor         = $apollo13framework_a13->get_option( 'custom_cursor' );
	if ( $custom_cursor === 'custom' ) {
		$cursor_css = apollo13framework_make_css_rule( 'cursor', $apollo13framework_a13->get_option_media_url( 'cursor_image' ), 'url("%s"), auto' );
	} elseif ( $custom_cursor === 'select' ) {
		$cursor     = $apollo13framework_a13->get_option( 'cursor_select' );
		$cursor_css = apollo13framework_make_css_rule( 'cursor', get_theme_file_uri( 'images/cursors/' . $cursor ), 'url("%s"), auto' );
	}

//global sidebars
	$basket_sidebar_bg_color  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'basket_sidebar_bg_color' ) );
	$basket_sidebar_font_size = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'basket_sidebar_font_size' ), '%spx' );
	$hidden_sidebar_bg_color  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'hidden_sidebar_bg_color' ) );
	$hidden_sidebar_font_size = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'hidden_sidebar_font_size' ), '%spx' );


	/*
	 *  logo
	 */
	$logo_container_min_width_desktop = $logo_container_max_width_desktop = '';
	$logo_container_min_width_mobile  = $logo_container_max_width_mobile = '';
	$logo_max_width_half_desktop      = $logo_max_width_half_mobile = '100px';
	$_logo_image                      = $apollo13framework_a13->get_option( 'logo_image' );
	$logo_url                         = $apollo13framework_a13->get_option_media_url( 'logo_image' );

	//try to use WordPress custom logo feature if there is no theme logo
	if( strlen( $logo_url ) === 0 && has_custom_logo() ){
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$logo_url = $custom_logo[0];
		//simulate theme logo
		$_logo_image = array();
		$_logo_image['width'] = $custom_logo[1];
	}

	$logo_image        = apollo13framework_make_css_rule( 'background-image', $logo_url, 'url(%s)', 'no_none' );
	$logo_image_2x     = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'logo_image_high_dpi' ), 'url(%s)', 'no_none' );
	$logo_image_height = (string) $apollo13framework_a13->get_option( 'logo_image_height' );
	$logo_image_height = $logo_image_height === '0' ? '' : apollo13framework_make_css_rule( 'height', $logo_image_height, '%spx' );

	$logo_type                        = $apollo13framework_a13->get_option( 'logo_type' );
	$max_allowed_logo_desktop_width   = $apollo13framework_a13->get_option( 'logo_image_max_desktop_width' );
	$max_allowed_logo_desktop_width   = strlen( $max_allowed_logo_desktop_width ) ? $max_allowed_logo_desktop_width : 200;
	$max_allowed_logo_mobile_width    = $apollo13framework_a13->get_option( 'logo_image_max_mobile_width' );
	$max_allowed_logo_mobile_width    = strlen( $max_allowed_logo_mobile_width ) ? $max_allowed_logo_mobile_width : 200;
	$logo_shield_padding              = (int) $apollo13framework_a13->get_option_color_rgba( 'logo_shield_padding' );

	$svg_logo    = $apollo13framework_a13->get_option( 'logo_svg', 'off' ) === 'on';
	$shield_logo = $apollo13framework_a13->get_option( 'logo_with_shield', 'off' ) === 'on';
	$mobile_logo_shield_space = '';
//	$bonus_space
	$bonus_centered_logo_space = 20;  //20px on each side of centered logo to breath from menu
	if ( $shield_logo ) {
		$bonus_centered_logo_space += $logo_shield_padding;
	}
	//image logo type and image is set
	if ( $logo_type === 'image' && is_array( $_logo_image ) ){
		//we set dimensions only based on theme settings
		if( $svg_logo ){
			//desktop
			$logo_container_min_width_desktop = apollo13framework_make_css_rule( 'min-width', $max_allowed_logo_desktop_width, '%spx' );
			$logo_container_max_width_desktop = apollo13framework_make_css_rule( 'max-width', $max_allowed_logo_desktop_width, '%spx' );
			$logo_max_width_half_desktop = (float) ( $max_allowed_logo_desktop_width / 2 ) + $bonus_centered_logo_space . 'px';

			//mobile
			$logo_container_min_width_mobile = apollo13framework_make_css_rule( 'min-width', $max_allowed_logo_mobile_width, '%spx' );
			$logo_container_max_width_mobile = apollo13framework_make_css_rule( 'max-width', $max_allowed_logo_mobile_width, '%spx' );
			$logo_max_width_half_mobile      = (float) ( $max_allowed_logo_mobile_width / 2 ) . 'px';
		}
		//classic image with width defined
		elseif( isset( $_logo_image['width'] ) ){
			//desktop
			$temp_width                       = $_logo_image['width'] > $max_allowed_logo_desktop_width ? $max_allowed_logo_desktop_width : $_logo_image['width'];
			$logo_container_min_width_desktop = apollo13framework_make_css_rule( 'min-width', $temp_width, '%spx' );
			$logo_container_max_width_desktop = apollo13framework_make_css_rule( 'max-width', $temp_width, '%spx' );
			$logo_max_width_half_desktop = (float) ( $temp_width / 2 ) + $bonus_centered_logo_space . 'px';

			//mobile
			$temp_width                      = $_logo_image['width'] > $max_allowed_logo_mobile_width ? $max_allowed_logo_mobile_width : $_logo_image['width'];
			$logo_container_min_width_mobile = apollo13framework_make_css_rule( 'min-width', $temp_width, '%spx' );
			$logo_container_max_width_mobile = apollo13framework_make_css_rule( 'max-width', $temp_width, '%spx' );
			$logo_max_width_half_mobile      = (float) ( $temp_width / 2 ) . 'px';
		}

		if ( $shield_logo ) {
			$mobile_logo_shield_space = apollo13framework_make_css_rule( 'min-width', ((int) $max_allowed_logo_mobile_width + 2*$logo_shield_padding), '%spx' );
		}
	}


	$logo_shield_bg_color     = apollo13framework_make_css_rule( 'fill', $apollo13framework_a13->get_option_color_rgba( 'logo_shield_bg_color' ) );
	$logo_shield_padding      = $logo_shield_padding . 'px';
	$logo_shield_hide         = '-' . $apollo13framework_a13->get_option( 'logo_shield_hide' ) . '%';
	$logo_shield_hide_mobile  = '-' . $apollo13framework_a13->get_option( 'logo_shield_hide_mobile' ) . '%';
	$logo_image_opacity       = apollo13framework_make_css_rule( 'opacity', $apollo13framework_a13->get_option( 'logo_image_normal_opacity' ) );
	$logo_image_opacity_hover = apollo13framework_make_css_rule( 'opacity', $apollo13framework_a13->get_option( 'logo_image_hover_opacity' ) );
	$logo_color               = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'logo_color' ) );
	$logo_color_hover         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'logo_color_hover' ) );
	$logo_font_size           = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'logo_font_size' ), '%spx' );
	$logo_weight              = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'logo_weight' ) );
	$logo_padding             = $apollo13framework_a13->get_option( 'logo_padding' );
	$logo_padding_top         = $logo_padding['padding-top'];
	$logo_padding_bottom      = $logo_padding['padding-bottom'];

	$logo_padding_mobile        = $apollo13framework_a13->get_option( 'logo_padding_mobile' );
	$logo_padding_top_mobile    = $logo_padding_mobile['padding-top'];
	$logo_padding_bottom_mobile = $logo_padding_mobile['padding-bottom'];


	/*
	 *  header part
	 */
	$header_bg_color              = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_bg_color' ) );
	$header_bg_hover_color        = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_bg_hover_color' ) );
	$header_mobile_menu_bg_color  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_mobile_menu_bg_color' ) );
	$header_bg_image              = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_bg_image' ), 'url(%s)' );
	$header_image_fit             = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'header_bg_image_fit' ) );
	$header_shadow                = $apollo13framework_a13->get_option( 'header_shadow' ) === 'off' ? 'box-shadow: none;' : $box_shadow_on_rule;
	$header_separators_color      = $apollo13framework_a13->get_option_color_rgba( 'header_separators_color' );
	$header_menu_part_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_menu_part_bg_color' ) );
	$header_content_padding       = $apollo13framework_a13->get_option( 'header_content_padding', '40' );
	$header_content_padding_left  = $header_content_padding == '40'? '' : 'padding-left:' . $header_content_padding . 'px;';
	$header_content_padding_right = $header_content_padding == '40'? '' : 'padding-right:' . $header_content_padding . 'px;';

//border
	$header_border       = $apollo13framework_a13->get_option( 'header_border' ) === 'on';
	$header_border_style = $header_border ? '' : 'border-bottom: none;';

	$header_tools_color         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_tools_color' ) );
	$header_tools_color_hover   = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_tools_color_hover' ) );
	$header_tools_bgcolor       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_tools_color' ) );
	$header_tools_bgcolor_hover = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_tools_color_hover' ) );

	$header_tools_mobile_menu_icon_size    = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_tools_mobile_menu_icon_size' ), '%spx' );
	$header_tools_basket_sidebar_icon_size = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_tools_basket_sidebar_icon_size' ), '%spx' );
	$header_tools_header_search_icon_size  = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_tools_header_search_icon_size' ), '%spx' );
	$header_tools_hidden_sidebar_icon_size = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_tools_hidden_sidebar_icon_size' ), '%spx' );
	$header_tools_menu_overlay_icon_size   = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_tools_menu_overlay_icon_size' ), '%spx' );

	$header_menu_overlay_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_menu_overlay_bg_color' ) );
	$header_menu_overlay_color       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_menu_overlay_color' ) );
	$header_menu_overlay_bgcolor     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_menu_overlay_color' ) );
	$header_menu_overlay_color_hover = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_menu_overlay_color_hover' ) );
	$header_menu_overlay_weight      = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'header_menu_overlay_weight' ) );
	$header_menu_overlay_transform   = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'header_menu_overlay_transform' ) );
	$header_menu_overlay_font_size   = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'header_menu_overlay_font_size' ), '%spx' );

	$menu_weight             = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'menu_weight' ) );
	$menu_transform          = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'menu_transform' ) );
	$menu_font_size          = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'menu_font_size' ), '%spx' );
	$menu_line_height        = apollo13framework_make_css_rule( 'line-height', $apollo13framework_a13->get_option( 'menu_line_height' ), '%spx' );
	$menu_hidden_icon_height = apollo13framework_make_css_rule( 'height', $apollo13framework_a13->get_option( 'menu_line_height' ), '%spx' );
	$menu_color              = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'menu_color' ) );
	$menu_hover_color        = $apollo13framework_a13->get_option_color_rgba( 'menu_hover_color' );
	$menu_hover_bg_color     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'menu_hover_bg_color' ) );
	$submenu_bg_color        = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'submenu_bg_color' ) );
	$submenu_separator_color = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'submenu_separator_color' ) );
	$submenu_weight          = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'submenu_weight' ) );
	$submenu_transform       = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'submenu_transform' ) );
	$submenu_font_size       = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'submenu_font_size' ), '%spx' );
	$submenu_color           = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'submenu_color' ) );
	$submenu_color_hover     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'submenu_color_hover' ) );

	//special menu settings for one-line ogo centered
	$_menu_width  = $apollo13framework_a13->get_option( 'header_main_menu_width', 70 );
	$_sides_width = ( 100 - $_menu_width ) / 2;
	$menu_width   = apollo13framework_make_css_rule( 'width', $_menu_width, '%s%%' );
	$sides_width  = apollo13framework_make_css_rule( 'width', $_sides_width, '%s%%' );

	/*
	 *  top-bar part
	 */
	$tb_bg_color         = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'top_bar_bg_color' ) );
	$tb_text_color       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'top_bar_text_color' ) );
	$tb_link_color       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'top_bar_link_color' ) );
	$tb_link_color_hover = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'top_bar_link_color_hover' ) );
	$tb_text_transform   = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'top_bar_text_transform' ) );
//border
	$tb_border       = $apollo13framework_a13->get_option( 'top_bar_border' ) === 'on';
	$tb_border_style = $tb_border ? '' : 'border-bottom: none;';
//message
	$tb_text_msg_part_text_align  = apollo13framework_make_css_rule( 'text-align', $apollo13framework_a13->get_option( 'top_bar_msg_part_text_align' ) );


	/*
	 *  sticky header
	 */
	$header_sticky_bg_color                  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_bg_color' ) );
	$header_sticky_mobile_menu_bg_color      = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_mobile_menu_bg_color' ) );
	$header_sticky_separators_color          = $apollo13framework_a13->get_option_color_rgba( 'header_sticky_separators_color' );
	$header_sticky_menu_part_bg_color        = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_menu_part_bg_color' ) );
	$header_sticky_shadow                    = $apollo13framework_a13->get_option( 'header_sticky_shadow' ) === 'off' ? 'box-shadow: none;' : $box_shadow_on_rule;
	$header_sticky_tools_color               = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_tools_color' ) );
	$header_sticky_tools_color_hover         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_tools_color_hover' ) );
	$header_sticky_tools_bgcolor             = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_tools_color' ) );
	$header_sticky_tools_bgcolor_hover       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_tools_color_hover' ) );
	$header_sticky_button_bg_color           = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_button_bg_color' ) );
	$header_sticky_button_bg_color_hover     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_button_bg_color_hover' ) );
	$header_sticky_button_border_color       = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_button_border_color' ) );
	$header_sticky_button_border_color_hover = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_button_border_color_hover' ) );
	$header_sticky_tb_bg_color               = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_top_bar_bg_color' ) );
	$header_sticky_tb_text_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_top_bar_text_color' ) );
	$header_sticky_tb_link_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_top_bar_link_color' ) );
	$header_sticky_tb_link_color_hover       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_top_bar_link_color_hover' ) );
	$header_sticky_menu_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_menu_color' ) );
	$header_sticky_menu_hover_color_value    = $apollo13framework_a13->get_option_color_rgba( 'header_sticky_menu_hover_color' );
	$header_sticky_menu_hover_color          = apollo13framework_make_css_rule( 'color', $header_sticky_menu_hover_color_value );
	$header_sticky_menu_hover_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_menu_hover_bg_color' ) );
	$header_sticky_logo_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_logo_color' ) );
	$header_sticky_logo_color_hover          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_sticky_logo_color_hover' ) );
	$header_sticky_logo_image                = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_sticky_logo_image' ), 'url(%s)', 'no_none' );
	$header_sticky_logo_image_2x             = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_sticky_logo_image_high_dpi' ), 'url(%s)', 'no_none' );
	$header_sticky_logo_padding              = $apollo13framework_a13->get_option( 'header_sticky_logo_padding' );
	$header_sticky_logo_padding_top          = $header_sticky_logo_padding['padding-top'];
	$header_sticky_logo_padding_bottom       = $header_sticky_logo_padding['padding-bottom'];
	$header_sticky_logo_padding_mobile        = $apollo13framework_a13->get_option( 'header_sticky_logo_padding_mobile' );
	$header_sticky_logo_padding_top_mobile    = $header_sticky_logo_padding_mobile['padding-top'];
	$header_sticky_logo_padding_bottom_mobile = $header_sticky_logo_padding_mobile['padding-bottom'];
	$header_sticky_logo_container_min_width_desktop = $header_sticky_logo_container_max_width_desktop = '';
	$header_sticky_logo_container_min_width_mobile  = $header_sticky_logo_container_max_width_mobile = '';
	$header_sticky_logo_max_width_half_desktop      = $header_sticky_logo_max_width_half_mobile = '100px';
	$header_sticky_max_allowed_logo_desktop_width   = $apollo13framework_a13->get_option( 'header_sticky_logo_image_max_desktop_width' );
	$header_sticky_max_allowed_logo_desktop_width   = strlen( $header_sticky_max_allowed_logo_desktop_width ) ? $header_sticky_max_allowed_logo_desktop_width : 200;
	$header_sticky_max_allowed_logo_mobile_width    = $apollo13framework_a13->get_option( 'header_sticky_logo_image_max_mobile_width' );
	$header_sticky_max_allowed_logo_mobile_width    = strlen( $header_sticky_max_allowed_logo_mobile_width ) ? $header_sticky_max_allowed_logo_mobile_width : 200;

	//image logo type and image is set
	if ( $logo_type === 'image' && is_array( $_logo_image ) ){
		//we set dimensions only based on theme settings
		if( $svg_logo ){
			//desktop
			$header_sticky_logo_container_min_width_desktop = apollo13framework_make_css_rule( 'min-width', $header_sticky_max_allowed_logo_desktop_width, '%spx' );
			$header_sticky_logo_container_max_width_desktop = apollo13framework_make_css_rule( 'max-width', $header_sticky_max_allowed_logo_desktop_width, '%spx' );
			$header_sticky_logo_max_width_half_desktop = (float) ( $header_sticky_max_allowed_logo_desktop_width / 2 ) + $bonus_centered_logo_space . 'px';

			//mobile
			$header_sticky_logo_container_min_width_mobile = apollo13framework_make_css_rule( 'min-width', $header_sticky_max_allowed_logo_mobile_width, '%spx' );
			$header_sticky_logo_container_max_width_mobile = apollo13framework_make_css_rule( 'max-width', $header_sticky_max_allowed_logo_mobile_width, '%spx' );
			$header_sticky_logo_max_width_half_mobile      = (float) ( $header_sticky_max_allowed_logo_mobile_width / 2 ) . 'px';
		}
		//classic image with width defined
		elseif( isset( $_logo_image['width'] ) ){
			//desktop
			$temp_width                       = $_logo_image['width'] > $header_sticky_max_allowed_logo_desktop_width ? $header_sticky_max_allowed_logo_desktop_width : $_logo_image['width'];
			$header_sticky_logo_container_min_width_desktop = apollo13framework_make_css_rule( 'min-width', $temp_width, '%spx' );
			$header_sticky_logo_container_max_width_desktop = apollo13framework_make_css_rule( 'max-width', $temp_width, '%spx' );
			$header_sticky_logo_max_width_half_desktop = (float) ( $temp_width / 2 ) + $bonus_centered_logo_space . 'px';

			//mobile
			$temp_width                      = $_logo_image['width'] > $header_sticky_max_allowed_logo_mobile_width ? $header_sticky_max_allowed_logo_mobile_width : $_logo_image['width'];
			$header_sticky_logo_container_min_width_mobile = apollo13framework_make_css_rule( 'min-width', $temp_width, '%spx' );
			$header_sticky_logo_container_max_width_mobile = apollo13framework_make_css_rule( 'max-width', $temp_width, '%spx' );
			$header_sticky_logo_max_width_half_mobile      = (float) ( $temp_width / 2 ) . 'px';
		}
	}


	/*
	 *  header light variant
	 */
	$header_light_bg_color                  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_bg_color' ) );
	$header_light_mobile_menu_bg_color      = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_mobile_menu_bg_color' ) );
	$header_light_separators_color          = $apollo13framework_a13->get_option_color_rgba( 'header_light_separators_color' );
	$header_light_menu_part_bg_color        = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_menu_part_bg_color' ) );
	$header_light_shadow                    = $apollo13framework_a13->get_option( 'header_light_shadow' ) === 'off' ? 'box-shadow: none;' : $box_shadow_on_rule;
	$header_light_tools_color               = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_tools_color' ) );
	$header_light_tools_color_hover         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_tools_color_hover' ) );
	$header_light_tools_bgcolor             = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_tools_color' ) );
	$header_light_tools_bgcolor_hover       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_tools_color_hover' ) );
	$header_light_button_bg_color           = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_button_bg_color' ) );
	$header_light_button_bg_color_hover     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_button_bg_color_hover' ) );
	$header_light_button_border_color       = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_button_border_color' ) );
	$header_light_button_border_color_hover = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_button_border_color_hover' ) );
	$header_light_tb_bg_color               = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_top_bar_bg_color' ) );
	$header_light_tb_text_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_top_bar_text_color' ) );
	$header_light_tb_link_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_top_bar_link_color' ) );
	$header_light_tb_link_color_hover       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_top_bar_link_color_hover' ) );
	$header_light_menu_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_menu_color' ) );
	$header_light_menu_hover_color_value    = $apollo13framework_a13->get_option_color_rgba( 'header_light_menu_hover_color' );
	$header_light_menu_hover_color          = apollo13framework_make_css_rule( 'color', $header_light_menu_hover_color_value );
	$header_light_menu_hover_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_light_menu_hover_bg_color' ) );
	$header_light_logo_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_logo_color' ) );
	$header_light_logo_color_hover          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_light_logo_color_hover' ) );
	$header_light_logo_image                = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_light_logo_image' ), 'url(%s)', 'no_none' );
	$header_light_logo_image_2x             = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_light_logo_image_high_dpi' ), 'url(%s)', 'no_none' );


	/*
	 *  header dark variant
	 */
	$header_dark_bg_color                  = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_bg_color' ) );
	$header_dark_mobile_menu_bg_color      = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_mobile_menu_bg_color' ) );
	$header_dark_separators_color          = $apollo13framework_a13->get_option_color_rgba( 'header_dark_separators_color' );
	$header_dark_menu_part_bg_color        = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_menu_part_bg_color' ) );
	$header_dark_shadow                    = $apollo13framework_a13->get_option( 'header_dark_shadow' ) === 'off' ? 'box-shadow: none;' : $box_shadow_on_rule;
	$header_dark_tools_color               = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_tools_color' ) );
	$header_dark_tools_color_hover         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_tools_color_hover' ) );
	$header_dark_tools_bgcolor             = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_tools_color' ) );
	$header_dark_tools_bgcolor_hover       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_tools_color_hover' ) );
	$header_dark_button_bg_color           = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_button_bg_color' ) );
	$header_dark_button_bg_color_hover     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_button_bg_color_hover' ) );
	$header_dark_button_border_color       = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_button_border_color' ) );
	$header_dark_button_border_color_hover = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_button_border_color_hover' ) );
	$header_dark_tb_bg_color               = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_top_bar_bg_color' ) );
	$header_dark_tb_text_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_top_bar_text_color' ) );
	$header_dark_tb_link_color             = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_top_bar_link_color' ) );
	$header_dark_tb_link_color_hover       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_top_bar_link_color_hover' ) );
	$header_dark_menu_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_menu_color' ) );
	$header_dark_menu_hover_color_value    = $apollo13framework_a13->get_option_color_rgba( 'header_dark_menu_hover_color' );
	$header_dark_menu_hover_color          = apollo13framework_make_css_rule( 'color', $header_dark_menu_hover_color_value );
	$header_dark_menu_hover_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_menu_hover_bg_color' ) );
	$header_dark_logo_color                = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_logo_color' ) );
	$header_dark_logo_color_hover          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'header_dark_logo_color_hover' ) );
	$header_dark_logo_image                = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_dark_logo_image' ), 'url(%s)', 'no_none' );
	$header_dark_logo_image_2x             = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'header_dark_logo_image_high_dpi' ), 'url(%s)', 'no_none' );


	/*
	 *  to top button
	 */
	$to_top_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'to_top_bg_color' ) );
	$to_top_hover_bg_color = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'to_top_bg_hover_color' ) );
	$to_top_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'to_top_color' ) );
	$to_top_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'to_top_hover_color' ) );
	$to_top_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'to_top_font_size' ), '%spx' );


	/*
	 *  buttons
	 */
	$button_submit_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_submit_bg_color' ) );
	$button_submit_hover_bg_color = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_submit_bg_hover_color' ) );
	$button_submit_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_submit_color' ) );
	$button_submit_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_submit_hover_color' ) );
	$button_submit_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'button_submit_font_size' ), '%spx' );
	$button_submit_radius         = $apollo13framework_a13->get_option( 'button_submit_radius' ) . 'px';
	$button_submit_weight         = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'button_submit_weight' ) );
	$button_submit_transform      = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'button_submit_transform' ) );
	$button_submit_padding        = $apollo13framework_a13->get_option( 'button_submit_padding' );
	$button_submit_padding_left   = isset( $button_submit_padding['padding-left'] ) ? $button_submit_padding['padding-left'] : '0px';
	$button_submit_padding_right  = isset( $button_submit_padding['padding-right'] ) ? $button_submit_padding['padding-right'] : '0px';



	/*
	 *  posts list(blog)
	 */
//title bar
	$blog_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'blog_title_bar_image' ), 'url(%s)' );
	$blog_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'blog_title_bar_image_fit' ) );
	$blog_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'blog_title_bar_bg_color' ) );
	$blog_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'blog_title_bar_title_color' ) );
	$blog_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'blog_title_bar_color_1' ) );
	$blog_title_bar_space_width = $apollo13framework_a13->get_option( 'blog_title_bar_space_width' ) . 'px';

//filter
	$blog_filter_padding        = $apollo13framework_a13->get_option( 'blog_filter_padding' );
	$blog_filter_padding_top    = isset( $blog_filter_padding['padding-top'] ) ? $blog_filter_padding['padding-top'] : '0px';
	$blog_filter_padding_bottom = isset( $blog_filter_padding['padding-bottom'] ) ? $blog_filter_padding['padding-bottom'] : '0px';
	$blog_filter_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'blog_filter_bg_color' ) );
	$blog_filter_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'blog_filter_color' ) );
	$blog_filter_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'blog_filter_hover_color' ) );
	$blog_filter_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'blog_filter_font_size' ), '%spx' );
	$blog_filter_weight         = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'blog_filter_weight' ) );
	$blog_filter_transform      = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'blog_filter_transform' ) );
	$blog_filter_text_align     = apollo13framework_make_css_rule( 'text-align', $apollo13framework_a13->get_option( 'blog_filter_text_align' ) );


	$post_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'post_title_bar_image' ), 'url(%s)' );
	$post_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'post_title_bar_image_fit' ) );
	$post_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'post_title_bar_bg_color' ) );
	$post_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'post_title_bar_title_color' ) );
	$post_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'post_title_bar_color_1' ) );
	$post_title_bar_space_width = $apollo13framework_a13->get_option( 'post_title_bar_space_width' ) . 'px';



	/*
	 *  Albums list
	 */
//title bar
	$albums_list_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'albums_list_title_bar_image' ), 'url(%s)' );
	$albums_list_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'albums_list_title_bar_image_fit' ) );
	$albums_list_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_title_bar_bg_color' ) );
	$albums_list_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_title_bar_title_color' ) );
	$albums_list_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_title_bar_color_1' ) );
	$albums_list_title_bar_space_width = $apollo13framework_a13->get_option( 'albums_list_title_bar_space_width' ) . 'px';

//filter for albums list
	$albums_list_filter_padding        = $apollo13framework_a13->get_option( 'albums_list_filter_padding' );
	$albums_list_filter_padding_top    = isset( $albums_list_filter_padding['padding-top'] ) ? $albums_list_filter_padding['padding-top'] : '0px';
	$albums_list_filter_padding_bottom = isset( $albums_list_filter_padding['padding-bottom'] ) ? $albums_list_filter_padding['padding-bottom'] : '0px';
	$albums_list_filter_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_filter_bg_color' ) );
	$albums_list_filter_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_filter_color' ) );
	$albums_list_filter_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'albums_list_filter_hover_color' ) );
	$albums_list_filter_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'albums_list_filter_font_size' ), '%spx' );
	$albums_list_filter_weight         = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'albums_list_filter_weight' ) );
	$albums_list_filter_transform      = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'albums_list_filter_transform' ) );
	$albums_list_filter_text_align     = apollo13framework_make_css_rule( 'text-align', $apollo13framework_a13->get_option( 'albums_list_filter_text_align' ) );

//filter for album bricks
	$album_bricks_filter_padding        = $apollo13framework_a13->get_option( 'album_bricks_filter_padding' );
	$album_bricks_filter_padding_top    = isset( $album_bricks_filter_padding['padding-top'] ) ? $album_bricks_filter_padding['padding-top'] : '0px';
	$album_bricks_filter_padding_bottom = isset( $album_bricks_filter_padding['padding-bottom'] ) ? $album_bricks_filter_padding['padding-bottom'] : '0px';
	$album_bricks_filter_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'album_bricks_filter_bg_color' ) );
	$album_bricks_filter_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'album_bricks_filter_color' ) );
	$album_bricks_filter_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'album_bricks_filter_hover_color' ) );
	$album_bricks_filter_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'album_bricks_filter_font_size' ), '%spx' );
	$album_bricks_filter_weight         = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'album_bricks_filter_weight' ) );
	$album_bricks_filter_transform      = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'album_bricks_filter_transform' ) );
	$album_bricks_filter_text_align     = apollo13framework_make_css_rule( 'text-align', $apollo13framework_a13->get_option( 'album_bricks_filter_text_align' ) );



	/*
	 *  Albums layout
	 */
	$album_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'album_title_bar_image' ), 'url(%s)' );
	$album_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'album_title_bar_image_fit' ) );
	$album_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'album_title_bar_bg_color' ) );
	$album_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'album_title_bar_title_color' ) );
	$album_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'album_title_bar_color_1' ) );
	$album_title_bar_space_width = $apollo13framework_a13->get_option( 'album_title_bar_space_width' ) . 'px';


	/*
	 *  Works list
	 */
//title bar
	$works_list_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'works_list_title_bar_image' ), 'url(%s)' );
	$works_list_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'works_list_title_bar_image_fit' ) );
	$works_list_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'works_list_title_bar_bg_color' ) );
	$works_list_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'works_list_title_bar_title_color' ) );
	$works_list_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'works_list_title_bar_color_1' ) );
	$works_list_title_bar_space_width = $apollo13framework_a13->get_option( 'works_list_title_bar_space_width' ) . 'px';

//filter
	$works_list_filter_padding        = $apollo13framework_a13->get_option( 'works_list_filter_padding' );
	$works_list_filter_padding_top    = isset( $works_list_filter_padding['padding-top'] ) ? $works_list_filter_padding['padding-top'] : '0px';
	$works_list_filter_padding_bottom = isset( $works_list_filter_padding['padding-bottom'] ) ? $works_list_filter_padding['padding-bottom'] : '0px';
	$works_list_filter_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'works_list_filter_bg_color' ) );
	$works_list_filter_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'works_list_filter_color' ) );
	$works_list_filter_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'works_list_filter_hover_color' ) );
	$works_list_filter_font_size      = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'works_list_filter_font_size' ), '%spx' );
	$works_list_filter_weight         = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'works_list_filter_weight' ) );
	$works_list_filter_transform      = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'works_list_filter_transform' ) );
	$works_list_filter_text_align     = apollo13framework_make_css_rule( 'text-align', $apollo13framework_a13->get_option( 'works_list_filter_text_align' ) );



	/*
	 *  Works layout
	 */
	$work_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'work_title_bar_image' ), 'url(%s)' );
	$work_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'work_title_bar_image_fit' ) );
	$work_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'work_title_bar_bg_color' ) );
	$work_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'work_title_bar_title_color' ) );
	$work_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'work_title_bar_color_1' ) );
	$work_title_bar_space_width = $apollo13framework_a13->get_option( 'work_title_bar_space_width' ) . 'px';


	/*
	 *  Pages layout
	 */
	$page_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'page_title_bar_image' ), 'url(%s)' );
	$page_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'page_title_bar_image_fit' ) );
	$page_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'page_title_bar_bg_color' ) );
	$page_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'page_title_bar_title_color' ) );
	$page_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'page_title_bar_color_1' ) );
	$page_title_bar_space_width = $apollo13framework_a13->get_option( 'page_title_bar_space_width' ) . 'px';


	/*
	 *  content
	 */
	$content_bg_color         = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'content_bg_color' ) );
	$content_font_size        = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'content_font_size' ), '%spx' );
	$content_font_color       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'content_color' ) );
	$content_link_color       = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'content_link_color' ) );
	$content_link_color_hover = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'content_link_color_hover' ) );
	$content_first_p_show     = ( $apollo13framework_a13->get_option( 'first_paragraph' ) === 'off' ) ? 'font-size: inherit; color: inherit; line-height: inherit;' : '';
	$content_first_p_color    = ( $apollo13framework_a13->get_option( 'first_paragraph' ) === 'off' ) ? '' : apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'first_paragraph_color' ) );
	$page_title_font_size     = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'page_title_font_size' ), '%spx' );
	$page_title_font_size_768 = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'page_title_font_size_768' ), '%spx' );
	$widget_title_font_size   = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'widget_title_font_size' ), '%spx' );
	$widget_font_size         = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'widget_font_size' ), '%spx' );


	/*
	 *  lightbox
	 */
	$lg_lightbox_bg_color                     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_bg_color' ) );
	$lg_lightbox_elements_bg_color            = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_elements_bg_color' ) );
	$lg_lightbox_elements_color               = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_elements_color' ) );
	$lg_lightbox_elements_color_hover         = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_elements_color_hover' ) );
	$lg_lightbox_elements_text_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_elements_text_color' ) );
	$lg_lightbox_thumbs_bg_color              = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_thumbs_bg_color' ) );
	$lg_lightbox_thumbs_border_bg_color       = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_thumbs_border_bg_color' ) );
	$lg_lightbox_thumbs_border_bg_color_hover = apollo13framework_make_css_rule( 'border-color', $apollo13framework_a13->get_option_color_rgba( 'lg_lightbox_thumbs_border_bg_color_hover' ) );


	/*
	 *  fonts
	 */
	$temp                        = $apollo13framework_a13->get_option( 'normal_fonts' );
	$normal_fonts                = ( $temp['font-family'] === 'default' ) ? '' : apollo13framework_make_css_rule( 'font-family', $temp['font-family'], '%s, sans-serif' );
	$normal_fonts_letter_spacing = apollo13framework_make_css_rule( 'letter-spacing', $temp['letter-spacing'] );
	$normal_fonts_word_spacing   = apollo13framework_make_css_rule( 'word-spacing', $temp['word-spacing'] );

	$temp                        = $apollo13framework_a13->get_option( 'titles_fonts' );
	$titles_fonts                = ( $temp['font-family'] === 'default' ) ? '' : apollo13framework_make_css_rule( 'font-family', $temp['font-family'], '%s, sans-serif' );
	$titles_fonts_letter_spacing = apollo13framework_make_css_rule( 'letter-spacing', $temp['letter-spacing'] );
	$titles_fonts_word_spacing   = apollo13framework_make_css_rule( 'word-spacing', $temp['word-spacing'] );

	$temp                        = $apollo13framework_a13->get_option( 'logo_fonts', $temp );//default to titles fonts as it was in previous versions
	$logo_fonts                = ( $temp['font-family'] === 'default' ) ? '' : apollo13framework_make_css_rule( 'font-family', $temp['font-family'], '%s, sans-serif' );
	$logo_fonts_letter_spacing = apollo13framework_make_css_rule( 'letter-spacing', $temp['letter-spacing'] );
	$logo_fonts_word_spacing   = apollo13framework_make_css_rule( 'word-spacing', $temp['word-spacing'] );

	$temp                          = $apollo13framework_a13->get_option( 'nav_menu_fonts' );
	$nav_menu_fonts                = ( $temp['font-family'] === 'default' ) ? '' : apollo13framework_make_css_rule( 'font-family', $temp['font-family'], '%s, sans-serif' );
	$nav_menu_fonts_letter_spacing = apollo13framework_make_css_rule( 'letter-spacing', $temp['letter-spacing'] );
	$nav_menu_fonts_word_spacing   = apollo13framework_make_css_rule( 'word-spacing', $temp['word-spacing'] );


	/**********************************
	 * START OF CSS
	 **********************************/
	$user_css = '';

//prelaoder
	$user_css .= apollo13framework_page_preloader_css();

//menu hover effect
	$menu_hover_effect          = $apollo13framework_a13->get_option( 'menu_hover_effect' );
	$menu_hover_effect_property = 'background-color';
	$ignored_effects            = array( 'none', 'show_icon' );
	if ( strlen( $menu_hover_effect ) && ! in_array( $menu_hover_effect, $ignored_effects ) ) {
		$menu_hover_effect_css_file = get_theme_file_path( 'css/menu-effects/' . $menu_hover_effect . '.css' );
		$content = apollo13framework_read_contents( $menu_hover_effect_css_file );

		$user_css .= ($content === false ? '' : $content);

		$border_menu_effects = array( 'iris' );
		//check if this effect switch different property
		if ( in_array( $menu_hover_effect, $border_menu_effects ) ) {
			$menu_hover_effect_property = 'border-color';
		}
	}


	$user_css .= "
/* ==================
   GLOBAL
   ==================*/
a{
    $content_link_color
}
a:hover{
    $content_link_color_hover
}
body{
    $cursor_css
}

" . apollo13framework_page_background_css() . "

/* GLOBAL SIDEBARS */
#basket-menu{
	$basket_sidebar_bg_color
}
#basket-menu, #basket-menu .widget{
	$basket_sidebar_font_size
}
#side-menu{
	$hidden_sidebar_bg_color
}
#side-menu, #side-menu .widget{
	$hidden_sidebar_font_size
}

/* boxed layout */
.site-layout-boxed #mid{
    $boxed_layout_bg_color
}

/* theme borders */
.theme-borders div{
    $theme_borders_color
}

/* lightbox */
.lg-backdrop {
    $lg_lightbox_bg_color
}
.lg-toolbar,
.lg-sub-html .customHtml h4,
.lg-sub-html .customHtml .description,
.lg-actions .lg-next, .lg-actions .lg-prev{
    $lg_lightbox_elements_bg_color
}
.lg-toolbar .lg-icon,
.lg-actions .lg-next, .lg-actions .lg-prev{
    $lg_lightbox_elements_color
}
.lg-toolbar .lg-icon:hover,
.lg-actions .lg-next:hover, .lg-actions .lg-prev:hover{
    $lg_lightbox_elements_color_hover
}
#lg-counter,
.lg-sub-html,
.customHtml > h4{
    $lg_lightbox_elements_text_color
}
.lg-outer .lg-thumb-outer,
.lg-outer .lg-toogle-thumb{
    $lg_lightbox_thumbs_bg_color
}
.lg-outer .lg-thumb-item {
    $lg_lightbox_thumbs_border_bg_color
}
.lg-outer .lg-thumb-item:hover {
    $lg_lightbox_thumbs_border_bg_color_hover
}


/* ==================
   TYPOGRAPHY
   ==================*/
/* Titles and titles alike font */
h1,h2,h3,h4,h5,h6,
h1 a,h2 a,h3 a,h4 a,h5 a, h6 a,
.page-title,
.widget .title{
    $headings_color
    $titles_fonts
    $titles_fonts_letter_spacing
    $titles_fonts_word_spacing
    $headings_weight
    $headings_transform
}
h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,
.post .post-title a:hover, .post a.post-title:hover{
    $headings_color_hover
}
input[type=\"submit\"],
form button,
.posts-nav a span,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
ul.products .product-meta .product_name{
    $titles_fonts
    $titles_fonts_letter_spacing
    $titles_fonts_word_spacing
}

/* Top menu font */
ul.top-menu,
#menu-overlay{
	$nav_menu_fonts
}
ul.top-menu li,
#menu-overlay li{
	$nav_menu_fonts_letter_spacing
	$nav_menu_fonts_word_spacing
}

/* Text content font */
html,input,select,textarea{
    $normal_fonts
    $normal_fonts_letter_spacing
    $normal_fonts_word_spacing
}




/* ==================
   HEADER
   ==================*/

#header-tools .tool,
#header-tools .tool a{
    $header_tools_color
}
#header-tools .tool:hover,
#header-tools .tool a:hover,
#header-tools .tool.highlight,
#header-tools .tool.active{
	$header_tools_color_hover
}
" . apollo13framework_header_button_css() . "
#header-tools .languages{
	$header_bg_color
}
.hamburger i,
.hamburger i::before,
.hamburger i::after{
	$header_tools_bgcolor
}
.hamburger.active i,
.hamburger.active i::before,
.hamburger.active i::after,
.hamburger:hover i,
.hamburger:hover i::before,
.hamburger:hover i::after{
	$header_tools_bgcolor_hover
}
#header-tools #mobile-menu-opener{
	$header_tools_mobile_menu_icon_size
}
#header-tools #basket-menu-switch{
	$header_tools_basket_sidebar_icon_size
}
#header-tools #search-button{
	$header_tools_header_search_icon_size
}
#header-tools #side-menu-switch{
	$header_tools_hidden_sidebar_icon_size
}
#header-tools #menu-overlay-switch{
	$header_tools_menu_overlay_icon_size
}
#header{
    $header_bg_color
    $header_shadow
    $header_bg_image
    $header_image_fit
}
#header:hover{
    $header_bg_hover_color
}
#header.a13-horizontal{
	$header_border_style
}
.header-type-multi_line .bottom-head{
	$header_menu_part_bg_color
}
.header-horizontal #header .head,
.top-bar-container .top-bar{
	$header_content_padding_left
	$header_content_padding_right
}

/* separators color */
#header.a13-horizontal,
.top-bar-container,
.header-type-multi_line .bottom-head{
	border-color: $header_separators_color;
}
.a13-horizontal #header-tools::before,
.a13-horizontal .head .socials::before,
.top-bar .language-switcher li::before{
    background-color: $header_separators_color;
}

/* LOGO */
a.logo{
	$logo_color
    $logo_font_size
    $logo_weight
    $logo_fonts
    $logo_fonts_letter_spacing
    $logo_fonts_word_spacing
    padding-top: $logo_padding_top;
    padding-bottom: $logo_padding_bottom;
    $logo_image
    $logo_image_height
}
a.logo img{
    $logo_image_height
}
a.normal-logo{
    $logo_image
}
a.logo:hover{
	$logo_color_hover
}
a.logo.image-logo{
	$logo_image_opacity
}
a.logo.image-logo:hover{
    $logo_image_opacity_hover;
}
.header-horizontal .logo-container{
    $logo_container_min_width_desktop
}
.header-variant-one_line_centered .logo-container,
.header-horizontal .logo-container a.logo{
    $logo_container_max_width_desktop
}
.header-variant-one_line_centered.sticky-values .logo-container.shield{
	-webkit-transform: translate(-50%, $logo_shield_hide);
		-ms-transform: translate(-50%, $logo_shield_hide);
			transform: translate(-50%, $logo_shield_hide);
}
.header-variant-one_line_centered.sticky-hide .logo-container.shield,
.header-variant-one_line_centered.hide-until-scrolled-to .logo-container.shield{
	-webkit-transform: translate(-50%, -102%);
		-ms-transform: translate(-50%, -102%);
			transform: translate(-50%, -102%);
}
.header-variant-one_line_centered .logo-container.shield:hover{
	-webkit-transform: translate(-50%, 0);
		-ms-transform: translate(-50%, 0);
			transform: translate(-50%, 0);
}
.header-variant-one_line_centered .menu-cell{
	$menu_width
}
.header-variant-one_line_centered .socials-cell,
.header-variant-one_line_centered .tools-cell{
	$sides_width
}
.header-variant-one_line_centered .menu-cell .top-menu{
	width: 50%;
	width: calc(50% - $logo_max_width_half_desktop);
}
.header-variant-one_line_centered .logo-container.shield{
	padding-left: $logo_shield_padding;
    padding-right: $logo_shield_padding;
}
.header-variant-one_line_centered .logo-container .scaling-svg-container path{
	$logo_shield_bg_color
}
@media only screen and (max-width: 1024px) {
	a.logo{
	    padding-top: $logo_padding_top_mobile;
	    padding-bottom: $logo_padding_bottom_mobile;
	}
	.header-horizontal .logo-container{
        $logo_container_min_width_mobile
	}
	.header-variant-one_line_centered .logo-container,
	.header-horizontal .logo-container a.logo{
	    $logo_container_max_width_mobile
	}
	.header-variant-one_line_centered .logo-container.shield,
	.header-variant-one_line_centered.sticky-values .logo-container.shield{
		-webkit-transform: translate(-50%, $logo_shield_hide_mobile);
			-ms-transform: translate(-50%, $logo_shield_hide_mobile);
				transform: translate(-50%, $logo_shield_hide_mobile);
	}
	.header-variant-one_line_centered.sticky-hide .logo-container.shield,
	.mobile-menu-open .header-variant-one_line_centered .logo-container.shield,
	.header-variant-one_line_centered.hide-until-scrolled-to .logo-container.shield{
		-webkit-transform: translate(-50%, -102%);
			-ms-transform: translate(-50%, -102%);
				transform: translate(-50%, -102%);
	}
	.header-variant-one_line_centered .logo-container.shield:hover{
		-webkit-transform: translate(-50%, 0);
			-ms-transform: translate(-50%, 0);
				transform: translate(-50%, 0);
	}
	.header-variant-one_line_centered .menu-cell{
		/* no sticky CSS for this as icons might jump around then */
		$mobile_logo_shield_space
	}
	.header-variant-one_line_centered .menu-cell .top-menu{
		width: 50%;
		width: calc(50% - $logo_max_width_half_mobile);
	}
}

/* MAIN MENU */
.top-menu ul{
	$header_bg_color
	$header_bg_hover_color
    $submenu_bg_color
}
.mega-menu > ul > li::before {
	$submenu_separator_color
}
.top-menu > li > a,
.top-menu > li > span.title,
.top-menu .mega-menu > ul > li > span.title,
.top-menu .mega-menu > ul > li > a{
    $menu_font_size
    $menu_weight
    $menu_transform
}
.top-menu li a,
.top-menu li span.title{
    $menu_color
}
.top-menu i.sub-mark{
    $menu_color
}
/* hover and active */
.top-menu > li:hover,
.top-menu > li.open,
.top-menu > li.current-menu-item,
.top-menu > li.current-menu-ancestor{
    $menu_hover_bg_color;
}
.top-menu > li > a:hover,
.top-menu > li.menu-parent-item:hover > span.title,
.top-menu > li.open > a,
.top-menu > li.open > span.title,
.top-menu > li.current-menu-item > a,
.top-menu > li.current-menu-ancestor > a,
.top-menu > li.current-menu-item > span.title,
.top-menu > li.current-menu-ancestor > span.title{
    color: $menu_hover_color;
}
.top-menu li.menu-parent-item:hover > span.title + i.sub-mark,
.top-menu i.sub-mark:hover,
.top-menu li.open > i.sub-mark{
    color: $menu_hover_color;
}
.top-menu.with-effect > li > a span::before,
.top-menu.with-effect > li > a span::after,
.top-menu.with-effect > li > span.title span::before,
.top-menu.with-effect > li > span.title span::after,
.top-menu.with-effect > li > a em::before,
.top-menu.with-effect > li > a em::after,
.top-menu.with-effect > li > span.title em::before,
.top-menu.with-effect > li > span.title em::after{
   $menu_hover_effect_property: $menu_hover_color;
}
/* group titles */
.top-menu .mega-menu > ul > li > span.title,
.top-menu .mega-menu > ul > li > a{
    $submenu_color
}
.top-menu .mega-menu > ul > li:hover > span.title,
.top-menu .mega-menu > ul > li:hover > a,
.top-menu .mega-menu > ul > li.current-menu-item > span.title,
.top-menu .mega-menu > ul > li.current-menu-item > a,
.top-menu .mega-menu > ul > li.current-menu-ancestor > span.title,
.top-menu .mega-menu > ul > li.current-menu-ancestor > a{
    $submenu_color_hover
}
.top-menu li li a,
.top-menu li li span.title{
    $submenu_font_size
    $submenu_weight
    $submenu_transform
    $submenu_color
}
.top-menu li li:hover > a,
.top-menu li li:hover > span.title,
.top-menu li li.menu-parent-item:hover > span.title,
.top-menu li li.open > a,
.top-menu li li.open > span.title,
.top-menu li li.current-menu-item > a,
.top-menu li li.current-menu-ancestor > a,
.top-menu li li.current-menu-item > span.title,
.top-menu li li.current-menu-ancestor > span.title{
    $submenu_color_hover;
}
.top-menu li li i.sub-mark{
    $submenu_color
}
.top-menu li li.menu-parent-item:hover > span.title + i.sub-mark,
.top-menu li li i.sub-mark:hover,
.top-menu li li.open > i.sub-mark{
    $submenu_color_hover
}


@media only screen and (max-width: 1024px) {
	.mobile-menu .navigation-bar .menu-container{
	    $header_mobile_menu_bg_color
	}
	.header-vertical .logo-container .logo{
        $logo_container_max_width_mobile
	}
}
@media only screen and (min-width: 1025px) {
	.header-vertical .top-menu li a,
	.header-vertical .top-menu li span.title {
	    $menu_line_height
	}
	.header-vertical .top-menu > li.hidden-icon > a,
	.header-vertical .top-menu > li.hidden-icon > span.title{
		$menu_hidden_icon_height
	}
}

/* MENU OVERLAY */
#menu-overlay,
#menu-overlay.eff-circle::before{
	$header_menu_overlay_bg_color
}
#menu-overlay ul a{
	$header_menu_overlay_color
	$header_menu_overlay_font_size
	$header_menu_overlay_transform
	$header_menu_overlay_weight
}
#menu-overlay ul a:hover{
	$header_menu_overlay_color_hover
}
.close-menu::before,
.close-menu::after{
	$header_menu_overlay_bgcolor
}


/* ==================
   TOP BAR
   ==================*/
.top-bar-container{
	$tb_bg_color
	$tb_border_style
	$tb_text_color
	$tb_text_transform
}
.top-bar-container a{
	$tb_link_color
}
.top-bar-container a.current,
.top-bar-container a:hover{
	$tb_link_color_hover
}
.top-bar .part1{
    $tb_text_msg_part_text_align
}

/* ==================
   LIGHT VARIANT HEADER OVERWRITES
   ==================*/
/* Main */
#header.a13-light-variant,
#header.a13-light-variant:hover{
	$header_light_bg_color
	$header_light_shadow
}
#header.a13-light-variant{
	border-color: $header_light_separators_color;
}
.a13-light-variant .top-bar-container,
.header-type-multi_line.a13-light-variant .bottom-head{
	border-color: $header_light_separators_color;
}
.a13-light-variant #header-tools::before,
.a13-light-variant .head .socials::before,
.a13-light-variant .top-bar .language-switcher li::before {
	background-color: $header_light_separators_color;
}
.a13-light-variant.header-type-multi_line .bottom-head{
	$header_light_menu_part_bg_color
}

/* Logo */
a.light-logo{
	$header_light_logo_image
}
.a13-light-variant a.logo{
	$header_light_logo_color
}
.a13-light-variant a.logo:hover{
	$header_light_logo_color_hover
}

/* Menu */
.a13-light-variant .top-menu > li > a, .a13-light-variant .top-menu > li > span.title {
	$header_light_menu_color
}
.a13-light-variant .top-menu > li:hover,
.a13-light-variant .top-menu > li.open,
.a13-light-variant .top-menu > li.current-menu-item,
.a13-light-variant .top-menu > li.current-menu-ancestor{
    $header_light_menu_hover_bg_color;
}
.a13-light-variant .top-menu > li > a:hover,
.a13-light-variant .top-menu > li.menu-parent-item:hover > span.title,
.a13-light-variant .top-menu > li.open > a,
.a13-light-variant .top-menu > li.open > span.title,
.a13-light-variant .top-menu > li.current-menu-item > a,
.a13-light-variant .top-menu > li.current-menu-ancestor > a,
.a13-light-variant .top-menu > li.current-menu-item > span.title,
.a13-light-variant .top-menu > li.current-menu-ancestor > span.title{
	$header_light_menu_hover_color
}
.a13-light-variant .top-menu > li > i.sub-mark{
	$header_light_menu_color
}
.a13-light-variant .top-menu > li.menu-parent-item:hover > span.title + i.sub-mark,
.a13-light-variant .top-menu > li > i.sub-mark:hover,
.a13-light-variant .top-menu > li.open > i.sub-mark {
	$header_light_menu_hover_color
}
.a13-light-variant .top-menu.with-effect > li > a span::before,
.a13-light-variant .top-menu.with-effect > li > a span::after,
.a13-light-variant .top-menu.with-effect > li > span.title span::before,
.a13-light-variant .top-menu.with-effect > li > span.title span::after,
.a13-light-variant .top-menu.with-effect > li > a em::before,
.a13-light-variant .top-menu.with-effect > li > a em::after,
.a13-light-variant .top-menu.with-effect > li > span.title em::before,
.a13-light-variant .top-menu.with-effect > li > span.title em::after{
   $menu_hover_effect_property: $header_light_menu_hover_color_value;
}

/* Tools */
.a13-light-variant #header-tools .tool,
.a13-light-variant #header-tools .tool a{
	$header_light_tools_color
}
.a13-light-variant #header-tools .tool:hover,
.a13-light-variant #header-tools .tool a:hover,
.a13-light-variant #header-tools .tool.highlight,
.a13-light-variant #header-tools .tool.active{
	$header_light_tools_color_hover
}
.a13-light-variant .tools_button {
	$header_light_tools_color
	$header_light_button_bg_color
	$header_light_button_border_color
}
.a13-light-variant .tools_button:hover {
	$header_light_tools_color_hover
	$header_light_button_bg_color_hover
	$header_light_button_border_color_hover
}
.a13-light-variant #header-tools .languages{
	$header_light_bg_color
}
.a13-light-variant .hamburger i,
.a13-light-variant .hamburger i::before,
.a13-light-variant .hamburger i::after{
	$header_light_tools_bgcolor
}
.a13-light-variant .hamburger.active i,
.a13-light-variant .hamburger.active i::before,
.a13-light-variant .hamburger.active i::after,
.a13-light-variant .hamburger:hover i,
.a13-light-variant .hamburger:hover i::before,
.a13-light-variant .hamburger:hover i::after{
	$header_light_tools_bgcolor_hover
}

/* Top bar */
.a13-light-variant .top-bar-container{
	$header_light_tb_bg_color
	$header_light_tb_text_color
}
.a13-light-variant .top-bar-container .part1 a,
.a13-light-variant .top-bar-container .language-switcher a{
	$header_light_tb_link_color
}
.a13-light-variant .top-bar-container .part1 a:hover,
.a13-light-variant .top-bar-container .language-switcher a:hover,
.a13-light-variant .top-bar-container .language-switcher a.current{
	$header_light_tb_link_color_hover
}

@media only screen and (max-width: 1024px) {
	.a13-light-variant.mobile-menu .navigation-bar .menu-container{
	    $header_light_mobile_menu_bg_color
	}
}


/* ==================
   DARK VARIANT HEADER OVERWRITES
   ==================*/
/* Main */
#header.a13-dark-variant,
#header.a13-dark-variant:hover{
	$header_dark_bg_color
	$header_dark_shadow
}
#header.a13-dark-variant{
	border-color: $header_dark_separators_color;
}
.a13-dark-variant .top-bar-container,
.header-type-multi_line.a13-dark-variant .bottom-head{
	border-color: $header_dark_separators_color;
}
.a13-dark-variant #header-tools::before,
.a13-dark-variant .head .socials::before,
.a13-dark-variant .top-bar .language-switcher li::before {
	background-color: $header_dark_separators_color;
}
.a13-dark-variant.header-type-multi_line .bottom-head{
	$header_dark_menu_part_bg_color
}

/* Logo */
a.dark-logo{
	$header_dark_logo_image
}
.a13-dark-variant a.logo{
	$header_dark_logo_color
}
.a13-dark-variant a.logo:hover{
	$header_dark_logo_color_hover
}

/* Menu */
.a13-dark-variant .top-menu > li > a, .a13-dark-variant .top-menu > li > span.title {
	$header_dark_menu_color
}
.a13-dark-variant .top-menu > li:hover,
.a13-dark-variant .top-menu > li.open,
.a13-dark-variant .top-menu > li.current-menu-item,
.a13-dark-variant .top-menu > li.current-menu-ancestor{
    $header_dark_menu_hover_bg_color;
}
.a13-dark-variant .top-menu > li > a:hover,
.a13-dark-variant .top-menu > li.menu-parent-item:hover > span.title,
.a13-dark-variant .top-menu > li.open > a,
.a13-dark-variant .top-menu > li.open > span.title,
.a13-dark-variant .top-menu > li.current-menu-item > a,
.a13-dark-variant .top-menu > li.current-menu-ancestor > a,
.a13-dark-variant .top-menu > li.current-menu-item > span.title,
.a13-dark-variant .top-menu > li.current-menu-ancestor > span.title{
	$header_dark_menu_hover_color
}
.a13-dark-variant .top-menu > li > i.sub-mark{
	$header_dark_menu_color
}
.a13-dark-variant .top-menu > li.menu-parent-item:hover > span.title + i.sub-mark,
.a13-dark-variant .top-menu > li > i.sub-mark:hover,
.a13-dark-variant .top-menu > li.open > i.sub-mark {
	$header_dark_menu_hover_color
}
.a13-dark-variant .top-menu.with-effect > li > a span::before,
.a13-dark-variant .top-menu.with-effect > li > a span::after,
.a13-dark-variant .top-menu.with-effect > li > span.title span::before,
.a13-dark-variant .top-menu.with-effect > li > span.title span::after,
.a13-dark-variant .top-menu.with-effect > li > a em::before,
.a13-dark-variant .top-menu.with-effect > li > a em::after,
.a13-dark-variant .top-menu.with-effect > li > span.title em::before,
.a13-dark-variant .top-menu.with-effect > li > span.title em::after{
   $menu_hover_effect_property: $header_dark_menu_hover_color_value;
}

/* Tools */
.a13-dark-variant #header-tools .tool,
.a13-dark-variant #header-tools .tool a{
	$header_dark_tools_color
}
.a13-dark-variant #header-tools .tool:hover,
.a13-dark-variant #header-tools .tool a:hover,
.a13-dark-variant #header-tools .tool.highlight,
.a13-dark-variant #header-tools .tool.active{
	$header_dark_tools_color_hover
}
.a13-dark-variant .tools_button {
	$header_dark_tools_color
	$header_dark_button_bg_color
	$header_dark_button_border_color
}
.a13-dark-variant .tools_button:hover {
	$header_dark_tools_color_hover
	$header_dark_button_bg_color_hover
	$header_dark_button_border_color_hover
}
.a13-dark-variant #header-tools .languages{
	$header_dark_bg_color
}
.a13-dark-variant .hamburger i,
.a13-dark-variant .hamburger i::before,
.a13-dark-variant .hamburger i::after{
	$header_dark_tools_bgcolor
}
.a13-dark-variant .hamburger.active i,
.a13-dark-variant .hamburger.active i::before,
.a13-dark-variant .hamburger.active i::after,
.a13-dark-variant .hamburger:hover i,
.a13-dark-variant .hamburger:hover i::before,
.a13-dark-variant .hamburger:hover i::after{
	$header_dark_tools_bgcolor_hover
}

/* Top bar */
.a13-dark-variant .top-bar-container{
	$header_dark_tb_bg_color
	$header_dark_tb_text_color
}
.a13-dark-variant .top-bar-container .part1 a,
.a13-dark-variant .top-bar-container .language-switcher a{
	$header_dark_tb_link_color
}
.a13-dark-variant .top-bar-container .part1 a:hover,
.a13-dark-variant .top-bar-container .language-switcher a:hover,
.a13-dark-variant .top-bar-container .language-switcher a.current{
	$header_dark_tb_link_color_hover
}

@media only screen and (max-width: 1024px) {
	.a13-dark-variant.mobile-menu .navigation-bar .menu-container{
	    $header_dark_mobile_menu_bg_color
	}
}


/* ==================
   STICKY HEADER OVERWRITES
   ==================*/
/* Main */
#header.a13-sticky-variant,
#header.a13-sticky-variant:hover{
	$header_sticky_bg_color
	border-color: $header_sticky_separators_color;
	$header_sticky_shadow
}
.a13-sticky-variant .top-bar-container,
.header-type-multi_line.a13-sticky-variant .bottom-head{
	border-color: $header_sticky_separators_color;
}
.a13-sticky-variant #header-tools::before,
.a13-sticky-variant .head .socials::before,
.a13-sticky-variant .top-bar .language-switcher li::before {
	background-color: $header_sticky_separators_color;
}
.a13-sticky-variant.header-type-multi_line .bottom-head{
	$header_sticky_menu_part_bg_color
}

/* Logo */
a.sticky-logo{
	$header_sticky_logo_image
}
.sticky-values a.logo{
    padding-top: $header_sticky_logo_padding_top;
    padding-bottom: $header_sticky_logo_padding_bottom;
}
.header-horizontal .sticky-values .logo-container{
    $header_sticky_logo_container_min_width_desktop
}
.header-variant-one_line_centered.sticky-values .logo-container,
.header-horizontal .sticky-values .logo-container a.logo{
    $header_sticky_logo_container_max_width_desktop
}
.header-variant-one_line_centered.sticky-values .menu-cell .top-menu{
	width: 50%;
	width: calc(50% - $header_sticky_logo_max_width_half_desktop);
}
.a13-sticky-variant a.logo{
	$header_sticky_logo_color
}
.a13-sticky-variant a.logo:hover{
	$header_sticky_logo_color_hover
}

/* Menu */
.a13-sticky-variant .top-menu > li > a, .a13-sticky-variant .top-menu > li > span.title {
	$header_sticky_menu_color
}
.a13-sticky-variant .top-menu > li:hover,
.a13-sticky-variant .top-menu > li.open,
.a13-sticky-variant .top-menu > li.current-menu-item,
.a13-sticky-variant .top-menu > li.current-menu-ancestor{
    $header_sticky_menu_hover_bg_color;
}
.a13-sticky-variant .top-menu > li > a:hover,
.a13-sticky-variant .top-menu > li.menu-parent-item:hover > span.title,
.a13-sticky-variant .top-menu > li.open > a,
.a13-sticky-variant .top-menu > li.open > span.title,
.a13-sticky-variant .top-menu > li.current-menu-item > a,
.a13-sticky-variant .top-menu > li.current-menu-ancestor > a,
.a13-sticky-variant .top-menu > li.current-menu-item > span.title,
.a13-sticky-variant .top-menu > li.current-menu-ancestor > span.title{
	$header_sticky_menu_hover_color
}
.a13-sticky-variant .top-menu > li > i.sub-mark{
	$header_sticky_menu_color
}
.a13-sticky-variant .top-menu > li.menu-parent-item:hover > span.title + i.sub-mark,
.a13-sticky-variant .top-menu > li > i.sub-mark:hover,
.a13-sticky-variant .top-menu > li.open > i.sub-mark {
	$header_sticky_menu_hover_color
}
.a13-sticky-variant .top-menu.with-effect > li > a span::before,
.a13-sticky-variant .top-menu.with-effect > li > a span::after,
.a13-sticky-variant .top-menu.with-effect > li > span.title span::before,
.a13-sticky-variant .top-menu.with-effect > li > span.title span::after,
.a13-sticky-variant .top-menu.with-effect > li > a em::before,
.a13-sticky-variant .top-menu.with-effect > li > a em::after,
.a13-sticky-variant .top-menu.with-effect > li > span.title em::before,
.a13-sticky-variant .top-menu.with-effect > li > span.title em::after{
   $menu_hover_effect_property: $header_sticky_menu_hover_color_value;
}

/* Tools */
.a13-sticky-variant #header-tools .tool,
.a13-sticky-variant #header-tools .tool a{
	$header_sticky_tools_color
}
.a13-sticky-variant #header-tools .tool:hover,
.a13-sticky-variant #header-tools .tool a:hover,
.a13-sticky-variant #header-tools .tool.highlight,
.a13-sticky-variant #header-tools .tool.active{
	$header_sticky_tools_color_hover
}
.a13-sticky-variant .hamburger i,
.a13-sticky-variant .hamburger i::before,
.a13-sticky-variant .hamburger i::after{
	$header_sticky_tools_bgcolor
}
.a13-sticky-variant .hamburger.active i,
.a13-sticky-variant .hamburger.active i::before,
.a13-sticky-variant .hamburger.active i::after,
.a13-sticky-variant .hamburger:hover i,
.a13-sticky-variant .hamburger:hover i::before,
.a13-sticky-variant .hamburger:hover i::after{
	$header_sticky_tools_bgcolor_hover
}
.a13-sticky-variant .tools_button {
	$header_sticky_tools_color
	$header_sticky_button_bg_color
	$header_sticky_button_border_color
}
.a13-sticky-variant .tools_button:hover {
	$header_sticky_tools_color_hover
	$header_sticky_button_bg_color_hover
	$header_sticky_button_border_color_hover
}
.a13-sticky-variant #header-tools .languages{
	$header_sticky_bg_color
}

/* Top bar */
.a13-sticky-variant .top-bar-container{
	$header_sticky_tb_bg_color
	$header_sticky_tb_text_color
}
.a13-sticky-variant .top-bar-container .part1 a,
.a13-sticky-variant .top-bar-container .language-switcher a{
	$header_sticky_tb_link_color
}
.a13-sticky-variant .top-bar-container .part1 a:hover,
.a13-sticky-variant .top-bar-container .language-switcher a:hover,
.a13-sticky-variant .top-bar-container .language-switcher a.current{
	$header_sticky_tb_link_color_hover
}

@media only screen and (max-width: 1024px) {
	.a13-sticky-variant.mobile-menu .navigation-bar .menu-container{
	    $header_sticky_mobile_menu_bg_color
	}
	.sticky-values a.logo{
	    padding-top: $header_sticky_logo_padding_top_mobile;
	    padding-bottom: $header_sticky_logo_padding_bottom_mobile;
	}
	.header-horizontal .sticky-values .logo-container{
        $header_sticky_logo_container_min_width_mobile
	}
	.header-variant-one_line_centered.sticky-values .logo-container,
	.header-horizontal .sticky-values .logo-container a.logo{
	    $header_sticky_logo_container_max_width_mobile
	}
	.header-variant-one_line_centered.sticky-values .menu-cell .top-menu{
		width: 50%;
		width: calc(50% - $header_sticky_logo_max_width_half_mobile);
	}
}

" . apollo13framework_cookie_message_css() . "
" . apollo13framework_footer_css() . "



/* ==================
   TO TOP BUTTON
   ==================*/
a.to-top{
	$to_top_bg_color
	$to_top_color
	$to_top_font_size
}
a.to-top:hover {
	$to_top_hover_bg_color
	$to_top_hover_color
}



/* ==================
   BUTTONS
   ==================*/
input[type=\"submit\"],
button[type=\"submit\"]{
	$button_submit_bg_color
	$button_submit_color
	$button_submit_font_size
	$button_submit_weight
	$button_submit_transform
	padding-left: $button_submit_padding_left;
	padding-right: $button_submit_padding_right;
	-webkit-border-radius: $button_submit_radius;
			border-radius: $button_submit_radius;
}
input[type=\"submit\"]:hover,
input[type=\"submit\"]:focus,
button[type=\"submit\"]:hover,
button[type=\"submit\"]:focus{
	$button_submit_hover_bg_color
	$button_submit_hover_color
}



/* ==================
   PAGES
   ==================*/
.page .title-bar.outside{
    $page_title_bar_image
    $page_title_bar_image_fit

}
.page .title-bar.outside .overlay-color{
    $page_title_bar_bg_color
    padding-top: $page_title_bar_space_width;
    padding-bottom: $page_title_bar_space_width;

}
.page .title-bar.outside .page-title,
.page .title-bar.outside h2{
    $page_title_bar_title_color
}
.page .title-bar.outside .breadcrumbs,
.page .title-bar.outside .breadcrumbs a,
.page .title-bar.outside .breadcrumbs a:hover{
    $page_title_bar_color_1
}



/* ==================
   ALBUMS LIST
   ==================*/
.albums-list-page .title-bar.outside{
    $albums_list_title_bar_image
    $albums_list_title_bar_image_fit

}
.albums-list-page .title-bar.outside .overlay-color{
    $albums_list_title_bar_bg_color
    padding-top: $albums_list_title_bar_space_width;
    padding-bottom: $albums_list_title_bar_space_width;

}
.albums-list-page .title-bar.outside .page-title,
.albums-list-page .title-bar.outside h2{
    $albums_list_title_bar_title_color
}
.albums-list-page .title-bar.outside .breadcrumbs,
.albums-list-page .title-bar.outside .breadcrumbs a,
.albums-list-page .title-bar.outside .breadcrumbs a:hover{
    $albums_list_title_bar_color_1
}



/* ==================
   WORKS LIST
   ==================*/
.works-list-page .title-bar.outside{
    $works_list_title_bar_image
    $works_list_title_bar_image_fit

}
.works-list-page .title-bar.outside .overlay-color{
    $works_list_title_bar_bg_color
    padding-top: $works_list_title_bar_space_width;
    padding-bottom: $works_list_title_bar_space_width;

}
.works-list-page .title-bar.outside .page-title,
.works-list-page .title-bar.outside h2{
    $works_list_title_bar_title_color
}
.works-list-page .title-bar.outside .breadcrumbs,
.works-list-page .title-bar.outside .breadcrumbs a,
.works-list-page .title-bar.outside .breadcrumbs a:hover{
    $works_list_title_bar_color_1
}



/* ==================
   CATEGORY FILTER
   ==================*/
/* albums list */
.category-filter.albums-filter{
	padding-top: $albums_list_filter_padding_top;
    padding-bottom: $albums_list_filter_padding_bottom;
	$albums_list_filter_bg_color
	$albums_list_filter_text_align
}
.category-filter.albums-filter a{
	$albums_list_filter_color
	$albums_list_filter_font_size
	$albums_list_filter_weight
	$albums_list_filter_transform
}
.category-filter.albums-filter .selected a,
.category-filter.albums-filter a:hover{
    $albums_list_filter_hover_color
}

/* single album bricks */
.single-album-bricks .category-filter{
	padding-top: $album_bricks_filter_padding_top;
    padding-bottom: $album_bricks_filter_padding_bottom;
	$album_bricks_filter_bg_color
	$album_bricks_filter_text_align
}
.single-album-bricks .category-filter a{
	$album_bricks_filter_color
	$album_bricks_filter_font_size
	$album_bricks_filter_weight
	$album_bricks_filter_transform
}
.single-album-bricks .category-filter .selected a,
.single-album-bricks .category-filter a:hover{
    $album_bricks_filter_hover_color
}

/* works list */
.category-filter.works-filter{
	padding-top: $works_list_filter_padding_top;
    padding-bottom: $works_list_filter_padding_bottom;
	$works_list_filter_bg_color
	$works_list_filter_text_align
}
.category-filter.works-filter a{
	$works_list_filter_color
	$works_list_filter_font_size
	$works_list_filter_weight
	$works_list_filter_transform
}
.category-filter.works-filter .selected a,
.category-filter.works-filter a:hover{
    $works_list_filter_hover_color
}

/* posts list */
.category-filter.posts-filter{
	padding-top: $blog_filter_padding_top;
    padding-bottom: $blog_filter_padding_bottom;
	$blog_filter_bg_color
	$blog_filter_text_align
}
.category-filter.posts-filter a{
	$blog_filter_color
	$blog_filter_font_size
	$blog_filter_weight
	$blog_filter_transform
}
.category-filter.posts-filter .selected a,
.category-filter.posts-filter a:hover{
    $blog_filter_hover_color
}



/* ==================
   SINGLE ALBUM
   ==================*/
.single-album .title-bar.outside{
    $album_title_bar_image
    $album_title_bar_image_fit

}
.single-album .title-bar.outside .overlay-color{
    $album_title_bar_bg_color
    padding-top: $album_title_bar_space_width;
    padding-bottom: $album_title_bar_space_width;

}
.single-album .title-bar.outside .page-title,
.single-album .title-bar.outside h2{
    $album_title_bar_title_color
}
.single-album .title-bar.outside .breadcrumbs,
.single-album .title-bar.outside .breadcrumbs a,
.single-album .title-bar.outside .breadcrumbs a:hover{
    $album_title_bar_color_1
}



/* ==================
   SINGLE WORK
   ==================*/
.single-work .title-bar.outside{
    $work_title_bar_image
    $work_title_bar_image_fit

}
.single-work .title-bar.outside .overlay-color{
    $work_title_bar_bg_color
    padding-top: $work_title_bar_space_width;
    padding-bottom: $work_title_bar_space_width;

}
.single-work .title-bar.outside .page-title,
.single-work .title-bar.outside h2{
    $work_title_bar_title_color
}
.single-work .title-bar.outside .breadcrumbs,
.single-work .title-bar.outside .breadcrumbs a,
.single-work .title-bar.outside .breadcrumbs a:hover{
    $work_title_bar_color_1
}



/* ==================
   POSTS LIST & POST
   ==================*/
.posts-list .title-bar.outside{
    $blog_title_bar_image
    $blog_title_bar_image_fit
}
.posts-list .title-bar.outside .overlay-color{
    $blog_title_bar_bg_color
    padding-top: $blog_title_bar_space_width;
    padding-bottom: $blog_title_bar_space_width;

}
.posts-list .title-bar.outside .page-title,
.posts-list .title-bar.outside h2{
    $blog_title_bar_title_color
}
.posts-list .title-bar.outside .breadcrumbs,
.posts-list .title-bar.outside .breadcrumbs a,
.posts-list .title-bar.outside .breadcrumbs a:hover{
    $blog_title_bar_color_1
}
.single-post .title-bar.outside{
    $post_title_bar_image
    $post_title_bar_image_fit

}
.single-post .title-bar.outside .overlay-color{
    $post_title_bar_bg_color
    padding-top: $post_title_bar_space_width;
    padding-bottom: $post_title_bar_space_width;
}
.single-post .title-bar.outside .page-title,
.single-post .title-bar.outside h2{
    $post_title_bar_title_color
}
.single-post .title-bar.outside .post-meta,
.single-post .title-bar.outside .post-meta a,
.single-post .title-bar.outside .post-meta a:hover,
.single-post .title-bar.outside .breadcrumbs,
.single-post .title-bar.outside .breadcrumbs a,
.single-post .title-bar.outside .breadcrumbs a:hover{
    $post_title_bar_color_1
}
" . ( apollo13framework_is_woocommerce_activated() ? apollo13framework_woocommerce_css() : '' ) . "

/* ==================
   CONTENT
   ==================*/
.layout-full #content,
.layout-full_fixed #content,
.layout-full_padding #content,
.layout-parted .content-box,
.layout-parted #secondary,
.default404 .page-background,
body.password-protected .page-background,
.posts-list.search-no-results .layout-full #content,
.posts-list.search-no-results .layout-full_fixed #content,
.posts-list.search-no-results .layout-full_padding #content,
.posts-list.search-no-results .layout-parted .content-box,
.posts-list .layout-full #secondary,
.posts-list .layout-full_fixed #secondary,
.posts-list .layout-full_padding #secondary,
.bricks-frame .formatter,
.posts_horizontal .archive-item,
.variant-under .caption,
.albums-list-page .pre-content-box,
.works-list-page .pre-content-box,
.single-album .album-content,
.single-album .formatter{
	$content_bg_color
}
#content{
    $content_font_size
    $content_font_color
}
.real-content > p:first-child{
    $content_first_p_show
    $content_first_p_color
}
.page-title{
    $page_title_font_size
}
.widget{
    $widget_font_size
}
.widget h3.title {
    $widget_title_font_size
}


/* ==================
   RESPONSIVE
   ==================*/
@media only screen and (max-width: 1024px) {
    #header{
        background-image: none;
    }
}
@media only screen and (max-width: 768px) {
    .page-title{
	    $page_title_font_size_768
	}
}
@media print,
only screen and (-o-min-device-pixel-ratio: 5/4),
only screen and (-webkit-min-device-pixel-ratio: 1.25),
only screen and (min-resolution: 120dpi) {
	a.normal-logo{
	    $logo_image_2x
	}
    a.light-logo{
        $header_light_logo_image_2x
    }
    a.dark-logo{
        $header_dark_logo_image_2x
    }
	a.sticky-logo{
        $header_sticky_logo_image_2x
    }
}

" . ($with_custom_css? apollo13framework_user_custom_css() : '') . "
";

	return apollo13framework_minify_css( $user_css );
}
/* get custom CSS setting value
 */
function apollo13framework_user_custom_css(){
	global $apollo13framework_a13;

	$custom_CSS = $apollo13framework_a13->get_option( 'custom_css' );

	$css = "
/* ==================
   CUSTOM CSS
   ==================*/
" . stripslashes( $custom_CSS );

	return $css;
}
apollo13framework_get_user_css();
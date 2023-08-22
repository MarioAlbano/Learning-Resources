<?php
/* WPML MENU SWITCHER - turn off default one */

/**
 * $sitepress_settings - is WPML global that stores settings for WPML plugin
 * $icl_language_switcher - is WPML global that is responsible for language switcher on front-end.
 */
global $sitepress_settings, $icl_language_switcher;

//we are removing default filter for language switcher and alter it a bit
if(!empty($sitepress_settings['display_ls_in_menu']) && ( !function_exists( 'wpml_home_url_ls_hide_check' ) || !wpml_home_url_ls_hide_check() ) ) {
	if( defined('ICL_SITEPRESS_VERSION') && version_compare(ICL_SITEPRESS_VERSION, '4.0', '<' ) ){
		remove_filter( 'wp_nav_menu_items', array( $icl_language_switcher, 'wp_nav_menu_items_filter' ), 10 );
		add_filter( 'wp_nav_menu_items', 'apollo13framework_wpml_add_custom_menu', 10, 2 );
	}
}

/**
 * We add here some customization so language switcher will work with our main menu
 * It is copy of default WPML function, see above remove_filter
 *
 * @see SitePressLanguageSwitcher::wp_nav_menu_items_filter()
 *
 * @param $items
 * @param $args
 *
 * @return string
 */
function apollo13framework_wpml_add_custom_menu($items, $args){
	global $sitepress_settings, $sitepress;

	$current_language = $sitepress->get_current_language();
	$default_language = $sitepress->get_default_language();
	// menu can be passed as integer or object
	if(isset($args->menu->term_id)) $args->menu = $args->menu->term_id;

	$abs_menu_id = wpml_object_id_filter($args->menu, 'nav_menu', false, $default_language );
	$settings_menu_id = wpml_object_id_filter( $sitepress_settings[ 'menu_for_ls' ], 'nav_menu', false, $default_language );

	if ( $abs_menu_id == $settings_menu_id  || false === $abs_menu_id ) {

		$languages = $sitepress->get_ls_languages();

		$items .= '<li class="menu-item menu-item-language menu-item-language-current'.(sizeof($languages) > 1 ? ' menu-parent-item' : '').'">';
		if(isset($args->before)){
			$items .= $args->before;
		}
		$items .= '<span tabindex="0" class="title">';
		if(isset($args->link_before)){
			$items .= $args->link_before;
		}

		$language_name = '';
		if ( $sitepress_settings[ 'icl_lso_native_lang' ] ) {
			$language_name .= $languages[ $current_language ][ 'native_name' ];
		}
		if ( $sitepress_settings[ 'icl_lso_display_lang' ] && $sitepress_settings[ 'icl_lso_native_lang' ] ) {
			$language_name .= ' (';
		}
		if ( $sitepress_settings[ 'icl_lso_display_lang' ] ) {
			$language_name .= $languages[ $current_language ][ 'translated_name' ];
		}
		if ( $sitepress_settings[ 'icl_lso_display_lang' ] && $sitepress_settings[ 'icl_lso_native_lang' ] ) {
			$language_name .= ')';
		}

		$alt_title_lang = esc_attr($language_name);

		if( $sitepress_settings['icl_lso_flags'] ){
			$items .= '<img class="iclflag" src="' . $languages[ $current_language ][ 'country_flag_url' ] . '" width="18" height="12" alt="' . $alt_title_lang . '" title="' . esc_attr( $language_name ) . '" />';
		}

		$items .= $language_name;

		if(isset($args->link_after)){
			$items .= $args->link_after;
		}
		$items .= '</span>';
		if(sizeof($languages) > 1 ){
			$items .= '<i tabindex="0" class="fa sub-mark fa-angle-down"></i>';
		}
		if(isset($args->after)){
			$items .= $args->after;
		}

		unset($languages[ $current_language ]);
		$sub_items = false;
		$menu_is_vertical = !isset($sitepress_settings['icl_lang_sel_orientation']) || $sitepress_settings['icl_lang_sel_orientation'] == 'vertical';
		if(!empty($languages)){
			foreach($languages as $lang){
				$sub_items .= '<li class="menu-item menu-item-language menu-item-language-current">';
				$sub_items .= '<a href="'.esc_url( $lang['url'] ).'">';

				$language_name = '';
				if ( $sitepress_settings[ 'icl_lso_native_lang' ] ) {
					$language_name .= $lang[ 'native_name' ];
				}
				if ( $sitepress_settings[ 'icl_lso_display_lang' ] && $sitepress_settings[ 'icl_lso_native_lang' ] ) {
					$language_name .= ' (';
				}
				if ( $sitepress_settings[ 'icl_lso_display_lang' ] ) {
					$language_name .= $lang[ 'translated_name' ];
				}
				if ( $sitepress_settings[ 'icl_lso_display_lang' ] && $sitepress_settings[ 'icl_lso_native_lang' ] ) {
					$language_name .= ')';
				}
				$alt_title_lang = esc_attr($language_name);

				if( $sitepress_settings['icl_lso_flags'] ){
					$sub_items .= '<img class="iclflag" src="'.$lang['country_flag_url'].'" width="18" height="12" alt="'.$alt_title_lang.'" title="' . $alt_title_lang . '" />';
				}
				$sub_items .= $language_name;

				$sub_items .= '</a>';
				$sub_items .= '</li>';

			}
			if( $sub_items && $menu_is_vertical ) {
				$sub_items = '<ul class="sub-menu submenu-languages">' . $sub_items . '</ul>';
			}
		}
		if( $menu_is_vertical ) {
			$items .= $sub_items;
			$items .= '</li>';
		} else {
			$items .= '</li>';
			$items .= $sub_items;
		}

	}

	return $items;
}
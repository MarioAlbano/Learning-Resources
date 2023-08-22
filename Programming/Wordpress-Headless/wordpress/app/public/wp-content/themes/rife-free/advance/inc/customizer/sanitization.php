<?php
/**
 * Sanitize callbacks for customizer save
 */

/**
 * Sanitize images
 *
 * @param string $value url
 *
 * @return string
 */
function apollo13framework_sanitize_image($value) {
	$value = (is_array( $value ) && array_key_exists('url', $value)) ? $value : esc_url_raw( $value );

	return $value;
}


/**
 * Sanitize setting with options
 *
 * @param string $value url
 *
 * @param WP_Customize_Setting $setting Setting.
 *
 * @return string
 */
function apollo13framework_sanitize_options($value, $setting) {
	$choices = $setting->manager->get_control( $setting->id )->choices;

	//return value if valid or return default option
	return ( array_key_exists( $value, $choices ) ? $value : $setting->default );
}


/**
 * Sanitize button-set with multi select
 *
 * @param array $value array of selected items
 *
 * @param WP_Customize_Setting $setting Setting.
 *
 * @return string
 */
function apollo13framework_sanitize_button_set_multi($value, $setting) {
	if(!is_array($value)){
		return $setting->default;
	}
	
	$choices = $setting->manager->get_control( $setting->id )->choices;

	$valid = true;
	//check each option is it in defined choices
	foreach($value as $option){
		if(!array_key_exists( $option, $choices )){
			$valid = false;
			break;
		}
	}

	//return value if valid or return default option
	return $valid ? $value : $setting->default;
}


/**
 * Sanitize color
 *
 * @param string $value color
 *
 * @return string
 */
function apollo13framework_sanitize_color($value) {
	if ( empty( $value ) ) {
		return '';
	}

	//is it rgba or HEX
	if ( strpos( $value, 'rgba' ) === false ) {
		return sanitize_hex_color( $value );
	}

	//remove any white space
	$value = str_replace( ' ', '', $value );

	//check is it valid rgba
	if ( preg_match('!^rgba\(([0-9]{1,3},){3}(0(\.\d+)?|1)\)$!', $value ) ) {
		return $value;
	}

	//no color if not valid
	return '';
}


/**
 * Textarea value
 *
 * @param string $value color
 *
 * @return string
 */
function apollo13framework_sanitize_wp_kses_data($value) {
	return wp_kses_post( balanceTags( $value, true ) );
}


/**
 * Text value
 *
 * @param string $value color
 *
 * @return string
 */
function apollo13framework_sanitize_esc_html($value) {
	return sanitize_text_field($value);
}

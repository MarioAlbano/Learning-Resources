<?php
/**
 * TGMPA plugin installer config
 */
function apollo13framework_register_required_plugins() {
	/**
	 * Array of configuration settings. Amend each line as needed.
	 */

	tgmpa(
		array(
			array(
				'name'               => esc_html__( 'Apollo13 Framework Extensions', 'rife-free' ),
				'slug'               => 'apollo13-framework-extensions',
				'required'           => false,
				'version'            => A13FRAMEWORK_MIN_COMPANION_VERSION,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'     				=> esc_html__( 'Rife Elementor Extensions', 'rife-free' ),
				'slug'     				=> 'rife-elementor-extensions',
				'required' 				=> false,
				'version' 				=> '1.0.1',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
			)
		)
	);
}


add_action('tgmpa_register', 'apollo13framework_register_required_plugins');
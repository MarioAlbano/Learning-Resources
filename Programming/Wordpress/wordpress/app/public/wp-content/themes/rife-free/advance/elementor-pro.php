<?php
/**
 * Adds support for Elementor Pro custom locations
 *
 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager
 */
function apollo13framework_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'apollo13framework_register_elementor_locations' );
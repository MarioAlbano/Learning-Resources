<?php
/**
 * WP and PHP compatibility.
 *
 * Functions used to gracefully fail when a theme doesn't meet the minimum WP or
 * PHP versions required. Note that only code that will work on PHP 5.2.4 should
 * go into this file. Otherwise, it'll break on sites not meeting the minimum
 * PHP requirement. Only call this file after initially checking that the site
 * doesn't meet either the WP or PHP requirement.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

# Add actions to fail at certain points in the load process.
add_action( 'after_switch_theme', 'apollo13framework_switch_theme'   );
add_action( 'load-customize.php', 'apollo13framework_load_customize' );
add_action( 'template_redirect',  'apollo13framework_preview'        );

/**
 * Returns the compatibility messaged based on whether the WP or PHP minimum
 * requirement wasn't met.
 *
 * @since  2.1.1
 * @access public
 * @return string
 */
function apollo13framework_compat_message() {
	if ( version_compare( $GLOBALS['wp_version'], A13FRAMEWORK_MIN_WP_VERSION, '<' ) ) {

		return sprintf(
		/* translators: %1$s: Theme name, %2$s: the required WordPress version, %3$s: user's current version */
			__( '%1$s theme requires at least WordPress version %2$s. You are running version %3$s. Please upgrade and try again.', 'rife-free' ),
			A13FRAMEWORK_OPTIONS_NAME_PART,
			A13FRAMEWORK_MIN_WP_VERSION,
			$GLOBALS['wp_version']
		);

	} elseif ( version_compare( PHP_VERSION, A13FRAMEWORK_MIN_PHP_VERSION, '<' ) ) {

		return sprintf(
		/* translators: %1$s: Theme name, %2$s: required PHP version, %3$s: current PHP version */
			__( '%1$s theme requires at least PHP version %2$s. You are running version %3$s. Please upgrade and try again.', 'rife-free' ),
			A13FRAMEWORK_OPTIONS_NAME_PART,
			A13FRAMEWORK_MIN_PHP_VERSION,
			PHP_VERSION
		);
	}

	return '';
}

/**
 * Switches to the previously active theme after the theme has been activated.
 *
 * @since  2.1.0
 * @access public
 * @param  string  $old_name  Previous theme name/slug.
 * @return void
 */
function apollo13framework_switch_theme( $old_name ) {

	switch_theme( $old_name ? $old_name : WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'apollo13framework_upgrade_notice' );
}

/**
 * Outputs an admin notice with the compatibility issue.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
function apollo13framework_upgrade_notice() {

	printf( '<div class="error"><p>%s</p></div>', esc_html( apollo13framework_compat_message() ) );
}

/**
 * Kills the loading of the customizer.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
function apollo13framework_load_customize() {

	wp_die( esc_html( apollo13framework_compat_message() ), '', array( 'back_link' => true ) );
}

/**
 * Kills the customizer previewer on installs prior to WP 4.7.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
function apollo13framework_preview() {

	if ( isset( $_GET['preview'] ) ) { // WPCS: CSRF ok.
		wp_die( esc_html( apollo13framework_compat_message() ) );
	}
}

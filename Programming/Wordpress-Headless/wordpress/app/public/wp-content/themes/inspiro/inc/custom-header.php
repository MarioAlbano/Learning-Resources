<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro 1.0.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses inspiro_header_style()
 */
function inspiro_custom_header_setup() {
	add_theme_support(
		'custom-header',
		/**
		 * Filters Inspiro Lite custom-header support arguments.
		 *
		 * @since Inspiro 1.0.0
		 *
		 * @param array $args {
		 *     An array of custom-header support arguments.
		 *
		 *     @type string $default-image    Default image of the header.
		 *     @type int    $width            Width in pixels of the custom header image. Default 954.
		 *     @type int    $height           Height in pixels of the custom header image. Default 1300.
		 *     @type string $flex-height      Flex support for height of header.
		 *     @type string $video            Video support for header.
		 *     @type string $wp-head-callback Callback function used to styles the header image and text
		 *                                    displayed on the blog.
		 * }
		 */
		apply_filters(
			'inspiro_custom_header_args',
			array(
				'default-image'    => get_parent_theme_file_uri( '/assets/images/StockSnap_M6D1GS9PSL.jpg' ),
				'width'            => 2000,
				'height'           => 1200,
				'flex-height'      => true,
				'video'            => true,
				'wp-head-callback' => 'inspiro_header_style',
			)
		)
	);

	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/images/StockSnap_M6D1GS9PSL.jpg',
				'thumbnail_url' => '%s/assets/images/StockSnap_M6D1GS9PSL.jpg',
				'description'   => __( 'Default Header Image', 'inspiro' ),
			),
			'forest-image'  => array(
				'url'           => '%s/assets/images/StockSnap_89BQZ89TLH.jpg',
				'thumbnail_url' => '%s/assets/images/StockSnap_89BQZ89TLH.jpg',
				'description'   => __( 'Forest', 'inspiro' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'inspiro_custom_header_setup' );

if ( ! function_exists( 'inspiro_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see inspiro_custom_header_setup().
	 */
	function inspiro_header_style() {
		$header_text_color              = get_header_textcolor();
		$header_button_text_color       = inspiro_get_theme_mod( 'header_button_textcolor' );
		$header_button_text_color_hover = inspiro_get_theme_mod( 'header_button_textcolor_hover' );
		$header_button_bg_color_hover   = inspiro_get_theme_mod( 'header_button_bgcolor_hover' );
		$color_menu_background          = inspiro_get_theme_mod( 'color_menu_background' );
        $color_menu_background_scroll   = inspiro_get_theme_mod( 'color-menu-background-scroll' );
        $color_footer_background        = inspiro_get_theme_mod( 'color_footer_background' );
        $color_footer_text              = inspiro_get_theme_mod( 'color_footer_text' );
		?>
		<style id="inspiro-custom-header-styles" type="text/css">
		<?php
			// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
			.site-title a,
			.colors-dark .site-title a,
			.colors-custom .site-title a,
			body.has-header-image .site-title a,
			body.has-header-video .site-title a,
			body.has-header-image.colors-dark .site-title a,
			body.has-header-video.colors-dark .site-title a,
			body.has-header-image.colors-custom .site-title a,
			body.has-header-video.colors-custom .site-title a,
			.site-description,
			.colors-dark .site-description,
			.colors-custom .site-description,
			body.has-header-image .site-description,
			body.has-header-video .site-description,
			body.has-header-image.colors-dark .site-description,
			body.has-header-video.colors-dark .site-description,
			body.has-header-image.colors-custom .site-description,
			body.has-header-video.colors-custom .site-description {
				color: <?php echo maybe_hash_hex_color( $header_text_color ); ?>;
			}
		<?php endif; ?>

		<?php if ( 'blank' !== $header_button_text_color ) : ?>
			.custom-header-button {
				color: <?php echo maybe_hash_hex_color( $header_button_text_color ); ?>;
				border-color: <?php echo maybe_hash_hex_color( $header_button_text_color ); ?>;
			}
		<?php endif; ?>

		<?php if ( 'blank' !== $header_button_text_color_hover ) : ?>
			.custom-header-button:hover {
				color: <?php echo maybe_hash_hex_color( $header_button_text_color_hover ); ?>;
			}
		<?php endif; ?>

		<?php if ( '#0bb4aa' !== $header_button_bg_color_hover ) : ?>
			.custom-header-button:hover {
				background-color: <?php echo maybe_hash_hex_color( $header_button_bg_color_hover ); ?> !important;
				border-color: <?php echo maybe_hash_hex_color( $header_button_bg_color_hover ); ?> !important;
			}
		<?php endif; ?>

        <?php if ( '#101010' !== $color_menu_background ) : ?>
            .navbar {
                background-color: <?php echo maybe_hash_hex_color( $color_menu_background ); ?>;
            }
        <?php endif; ?>

        <?php if ( '#101010' !== $color_footer_background ) : ?>
            .site-footer {
                background-color: <?php echo maybe_hash_hex_color( $color_footer_background ); ?>;
            }
        <?php endif; ?>

        <?php if ( '#78787f' !== $color_footer_text ) : ?>
            .site-footer {
                color: <?php echo maybe_hash_hex_color( $color_footer_text ); ?>;
            }
        <?php endif; ?>

		<?php if ( 'blank' !== $color_menu_background_scroll ) : ?>
            .headroom--not-top .navbar,
			.has-header-image.home.blog .headroom--not-top .navbar, 
			.has-header-image.inspiro-front-page .headroom--not-top .navbar, 
			.has-header-video.home.blog .headroom--not-top .navbar, 
			.has-header-video.inspiro-front-page .headroom--not-top .navbar {
				background-color: <?php echo maybe_hash_hex_color( $color_menu_background_scroll ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif; // End of inspiro_header_style().

/**
 * Customize video play/pause button in the custom header.
 *
 * @param array $settings Video settings.
 * @return array The filtered video settings.
 */
function inspiro_video_controls( $settings ) {
	$settings['l10n']['play']  = '<span class="screen-reader-text">' . __( 'Play background video', 'inspiro' ) . '</span>' . inspiro_get_theme_svg( 'play' );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . __( 'Pause background video', 'inspiro' ) . '</span>' . inspiro_get_theme_svg( 'pause' );

	/**
	 * Change the minimum screen size to use the video header.
	 *
	 * @since 1.3.1
	 */
	$settings['minWidth']  = 100;
	$settings['minHeight'] = 100;

	/**
	 * Adds support for Vimeo to the video in the custom header.
	 *
	 * @see https://github.com/bradyvercher/custom-header-vimeo
	 */
	if ( preg_match( '#^https?://(.+\.)?vimeo\.com/.*#', $settings['videoUrl'] ) ) {
		$settings['mimeType'] = 'video/x-vimeo';
	}

	return $settings;
}
add_filter( 'header_video_settings', 'inspiro_video_controls' );

/**
 * Maybe enqueue custom header vimeo scripts
 */
function inspiro_maybe_enqueue_vimeo_handler() {
	if ( wp_script_is( 'wp-custom-header' ) ) {
		wp_enqueue_script(
			'wp-custom-header-vimeo',
			inspiro_get_assets_uri( 'custom-header-vimeo', 'js' ),
			array( 'wp-custom-header' ),
			INSPIRO_THEME_VERSION,
			true
		);
	}
}
add_action( 'wp_footer', 'inspiro_maybe_enqueue_vimeo_handler' );

/**
 * Filter extenal header video settting validity
 *
 * @param boolean $validity Validity.
 * @param string  $value Video setting value.
 * @return boolean
 */
function inspiro_filter_external_header_video_setting_validity( $validity, $value ) {
	if ( preg_match( '#^https?://(.+\.)?vimeo\.com/.*#', $value ) ) {
		return true;
	}

	return $validity;
}
add_filter( 'customize_validate_external_header_video', 'inspiro_filter_external_header_video_setting_validity', 11, 2 );


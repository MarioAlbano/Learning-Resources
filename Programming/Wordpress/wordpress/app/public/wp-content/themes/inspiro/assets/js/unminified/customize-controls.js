/* global jQuery */

/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hex control and informs the preview
 * when users open or close the front page sections section.
 */

( function ( api, $ ) {
	api.bind( 'ready', function () {
		// Only show the color hex control when there's a custom color scheme.
		api( 'colorscheme', function ( setting ) {
			api.control( 'colorscheme_hex', function ( control ) {
				const visibility = function () {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			} );
		} );

		/**
		 * Display checkbox field for Full Height video iframe on mobile when input has value.
		 *
		 * @since 1.4.0
		 */
		api( 'external_header_video', function ( setting ) {
			api.control(
				'external_header_video_full_height',
				function ( control ) {
					const visibility = function () {
						if ( '' !== setting.get() ) {
							control.container.slideDown( 180 );
						} else {
							control.container.slideUp( 180 );
						}
					};
					visibility();
					setting.bind( visibility );
				}
			);
		} );

		/**
		 * Hide external video settings if self-hosted video is uploaded.
		 *
		 * @since 1.4.0
		 */
		api( 'header_video', function ( setting ) {
			const videoSettingControls = [
				'external_header_video',
				'external_header_video_full_height',
			];
			$.each( videoSettingControls, function ( _, controlId ) {
				api.control( controlId, function ( control ) {
					const visibility = function () {
						if ( parseInt( setting.get() ) > 0 ) {
							control.container.slideUp( 180 );
						} else {
							control.container.slideDown( 180 );
						}
					};
					visibility();
					setting.bind( visibility );
				} );
			} );
		} );
	} );

	// Extends our custom "upgrade-pro" section.
	api.sectionConstructor[ 'upgrade-pro' ] = api.Section.extend( {
		// No events for this type of section.
		attachEvents() {},

		// Always make the section active.
		isContextuallyActive() {
			return true;
		},
	} );

	api.controlConstructor[ 'inspiro-range' ] = api.Control.extend( {
		ready() {
			const control = this,
				$input = this.container.find( '.inspiro-control-range-value' ),
				$slider = this.container.find( '.inspiro-control-range' );

			$slider.on( 'input change keyup', function () {
				$input.val( $( this ).val() ).trigger( 'change' );
			} );

			if ( control.setting() === '' ) {
				$slider.val( parseFloat( $slider.attr( 'min' ) ) );
			}

			$input.on( 'change keyup', function () {
				const value = $( this ).val();
				control.setting.set( value );
				if ( value ) {
					$slider.val( parseFloat( value ) );
				} else {
					$slider.val( parseFloat( $slider.attr( 'min' ) ) );
				}
			} );

			// Update the slider if the setting changes.
			control.setting.bind( function ( value ) {
				$slider.val( parseFloat( value ) );
			} );
		},
	} );

	api.controlConstructor[ 'inspiro-alpha-color-picker' ] = api.Control.extend({
		ready: function() {
			var control = this,
				$container = control.container.find('.zoom-color-picker-container'),
				$input = $('input.zoom-alpha-color-picker', $container);

			$input.alphaColorPicker();
		}
	});

} )( wp.customize, jQuery );

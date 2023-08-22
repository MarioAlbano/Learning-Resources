<?php
/**
 * Alpha Color Picker Customizer Control
 *
 * This control adds a second slider for opacity to the stock WordPress color picker,
 * and it includes logic to seamlessly convert between RGBa and Hex color values as
 * opacity is added to or removed from a color.
 *
 * This Alpha Color Picker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this Alpha Color Picker. If not, see <http://www.gnu.org/licenses/>.
 */
class A13_Customize_Alpha_Color_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'alpha-color';

	/**
	 * Add support for palettes to be passed in.
	 *
	 * Supported palette values are true, false, or an array of RGBa and Hex colors.
	 */
	public $palette;

	/**
	 * Add support for showing the opacity value on the slider handle.
	 */
	public $show_opacity;


	/**
	 * Constructor.
	 *
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		$value = $this->manager->get_setting( $id )->value();
		//if this setting was previously saved with Redux plugin
		if ( is_array($value) ) {
			add_filter("customize_sanitize_js_{$id}", array($this,'fix_value' ));
		}
	}


	/**
	 * Fixes value set in Redux Framework to work in native customizer
	 */
	public function fix_value($value){
		return isset($value['rgba'])? $value['rgba'] : '';
	}



	/**
	 * Enqueue scripts and styles.
	 *
	 * Ideally these would get registered and given proper paths before this control object
	 * gets initialized, then we could simply enqueue them here, but for completeness as a
	 * stand alone class we'll register and enqueue them here.
	 */
	public function enqueue() {
		wp_enqueue_script(
			'a13-alpha-color-picker',
			get_theme_file_uri( 'js/alpha-color-picker.js' ),
			array( 'jquery', 'wp-color-picker' ),
			'1.0.0',
			true
		);
		wp_enqueue_style(
			'a13-alpha-color-picker',
			get_theme_file_uri( 'css/alpha-color-picker.css' ),
			array( 'wp-color-picker' ),
			'1.0.0'
		);
	}

	/**
	 * Render the control.
	 */
	public function render_content() {
		if (is_array( $this->settings['default']->default ) ){
			$default_value = isset($this->settings['default']->default['rgba']) ? $this->settings['default']->default['rgba'] : $this->settings['default']->default['color'];
		}
		else{
			$default_value = '';
		}

		// Process the palette
		if ( is_array( $this->palette ) ) {
			$palette = implode( '|', $this->palette );
		} else {
			// Default to true.
			$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
		}

		// Support passing show_opacity as string or boolean. Default to true.
		$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

		// Begin the output. ?>
			<?php // Output the label and description if they were passed in.
			if ( isset( $this->label ) && '' !== $this->label ) {
				echo '<span class="customize-control-title">' . esc_html( $this->label ). '</span>';
			}
			if ( isset( $this->description ) && '' !== $this->description ) {
				echo '<span class="description customize-control-description">' . esc_html( $this->description ). '</span>';
			} ?>
			<div class="customize-control-content">
				<label><span class="screen-reader-text">' . sanitize_text_field( $this->label ) . '</span>
					<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $default_value ); ?>" <?php $this->link(); ?>  />
				</label>
			</div>
		<?php
	}
}
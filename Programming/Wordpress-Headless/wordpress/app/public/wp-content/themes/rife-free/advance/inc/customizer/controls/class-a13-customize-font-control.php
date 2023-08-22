<?php
/**
 * Font Customizer Control
 *
 */
class A13_Customize_Font_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'font';


	public function to_json() {
		parent::to_json();

		$value = $this->value();

		//make sure we have variants as array(Past "Redux era" )
		if ( isset( $value['font-multi-style'] ) ){
			$tmp_value = json_decode( $value['font-multi-style'] );
			//if $value was not array try as string
			if($tmp_value === NULL){
				$tmp_value = strlen($value['font-multi-style']) === 0? array() : array($value['font-multi-style']);
			}

			//new setting
			$value['variants'] = $tmp_value;
			//remove legacy setting
			unset($value['font-multi-style']);
		}

		//make sure subsets are array
		if ( isset( $value['subsets'] ) && ! is_array( $value['subsets'] ) ){
			$value['subsets'] = array($value['subsets']);
		}

		$this->json['current_font'] = $value;
	}


	/**
	 * Don't render any content for this control from PHP.
	 *
	 * @see A13_Customize_Font_Control::content_template()
	 */
	public function render_content() {}



	/**
	 * Render a JS template for the content of the font control.
	 *
	 */
	public function content_template() {
		?>
		<#
		var id = data.settings.default,
			id_prefix = _.uniqueId( 'el' ) + '-',
			standard_fonts = A13FECustomizerControls.standard_fonts,
			google_fonts = A13FECustomizerControls.google_fonts,
			readabe_variants = A13FECustomizerControls.human_font_variants,
			selected_font = data.current_font['font-family'],
			selected_subsets = data.current_font['subsets'],
			selected_variants = data.current_font['variants'],
			selected_word_spacing = parseInt(data.current_font['word-spacing'], 10),
			selected_letter_spacing = parseInt(data.current_font['letter-spacing'], 10),
			selected_attr = ' selected',
			checked_attr = ' checked';
		#>
		<# if ( data.label ) { #>
		<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<label for="{{ id }}" class="outside"><?php esc_html_e( 'Font Family', 'rife-free' ); ?></label>
			<select id="{{ id }}">
				<# if ( typeof standard_fonts === 'object' ) { #>
					<optgroup label="<?php echo esc_attr( __( 'Standard Fonts', 'rife-free' )); ?>">
						<# _.each( standard_fonts, function( name, font ) { #>
						<option value="{{ font }}"{{ selected_font === font ? selected_attr : '' }} >{{ name }}</option>
						<# } ); #>
					</optgroup>
				<# } #>

				<# if ( typeof google_fonts === 'object' ) { #>
					<optgroup label="<?php echo esc_attr( __( 'Google Webfonts', 'rife-free' )); ?>">'
						<# _.each( google_fonts, function( font, name ) { #>
						<option value="{{ name }}"{{ selected_font === name ? selected_attr : '' }}>{{ name }}</option>
						<# } ); #>
					</optgroup>
				<# } #>
			</select>

			<# if(typeof google_fonts[selected_font] !== 'undefined'){ #>
				<fieldset class="font-subsets checkboxes">
					<legend><?php esc_html_e( 'Font Subsets', 'rife-free' ); ?></legend>
				<# _.each( google_fonts[selected_font].subsets, function( subset ) { #>
					<label><input type="checkbox" name="font-subset" value="{{ subset }}"{{ _.contains(selected_subsets, subset) ? checked_attr : '' }} />{{ subset }}</label>
				<# } ); #>
				</fieldset>

				<fieldset class="font-variants checkboxes">
					<legend><?php esc_html_e( 'Font Weights & Styles', 'rife-free' ); ?></legend>
				<# _.each( google_fonts[selected_font].variants, function( weights, variant ) { #>
					<# _.each( weights, function( weight ) {
						var val_variant = weight + (variant === 'normal'? '' : variant),
							readable_variant = readabe_variants[weight] + ' ' + weight + ' ' + (variant === 'normal'? '' : variant);
					#>
					<label><input type="checkbox" name="font-variant" value="{{ val_variant }}"{{ _.contains(selected_variants, val_variant) ? checked_attr : '' }} />{{ readable_variant }}</label>
					<# } ); #>
				<# } ); #>
				</fieldset>
			<# } #>

			<fieldset class="font-spacing">
				<div>
					<label class="outside" for="{{ id_prefix }}word-spacing"><?php esc_html_e( 'Word Spacing', 'rife-free' ); ?></label>
					<input id="{{ id_prefix }}word-spacing" type="number" name="word-spacing" value="{{ selected_word_spacing }}" /><span class="input-unit">px</span>
				</div>
				<div>
					<label class="outside" for="{{ id_prefix }}letter-spacing"><?php esc_html_e( 'Letter Spacing', 'rife-free' ); ?></label>
					<input id="{{ id_prefix }}letter-spacing" type="number" name="letter-spacing" value="{{ selected_letter_spacing }}" /><span class="input-unit">px</span>
				</div>
			</fieldset>

			<div class="preview-font" style="font-family:{{ selected_font }};"><?php _e( 'Sample text with <strong>some bold words</strong>, <em>some italic ones</em> and numbers 1 2 3 4 5 6 7 8 9 :-)', 'rife-free' ); ?></div>
		</div>
		<?php
	}
}
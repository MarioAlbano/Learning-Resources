<?php
/**
 * Slider Customizer Control
 *
 * For numeric values
 *
 */
class A13_Customize_Slider_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'slider';

	/**
	 * Params of range slider
	 */
	public $min = '';
	public $max = '';
	public $unit = '';
	public $step = '';


	/**
	 * Enqueue scripts and styles.
	 *
	 * Ideally these would get registered and given proper paths before this control object
	 * gets initialized, then we could simply enqueue them here, but for completeness as a
	 * stand alone class we'll register and enqueue them here.
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-slider' );
	}


	public function to_json() {
		parent::to_json();

		$this->json['min'] = $this->min;
		$this->json['max'] = $this->max;
		$this->json['step'] = $this->step;
		$this->json['unit'] = $this->unit;
		$this->json['value'] = $this->value();
	}


	/**
	 * Don't render any content for this control from PHP.
	 *
	 * @see A13_Customize_Button_Set_Control::content_template()
	 */
	public function render_content() {}



	/**
	 * Render a JS template for the content of the button_set control.
	 *
	 */
	public function content_template() {
		?>
		<#
			var id = data.settings.default,
				using_unit = data.unit.length > 0;

		#>
		<# if ( data.label ) { #>
			<label class="customize-control-title" for="{{ id }}">{{{ data.label }}}</label>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<input id="{{ id }}" class="slider-dump" type="number" value="{{ data.value }}" step="{{ data.step }}" min="{{ data.min }}" max="{{ data.max }}" /><# if( using_unit ){ #></#><span class="input-unit">{{ data.unit }}</span><# } #>
			<div class="slider-place" data-min="{{ data.min }}" data-max="{{ data.max }}" data-step="{{ data.step }}"></div>
		</div>
		<?php
	}
}
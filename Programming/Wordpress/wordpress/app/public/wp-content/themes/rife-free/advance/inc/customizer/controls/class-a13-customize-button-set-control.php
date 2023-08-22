<?php
/**
 * Button Set Customizer Control
 *
 * It can be used as radio or checkbox version
 *
 */
class A13_Customize_Button_Set_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'button-set';

	/**
	 * multi selecting
	 */
	public $multi = false;



	public function to_json() {
		parent::to_json();

		$this->json['multi'] = $this->multi;
		$this->json['choices'] = $this->choices;
		$this->json['selected'] = $this->value();
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
			var is_multi = data.multi;
			var id = data.settings.default;
			var input_type = is_multi ? 'checkbox' : 'radio';
		#>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<# _.each( data.choices, function( choice, index ) { #>
				<span class="customize-inside-control-row">
					<input type="{{ input_type }}" name="{{ id }}" id="{{ id }}-{{ index }}" value="{{ index }}"
					<# if(_.contains(data.selected, index)){ #>
						checked
					<# } #>
					/>
					<label for="{{ id }}-{{ index }}">{{ choice }}</label>
				</span>
			<# } ); #>
		</div>
		<?php
	}
}
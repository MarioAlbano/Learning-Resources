<?php
/**
 * Button Set Customizer Control
 *
 * It can be used as radio or checkbox version
 *
 */
class A13_Customize_Sidebars_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'custom_sidebars';

	public function to_json() {
		parent::to_json();

		$this->json['sidebars'] = $this->value();
	}

	/**
	 * Don't render any content for this control from PHP.
	 *
	 * @see A13_Customize_Socials_Control::content_template()
	 */
	public function render_content() {}


	/**
	 * Render a JS template for the content of the socials control.
	 *
	 */
	public function content_template() {
		?>
		<#
			var id_prefix = _.uniqueId( 'el' ) + '-';
		#>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<# _.each( data.sidebars, function( value, index ) {
				if(_.isNull(value) || _.isUndefined(value) || value.length === 0){ return; }
			#>
				<div class="custom_sidebar-row clearfix">
					<label class="screen-reader-tex" for="{{ id_prefix }}sidebar-{{ index }}"><?php esc_html_e( 'Name of sidebar', 'rife-free' ); ?> {{ index }}</label>
					<input type="text" class="custom_sidebar" name="{{ index }}" id="{{ id_prefix }}sidebar-{{ index }}" value="{{ value }}" />
					<button class="remove"><?php esc_html_e( 'Remove this sidebar', 'rife-free' ); ?></button>
				</div>
			<# } ); #>
			<button class="button button-primary add-new"><?php esc_html_e( 'Add sidebar', 'rife-free' ); ?></button>

		</div>
		<?php
	}
}
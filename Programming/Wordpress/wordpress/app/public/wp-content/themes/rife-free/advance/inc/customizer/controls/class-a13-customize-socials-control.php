<?php
/**
 * Button Set Customizer Control
 *
 * It can be used as radio or checkbox version
 *
 */
class A13_Customize_Socials_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'socials';

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	public function to_json() {
		parent::to_json();

		$available_services = $this->choices;
		$saved_services = $this->value();

		//make sure we have new services in list if there were added some new since last save
		$new_services = array_diff_key($available_services, $saved_services);
		if(count($new_services) > 0){
			foreach($new_services as $id => $name){
				$saved_services[$id] =  '';
			}
		}

		$this->json['available_services'] = $available_services;
		$this->json['saved_services'] = $saved_services;
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
			<# _.each( data.saved_services, function( value, index ) {
				if( index === '__last_edit'){
					return;
				}
				#>
				<div class="social-service-row">
					<label for="{{ id_prefix }}social-{{ index }}">{{ data.available_services[index] }}</label>
					<input type="text" class="social_services" name="{{ index }}" id="{{ id_prefix }}social-{{ index }}" value="{{ value }}" />
					<span class="drag"><i class="fa fa-arrows"></i></span>
				</div>
			<# } ); #>
		</div>
		<?php
	}
}
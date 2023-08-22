<?php
/**
 * Font Customizer Control
 *
 */
class A13_Customize_Spacing_Control extends WP_Customize_Control {

	/**
	 * Official control name.
	 */
	public $type = 'spacing';

	/**
	 * Padding or margin
	 */
	public $mode = 'padding';

	/**
	 * Which side we will set
	 */
	public $sides = array('top', 'right', 'bottom', 'left');
	public $side_icons = array(
		'top' => 'fa fa-long-arrow-up',
		'right' => 'fa fa-long-arrow-right',
		'bottom' => 'fa fa-long-arrow-down',
		'left' => 'fa fa-long-arrow-left'
	);
	public $side_labels;

	/**
	 * Which side we will set
	 */
	public $units = array('px');


	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		$this->side_labels = array(
			'top' => esc_html__( 'Top', 'rife-free' ),
			'right' => esc_html__( 'Right', 'rife-free' ),
			'bottom' => esc_html__( 'Bottom', 'rife-free' ),
			'left' => esc_html__('Left', 'rife-free' ),
		);
	}


	public function to_json() {
		parent::to_json();

		$this->json['mode']        = $this->mode;
		$this->json['sides']       = $this->sides;
		$this->json['side_icons']  = $this->side_icons;
		$this->json['side_labels'] = $this->side_labels;
		$this->json['units']       = $this->units;
		$this->json['value']       = $this->value();
	}


	/**
	 * Don't render any content for this control from PHP.
	 *
	 * @see A13_Customize_Spacing_Control::content_template()
	 */
	public function render_content() {}



	/**
	 * Render a JS template for the content of the spacing control.
	 *
	 */
	public function content_template() {
		?>
		<#
		var id = data.settings.default,
			id_prefix = _.uniqueId( 'el' ) + '-',
			value = data.value,
			units = data.units,
			selected_unit = typeof value.units !== "undefined" ? value.units : units[0],
			selected_attr = ' selected',
			mode = data.mode;
		#>
		<# if ( data.label ) { #>
		<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div class="customize-control-content">
			<# _.each( data.sides, function( side ) { #>
				<label><span class="screen-reader-text">{{ data.side_labels[side] }}</span>
					<span title="{{ data.side_labels[side] }}" class="side-icon {{ data.side_icons[side] }}"></span><input type="number" name="{{ mode+'-'+side }}" value="{{ parseInt(value[mode+'-'+side], 10) }}" /></label>
			<# } ); #>

			<label class="screen-reader-text" for="{{ id_prefix }}{{ mode }}-unit"><?php esc_html_e( 'Unit', 'rife-free' ); ?></label>
			<select id="{{ id_prefix }}{{ mode }}-unit" name="unit">
				<# _.each( units, function( unit ) { #>
				<option value="{{ unit }}"{{ selected_unit === unit ? selected_attr : '' }} >{{ unit }}</option>
				<# } ); #>
			</select>
		</div>
		<?php
	}
}
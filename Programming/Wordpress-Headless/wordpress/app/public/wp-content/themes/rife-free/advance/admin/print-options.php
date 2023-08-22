<?php
/**
 * Checks single dependency if it is valid
 *
 * @param array $dependency  dependency to check in form of 3 fields array
 *
 * @return bool valid or not
 */

function apollo13framework_compare_dependency($dependency){
	global $apollo13framework_a13;

	$parent   = $dependency[0];
	$operator = $dependency[1];
	$value    = $dependency[2];
	$parent_value = $apollo13framework_a13->get_meta( '_'.$parent );

	//check if it is "new post" page
	global $pagenow;
	if('post-new.php' == $pagenow ) {
		$parent_value = $apollo13framework_a13->defaults_of_meta[$parent];
	}


	//check operators
	if($operator === '='){
		return $value === $parent_value;
	}
	elseif($operator === '!='){
		return $value !== $parent_value;
	}
	
	//for all other operators
	return false;
}


/**
 * @param array $required dependency to check in form of 3 fields array
 * @param bool $is_meta is it called for meta filed or option
 *
 * @return bool
 */
function apollo13framework_check_control_dependencies($required, $is_meta ){
	if($is_meta){
		//we have more then one required condition
		if(is_array($required[0]) ){
			foreach($required as $dependency){
				if(!apollo13framework_compare_dependency($dependency)){
					//some dependency were not met
					return false;
				}
			}
			//all dependencies were met
			return true;
		}
		//we have only one required condition
		else{
			return apollo13framework_compare_dependency($required);
		}
	}
	//classic option - not supported 
	else{
		return true;
	}
}


function apollo13framework_input_help_tip($message){
	?>
	<div class="input-tip">
		<span class="activator" tabindex="0">?</span>

		<div class="tip"><?php echo wp_kses_post( balanceTags( $message ) ); ?></div>
	</div>
	<?php
}


/**
 * Generates input, selects and other form controls
 *
 * @param $option  : currently processed option with all attributes
 * @param $params  : params for meta type or option type
 * @param $is_meta : meta or option
 *
 * @return bool true if some field was used, false other way
 */
function apollo13framework_print_form_controls( $option, &$params, $is_meta = false ) {
	global $apollo13framework_a13;
	$input_prefix = A13FRAMEWORK_INPUT_PREFIX;

	$style  = '';

	$description = isset( $option['description'] ) ? $option['description'] : '';

	/* Extract some variables */
	if ( $is_meta ) {
		$value = $params['value'];
		$style = $params['style'];
	} //if run for theme options
	else {
		$value = $apollo13framework_a13->get_option( $option['id'] );
	}

	//check if field should be visible
	if ( isset( $option['required'] ) && is_array( $option['required'] ) ) {
		//display or not
		$style .= apollo13framework_check_control_dependencies( $option['required'], $is_meta ) ? '' : 'display: none;';
	}

	$valid_tags = array(
		'a'      => array(
			'href' => array(),
		),
		'br'     => array(),
		'code'   => array(),
		'strong' => array(),
	);
	
	/* TYPES */
	if ( $option['type'] == 'upload' ) {
		$upload_button_text = ! empty( $option['button_text'] ) ? $option['button_text'] : esc_html__( 'Upload', 'rife-free' );
		?>

		<div class="upload-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?>&nbsp;</label>

			<div class="input-desc">
				<input id="<?php echo esc_attr( $input_prefix . $option['id'] ); ?>"<?php
				echo ( isset( $option['attachment_field'] ) && strlen( $option['attachment_field'] ) ) ?
					' data-attachment="'.esc_attr($option['attachment_field']).'"' : '';
				?> type="text" size="36" name="<?php echo esc_attr( $input_prefix . $option['id'] ); ?>" value="<?php echo esc_attr( wp_unslash( $value ) ); ?>" />
				<input id="upload_<?php echo esc_attr($input_prefix . $option['id']); ?>" class="upload-image-button button" type="button" value="<?php echo esc_attr($upload_button_text) ?>"<?php
				//text on upload button
				echo ( isset( $option['media_button_text'] ) && strlen( $option['media_button_text'] ) ) ?
					' data-media-button-name="' . esc_attr($option['media_button_text']) . '"' : '';
				//media type we look for
				echo ( isset( $option['media_type'] ) && strlen( $option['media_type'] ) ) ?
					' data-media-type="' . esc_attr($option['media_type']) . '"' : '';
				?> />
				<input id="clear_<?php echo esc_attr($input_prefix . $option['id']); ?>" class="clear-image-button button" type="button" value="<?php echo esc_attr__( 'Clear field', 'rife-free' ) ?>" />

				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'text' ) {
		?>
		<div class="text-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?>&nbsp;</label>

			<div class="input-desc">
				<input id="<?php echo esc_attr($input_prefix . $option['id']); ?>"<?php
				echo isset( $option['input_class'] ) ? ' class="' . esc_attr( $option['input_class'] ) . '"' : '';
				echo isset( $option['placeholder'] ) ? ' placeholder="' . esc_attr( $option['placeholder'] ) . '"' : '';
				?> type="text" size="36" name="<?php echo esc_attr($input_prefix . $option['id']); ?>" value="<?php echo esc_attr( wp_unslash( $value ) ); ?>" />

				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'hidden' ) {
		?>
		<div class="hidden-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<input id="<?php echo esc_attr($input_prefix . $option['id']); ?>" type="hidden" name="<?php echo esc_attr($input_prefix . $option['id']); ?>" value="<?php echo esc_attr( $value ); ?>" />
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'textarea' ) {
		?>
		<div class="textarea-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?>&nbsp;</label>

			<div class="input-desc">
				<textarea rows="10" cols="20" class="large-text" id="<?php echo esc_attr($input_prefix . $option['id']); ?>" name="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_textarea( wp_unslash( $value ) ); ?></textarea>

				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'select' ) {
		$selected      = $value;
		?>
		<div class="select-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?></label>

			<div class="input-desc">
				<select id="<?php echo esc_attr($input_prefix . $option['id']); ?>" name="<?php echo esc_attr($input_prefix . $option['id']); ?>">
					<?php
					foreach ( $option['options'] as $html_value => $html_option ) {
						echo '<option value="' . esc_attr( $html_value ) . '"' . ( (string) $html_value == (string) $selected ? ' selected="selected"' : '' ) . '>' . esc_html( $html_option ) . '</option>';
					}
					?>
				</select>

				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'radio' ) {
		$selected = $value;
		?>
		<div class="radio-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<span class="label-like"><?php echo esc_html($option['name']); ?></span>

			<div class="input-desc">
				<?php
				foreach ( $option['options'] as $html_value => $html_option ) {
					echo '<label><input type="radio" name="' . esc_attr( $input_prefix . $option['id'] ) . '" value="' . esc_attr( $html_value ) .
					     '" ' .( (string) $html_value === (string) $selected ? ' checked="checked"' : '' )  . ' />' . esc_html( $html_option ) . '</label>';
				}
				?>
				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'color' ) {
		?>
		<div class="color-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?></label>

			<div class="input-desc">
				<?php apollo13framework_input_help_tip( '<p>'.__( 'Use the correct <code>color</code> property in CSS( <code>green, #33FF99, rgb(255,128,0), rgba(222,112,12,0.5)</code> ), or choose a color with a color picker. Leave an empty value to use the default theme value.', 'rife-free' ).'</p><p>'.__( 'Use the "Transparent" button to insert a transparent value.', 'rife-free' ) ); ?>
				<input id="<?php echo esc_attr($input_prefix . $option['id']); ?>" type="text" class="with-color" name="<?php echo esc_attr($input_prefix . $option['id']); ?>" value="<?php echo esc_attr( wp_unslash( $value ) ); ?>" />
				<button class="transparent-value button-secondary"><?php esc_html_e( 'Transparent', 'rife-free' ); ?></button>
				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'tag_media' ) {
		?>
		<div class="tag_media-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>-helper"><?php echo esc_html($option['name']); ?>&nbsp;</label>

			<div class="input-desc">
				<textarea rows="1" cols="20" class="hide-if-js large-text" id="<?php echo esc_attr($input_prefix . $option['id']); ?>" name="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_textarea( wp_unslash( $value ) ); ?></textarea>
				<p><input id="<?php echo esc_attr($input_prefix . $option['id']); ?>-helper" class="not-to-collect newtag" size="16" value="" type="text">
					<input class="not-to-collect button tagadd" value="<?php esc_attr_e( 'Add', 'rife-free' ); ?>" type="button"></p>
				<div class="current-tags tagchecklist"></div>
				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'slider' ) {
		$min  = isset( $option['min'] ) ? $option['min'] : '';
		$max  = isset( $option['max'] ) ? $option['max'] : '';
		$step = isset( $option['step'] ) ? $option['step'] : 1;
		$min  = number_format( $min, 2, '.', '' );
		$max  = number_format( $max, 2, '.', '' );
		$step = number_format( $step, 2, '.', '' );
		?>
		<div class="slider-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?></label>

			<div class="input-desc">
				<?php apollo13framework_input_help_tip( __( 'Use slider to set proper value. You can click on slider handle and then use arrows keys(on keyboard) to adjust value precisely. You can also type in input value that is in/out of range of slider, and it will be used.', 'rife-free' ) ); ?>
				<input class="slider-dump" id="<?php echo esc_attr($input_prefix . $option['id']); ?>" type="text" name="<?php echo esc_attr($input_prefix . $option['id']); ?>" value="<?php echo esc_attr( wp_unslash( $value ) ); ?>" />

				<div class="slider-place" data-min="<?php echo esc_attr($min); ?>" data-max="<?php echo esc_attr($max); ?>" data-unit="<?php echo esc_attr($option['unit']); ?>" data-step="<?php echo esc_attr($step); ?>"></div>
				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] == 'wp_dropdown_products' ) {
		?>
		<div class="select-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
			<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?></label>

			<div class="input-desc">
				<?php

				$args = array(
					'post_type'				=> 'product',
					'post_status'			=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' 		=> -1,
					'orderby' => 'title'
				);

				$products = get_posts( apply_filters( 'woocommerce_shortcode_products_query', $args ) );

				if ( $products ) {
					echo '<select name="'.esc_attr($input_prefix.$option['id']).'" id="'.esc_attr($input_prefix.$option['id']).'">';
					echo '<option value="0">'.esc_html__( 'None', 'rife-free' ).'</option>';

					foreach ( $products as $product ){
						$id = $product->ID;
						echo '<option value="'.esc_attr($id).'" '.selected( $value, 1, false ).'>'.esc_html( $product->post_title ).'</option>';
					}

					echo '</select>';
				}
				else{
					echo '<span class="empty-type">'. esc_html__( 'There are no products yet!', 'rife-free' ) . '</span>';
				}


				?>
				<p class="desc"><?php echo wp_kses( $description, $valid_tags ); ?></p>
			</div>
		</div>
		<?php
		return true;
	}
	elseif ( $option['type'] === 'proofing_items' ) {
		if(function_exists('a13fe_album_proofing_return_approved_files')){
			$valid_tags = array(
				'a'      => array(
					'href' => array(),
				),
				'br'     => array(),
				'code'   => array(),
				'strong' => array(),
			);
			$approved_array = a13fe_album_proofing_return_approved_files(get_the_ID());
			if(sizeof($approved_array) === 0){
				$value = '';
			}
			else{
				$value = '**'.__('Adobe Lightroom', 'rife-free').'**';

				$value .= "\r\n".implode(', ', $approved_array);

				$value .= "\r\n\r\n**".__('Windows Explorer or Mac Finder', 'rife-free').'**';
				$value .= "\r\n\"".implode('" OR "', $approved_array).'"';
			}


			?>
			<div class="textarea-input input-parent"<?php echo strlen($style) ? ' style="'.esc_attr($style).'"' : ''; ?>>
				<label for="<?php echo esc_attr($input_prefix . $option['id']); ?>"><?php echo esc_html($option['name']); ?>&nbsp;</label>

				<div class="input-desc">
					<textarea rows="10" cols="20" class="large-text" id="<?php echo esc_attr($input_prefix . $option['id']); ?>" name="<?php echo esc_attr($input_prefix . $option['id']); ?>" readonly><?php echo esc_textarea( wp_unslash( $value ) ); ?></textarea>

					<p class="desc"><?php echo wp_kses( isset( $description ) ? $description : '', $valid_tags ); ?></p>
				</div>
			</div>
			<?php
		}
	}

	return false;
}
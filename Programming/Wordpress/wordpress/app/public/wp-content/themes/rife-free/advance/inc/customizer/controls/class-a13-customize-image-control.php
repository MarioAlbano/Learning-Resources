<?php
class A13_Customize_Image_Control extends WP_Customize_Image_Control {
	public $type = 'a13-image';
	public $mime_type = 'image';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * Cause we have much richer value, then we can't use WP_Customize_Media_Control::to_json as it produces error.
	 * So we make same things without error.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		//legit grand-grandpa call
		WP_Customize_Control::to_json();

		$this->json['label'] = html_entity_decode( $this->label, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$this->json['mime_type'] = $this->mime_type;
		$this->json['button_labels'] = $this->button_labels;
		$this->json['canUpload'] = current_user_can( 'upload_files' );

		$value = $this->value();

		if ( is_object( $this->setting ) ) {
			if ( $this->setting->default ) {
				// Fake an attachment model - needs all fields used by template.
				// Note that the default value must be a URL, NOT an attachment ID.
				$default_val = is_array($this->setting->default)? $this->setting->default['url'] : $this->setting->default;
				$type = in_array( substr( $default_val, -3 ), array( 'jpg', 'png', 'gif', 'bmp' ) ) ? 'image' : 'document';
				$default_attachment = array(
					'id' => 1,
					'url' => $default_val,
					'type' => $type,
					'icon' => wp_mime_type_icon( $type ),
					'title' => basename( $default_val ),
				);

				if ( 'image' === $type ) {
					$default_attachment['sizes'] = array(
						'full' => array( 'url' => $default_val ),
					);
				}

				$this->json['defaultAttachment'] = $default_attachment;
			}

			if ( $value && $this->setting->default && $value === $this->setting->default ) {
				// Set the default as the attachment.
				$this->json['attachment'] = $this->json['defaultAttachment'];
			}
			elseif ( $value ) {
				//if this setting was previously saved with Redux plugin
				if ( is_array($value) ) {
					// Get the attachment model for the existing file.
					$attachment_id = $value['id'];
					if ( $attachment_id ) {
						$this->json['attachment'] = wp_prepare_attachment_for_js( $attachment_id );
					}
				}
			}
		}
	}
}


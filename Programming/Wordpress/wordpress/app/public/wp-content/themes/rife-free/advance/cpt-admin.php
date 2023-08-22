<?php
add_action( 'wp_ajax_apollo13framework_prepare_gallery_single_item_html', 'apollo13framework_prepare_gallery_single_item_html' );

/**
 * Just a helper to create item for gallery in album/work
 */
function apollo13framework_prepare_gallery_single_item_html() {
	//check priviliges
	if ( ! current_user_can( 'edit_posts' ) ) {
		exit;
	}

	$array[] = isset( $_POST['item'] )? array_map( 'sanitize_text_field', wp_unslash( $_POST['item'] ) ) : array();
	apollo13framework_prepare_external_media( $array );
	apollo13framework_prepare_admin_gallery_html( $array );

	die(); // this is required to return a proper result
}






/**
 * Prepares admin gallery ready to display
 *
 * @param array $attachments
 *
 * @return string HTML of all items
 */
function apollo13framework_prepare_admin_gallery_html($attachments){
	if ( $attachments ) {
		foreach ( $attachments as $item ) {
			$src = '';
			if( !is_array($item) && $item === 'deleted' ){
				$file_name = 'File deleted?';
				$item_class = 'attachment-preview image deleted';
				$src = get_theme_file_uri( 'images/holders/deleted.png');
				$img_class = 'thumbnail';
			}
			else{
				//thumbnail src
				if(isset($item['thumb'])){
					$src = $item['thumb']['src'];
				}
				else{
					if(isset($item['sizes'])){
						if(isset($item['sizes']['thumbnail'])){
							$src = $item['sizes']['thumbnail']['url'];
						}
						//image is very small or just don't have thumbnail yet
						else{
							$src = $item['sizes']['full']['url'];
						}
					}
					elseif(isset($item['icon'])){
						$src = $item['icon'];
					}
				}

				//classes of item
				$item_class = 'attachment-preview'
				              .' type-'.$item['type']
				              .' subtype-'.$item['subtype']
				              .( isset($item['orientation'])? ' '.$item['orientation'] : '' )
				;

				//icon & filename for no image types
				$img_class = "thumbnail";
				$file_name = false;
				if($item['type'] !== 'image'){
					if( isset($item['thumb']) && $src === $item['icon'] ){
						$img_class = 'icon';
					}
					elseif( isset($item['icon']) && $src === $item['icon'] ){
						$img_class = 'icon';
					}
					$file_name = $item['filename'];
				}
			}

			apollo13framework_admin_gallery_item_html($item_class, $img_class, $src, $file_name );
		}
	}
}



/**
 * Helper to prepare each gallery item to display in admin
 *
 * @param string     $item_class    classes for current item
 * @param string     $img_class     classes for image of item
 * @param string     $src           image path
 * @param bool|string $file_name    file name for external attachments
 */
function apollo13framework_admin_gallery_item_html($item_class, $img_class, $src, $file_name = false ){
	?>
	<li class="mu-item attachment">
	<div class="<?php echo esc_attr($item_class); ?>">
		<div class="thumbnail">
			<div class="centered">
				<img class="<?php echo esc_attr($img_class); ?>" src="<?php echo esc_url($src); ?>">
			</div>

			<?php if($file_name !== false): ?>
				<div class="filename">
					<div><?php echo esc_html($file_name); ?></div>
				</div>
			<?php endif; ?>
		</div>
		<span class="mu-item-edit fa fa-pencil" title="<?php esc_attr_e( 'Edit', 'rife-free' ); ?>"></span>
		<span class="mu-item-remove fa fa-times" title="<?php esc_attr_e( 'Remove item', 'rife-free' ); ?>"></span>
		<div class="mu-item-drag"></div>
	</div>
	</li>
<?php
}

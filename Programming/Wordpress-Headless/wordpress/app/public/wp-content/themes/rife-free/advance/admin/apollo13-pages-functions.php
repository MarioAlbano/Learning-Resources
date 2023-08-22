<?php
function apollo13framework_apollo13_pages() {
	//check is such subpage is registered
	if ( isset( $_GET['subpage'] ) ) {
		$function_name = 'apollo13framework_apollo13_'.sanitize_text_field( wp_unslash( $_GET['subpage'] ) );
		if( $function_name !== __FUNCTION__ && function_exists( $function_name )){
			//process with subpage
			$function_name();
		}
		else{
			//go to default page
			apollo13framework_apollo13_info();
		}
	}
	else{
		//go to default page
		apollo13framework_apollo13_info();
	}
}



function apollo13framework_theme_requirements_table(){
	?>
	<div class="server-config">
		<table class="status_table widefat" cellspacing="0">
			<thead>
			<tr>
				<th colspan="3"><?php esc_html_e( 'Server/WordPress Environment', 'rife-free' ); ?></th>
			</tr>
			</thead>

			<tbody>
			<?php if(defined('A13FRAMEWORK_IMPORTER_TMP_DIR')) { ?>
			<tr>
				<td><?php esc_html_e( 'Demo Data Directory', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( __( 'The directory must be writable so downloaded demo data could be saved for the import process.', 'rife-free' ) ); ?></td>
				<td><?php
					if ( is_writable( A13FRAMEWORK_IMPORTER_TMP_DIR ) ) {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> <code>' . esc_html( A13FRAMEWORK_IMPORTER_TMP_DIR ) . '</code></mark> ';
					} else {
						/* translators: %s: directory name */
						printf( '<mark class="error"><span class="dashicons dashicons-no"></span> ' . esc_html__( 'To allow import, make %s writable.', 'rife-free' ) . '</mark>', '<code>'.esc_html( A13FRAMEWORK_IMPORTER_TMP_DIR ).'</code>' );
					}
					?></td>
			</tr>
			<?php } ?>
			<tr>
				<td><?php esc_html_e( 'WP Memory Limit', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( __( 'The maximum amount of memory (RAM) that your site can use at one time.', 'rife-free' ) ); ?></td>
				<td><?php
//					$memory = wp_convert_hr_to_bytes( WP_MEMORY_LIMIT );

					$system_memory = wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) );
					$memory        = $system_memory;//max( $memory, $system_memory );

					if ( $memory <= 0 ) {//0MB
						/* translators:  %1$s is memory available and %2$s is link to "Increasing memory allocated to PHP" article */
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%1$s - We can not determine the true memory limit that is set on your server. It is possible that your server admin blocked manipulating this limit. See: %2$s', 'rife-free' ), esc_html( size_format( $memory ) ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__( 'Increasing memory allocated to PHP', 'rife-free' ) . '</a>' ) . '</mark>';
					}
					elseif ( $memory < 100663296 ) {//96MB
						/* translators:  %1$s is memory available and %2$s is link to "Increasing memory allocated to PHP" article */
						echo '<mark class="error"><span class="dashicons dashicons-no"></span> ' . sprintf( esc_html__( '%1$s - Having memory lower than 96 MB(we recommend 128 MB or more) can produce errors while importing demo data, depending on how many plugins you have active. See: %2$s', 'rife-free' ), esc_html( size_format( $memory ) ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__( 'Increasing memory allocated to PHP', 'rife-free' ) . '</a>' ) . '</mark>';
					}
					elseif ( $memory < 134217728 ) {//128MB
						/* translators:  %1$s is memory available and %2$s is link to "Increasing memory allocated to PHP" article */
						echo '<mark class="warning"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%1$s - You should be fine with so much memory, however, depending on how many plugins you have active you should change it to 128 MB or more. See: %2$s', 'rife-free' ), esc_html( size_format( $memory ) ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__( 'Increasing memory allocated to PHP', 'rife-free' ) . '</a>' ) . '</mark>';
					}
					else {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> ' . esc_html( size_format( $memory ) ) . '</mark>';
					}
					?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'PHP Version', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( __( 'The version of PHP installed on your hosting server.', 'rife-free' ) ); ?></td>
				<td><?php
					// Check if phpversion function exists.
					if ( function_exists( 'phpversion' ) ) {
						$php_version = phpversion();

						if ( version_compare( $php_version, '5.3', '<' ) ) {
							/* translators:  %1$s is PHP version number and %2$s is link to "How to update your PHP version" article */
							echo '<mark class="error"><span class="dashicons dashicons-no"></span> ' . sprintf( esc_html__( '%1$s - We recommend a minimum PHP version of 5.6. Having version 7 or higher is even better. See: %2$s', 'rife-free' ), esc_html( $php_version ), '<a href="https://docs.woocommerce.com/document/how-to-update-your-php-version/" target="_blank">' . esc_html__( 'How to update your PHP version', 'rife-free' ) . '</a>' ) . '</mark>';
						}
						elseif ( version_compare( $php_version, '5.6', '<' ) ) {
							/* translators:  %1$s is PHP version number and %2$s is link to "How to update your PHP version" article */
							echo '<mark class="warning"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%1$s - We recommend a minimum PHP version of 5.6. Having version 7 or higher is even better. See: %2$s', 'rife-free' ), esc_html( $php_version ), '<a href="https://docs.woocommerce.com/document/how-to-update-your-php-version/" target="_blank">' . esc_html__( 'How to update your PHP version', 'rife-free' ) . '</a>' ) . '</mark>';
						}
						else {
							echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> ' . esc_html( $php_version ) . '</mark>';
						}
					} else {
						esc_html_e( "Couldn't determine PHP version because phpversion() doesn't exist.", 'rife-free' );
					}
					?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'PHP Time Limit', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( __( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups). Recommended 60 seconds or more for the import process.', 'rife-free' ) ); ?></td>
				<td><?php
					$max_execution_time =  (int)ini_get( 'max_execution_time' );

					if ( $max_execution_time > 0 ){
						if ( $max_execution_time < 30 ) {
							/* translators: %1$s - time in seconds, %2$s - max_execution_time */
							echo '<mark class="warning"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%1$s - Having %2$s less than 30 can hurt the import process. We recommend setting it to at least 60 if possible, even if only for the import process.', 'rife-free' ), esc_html( $max_execution_time ), '<code>max_execution_time</code>' ) . '</mark>';
						}
						else {
							echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> ' . esc_html( $max_execution_time ) . '</mark>';
						}
					}
					else{
						echo '<mark>' . esc_html( $max_execution_time ) . '</mark>';
					}
					?>
				</td>
			</tr>
			<tr>
				<td data-export-label="PHP Post Max Size"><?php esc_html_e( 'PHP Post Max Size', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( esc_html__( 'The largest file size that can be contained in one post. Recommended 64 MB or more.', 'rife-free' ) ); ?></td>
				<td><?php
					$post_max_size = wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) );

					if ( $post_max_size < 33554432 ) {//32MB
						/* translators: %s: Post size limit value */
						echo '<mark class="warning"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%s - too low value for this setting might cause problems. Recommended 64MB or more.', 'rife-free' ), esc_html( size_format( $post_max_size ) ) ) . '</mark>';
					}
					else {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> ' . esc_html( size_format( $post_max_size ) ) . '</mark>';
					}
					?></td>
			</tr>
			<tr>
				<td data-export-label="Max Upload Size"><?php esc_html_e( 'Max Upload Size', 'rife-free' ); ?>:</td>
				<td class="help"><?php apollo13framework_input_help_tip( esc_html__( 'The largest file size that can be uploaded to your WordPress installation. Recommended 64 MB or more.', 'rife-free' ) ); ?></td>
				<td><?php
					$max_upload_size = wp_convert_hr_to_bytes( wp_max_upload_size() );

					if ( $max_upload_size < 33554432 ) {//32MB
						/* translators: %s: Max upload size limit value */
						echo '<mark class="warning"><span class="dashicons dashicons-warning"></span> ' . sprintf( esc_html__( '%s - too low value for this setting might cause problems. Recommended 64MB or more.', 'rife-free' ), esc_html( size_format( $max_upload_size ) ) ) . '</mark>';
					}
					else {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span> ' . esc_html( size_format( $max_upload_size ) ) . '</mark>';
					}
					?></td>
			</tr>
			</tbody>
		</table>
	</div>
	<?php
}



function apollo13framework_is_companion_plugin_ready($fail_message = false, $silent = false){
	global $apollo13framework_a13;
	return $apollo13framework_a13->is_companion_plugin_ready($fail_message, $silent);
}


function apollo13framework_apollo13_recommendations() {
	global $apollo13framework_a13;
	apollo13framework_theme_pages_header();
	?>
	<h2><?php echo esc_html__( 'Recommended Tools', 'rife-free' ); ?></h2>
	<p class="center"><?php echo esc_html__( 'Below you can find various tools that can improve your site and workflow. All of these tools we use in our websites and recommend them as great help!', 'rife-free' ); ?></p>
	<div class="tools-grid">
		<div class="tool">
			<a href="<?php echo esc_url('https://shortpixel.com/'); ?>" title="<?php echo esc_attr__( 'Shortpixel', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/shortpixel.png' ) ); ?>" alt="<?php echo esc_attr__( 'Shortpixel', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'Image optimization is one element that can cut off your page weight by 50 percent or more. Check this great plugin & service to achieve better results in no time.', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="https://apollo13themes.com/effective-image-optimization-makes-website-faster/">'.esc_html__( 'Read more details on our Blog', 'rife-free' ).'</a>';
				?></p>
		</div>

		<div class="tool">
			<a href="<?php echo esc_url('https://kinsta.com/'); ?>" title="<?php echo esc_attr__( 'Kinsta', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/kinsta.png' ) ); ?>" alt="<?php echo esc_attr__( 'Kinsta', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'Great speed with flawless support - a managed hosting for WordPress. In terms of speed, hosting is the first thing you have to upgrade to make your website fly!', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="https://apollo13themes.com/our-story-with-kinsta-hosting/">'.esc_html__( 'Read more details on our Blog', 'rife-free' ).'</a>';
				?></p>
		</div>

		<div class="tool">
			<a href="<?php echo esc_url('https://wordpress.org/plugins/autoptimize/'); ?>" title="<?php echo esc_attr__( 'Autoptimize', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/autoptimize.png' ) ); ?>" alt="<?php echo esc_attr__( 'Autoptimize', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'A lightweight plugin that can help you speed up your website by optimizing various assets.', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="https://apollo13themes.com/blog/">'.esc_html__( 'Read more details on our Blog', 'rife-free' ).'</a>';
				?></p>
		</div>

		<div class="tool">
			<a href="<?php echo esc_url('https://wpml.org/'); ?>" title="<?php echo esc_attr__( 'WPML', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/_wpml.png' ) ); ?>" alt="<?php echo esc_attr__( 'WPML', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'Releasing website in few languages is a lot of work. Use the WPML plugin to get much help with this.', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="'.esc_url( $apollo13framework_a13->get_docs_link('docs/translations/translating-site-with-wpml/' ) ).'">'.esc_html__( 'Read more details in the documentation.', 'rife-free' ).'</a>';
				?></p>
		</div>

		<div class="tool">
			<a href="<?php echo esc_url('https://elementor.com/pro/'); ?>" title="<?php echo esc_attr__( 'Elementor Pro', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/elementor.png' ) ); ?>" alt="<?php echo esc_attr__( 'Elementor Pro', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'You already know Elementor Page builder in its great free version. Support team behind it and get more cool widgets by upgrading to Pro version.', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="https://apollo13themes.com/basic-elementor-plugin-tricks/">'.esc_html__( 'Read more details on our Blog', 'rife-free' ).'</a>';
				?></p>
		</div>

		<div class="tool">
			<a href="<?php echo esc_url('https://apollo13themes.com/rife-elementor-extensions/'); ?>" title="<?php echo esc_attr__( 'Rife Elementor Extensions &amp; Templates', 'rife-free' ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/tools/_rife.png' ) ); ?>" alt="<?php echo esc_attr__( 'Rife Elementor Extensions &amp; Templates', 'rife-free' ); ?>" /></a>
			<p><?php echo esc_html__( 'If you are looking for more beautiful and Free templates for Elementor try our Templates pack. It also includes new Elementor widgets.', 'rife-free' ); ?></p>
			<p><?php
				echo '<a href="https://apollo13themes.com/free-elementor-templates/">'.esc_html__( 'Read more details on our Blog', 'rife-free' ).'</a>';
				?></p>
		</div>
	</div>

	<?php
	apollo13framework_theme_pages_footer();
}


<?php // Reset Settings

if (!defined('ABSPATH')) exit;

function disable_gutenberg_admin_notice() {
	
	$screen_id = disable_gutenberg_get_current_screen_id();
	
	if ($screen_id === 'settings_page_disable-gutenberg') {
		
		if (isset($_GET['reset-options'])) {
			
			if ($_GET['reset-options'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Default options restored.', 'disable-gutenberg'); ?></strong></p>
				</div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible">
					<p><strong><?php esc_html_e('No changes made to options.', 'disable-gutenberg'); ?></strong></p>
				</div>
				
			<?php endif;
			
		}
		
		if (!disable_gutenberg_check_date_expired() && !disable_gutenberg_dismiss_notice_check()) {
			
			?>
			
			<div class="notice notice-success">
				<p>
					<strong><?php esc_html_e('Plugin Sale:', 'disable-gutenberg'); ?></strong> 
					<?php esc_html_e('Save 20% on any of our', 'disable-gutenberg'); ?> 
					<a target="_blank" rel="noopener noreferrer" href="https://plugin-planet.com/"><?php esc_html_e('Pro WordPress plugins', 'disable-gutenberg'); ?></a>. 
					<?php esc_html_e('Apply code', 'disable-gutenberg'); ?> <code>PLANET2023</code> <?php esc_html_e('at checkout. Sale ends 9/9/23.', 'disable-gutenberg'); ?> 
					<?php echo disable_gutenberg_dismiss_notice_link(); ?>
				</p>
			</div>
			
			<?php
			
		}
		
	}
	
}

//

function disable_gutenberg_dismiss_notice_activate() {
	
	delete_option('disable-gutenberg-dismiss-notice');
	
}

function disable_gutenberg_dismiss_notice_version() {
	
	$version_current = DISABLE_GUTENBERG_VERSION;
	
	$version_previous = get_option('disable-gutenberg-dismiss-notice');
	
	$version_previous = ($version_previous) ? $version_previous : $version_current;
	
	if (version_compare($version_current, $version_previous, '>')) {
		
		delete_option('disable-gutenberg-dismiss-notice');
		
	}
	
}

function disable_gutenberg_dismiss_notice_check() {
	
	$check = get_option('disable-gutenberg-dismiss-notice');
	
	return ($check) ? true : false;
	
}

function disable_gutenberg_dismiss_notice_save() {
	
	if (isset($_GET['dismiss-notice-verify']) && wp_verify_nonce($_GET['dismiss-notice-verify'], 'disable_gutenberg_dismiss_notice')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$result = update_option('disable-gutenberg-dismiss-notice', DISABLE_GUTENBERG_VERSION, false);
		
		$result = $result ? 'true' : 'false';
		
		$location = admin_url('options-general.php?page=disable-gutenberg&dismiss-notice='. $result);
		
		wp_redirect($location);
		
		exit;
		
	}
	
}

function disable_gutenberg_dismiss_notice_link() {
	
	$nonce = wp_create_nonce('disable_gutenberg_dismiss_notice');
	
	$href  = add_query_arg(array('dismiss-notice-verify' => $nonce), admin_url('options-general.php?page=disable-gutenberg'));
	
	$label = esc_html__('Dismiss', 'disable-gutenberg');
	
	echo '<a class="disable-gutenberg-dismiss-notice" href="'. esc_url($href) .'">'. esc_html($label) .'</a>';
	
}

function disable_gutenberg_check_date_expired() {
	
	$expires = apply_filters('disable_gutenberg_check_date_expired', '2023-09-09');
	
	return (new DateTime() > new DateTime($expires)) ? true : false;
	
}

//

function disable_gutenberg_reset_options() {
	
	if (isset($_GET['reset-options-verify']) && wp_verify_nonce($_GET['reset-options-verify'], 'disable_gutenberg_reset_options')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$options_delete = delete_option('disable_gutenberg_options');
		
		$result = 'false';
		
		if ($options_delete) $result = 'true';
		
		$location = admin_url('options-general.php?page=disable-gutenberg&reset-options='. $result);
		
		wp_redirect($location);
		
		exit;
		
	}
	
}

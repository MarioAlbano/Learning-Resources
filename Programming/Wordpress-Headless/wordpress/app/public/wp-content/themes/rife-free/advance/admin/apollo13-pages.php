<?php
function apollo13framework_apollo13_info() {
	apollo13framework_theme_pages_header();

	global $apollo13framework_a13;

	echo '<h2>'.esc_html__( 'Thanks for using Rife Free!', 'rife-free' ).'</h2>';
	echo '<p>'.esc_html__( 'We are glad that you have decided to test & use our Rife Free theme. We hope it will help you with making your site beautiful!', 'rife-free').'</p>';
	echo '<p>'.esc_html__( 'If you are looking for even more features or Designs, you can always try Rife Pro version.', 'rife-free' ).
	     ' <a href="'.esc_url( admin_url( 'themes.php?page=apollo13_pages&amp;subpage=rife_pro') ).'">'.esc_html__( 'Get more details in Rife Pro tab.', 'rife-free').'</a>'.
	     '</p>';

	echo '<h2>'.esc_html__( 'What\'s next?', 'rife-free' ).'</h2>';
	//check for companion plugin
	if( apollo13framework_is_companion_plugin_ready( esc_html__( 'Some features(like Albums, Works, shortcodes, plugins support) of the Theme requires an additional plugin before you will be able to use it. ', 'rife-free' ) ) ){
		echo '<p>'.esc_html__( 'You can check out what is new in the Changelog or just move on with your usual work.', 'rife-free' ).
		     ' <a href="https://www.apollo13.eu/themes_update/apollo13_framework_theme/index.html#change-log">'.esc_html__( 'Visit the Changelog', 'rife-free').'</a>'.
		     '</p>';

		echo '<p>'.esc_html__( 'If you have fresh installation then it would be good time to import one of our designs.', 'rife-free' ).
		     ' <a class="button" href="'.esc_url( admin_url( 'themes.php?page=apollo13_pages&amp;subpage=import' ) ).'">'.esc_html__( 'Go to Design Importer', 'rife-free').'</a>'.
		     '</p>';

		echo '<p>'.esc_html__( 'If you have an existing website, then you can start from scratch by changing theme options.', 'rife-free' ).
		     ' <a class="button" href="'.esc_url( admin_url( 'customize.php') ).'">'.esc_html__( 'Go to Customizer', 'rife-free').'</a>'.
		     '</p>';

		echo '<p>'.esc_html__( 'If you have an existing website, you can also try to import one of our designs to speed up your work. You will have to do it without demo data.', 'rife-free' ).
		     ' <a href="'.esc_url( $apollo13framework_a13->get_docs_link('importer-configuration') ).'">'.esc_html__( 'How to do it is explained in the documentation here.', 'rife-free').'</a>'.
		     '</p>';
	}

	apollo13framework_theme_pages_footer();
}

function apollo13framework_apollo13_import() {
	apollo13framework_theme_pages_header();

	if(apollo13framework_is_companion_plugin_ready()){
		do_action('apollo13framework_apollo13_importer_page_content');
	}

	apollo13framework_theme_pages_footer();
}

function apollo13framework_apollo13_export() {
	apollo13framework_theme_pages_header();
	if(apollo13framework_is_companion_plugin_ready()){
		do_action('apollo13framework_apollo13_exporter_page_content');
	}

	apollo13framework_theme_pages_footer();
}

function apollo13framework_apollo13_help() {
	apollo13framework_theme_pages_header();
	global $apollo13framework_a13;
	?>

	<h2><?php echo esc_html__( 'Where to get help?', 'rife-free' ); ?></h2>

	<h3 class="center"><a href="<?php echo esc_url($apollo13framework_a13->get_docs_link()); ?>"><?php echo esc_html__( 'Online Documentation', 'rife-free' ); ?></a></h3>
	<p><?php echo
		esc_html__( 'Online documentation is always most up to date if it comes to explaining how to work with the theme. It will come handy as the first source when you trying to work out problematic topics.', 'rife-free' );
		?></p>

	<h3 class="center"><a href="https://apollo13themes.com/rife/tutorials/"><?php echo esc_html__( 'Video Tutorials', 'rife-free' ); ?></a></h3>
	<p><?php
		echo esc_html__( 'We have prepared some basics tutorials on how to work with the theme.', 'rife-free' );
		?></p>
	<p><?php
		echo esc_html__( 'We are planning to do more, but if you have idea for subject that we should cover in next tutorials, please let us know.', 'rife-free' );
		?></p>

	<h3 class="center"><a href="https://support.apollo13.eu/"><?php echo esc_html__( 'Support Forum', 'rife-free' ); ?></a>(<?php echo esc_html__( 'Rife Pro', 'rife-free' ); ?>)</h3>
	<p><?php
		echo esc_html__( 'If you have question about how something works, or you feel like you have found bug please come to our support forum! It is the best place, where we can work together to solve issues and explain various topics.', 'rife-free' );
		?></p>
	<p><?php
		echo esc_html__( 'To access forum you will need your license code.', 'rife-free' ).
			' <a href="'.esc_url( $apollo13framework_a13->get_docs_link('license-code') ).'" target="_blank">'.esc_html__( 'Where to find your code?', 'rife-free' ).'</a>';
		?></p>
	<p><?php echo esc_html__( 'We understand that most of our customers are not developers(programmers), that is why we will also help you with issues caused by other components (plugins for example) and we will provide you instructions to help fixing issues, even if it is not directly related to our theme.', 'rife-free' ); ?></p>
	<p><?php echo sprintf(
			/* translators: %1$s: Rife Free */
			esc_html__( '%1$s users can access our support forum in read mode and check if their issue was not explained or solved there. Read mode is available for anyone :-)', 'rife-free' ),
			'<strong>Rife Free</strong>'
		); ?></p>

	<h3 class="center"><a href="https://wordpress.org/support/theme/rife-free"><?php echo esc_html__( 'Community Support', 'rife-free' ); ?></a>(<?php echo esc_html__( 'Rife Free', 'rife-free' ); ?>)</h3>
	<p><?php
		echo esc_html__( 'To get support for Rife Free we invite you to visit community support forum on WordPress.org theme repository. We also are monitoring this forum, however, priority support is provided for Rife Pro users, so we might not be available.', 'rife-free' );
		?></p>

	<h3 class="center"><a href="https://apollo13themes.com/contact/"><?php echo esc_html__( 'Contact Apollo13Themes', 'rife-free' ); ?></a></h3>
	<p><?php
		echo '<a href="https://apollo13themes.com/contact/">'.esc_html__( 'Just come and say hi :-)', 'rife-free').'</a>'
		?></p>

	<h2><?php echo esc_html__( 'Changelog', 'rife-free' ); ?></h2>
	<h3 class="center"><a href="https://www.apollo13.eu/themes_update/apollo13_framework_theme/index.html#change-log"><?php echo esc_html__( 'Visit the Changelog', 'rife-free' ); ?></a></h3>

	<h2><?php echo esc_html__( 'Theme requirements:', 'rife-free' ); ?></h2>
	<div class="feature-section one-col">
		<div class="col">
			<?php apollo13framework_theme_requirements_table(); ?>
		</div>
	</div>

	<?php
	apollo13framework_theme_pages_footer();
}

function apollo13framework_apollo13_rife_pro() {
	apollo13framework_theme_pages_header();
	global $apollo13framework_a13;
	?>
	<h2><?php echo esc_html__( 'Rife Pro', 'rife-free' ); ?></h2>

	<h3 class="center"><a href="<?php echo esc_url('https://apollo13themes.com/rife/features/'); ?>"><?php echo esc_html__( 'More features', 'rife-free' ); ?></a></h3>
	<p><?php echo esc_html__( 'In Pro version of Rife theme, you get access to much more features, that can help make your page more useful & beautiful.', 'rife-free' ); ?></p>
	<p><?php
		echo '<a href="https://apollo13themes.com/rife/features/">'.esc_html__( 'Check what we have in stock here on features page.', 'rife-free' ).'</a>';
		?></p>

	<h3 class="center"><a href="<?php echo esc_url('https://apollo13themes.com/rife/designs/'); ?>"><?php echo esc_html__( 'More Designs!', 'rife-free' ); ?></a></h3>
	<p><?php echo esc_html__( 'Each month we are adding new beautiful designs that you can use on sites that you build. Designs target various niches & also general purpose pages.', 'rife-free' ); ?></p>
	<p><?php
		echo '<a href="https://apollo13themes.com/rife/designs/">'.esc_html__( 'Check what you can use for your site on designs page.', 'rife-free' ).'</a>';
		?></p>

	<h3 class="center"><?php echo esc_html__( 'Premium Support', 'rife-free' ); ?></h3>
	<p><?php echo esc_html__( 'For Rife Pro users we offer premium support, which means we can help you more closely & faster with issues that you may encounter.', 'rife-free' ); ?></p>
	<p><?php
		echo '<a href="'.esc_url( $apollo13framework_a13->get_docs_link('support-forum' ) ).'">'.esc_html__( 'You can read more about it in the documentation.', 'rife-free' ).'</a>';
		?></p>

	<h2><a href="<?php echo esc_url('https://apollo13themes.com/rife/pricing/'); ?>"><?php echo esc_html__( 'Try Rife Pro', 'rife-free' ); ?></a></h2>

	<?php
	apollo13framework_theme_pages_footer();
}

function apollo13framework_theme_pages_header(){
	if(!current_user_can('install_plugins')){
		wp_die(esc_html__('Sorry, you are not allowed to access this page.', 'rife-free'));
	}
	$pages = array(
		'info' => esc_html__( 'Info', 'rife-free' ),
		'import' => esc_html__( 'Design Importer', 'rife-free' ),
		'export' => esc_html__( 'Export', 'rife-free' ),
		'help' => esc_html__( 'Get Help', 'rife-free' ),
		'rife_pro' => esc_html__( 'Rife Pro', 'rife-free' ),
		'recommendations' => esc_html__( 'Recommended Tools', 'rife-free' ),
	);

	//check for current tab
	$current_subpage = isset( $_GET['subpage'] ) ? sanitize_text_field( wp_unslash( $_GET['subpage'] ) ) : 'info';
?>
<div class="wrap apollo13-page <?php echo esc_attr( $current_subpage ); ?> about-wrap">
	<h1><?php
		/* translators: %s: Theme name */
		echo sprintf( esc_html__( 'Welcome to %s Theme', 'rife-free' ), esc_html( A13FRAMEWORK_OPTIONS_NAME_PART ) );
		?></h1>

	<div class="about-text">
		<?php echo esc_html__( 'On these pages you can get info what is new, import designs and get help if you will ever need it.', 'rife-free' ); ?><br />
		<?php echo esc_html__( 'Thanks for being with us!', 'rife-free' ); ?>
		<p class="socials"><a class="on-twitter" href="https://twitter.com/apollo13themes" target="_blank"><?php echo esc_html__( 'Apollo13Themes on Twitter', 'rife-free' ); ?></a></p>
	</div>
	<div class="wp-badge"><?php echo esc_html__( 'Version', 'rife-free' ).' '.esc_html( A13FRAMEWORK_THEME_VERSION ); ?></div>
	<h2 class="nav-tab-wrapper wp-clearfix">
		<?php
		foreach($pages as $subpage => $title){
			$query_args = array(
				'page' => 'apollo13_pages',
				'subpage' => $subpage
			);

			$is_current = $current_subpage === $subpage;

			echo '<a href="'.esc_url( add_query_arg( $query_args, admin_url( 'themes.php') ) ).'" class="nav-tab'.esc_attr( $is_current ? ' nav-tab-active' : '').'">'.esc_html( $title ).'</a>';
		}
		?>
	</h2>
	<?php
}

function apollo13framework_theme_pages_footer(){
	echo '</div>';
}

function apollo13framework_importer_grid_item($files_directory, $demo ){
	$current_item_categories = '';
	foreach ( $demo['categories'] as $category ) {
		$current_item_categories .= str_replace( ' ', '_', strtolower( $category ) ) . ' ';
	}

	echo '<div class="demo_grid_item" '.
	     'data-main_category="' . esc_attr( str_replace( ' ', '_', strtolower( implode( '|', $demo['categories'] ) ) ) ) . '" '.
	     'data-categories="' . esc_attr( $current_item_categories . ' ' . strtolower( $demo['name'] ) ) . '"'.
	     'data-full="' . esc_url( $files_directory . 'full.jpg' ) . '"'.
	     'data-id="' . esc_attr( $demo['id'] ) . '"'.
	     'data-name="' . esc_attr( $demo['name'] ) . '"'.
	     '>';
	echo '<div>';
	echo '<img class="thumb" src="' . esc_url( $files_directory . 'thumb.jpg' ).'">';
	echo '<div class="demo_grid_item_title" style="'. esc_attr( 'background-color:'.$demo['background'].';color:'.$demo['font_color'].';' ) .'">' . esc_html( implode( ' ', $demo['categories'] ) ) . '</div>';

	echo '<div class="action-bar">';
		echo '<a class="button demo-preview" href="' . esc_url( $demo['demo_url'] ) . '" target="_blank">' .
		     esc_html__( 'Live preview', 'rife-free' ) . '</a>'.
		     '<span class="a13_demo_name">' . esc_html( $demo['name'] ) .'</span>';
	if( in_array( 'pro', array_map( 'strtolower', $demo['categories'] ) ) ){
		$query_args = array(
			'page' => 'apollo13_pages',
			'subpage' => 'rife_pro'
		);

		echo '<a href="'.esc_url( add_query_arg( $query_args, admin_url( 'themes.php') ) ).'" class="try-button button button-primary">'.esc_html__( 'Try Rife Pro', 'rife-free' ).'</a>';
	}
	else{
		echo '<button class="button button-primary demo-select" data-demo-id="' . esc_attr( $demo['id'] ) . '">' . esc_html__( 'Choose & move to next step', 'rife-free' ) . '</button>';
	}
	echo '</div>';//end .action-bar

	echo '</div>';//end .demo_grid_item > div
	echo '</div>';//end .demo_grid_item
}

<?php

class Apollo13Framework_Rifef {
	function __construct(){


		//get Rife Universal first so it could fire its actions first
		/** @noinspection PhpIncludeInspection */
		require_once( get_theme_file_path( 'advance/rife_uni.php' ));
		add_action( 'customize_register', array( $this, 'customizer_pro_section' ) );

		if(is_admin()){
			//check on what page we are
			$current_page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
			$current_subpage = isset( $_GET['subpage'] ) ? sanitize_text_field( wp_unslash( $_GET['subpage'] ) ) : '';

			//always registered in admin
			add_filter( 'apollo13framework_is_import_allowed', array( $this, 'is_import_allowed' ) );
			add_action( 'apollo13framework_after_designs_list', array( $this, 'more_designs_info' ) );
			add_action( 'apollo13framework_theme_notices', array( $this, 'rating_notice' ) );
			add_action( 'init', array( $this, 'import_notice_check' ), 9 );

			//only for import design page
			if( $current_page === 'apollo13_pages' && $current_subpage === 'import' ){
				add_action( 'admin_enqueue_scripts', array( $this, 'designs_import_inline_style' ), 28 );
			}
		}
	}

	function is_import_allowed(){
		return true;
	}


	function more_designs_info(){
		echo '<p>'.esc_html__( 'Faded out Designs are available only in Rife Pro. You can preview them from here by clicking on each Design and then using "Live preview" button.', 'rife-free' ).'</p>';
	}


	function designs_import_inline_style(){
		$css = '
.demo_grid_item[data-categories~=pro] img{
    opacity: .2;
	transition: opacity 0.3s ease;
}
.demo_grid_item[data-categories~=pro]:hover img{
    opacity: 1;
}
.demo_grid_item.open img{
    opacity: 1;
	transition: none;
}
.top_bar_button.try-button {
    right: 20px;
}';
		wp_add_inline_style( 'apollo13framework-admin-css', apollo13framework_minify_css( $css ) );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizer_pro_section( $manager ) {

		// Load custom section.
		require_once( get_theme_file_path( 'advance/inc/customizer/sections/class-a13-customize-section-pro.php' ) );

		// Register custom section types.
		$manager->register_section_type( 'A13_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new A13_Customize_Section_Pro(
				$manager,
				'rife-pro-theme',
				array(
					'title'    => esc_html__( 'Try Rife Pro', 'rife-free' ),
					'pro_text' => esc_html__( 'Rife Pro',         'rife-free' ),
					'pro_url'  => 'https://apollo13themes.com/rife/',
					'priority' => 0
				)
			)
		);
	}

	function rating_notice(){
		//check priviliges
		if(!current_user_can('switch_themes')){
			return;
		}

		$display_rating_notice = true;
		$option_name = 'a13_'.A13FRAMEWORK_TPL_SLUG.'_rating';
		$rating_option = get_option( $option_name );

		if($rating_option !== false){
			//we have date saved
			if($rating_option !== 'disabled'){
				$now = time();
				//days that passed since last time we displayed rating notice
				$days = floor(($now - $rating_option) / (60 * 60 * 24));

				//less then 2 weeks?
				if($days < 14){
					$display_rating_notice = false;
				}
			}
			//message have been disabled
			else{
				$display_rating_notice = false;
			}
		}
		//they have just installed theme, lets give them a week before asking for rating
		else{
			update_option( $option_name, time() );
			$display_rating_notice = false;
		}

		if($display_rating_notice){
			echo '<div class="notice notice-info is-dismissible rating-notice">';

			//text
			echo '<p>'.esc_html__( 'Thank you for using our Rife Free theme, we hope everything is working good for you.', 'rife-free' ).'</p>';
			echo '<p>'.esc_html__( 'If you have a spare 2 minutes please rate our Rife Free theme. If not, no big deal, just keep on rocking :-)', 'rife-free' ).'</p>';
			echo '<p>'.esc_html__( 'Daniel &amp; Air. from Apollo13Themes.', 'rife-free' ).'</p>';

			//links
			echo '<p class="links">';

			echo '<a href="https://wordpress.org/support/theme/rife-free/reviews/#new-post" target="_blank">'.esc_html__( 'Rate Rife Free', 'rife-free' ).'</a> | ';
			/** @noinspection HtmlUnknownAnchorTarget */
			echo '<a href="#remind-later" target="_blank">'.esc_html__( 'Maybe later&#8230;(hide for 7 days)', 'rife-free' ).'</a> | ';
			/** @noinspection HtmlUnknownAnchorTarget */
			echo '<a href="#disable-rating" target="_blank">'.esc_html__( 'Do not show this notification again', 'rife-free' ).' <i class="fa fa-times" aria-hidden="true"></i></a>';

			echo '</p>';

			echo '</div>';
		}
	}

	function import_notice_check(){
		$plugin_path = 'apollo13-framework-extensions/apollo13-framework-extensions.php';

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( is_plugin_active( $plugin_path ) ){
			return;
		}

		if( !apollo13framework_is_admin_notice_active( 'fresh_import' ) ){
			return;
		}

		remove_action('tgmpa_register', 'apollo13framework_register_required_plugins');
		add_action( 'apollo13framework_theme_notices', array( $this, 'import_notice' ) );
	}

	function import_notice(){
		echo '<div class="a13fe-admin-notice notice notice-warning is-dismissible" data-notice_id="fresh_import">';
		/* translators: %s: Theme name */
		echo '<h3>'.sprintf( esc_html__( 'Welcome to %s Theme', 'rife-free' ), esc_html(A13FRAMEWORK_OPTIONS_NAME_PART )).'</h3>';
		echo '<p>'.esc_html__( 'If you have fresh installation then it would be good time to import one of our designs.', 'rife-free' ).'</p>';
		echo '<p><a class="button button-primary" href="'.esc_url( admin_url( 'themes.php?page=apollo13_pages&amp;subpage=import' ) ).'">'.esc_html__( 'Go to Design Importer', 'rife-free').'</a></p>';
		echo '</div>';
	}
}

//run
new Apollo13Framework_Rifef();
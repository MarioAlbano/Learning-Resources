<?php
/*
 * JS Params added in admin area
 */
if(!function_exists('apollo13framework_admin_js_parameters')){
    function apollo13framework_admin_js_parameters(){
        global $apollo13framework_a13;
        //notification message
        $params['messages']['duplicate_nava_anchors'] = esc_html__( 'There are rows in content with identical "Navigation anchor title" parameter, which has to be unique for each item. Please fix it by editing row parameters. Duplicated titles are:', 'rife-free' );
        $params['messages']['confirm_delete_nava'] = esc_html__( 'Do You want to delete selected One Page Navigation Pointer?', 'rife-free' );

        //get all nava
        //only to have nava names to produce verbose message in case of nava duplication
        $params['nava'] = array();
        $args = array( 'numberposts' => -1, "post_type" => 'nava');
        $posts = get_posts($args);
        foreach( $posts as $post ){
            $params['nava'][$post->ID] = $post->post_title;
        }

        $params['ajaxurl'] = admin_url( 'admin-ajax.php' );
        $params['input_prefix'] = A13FRAMEWORK_INPUT_PREFIX;
        $required_arrays = $apollo13framework_a13->get_meta_required_array();
        $params['list_of_requirements'] = $required_arrays[0];
        $params['list_of_dependent'] = $required_arrays[1];

        //options transferred to js files
        return $params;
    }
}

if(!function_exists('apollo13framework_admin_head')){
	/**
	 * Register Scripts and styles added in admin area
	 */
    function apollo13framework_admin_head(){
        // color picker
        wp_register_script('jquery-wheelcolorpicker', get_theme_file_uri( 'js/jquery-wheelcolorpicker/jquery.wheelcolorpicker.min.js' ), array('jquery'), '3.0.5' );

        wp_register_script( 'apollo13framework-isotope', get_theme_file_uri( 'js/isotope.pkgd.min.js' ), array('jquery'), '3.0.6', true);

        //main admin scripts
        wp_register_script('apollo13framework-admin', get_theme_file_uri( 'js/admin-script.js' ),
            array(
                'jquery',   //dom operation
                'apollo13framework-isotope',
	            'jquery-wheelcolorpicker', //color picker
                'jquery-ui-slider', //slider for font-size setting
                'jquery-ui-sortable' //sortable meta
            ),
            A13FRAMEWORK_THEME_VERSION
        );

        wp_register_style( 'apollo13framework-font-awesome', get_theme_file_uri( 'css/font-awesome.min.css' ), false, '4.7.0');
        wp_register_style( 'apollo13framework-admin-css', get_theme_file_uri( 'css/admin-css.css' ), array('apollo13framework-font-awesome'), A13FRAMEWORK_THEME_VERSION, 'all' );

        //editor
        add_editor_style( 'css/editor-style.css' );
    }
}
add_action( 'admin_init', 'apollo13framework_admin_head' );


if(!function_exists('apollo13framework_admin_scripts')){
    /**
     * Use scripts and styles only on specific pages
     *
     * @param string $hook The current admin page.
     */
    function apollo13framework_admin_scripts($hook){
        $admin_pages = array(
            'appearance_page_apollo13_pages',
            'post-new.php',
            'post.php',
            'nav-menus.php',
            'widgets.php',
        );

        //used everywhere
        wp_enqueue_style( 'apollo13framework-admin-css' );
        wp_enqueue_script('apollo13framework-admin');

        $apollo_params = apollo13framework_admin_js_parameters();
        wp_localize_script( 'apollo13framework-admin', 'ApolloParams', $apollo_params );


        //load only when needed
        if( in_array( $hook, $admin_pages ) ){

            //styles for uploading window
            wp_enqueue_style('thickbox');

            //some styling for admin options
            wp_enqueue_style( 'jquery-wheelcolorpicker', get_theme_file_uri( 'js/jquery-wheelcolorpicker/css/wheelcolorpicker.css' ), false, '3.0.5', 'all' );
            wp_enqueue_style( 'apollo13framework-jquery-ui', get_theme_file_uri( 'css/ui-lightness/jquery-ui-1.10.4.custom.css' ), false, A13FRAMEWORK_THEME_VERSION, 'all'  );
            wp_enqueue_style( 'apollo13framework-admin-css', get_theme_file_uri( 'css/admin-css.css' ), false, A13FRAMEWORK_THEME_VERSION, 'all' );


            wp_enqueue_media();
        }
    }
}
add_action( 'admin_enqueue_scripts', 'apollo13framework_admin_scripts');


if(!function_exists('apollo13framework_admin_pages')){
	/**
	 * Adds menu with settings for theme
	 */
    function apollo13framework_admin_pages() {
        /* translators: %s: Theme name */
        $temp = sprintf( esc_html__( '%s Import &amp; Info', 'rife-free' ), A13FRAMEWORK_OPTIONS_NAME_PART);
        add_theme_page( $temp,  $temp, 'manage_options', 'apollo13_pages', 'apollo13framework_apollo13_pages');
    }
}
add_action( 'admin_menu', 'apollo13framework_admin_pages' );



/**
 * Prints code on admin footer action
 * In this case it is font icon chooser
 */
function apollo13framework_admin_footer() {
    if( defined( 'WPB_VC_VERSION' ) ){
        //remove conflicting styles from VC plugin
        global $wp_styles;

        if(isset($wp_styles->registered['font-awesome'])){
            $wp_styles->registered['font-awesome']->src = get_theme_file_uri( 'css/font-awesome.min.css' );
            $wp_styles->registered['font-awesome']->ver = '4.7.0';
        }
    }

    echo '<div id="a13-fa-icons"><input type="search" value="" placeholder="'.esc_attr__( 'Start typing to filter icons', 'rife-free' ).'" /> ';
    /** @noinspection PhpIncludeInspection */
    $classes = require_once(get_theme_file_path( 'advance/inc/font-awesome-icons' ));
    foreach($classes as $name){
        $name = trim($name);
        echo '<span class="a13-font-icon fa fa-'.esc_attr( $name ).'" title="'.esc_attr( $name ).'"></span>'."\n";
    }
    echo '</div>';
}
add_action( 'admin_footer', 'apollo13framework_admin_footer');



function apollo13framework_is_admin_notice_active($id){
    $notices = get_option('a13_'.A13FRAMEWORK_TPL_SLUG.'_ajax_notices');

    if($notices === false){
        return true; //no track of any notice so it should be active
    }

    return !array_key_exists($id, $notices);
}





/**
 * Checks for proper names of templates since 1.5.2 as some were renamed. It works while editing page
 */
function apollo13framework_check_for_proper_page_template_name($dropdown_args){
    global $post;

    //make sure we use up to date template name
    $post->page_template = apollo13framework_proper_page_template_name($post->page_template);

    //don't change anything for this filter
    return $dropdown_args;
}
//dirty to add it here, but it is best that WordPress give us ATM
add_filter( 'page_attributes_dropdown_pages_args', 'apollo13framework_check_for_proper_page_template_name' );



add_action( 'wp_ajax_apollo13framework_disable_ajax_notice', 'apollo13framework_disable_ajax_notice' );

/**
 * Mark notice to be displayed later or disabled
 */
function apollo13framework_disable_ajax_notice() {
	$id = isset( $_POST['notice_id'] )? sanitize_text_field( wp_unslash( $_POST['notice_id'] ) ) : '';
	$option_name = 'a13_'.A13FRAMEWORK_TPL_SLUG.'_ajax_notices';

	//get notices
	$current_notices = get_option($option_name);
	//update mentioned notice
	$current_notices[$id] = 0;

	//save
	update_option($option_name, $current_notices);

	die(); // this is required to return a proper result
}



/* rating notice */
add_action( 'wp_ajax_apollo13framework_rating_notice_action', 'apollo13framework_rating_notice_action' );

/**
 * Mark rating notice to be displayed later or disabled
 */
function apollo13framework_rating_notice_action() {
    //check priviliges
    if(!current_user_can('switch_themes')){
        wp_die( esc_html__('Sorry, you are not allowed to access this page.', 'rife-free'), esc_html__('Something went wrong.', 'rife-free'), 403 );
    }

	$what_to_do = isset( $_POST['what'] ) ? sanitize_text_field( wp_unslash( $_POST['what'] ) ) : '';
	$new_value  = '';

	if( $what_to_do === 'remind-later' ){
		$new_value = time();
	}
	elseif( $what_to_do === 'disable-rating' ){
		$new_value = 'disabled';
	}

	update_option( 'a13_' . A13FRAMEWORK_TPL_SLUG . '_rating', $new_value );

	echo esc_html( $what_to_do );

	die(); // this is required to return a proper result
}
<?php
/**
 * Template used for displaying password protected page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


global $apollo13framework_a13;


//custom template
if($apollo13framework_a13->get_option( 'page_password_template_type' ) === 'custom' ){
	$_page = $apollo13framework_a13->get_option( 'page_password_template' );

	if( !defined( 'A13FRAMEWORK_CUSTOM_PASSWORD_PROTECTED' ) ){
		define('A13FRAMEWORK_CUSTOM_PASSWORD_PROTECTED', true );
	}

	//make query
	$query = new WP_Query( array('page_id' => $_page ) );

	//add password form to content
	add_filter( 'the_content', 'apollo13framework_add_password_form_to_template' );

	//show
	apollo13framework_page_like_content($query);

	// Reset Post Data
	wp_reset_postdata();

	return;
}

//default template
else{
	define('A13FRAMEWORK_PASSWORD_PROTECTED', true); //to get proper class in body

	$_title = '<span class="fa fa-lock emblem"></span>' . esc_html__( 'This content is password protected.', 'rife-free' )
	         .'<br />'
	         .esc_html__( 'To view it please enter your password below', 'rife-free' );

	get_header();

	apollo13framework_title_bar( 'outside', $_title );

	echo apollo13framework_password_form();//escaped on creation

	get_footer();
}
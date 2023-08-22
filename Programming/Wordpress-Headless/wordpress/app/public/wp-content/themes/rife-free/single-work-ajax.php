<?php
/**
 * The Template for displaying work items when displayed in lightbox.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13framework_a13;

the_post();

if(post_password_required()){
	echo '<p>'.esc_html_e( 'To view it please enter your password below', 'rife-free' ).'</p>';
	echo apollo13framework_password_form();//escaped on creation
}
else{
	//main title
	echo '<h1 class="page-title">'.esc_html(get_the_title()).'</h1>';

	//subtitle
	$subtitle = $apollo13framework_a13->get_meta('_subtitle');
	if(strlen($subtitle)){
		echo '<h2 class="subtitle">'.esc_html($subtitle).'</h2>';
	}

	// Disable default placement of addtoany widget but only in works
	remove_filter( 'the_content', 'A2A_SHARE_SAVE_add_to_content', 98 );

	$theme           = 'slider';//for ajax loading we move images to slider always
	$_id              = get_the_ID();
	$show_desc      = get_post_meta( $_id, '_enable_desc', true);
	$is_text_content = strlen( $post->post_content ) > 0;


	$title_color    = get_post_meta( $_id, '_slide_title_bg_color', true );
	$title_color    = ( $title_color === '' || $title_color === false || $title_color === 'transparent' ) ? '' : $title_color;
	$thumbs         = $apollo13framework_a13->get_meta( '_thumbs' );
	$thumbs_on_load = $apollo13framework_a13->get_meta( '_thumbs_on_load' );
	$ken_scale      = $apollo13framework_a13->get_meta( '_ken_scale' );

	$slider_opts = array(
		'autoplay'             => $apollo13framework_a13->get_meta( '_autoplay' ),
		'transition'            => $apollo13framework_a13->get_meta( '_transition' ),
		'fit_variant'           => $apollo13framework_a13->get_meta( '_fit_variant' ),
		'pattern'               => $apollo13framework_a13->get_meta( '_pattern' ),
		'gradient'              => $apollo13framework_a13->get_meta( '_gradient' ),
		'ken_burns_scale'       => strlen($ken_scale) ? $ken_scale : 120,
		'texts'                 => $show_desc,
		'title_color'           => $title_color,
		'transition_time'       => $apollo13framework_a13->get_option( 'work_slider_transition_time' ),
		'slide_interval'        => $apollo13framework_a13->get_option( 'work_slider_slide_interval' ),
		'thumbs'                => $thumbs,
		'thumbs_on_load'        => $thumbs_on_load,
		'socials'               => 'off'
	);

	apollo13framework_make_slider($slider_opts);
	apollo13framework_single_work_text_content($is_text_content);
	apollo13framework_similar_works();
}
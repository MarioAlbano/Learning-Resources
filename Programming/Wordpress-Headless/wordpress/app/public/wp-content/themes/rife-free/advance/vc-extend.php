<?php
/**
 * functions that are used for post grid in WPBakery Page builder
 * They are deprecated @since 1.6 as theme now have own shortcodes for post grids that uses theme features
 */

function vc_gitem_template_attribute_a13_team_member_socials( $value, $data ) {
	global $post;
	global $apollo13framework_a13;

	extract( array_merge( array(
		'post' => null,
	), $data ) );
	$all_meta    = get_post_meta( $post->ID );
	$tmp_socials = array();
	$socials_list = $apollo13framework_a13->get_social_icons_list('empty');

	foreach( $socials_list as $id=>$social){
		$socials_list[$id] = isset($all_meta['_'.$id][0]) ? $all_meta['_'.$id][0] : '';
	}
	return apollo13framework_social_icons( $apollo13framework_a13->get_option( 'people_socials_color' ), $apollo13framework_a13->get_option( 'people_socials_color_hover' ), $socials_list );
}

function vc_gitem_template_attribute_a13_post_body( $value, $data ) {
	global $post;
	global $apollo13framework_a13;

	extract( array_merge( array(
			'post' => null,
	), $data ) );
	$html                   = '';
	$posts_layout_class = $apollo13framework_a13->get_option( 'blog_post_look');
	$posts_classes = 'posts_'.$posts_layout_class;

	$html .= '<div class="'.$posts_classes.'">';


	$posts_layout_class     = $apollo13framework_a13->get_option( 'blog_post_look' );
	$special_post_formats   = array( 'link', 'status', 'quote', 'chat' );
	$post_format            = get_post_format( $post->ID );
	$is_special_post_format = ( in_array( $post_format, $special_post_formats ) );
	$post_classes           = $is_special_post_format ? array('archive-item post', 'special-post-format') : array('archive-item post');
	$link_it                = $is_special_post_format ? false : true;
	$html .= '<div class="' . implode(' ', get_post_class( $post_classes ) ) . '" >';


	if ( post_password_required( $post->ID ) ) {

		$html .= '<div class="formatter">';
		$html .= '<h2 class="post-title"><a href="' . esc_url( get_the_permalink( $post->ID ) ) . '"><span class="fa fa-lock"></span>' . esc_html__( 'This content is password protected', 'rife-free' ) . '</a></h2>';
		$html .= '<div class="real-content">';
		$html .= '<p>' . esc_html__( 'To view it please enter your password below', 'rife-free' ) . '</p>';
		$html .= apollo13framework_password_form();
		$html .= '</div>';
		$html .= '</div>';

	} else {
		//classic layout of post
		$html .= apollo13framework_get_top_image_video( $link_it );

		ob_start();
		get_template_part( 'content', $post_format );
		$html .= ob_get_contents();
		ob_end_clean();


		if ( $posts_layout_class === 'horizontal' ) {
			$html .= '<div class="clear"></div>';
		}
	}


	$html .= '</div>';
	$html .= '</div>';

	return $html;
}

function vc_gitem_template_attribute_a13_work_body( $value, $data ) {
	/** @noinspection PhpUnusedLocalVariableInspection */
	global $post; /* is is used in extract */

	extract( array_merge( array(
		'post' => null,
	), $data ) );


	$html = '<div class="post-grid-bricks-frame' . esc_attr( apollo13framework_works_list_look_classes(1) ) . '">';
	$html .= apollo13framework_works_list_item(false, 'wpbakery');
	$html .= '</div>';

	return $html;
}

function vc_gitem_template_attribute_a13_album_body( $value, $data ) {
	/** @noinspection PhpUnusedLocalVariableInspection */
	global $post; /* is is used in extract */

	extract( array_merge( array(
		'post' => null,
	), $data ) );


	$html = '<div class="post-grid-bricks-frame' . esc_attr( apollo13framework_albums_list_look_classes(1) ) . '">';
	$html .= apollo13framework_albums_list_item(false, 'wpbakery');
	$html .= '</div>';

	return $html;
}

function vc_a13_post_meta_1_render() {
	return '<div class="a13_post_meta_data">{{ post_data:post_date }} | {{ a13_post_categories }}</div>';
}
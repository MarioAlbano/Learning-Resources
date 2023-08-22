<?php
/**
 * The Template for displaying front-page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( get_option( 'show_on_front' ) === 'posts' ) {
	get_template_part( 'index' );
} else {
	global $apollo13framework_a13;
	$fp_variant = $apollo13framework_a13->get_option( 'fp_variant' );

	if ( $fp_variant == 'page' ) {
		//it makes use of real page templates instead of front-page.php
		$page_template = basename( get_page_template(), '.php' );
		//below check is incorrect in WordPress 4.8, but might be true in older WP versions
		//now $page_template will never return "page.php" or "front-page"
		//however it works proper so lets keep it for few versions
		if ( $page_template !== 'page.php' && $page_template !== 'front-page' ) {
			get_template_part( $page_template );
		} else {
			get_template_part( 'page' );
		}
	}
	elseif ( $fp_variant == 'blog' ) {
		global $wp_query;

		//fix for front page pagination
		if ( get_query_var( 'paged' ) ) {
			$_paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$_paged = get_query_var( 'page' );
		} else {
			$_paged = 1;
		}

		$args = array(
			'post_type' => 'post',
			'paged'          => $_paged
		);


		$wp_query->query( $args );

		get_template_part( 'index' );
	}
	elseif ( $fp_variant == 'albums_list' ) {
		get_template_part( 'albums-template' );
	}
	elseif ( $fp_variant == 'works_list' ) {
		get_template_part( 'works-template' );
	}
}

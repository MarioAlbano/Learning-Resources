<?php
/**
 * Displays category filter for post, albums & works
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13framework_a13;

$page_type = apollo13framework_what_page_type_is_it();

if($page_type['search']){
	//we don't display filter on search result page
	return;
}

//get field
$albums_list = $page_type['albums_list'];
$works_list = $page_type['works_list'];
$posts_list = $page_type['blog_type'];

//filter will be usable here?
if ( $albums_list || $works_list || $posts_list ) {
	$terms = array();
	$filter_class = '';
	$selected_term = '__all';
	$show_all = true;

	//albums
	if ( $albums_list ) {
		$category_template = defined( 'A13FRAMEWORK_ALBUM_GENRE_TEMPLATE' );
		$filter_class = 'albums-filter';

		//prepare filter
		$query_args = array(
			'taxonomy'   => A13FRAMEWORK_CPT_ALBUM_TAXONOMY,
			'hide_empty' => true,
			'parent'     => 0,
		);

		if ( $category_template === true ) {
			$term_slug = get_query_var( 'term' );
			if ( ! empty( $term_slug ) ) {
				$term_obj             = get_term_by( 'slug', $term_slug, A13FRAMEWORK_CPT_ALBUM_TAXONOMY );
				$term_id              = $term_obj->term_id;
				$query_args['parent'] = $term_id;
			}
		}
		else{
			$selected_term = $apollo13framework_a13->get_option( 'albums_list_filter_default_filter', '__all' );
			$show_all = $apollo13framework_a13->get_option( 'albums_list_filter_all_filter', 'on' ) === 'on';
		}
		$terms = get_terms( $query_args );
	}

	//works
	elseif ( $works_list ) {
		$category_template = defined( 'A13FRAMEWORK_WORK_GENRE_TEMPLATE' );
		$filter_class = 'works-filter';

		//prepare filter
		$query_args = array(
			'taxonomy'   => A13FRAMEWORK_CPT_WORK_TAXONOMY,
			'hide_empty' => true,
			'parent'     => 0,
		);

		if ( $category_template === true ) {
			$term_slug = get_query_var( 'term' );
			if ( ! empty( $term_slug ) ) {
				$term_obj             = get_term_by( 'slug', $term_slug, A13FRAMEWORK_CPT_WORK_TAXONOMY );
				$term_id              = $term_obj->term_id;
				$query_args['parent'] = $term_id;
			}
		}
		else{
			$selected_term = $apollo13framework_a13->get_option( 'works_list_filter_default_filter', '__all' );
			$show_all = $apollo13framework_a13->get_option( 'works_list_filter_all_filter', 'on' ) === 'on';
		}
		$terms = get_terms( $query_args );
	}

	//blog
	elseif ( $posts_list ) {
		$category_template = is_category();
		$filter_class = 'posts-filter';

		$query_args = array(
			'hide_empty' => true,
			'parent'     => 0,
		);

		if ( $category_template === true ) {
			$term_id = get_query_var( 'cat' );
			if ( ! empty( $term_id ) ) {
				$query_args['parent'] = $term_id;
			}
		}
		else{
			$selected_term = $apollo13framework_a13->get_option( 'blog_filter_default_filter', '__all' );
			$show_all = $apollo13framework_a13->get_option( 'blog_filter_all_filter', 'on' ) === 'on';
		}

		$terms = get_categories( $query_args );

	}

	apollo13framework_make_post_grid_filter($terms, $filter_class, $selected_term, $show_all );
}

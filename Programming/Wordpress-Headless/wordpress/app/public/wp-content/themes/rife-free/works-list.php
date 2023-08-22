<?php
/**
 * Template for displaying works post type archive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
define( 'A13FRAMEWORK_WORKS_LIST_PAGE', true );

$ajax_call = isset( $_REQUEST['a13-ajax-get'] );
$genre_template = defined( 'A13FRAMEWORK_WORK_GENRE_TEMPLATE' );
$main_template  = ! $genre_template;
$is_elementor_preview = false;

if ( ! $ajax_call ) {
	get_header(); //so menu will highlight proper

	//read content with normal WordPress query that is already done
	if($main_template){
		the_post();
		$is_text_content = strlen( $post->post_content  ) > 0;
		// Elementor edit mode
		$is_elementor_preview = ( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->preview->is_preview_mode() );
	}
}

/**
 * The loop that displays works.
 *
 */

global $apollo13framework_a13;

//settings
$_paged    = get_query_var( 'page' ) === '' ? get_query_var( 'paged' ) : get_query_var( 'page' );
$_per_page = $apollo13framework_a13->get_option( 'works_list_items_per_page' );
$args = array(
	'posts_per_page'      => $_per_page,
	'paged'               => $_paged,
	'post_type'           => A13FRAMEWORK_CUSTOM_POST_TYPE_WORK,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'meta_key'            => '_exclude_in_works_list',
	'meta_value'          => 'off',
);

$_title = '';
$_subtitle = '';
if ( ! $ajax_call ) {
	$_title = get_the_title( $apollo13framework_a13->get_option( 'works_list_page' ) );

	if ( $genre_template === true ) {
		//special title for Category page
		$term_slug = get_query_var( 'term' );
		if ( ! empty( $term_slug ) ) {
			$args[ A13FRAMEWORK_CPT_WORK_TAXONOMY ] = $term_slug;
			$term_obj  = get_term_by( 'slug', $term_slug, A13FRAMEWORK_CPT_WORK_TAXONOMY );
			$_title    = sprintf( '%1$s : %2$s', $_title, $term_obj->name );
			$_subtitle = term_description( $term_obj->ID, A13FRAMEWORK_CPT_WORK_TAXONOMY );
		}
	}
}

if ( $main_template ) {
	/* Make query for works.
	 *
	 * We can't use "pre_get_posts" filter cause of 2 reasons:
	 * 1. There is no way to recognize that this page will list works.
	 * 2. We want to have link to Edit current page, as we also use content from this page.
	 */
	$query = new WP_Query( $args );
}
if ( ! $ajax_call ) {
	apollo13framework_title_bar( 'outside', $_title, $_subtitle );
	?>
	<article id="content" class="clearfix">
	<div class="content-limiter">
	<div id="col-mask">

	<?php
	//text content before items
	if ( $main_template && ( $is_text_content || $is_elementor_preview ) ) { ?>
		<div class="content-box pre-content-box">
			<div class="formatter">
				<div class="real-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	$pagination_class = $apollo13framework_a13->get_option( 'works_list_lazy_load' ) === 'on' ? ' lazy-load-on' : '';
	?>

	<div class="content-box<?php echo esc_attr( $pagination_class ); ?>">
	<?php
	//filter
	if($apollo13framework_a13->get_option( 'works_list_filter' ) === 'on'){
		get_template_part( 'parts/category-filter' );
	}
}

apollo13framework_display_items_from_query_work_list( $main_template? $query : false );
apollo13framework_cpt_list_navigation( $main_template? $query : false );
apollo13framework_result_count( $main_template? $query : false );

if ( $main_template ) {
	wp_reset_postdata();
}

if ( ! $ajax_call ) {
	?>

	</div>
	</div>
	</div>
	</article>

	<?php
	get_footer();
}
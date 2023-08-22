<?php
/**
 * Search results are contained within a div.searchwp-live-search-results
 * which you can style accordingly as you would any other element on your site
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'searchwp_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'searchwp-live-search' );
 *
 * You can use ~/searchwp-live-search/assets/styles/style.css as a guide to customize
 */
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
<!--		--><?php //$post_type = get_post_type_object( get_post_type() ); echo esc_html( $post_type->labels->singular_name ); ?>
		<div class="searchwp-live-search-result">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php if(has_post_thumbnail()){
						$src = apollo13framework_make_post_image( get_the_ID(), array(150,150), true);
						echo '<span class="icon" style="background-image: url('.esc_url( $src ).');"></span>';
					}
					else{
						?><span class="icon fa fa-file-text-o"></span><?php
					}?>
				<span class="title"><?php the_title(); ?></span>
				<?php echo apollo13framework_posted_on();//escaped on creation  ?>
				<span class="excerpt"><?php echo wp_kses_post( wp_html_excerpt( preg_replace( '/\[[^\]]+\]?/', '', get_the_excerpt() ), 70, '...' ) );  ?></span>
			</a>
		</div>
	<?php endwhile; ?>
	<?php
	$_search = isset( $_POST['s'] )? sanitize_text_field( wp_unslash( $_POST['s'] ) ) : '';
	?>
<div><a href="<?php echo esc_url( apollo13framework_current_url().'?s='.$_search ); ?>" class="all-results"><?php esc_html_e('View all results', 'rife-free'); ?></a></div>
<?php else : ?>
	<div class="searchwp-live-search-no-results">
		<h2><?php esc_html_e( 'No results found.', 'rife-free' ); ?></h2>
		<em><?php esc_html_e( 'Please try another search term', 'rife-free' ); ?></em>
	</div>
<?php endif; ?>

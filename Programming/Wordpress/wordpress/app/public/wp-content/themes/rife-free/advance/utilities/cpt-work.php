<?php
/* Functions used by custom post type work */
if(!function_exists('apollo13framework_work_posted_in')){
	/**
	 * For printing categories(taxonomies) of work
	 *
	 * @param string $separator string separating terms
	 *
	 * @return string HTML
	 */
	function apollo13framework_work_posted_in( $separator = '<span>/</span>' ) {
		$term_list = wp_get_post_terms(get_the_ID(), A13FRAMEWORK_CPT_WORK_TAXONOMY, array("fields" => "all"));
		$count_terms = count( $term_list );
		$html = '';
		$iteration = 1;
		if( $count_terms ){
			foreach($term_list as $term) {
				$html .= '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html( $term->name ). '</a>';
				if( $count_terms != $iteration ){
					$html .= $separator;
				}
				$iteration++;
			}
		}

		return $html;
	}
}



//Add some additional elements in meta_data
add_filter('apollo13framework_after_cpt_meta_fields', 'apollo13framework_work_meta_additions', 10);

if(!function_exists('apollo13framework_work_meta_additions')) {
	/**
	 * Adds categories and sharing buttons
	 *
	 * @return string html of additions
	 */
	function apollo13framework_work_meta_additions() {
		global $apollo13framework_a13;

		if ( A13FRAMEWORK_CUSTOM_POST_TYPE_WORK !== get_post_type() ) {
			return '';
		}

		$html = '';

		//categories
		if ( $apollo13framework_a13->get_meta( '_content_categories' ) === 'on' ) {
			$categories = apollo13framework_work_posted_in( ', ' );
			if(strlen($categories)){
				$html .= '<div class="cpt-categories work-categories">' . $categories . '</div>';
			}
		}

		//share buttons from addToAny
		if ( function_exists( 'A2A_SHARE_SAVE_add_to_content' ) ) {
			$html .= A2A_SHARE_SAVE_add_to_content( '' );
		}

		return $html;
	}
}


if(!function_exists('apollo13framework_single_work_text_content')) {
	/**
	 * Prints text content for single work
	 *
	 * @param $is_text_content
	 *
	 */
	function apollo13framework_single_work_text_content($is_text_content) {
		$meta_content    = apollo13framework_cpt_meta_fields();
		$is_meta_content = strlen( $meta_content ) > 0;

		?>
			<div class="formatter<?php echo $is_text_content? '' : ' no-content'; ?>">
				<div class="work-content<?php echo $is_meta_content ? esc_attr(' with-meta-fields') : ''; ?> clearfix">
					<div class="inside">
						<div class="real-content"<?php apollo13framework_schema_args('text'); ?>>
							<?php the_content(); ?>

							<?php
							if( !$is_meta_content ){
								echo apollo13framework_work_meta_additions();
							}
							?>
						</div>
					</div>
					<?php echo wp_kses_post($meta_content); ?>
				</div>
				<?php
				global $apollo13framework_a13;

				$comments_on_works = $apollo13framework_a13->get_option( 'work_comments', 'on' ) === 'on';
				// If comments are open or we have at least one comment, load up the comment template.
				if ( $comments_on_works && ( comments_open() || get_comments_number() ) ) :
					comments_template( '', true );
				endif;
				?>
			</div>
			<?php
	}
}



if(!function_exists('apollo13framework_works_nav')){
    /**
     * Navigation through work post type
     */
    function apollo13framework_works_nav() {
        global $apollo13framework_a13;
        $show_back_btn = true;
        $title = $href = '';
        $navigate_through_categories = $apollo13framework_a13->get_option( 'work_navigate_by_categories' ) === 'on';

        if($apollo13framework_a13->get_option( 'work_navigation') === 'off'){
            //nothing to do
            return;
        }

        if($navigate_through_categories){
            $term_list = wp_get_post_terms(get_the_ID(), A13FRAMEWORK_CPT_WORK_TAXONOMY, array("fields" => "all"));
            $count_terms = count( $term_list );
            if($count_terms > 0){
                $term = $term_list[0];
	            /* translators: %s: page title */
                $title = sprintf(esc_html__( 'Back to %s', 'rife-free' ), $term->name);
                $href = get_term_link($term);
            }
            else{
                $show_back_btn = false;
            }
        }
        else{
            $works_id = $apollo13framework_a13->get_option( 'works_list_page' );
	        /* translators: %s: page title */
            $title = sprintf(esc_html__( 'Back to %s', 'rife-free' ), get_the_title( $works_id ));
            if($works_id !== '0'){
                $href = get_permalink($works_id);
            }
            //works list as front page
            elseif($apollo13framework_a13->get_option( 'fp_variant' ) === 'works_list'){
                $href = home_url( '/' );
            }
            else{
                $show_back_btn = false;
            }
        }

        echo '<div class="cpt-nav">';

        if( $navigate_through_categories ) {
	        next_post_link( '%link', '<span class="fa fa-long-arrow-'.( is_rtl() ? 'right' : 'left' ).'" title="%title - %date"></span> ' . esc_html__( 'Previous', 'rife-free' ), true, '', A13FRAMEWORK_CPT_WORK_TAXONOMY );
        }
        else {
	        next_post_link( '%link', '<span class="fa fa-long-arrow-'.( is_rtl() ? 'right' : 'left' ).'" title="%title - %date"></span> ' . esc_html__( 'Previous', 'rife-free' ) );
        }

        echo $show_back_btn? '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" class="to-cpt-list fa fa-th"></a>' : '';

	    if( $navigate_through_categories ) {
            previous_post_link( '%link', esc_html__( 'Next', 'rife-free' ) . ' <span class="fa fa-long-arrow-'.( is_rtl() ? 'left' : 'right' ).'" title="%title - %date"></span>', true, '', A13FRAMEWORK_CPT_WORK_TAXONOMY );
        }
        else{
            previous_post_link( '%link', esc_html__( 'Next', 'rife-free' ) . ' <span class="fa fa-long-arrow-'.( is_rtl() ? 'left' : 'right' ).'" title="%title - %date"></span>' );
        }

        echo '</div>';
    }
}



if(!function_exists('apollo13framework_make_work_image')){
	/**
	 * Making cover for works in Works list
	 *
	 * @param int           $work_id
	 * @param string|array  $sizes
	 * @param array        $args
	 *
	 * @since 2.1.0 $args param is used to pass all additional settings overwrites
	 *
	 * @return string HTML of image
	 */
    function apollo13framework_make_work_image( $work_id, $sizes = '', $args = array() ){
        global  $apollo13framework_a13;

        if(empty($work_id)){
            $work_id = get_the_ID();
        }

        if( !is_array($sizes) ){
            $brick_size         = $apollo13framework_a13->get_meta('_brick_ratio_x', $work_id);
	        $columns            = array_key_exists( 'columns', $args ) ? $args['columns'] : (int)$apollo13framework_a13->get_option( 'works_list_brick_columns' );
	        $bricks_max_width   = array_key_exists( 'max_width', $args ) ? $args['max_width'] : (int)$apollo13framework_a13->get_option( 'works_list_bricks_max_width' );
	        $brick_margin       = array_key_exists( 'margin', $args ) ? $args['margin'] : (int)$apollo13framework_a13->get_option( 'works_list_bricks_margin' );
	        $brick_proportion   = $apollo13framework_a13->get_option( 'works_list_bricks_proportions_size' );

            /* brick_size can't be bigger then columns for calculations */
            $brick_size         = strlen($brick_size)? min((int)$brick_size, $columns) : 1;
            $ratio              = $brick_size/$columns;

            //many possible sizes, but one RULE to rule them all
	        $image_width =  ceil($ratio * $bricks_max_width - (1-$ratio) * $brick_margin);

	        $height_proportion = apollo13framework_calculate_height_proportion($brick_proportion);

	        $image_height = $image_width*$height_proportion;

            $sizes = array($image_width, $image_height);
        }


        $src = apollo13framework_make_post_image( $work_id, $sizes, true );
        if ( $src === false ) {
            $src = get_theme_file_uri( 'images/holders/photo.png');
	        $sizes = array($sizes[0], $sizes[0]); //same size as placeholder is square size
        }
	    else{
		    //check for animated gifs
		    $file_type = wp_check_filetype( $src );
		    //if it is gif then it is probably animated gif, so lets use original file
		    if( $file_type['type'] === 'image/gif'){
			    $src = apollo13framework_make_post_image( $work_id, array('full'), true );
			    //get real sizes, so native lazy loading can position image properly
			    $attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $album_id ), 'full' );
			    $sizes = array($attachment[1], $attachment[2]);
		    }
	    }

	    $image_alt = '';
	    $image_title = '';
	    $image_id = get_post_thumbnail_id( $work_id );
	    if($image_id){
	        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
	        $image_title = get_the_title( $image_id );
	    }
	    $disable_native_lazy_load =  (int)$sizes[0] === 0 || (int)$sizes[1] === 0;
        return '<img'.($disable_native_lazy_load? ' loading="eager"' : '').' src="'.esc_url($src).'" alt="'.esc_attr($image_alt).'"'.($image_title? ' title="'.esc_attr($image_title).'"' : '').' width="'.esc_attr($sizes[0]).'" height="'.esc_attr($sizes[1]).'" />';
    }
}


if(!function_exists('apollo13framework_display_items_from_query_work_list')){
	/**
	 * @param bool|WP_Query $query
	 * @param array         $args
	 */
	function apollo13framework_display_items_from_query_work_list($query = false, $args = array()){
		global $apollo13framework_a13;

		static $id = 0;
		$id++;

		if($query === false){
			global $wp_query;
			$query = $wp_query;
			$displayed_in = 'work-list';
		}
		else{
			$displayed_in = 'shortcode';
		}

		$default_args = array(
			'columns'        => $apollo13framework_a13->get_option( 'works_list_brick_columns' ),
			'max_width'      => $apollo13framework_a13->get_option( 'works_list_bricks_max_width' ),
			'margin'         => $apollo13framework_a13->get_option( 'works_list_brick_margin' ),
			'filter'         => false,
			'default_filter' => '__all',
			'all_filter'     => true,
		);

		$args = wp_parse_args($args, $default_args);

		/* show filter? */
		if($args['filter']){
			$query_args = array(
				'hide_empty' => true,
				'object_ids' => wp_list_pluck( $query->posts, 'ID' ),
				'taxonomy'   => A13FRAMEWORK_CPT_WORK_TAXONOMY,
			);

			/** @noinspection PhpInternalEntityUsedInspection */
			$terms = get_terms( $query_args );

			apollo13framework_make_post_grid_filter($terms, 'works-filter', $args['default_filter'], $args['all_filter']);
		}


		/* If there are no posts to display, such as an empty archive page */
		if ( ! $query->have_posts() ):
			?>
			<div class="formatter">
				<div class="real-content empty-blog">
					<?php
					echo '<p>'.esc_html__( 'Apologies, but no results were found for the requested archive.', 'rife-free' ).'</p>';
					get_template_part( 'no-content');
					?>
				</div>
			</div>
			<?php
		/* If there ARE some posts */
		else:
			$ajax_call = isset( $_REQUEST['a13-ajax-get'] );
			$works_list_page = defined( 'A13FRAMEWORK_WORKS_LIST_PAGE');

			if(!$ajax_call){
				?>
				<div class="bricks-frame works-bricks works-bricks-<?php echo esc_attr( $id ) .' '. esc_attr( apollo13framework_works_list_look_classes($args['columns']) ); ?>">
				<div class="works-grid-container"<?php
				//lazy load on
				if($works_list_page){
					$lazy_load        = $apollo13framework_a13->get_option( 'works_list_lazy_load' ) === 'on';
					$lazy_load_mode   = $apollo13framework_a13->get_option( 'works_list_lazy_load_mode' );
					echo ' data-lazy-load="' . esc_attr( $lazy_load ) . '" data-lazy-load-mode="' . esc_attr( $lazy_load_mode ) . '"';
				}
				echo ' data-margin="' . esc_attr( $args['margin'] ) . '"';
				?>>
				<div class="grid-master"></div>
				<?php
			}

			while ( $query->have_posts() ) :
				echo apollo13framework_works_list_item($query, $displayed_in, $args );
			endwhile;

			if ( ! $ajax_call ) { ?>
				</div>
				</div>
				<div class="clear"></div>
				<?php
				apollo13framework_works_list_individual_look($id, $args);
			}
		endif;
	}
}


if(!function_exists('apollo13framework_work_individual_look')){
	/**
	 * Prepares CSS specially for each work
	 */
	function apollo13framework_work_individual_look(){
		//checks if page can have meta fields
		if(!apollo13framework_is_no_property_page()){
			$page_type = apollo13framework_what_page_type_is_it();
			$work = $page_type['work'];

			if($work){
				$id = get_the_ID();

				$media_margin_top    = wp_strip_all_tags( apollo13framework_make_css_rule( 'margin-top', get_post_meta( $id, '_media_margin_top', true ) ) );
				$media_margin_bottom = wp_strip_all_tags( apollo13framework_make_css_rule( 'margin-bottom', get_post_meta( $id, '_media_margin_bottom', true ) ) );

				$slider_bg_color = wp_strip_all_tags( apollo13framework_make_css_rule( 'background-color', get_post_meta( $id, '_slider_bg_color', true) ) );


			$css = '/* slider */
.single-work .a13-main-slider{
    '.$media_margin_top.'
    '.$media_margin_bottom.'
}
.a13-main-slider .slider-slides > li{
	'.$slider_bg_color.'
}';

				//if we have some CSS then add it
				if(strlen($css)){
					wp_add_inline_style( 'a13-user-css', apollo13framework_minify_css($css) );
				}
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'apollo13framework_work_individual_look', 28 );



if(!function_exists('apollo13framework_works_list_look_classes')) {
	/**
	 * Return classes for bricks container of works list
	 *
	 * @param int|null $columns number of columns in container
	 *
	 * @return string classes
	 */
	function apollo13framework_works_list_look_classes( $columns = null ) {
		global $apollo13framework_a13;

		$works_look          = $apollo13framework_a13->get_option( 'works_list_work_look' );
		$bricks_look_classes = ' variant-' . $works_look;
		if ( $columns !== null ) {
			$bricks_look_classes .= ' works-columns-' . $columns;
		}

		//hover effect
		$hover_effect = $apollo13framework_a13->get_option( 'works_list_bricks_hover' );
		$bricks_look_classes .= ' hover-effect-' . $hover_effect;

		if ( $works_look === 'overlay' ) {
			//position
			$title_position = explode( '_', $apollo13framework_a13->get_option( 'works_list_work_overlay_title_position' ) );
			$bricks_look_classes .= ( is_array( $title_position ) && sizeof( $title_position ) === 2 ) ? ' title-' . $title_position[0] . ' title-' . $title_position[1] : '';

			//cover - not hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_cover' ) === 'on' ) {
				$bricks_look_classes .= ' cover-no-hover';
			}

			//cover - hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_cover_hover' ) === 'on' ) {
				$bricks_look_classes .= ' cover-hover';
			}

			//gradient - not hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_gradient' ) === 'on' ) {
				$bricks_look_classes .= ' gradient-no-hover';
			}

			//gradient - hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_gradient_hover' ) === 'on' ) {
				$bricks_look_classes .= ' gradient-hover';
			}

			//texts visibility - not hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_texts' ) === 'on' ) {
				$bricks_look_classes .= ' texts-no-hover';
			}

			//texts visibility - hovering
			if ( $apollo13framework_a13->get_option( 'works_list_work_overlay_texts_hover' ) === 'on' ) {
				$bricks_look_classes .= ' texts-hover';
			}
		} else {
			$title_position = $apollo13framework_a13->get_option( 'works_list_work_under_title_position' );
			$bricks_look_classes .= ' title-' . $title_position;
		}

		return $bricks_look_classes;
	}
}



if(!function_exists('apollo13framework_works_list_item')) {
	/**
	 * Prints HTML for item or items(when query is passed) of works item
	 *
	 * @param WP_Query|null $query        Query with list of post. If not given, will use global $post
	 *
	 * @param string        $displayed_in where item is displayed
	 * @param array         $args
	 *
	 * @since 2.1.0 $args param is used to pass all additional settings overwrites
	 *
	 * @return string HTML of items
	 *
	 */
	function apollo13framework_works_list_item( $query = null, $displayed_in = 'work-list', $args = array() ) {
		global $apollo13framework_a13, $post;

		$work_list = $displayed_in === 'work-list';
		$shortcode = $displayed_in === 'shortcode';

		$number_of_posts = 1; //if it is WP Bakery post grid, then we don't have whole query
		if ( is_object( $query ) ) {
			$number_of_posts = $query->post_count;
		}

		$html              = '';
		$how_to_open       = $apollo13framework_a13->get_option( 'works_list_work_how_to_open' );
		$how_to_open_class = ' open-item-' . $how_to_open;

		//do we need slider script
		if($how_to_open === 'in-lightbox'){
			wp_enqueue_script( 'apollo13framework-slider' );
			//for HTML5 videos
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}

		for ( $post_number = 0; $post_number < $number_of_posts; $post_number ++ ) {
			if ( is_object( $query ) ) {
				$query->the_post();
				$post_id = get_the_ID();
			} else {
				$post_id = $post->ID;
			}

			$href = get_the_permalink( $post_id );
			$work_classes    = $how_to_open_class;
			$category_string = '';

			//special thing when used in works list
			if ( $work_list || $shortcode ) {
				//get work categories
				$terms = wp_get_post_terms( $post_id, A13FRAMEWORK_CPT_WORK_TAXONOMY, array( "fields" => "all" ) );

				//get all genres that item belongs to
				if ( count( $terms ) ) {
					foreach ( $terms as $term ) {
						$category_string .= ' data-category-' . esc_attr($term->term_id) . '="1"';
					}
				}

				//size of brick
				$brick_size = $apollo13framework_a13->get_meta( '_brick_ratio_x' );
				$work_classes .= strlen( $brick_size ) ? ' w' . $brick_size : '';
			}

			$html .= '<div class="archive-item object-item' . esc_attr( $work_classes ) . '"' . $category_string/* escaped while preparing */ . ' data-id="work-'.esc_attr( $post_id ).'"' . apollo13framework_get_schema_args('creative') . '>';

			//simple for works list or shortcode
			if ( $work_list || $shortcode ) {
				$html .= apollo13framework_make_work_image( $post_id, '', $args );
			} //fixed for other place
			else {
				//prepare image in proportion
				$image_width       = 800;/* 800 - not depending on current theme settings for works list */
				$brick_proportion  = $apollo13framework_a13->get_option( 'works_list_bricks_proportions_size' );
				$height_proportion = apollo13framework_calculate_height_proportion( $brick_proportion );
				$image_height      = $image_width * $height_proportion;

				$html .= apollo13framework_make_work_image( $post_id, array( $image_width, $image_height ) );
			}

			$cover_color = $apollo13framework_a13->get_meta( '_cover_color' );
			if ( $cover_color === '' || $cover_color === false || $cover_color === 'transparent' ) {
				//no color - default to CSS value
				$html .= '<div class="cover"></div>';
			} else {
				$html .= '<div class="cover" style="background-color:' . esc_attr( $cover_color ). ';"></div>';
			}

			$html .= '<div class="covering-image"></div>';
			$html .= '<div class="icon a13icon-plus"></div>';

			$html .= '<div class="caption">';

			if ( post_password_required( $post_id ) ) {

				$html .= '<div class="texts_group">';
				$html .= '<h2 class="post-title">';

				if( $apollo13framework_a13->get_option( 'works_list_protected_titles', 'on' ) === 'on' ){
					$html .= '<span class="fa fa-lock"></span>' . esc_html__( 'This content is password protected', 'rife-free' );
				}
				else{
					$html .= '<span class="fa fa-lock"></span>' . get_the_title($post_id);
				}

				$html .= '</h2>';

				$html .= '<div class="excerpt">';
				$html .= '<p>' . esc_html__( 'Click and enter your password to view content', 'rife-free' ) . '</p>';
				$html .= '</div>';
				$html .= '</div>';

			} else {

				$html .= '<div class="texts_group">';

				//return taxonomy for works
				if ( $apollo13framework_a13->get_option( 'works_list_categories' ) === 'on' ) {
					$html .= '<div class="cpt-categories work-categories">' . apollo13framework_work_posted_in( ', ' ) . '</div>';
				}
				//title
				$html .= the_title( '<h2 class="post-title"'. apollo13framework_get_schema_args('headline').'>', '</h2>', false );

				$html .= '<div class="excerpt">';
				$html .= esc_html( $apollo13framework_a13->get_meta( '_subtitle' ) );
				$html .= '</div>';
				$html .= '</div>';

			}
			$html .= '</div>'; //.caption

			$html .= '<a href="' . esc_url($href) . '"'. apollo13framework_get_schema_args('url').'></a>';
			$html .= apollo13framework_cpt_social($href, get_the_title());
			$html .= '</div>';
		}

		return $html;
	}
}



if(!function_exists('apollo13framework_similar_works')){
	/*
	 * Prints similar works - up to 3 items
	 *
	 */
	function apollo13framework_similar_works(){
        global $apollo13framework_a13, $post;

        $is_work = defined('A13FRAMEWORK_WORK_PAGE');

		//make sure we called it for single work
		if(!$is_work){
			return;
		}

        //if deactivated then we have nothing to do here
        if( $apollo13framework_a13->get_option( 'work_similar_works' ) !== 'on' ){
            return;
        }

		//get categories of current work
        $__search = wp_get_post_terms(get_the_ID(), A13FRAMEWORK_CPT_WORK_TAXONOMY, array("fields" => "slugs"));

        if ( count($__search) ) {
            //search query
            $r = new WP_Query(
	            array(
		            'post_type'           => A13FRAMEWORK_CUSTOM_POST_TYPE_WORK,
		            'tax_query'           => array(
			            array(
				            'taxonomy' => A13FRAMEWORK_CPT_WORK_TAXONOMY,
				            'field'    => 'slug',
				            'terms'    => $__search,
				            'operator' => 'IN'
			            )
		            ),
		            'post__not_in'        => array( $post->ID ),
		            'posts_per_page'      => 3,
		            'no_found_rows'       => true,
		            'post_status'         => 'publish',
		            'ignore_sticky_posts' => true,
		            'orderby'             => 'date'
	            )
            );

            if ($r->have_posts()) :
                echo '<div class="similar-works">
                        	<h3>'.esc_html__('Similar works', 'rife-free' ).'</h3>
                        	<div class="similar-works-frame clearfix' . esc_attr( apollo13framework_works_list_look_classes() ) . '">';

	            echo apollo13framework_works_list_item($r);

	            echo '	</div>
						</div>';

                // Reset the global $the_post as this query will have stomped on it
                wp_reset_postdata();

            endif;
        }
    }
}



if(!function_exists('apollo13framework_works_list_individual_look')){
	/**
	 * Prepares CSS specially for each works list
	 *
	 * @since 2.1.0
	 *
	 * @param $id int unique id for current works list
	 * @param $args array custom params for works list
	 */
	function apollo13framework_works_list_individual_look($id, $args){
		$css = '';

		$max_width        = (int) $args['max_width'];
		$max_width        = esc_html( apollo13framework_make_css_rule( 'max-width', $max_width, '%spx' ) );
		$margin           = (int) $args['margin'];
		$margin           = esc_html( $margin . 'px' );
		$calc_safe_margin = esc_html( $margin === '0px' ? '' : ' - ' . $margin );

		//space in case of different layout mode
		$item_bottom_gutter = wp_strip_all_tags( 'margin-bottom: ' . $margin . ';' );

		$selector_class   = wp_strip_all_tags( '.works-bricks-' . $id );

		$css .= '
'.$selector_class.'{
	'.$max_width.'
}
'.$selector_class.' .works-grid-container{
	margin-right: -'.$margin.';
}
.rtl '.$selector_class.' .works-grid-container{
	margin-right: 0;
	margin-left: -'.$margin.';
}
'.$selector_class.' .layout-fitRows .archive-item,
'.$selector_class.' .layout-masonry .archive-item{
    '.$item_bottom_gutter.'
}

/* 4 columns */
'.$selector_class.'.works-columns-4 .archive-item,
'.$selector_class.'.works-columns-4 .grid-master{
	width: calc(25%'.$calc_safe_margin.');
}
'.$selector_class.'.works-columns-4 .archive-item.w2{
	width: calc(50%'.$calc_safe_margin.');
}
'.$selector_class.'.works-columns-4 .archive-item.w3{
	width: calc(75%'.$calc_safe_margin.');
}

/* 3 columns */
'.$selector_class.'.works-columns-3 .archive-item,
'.$selector_class.'.works-columns-3 .grid-master{
	width: calc(33.3333333%'.$calc_safe_margin.');
}
'.$selector_class.'.works-columns-3 .archive-item.w2{
	width: calc(66.6666666%'.$calc_safe_margin.');
}

/* 2 columns */
'.$selector_class.'.works-columns-2 .archive-item,
'.$selector_class.'.works-columns-2 .grid-master{
	width: calc(50%'.$calc_safe_margin.');
}

/* 100% width bricks */
'.$selector_class.'.works-columns-1 .grid-master,
'.$selector_class.'.works-columns-1 .archive-item,
'.$selector_class.'.works-columns-2 .archive-item.w2,
'.$selector_class.'.works-columns-2 .archive-item.w3,
'.$selector_class.'.works-columns-2 .archive-item.w4,
'.$selector_class.'.works-columns-3 .archive-item.w3,
'.$selector_class.'.works-columns-3 .archive-item.w4,
'.$selector_class.'.works-columns-4 .archive-item.w4{
	width: calc(100%'.$calc_safe_margin.');
}

@media only screen and (max-width: 1279px){
	/* 4 -> 3 columns */
	.works-columns-4 .archive-item,
	.works-columns-4 .grid-master{
		width: calc(33.3333333%'.$calc_safe_margin.');
	}
	.works-columns-4 .archive-item.w2{
		width: calc(66.6666666%'.$calc_safe_margin.');
	}
	.works-columns-4 .archive-item.w3{
		width: calc(100%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 800px){
	/* 4,3 -> 2 columns */
	'.$selector_class.'.works-columns-4 .grid-master,
	'.$selector_class.'.works-columns-4 .archive-item,
	'.$selector_class.'.works-columns-4 .archive-item.w2,
	'.$selector_class.'.works-columns-3 .grid-master,
	'.$selector_class.'.works-columns-3 .archive-item{
		width: calc(50%'.$calc_safe_margin.');
	}
	'.$selector_class.'.works-columns-4 .archive-item.w3,
	'.$selector_class.'.works-columns-3 .archive-item.w2{
		width: calc(100%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 480px) {
	'.$selector_class.' .works-grid-container{
        margin-right: 0;
    }
    .rtl '.$selector_class.' .works-grid-container{
        margin-left: 0;
    }

	/* all bricks layouts -> 1 column */
	'.$selector_class.'.works-columns-4 .grid-master,
	'.$selector_class.'.works-columns-4 .archive-item,
	'.$selector_class.'.works-columns-4 .archive-item.w2,
	'.$selector_class.'.works-columns-4 .archive-item.w3,
	'.$selector_class.'.works-columns-4 .archive-item.w4,
	'.$selector_class.'.works-columns-3 .grid-master,
	'.$selector_class.'.works-columns-3 .archive-item,
	'.$selector_class.'.works-columns-3 .archive-item.w2,
	'.$selector_class.'.works-columns-3 .archive-item.w3,
	'.$selector_class.'.works-columns-2 .grid-master,
	'.$selector_class.'.works-columns-2 .archive-item,
	'.$selector_class.'.works-columns-2 .archive-item.w2,
	'.$selector_class.'.works-columns-1 .grid-master,
	'.$selector_class.'.works-columns-1 .archive-item{
		width: 100%;
	}
}';

		//if we have some CSS then add it
		if(strlen($css)){
			$css = apollo13framework_minify_css($css);

			// Elementor edit mode
			if ( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				//we need to print inline CSS this way, cause otherwise it will be enqueued in frame parent(wrong place)
				echo '<style type="text/css" media="all" id="a13-works-grid-'.esc_attr($id).'">'.$css.'</style>';
			}
			// not edit mode
			else {
				//print works grid inline CSS without attaching it to any style
				//credits to https://www.cssigniter.com/late-enqueue-inline-css-wordpress/
				wp_register_style( 'a13-works-grid-'.esc_attr($id), false );
				wp_enqueue_style( 'a13-works-grid-'.esc_attr($id) );
				wp_add_inline_style( 'a13-works-grid-'.esc_attr($id), $css );
			}
		}
	}
}
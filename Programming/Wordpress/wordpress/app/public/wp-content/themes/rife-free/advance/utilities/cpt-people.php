<?php
/* Functions used by custom post type people */
if(!function_exists('apollo13framework_make_people_image')){
	/**
	 * Making cover for people in People list
	 *
	 * @param int          $item_id
	 * @param string|array $sizes
	 * @param bool|int     $columns
	 * @param int          $max_width
	 * @param int          $margin
	 *
	 * @return string HTML of image
	 */
	function apollo13framework_make_people_image( $item_id, $sizes = '', $columns = 3, $max_width = 1920, $margin = 10 ){
        if(empty($item_id)){
            $item_id = get_the_ID();
        }

        if( !is_array($sizes) ){
	        $brick_size       = 1; //$apollo13framework_a13->get_meta('_brick_ratio_x', $item_id);
	        $columns          = (int) $columns;
	        $max_width        = (int) $max_width;
	        $margin           = (int) $margin;
	        $brick_proportion = '1/1';//$apollo13framework_a13->get_option( 'people_list_bricks_proportions_size' );

            /* brick_size can't be bigger then columns for calculations */
            $brick_size         = strlen($brick_size)? min((int)$brick_size, $columns) : 1;
            $ratio              = $brick_size/$columns;

	        //many possible sizes, but one RULE to rule them all
	        $image_width =  ceil($ratio * $max_width - (1-$ratio) * $margin);

	        $height_proportion = apollo13framework_calculate_height_proportion($brick_proportion);

	        $image_height = $image_width*$height_proportion;

            $sizes = array($image_width, $image_height);
        }


        $src = apollo13framework_make_post_image( $item_id, $sizes, true );
        if ( $src === false ) {
            $src = get_theme_file_uri( 'images/holders/photo.png');
	        $sizes = array($sizes[0], $sizes[0]); //same size as placeholder is square size
        }
        else{
	        //check for animated gifs
	        $file_type = wp_check_filetype( $src );
	        //if it is gif then it is probably animated gif, so lets use original file
	        if( $file_type['type'] === 'image/gif'){
		        $src = apollo13framework_make_post_image( $item_id, array('full'), true );
		        //get real sizes, so native lazy loading can position image properly
		        $attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $album_id ), 'full' );
		        $sizes = array($attachment[1], $attachment[2]);
	        }
        }

	    $image_alt = '';
	    $image_title = '';
	    $image_id = get_post_thumbnail_id( $item_id );
	    if($image_id){
	        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
	        $image_title = get_the_title( $image_id );
	    }
		$disable_native_lazy_load =  (int)$sizes[0] === 0 || (int)$sizes[1] === 0;
        return '<img'.($disable_native_lazy_load? ' loading="eager"' : '').' src="'.esc_url($src).'" alt="'.esc_attr($image_alt).'"'.($image_title? ' title="'.esc_attr($image_title).'"' : '').' width="'.esc_attr($sizes[0]).'" height="'.esc_attr($sizes[1]).'" />';
    }
}



if(!function_exists('apollo13framework_display_items_from_query_people_list')) {
	/**
	 * @param bool|WP_Query $query
	 * @param array         $args
	 */
	function apollo13framework_display_items_from_query_people_list($query = false, $args = array()){
		static $id = 0;
		$id++;

		if($query === false){
			global $wp_query;
			$query = $wp_query;
			$displayed_in = 'people-list';
		}
		else{
			$displayed_in = 'shortcode';
		}

		$default_args = array(
			'columns'        => 3,
			'max_width'      => '1920',
			'margin'         => 10,
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
				'taxonomy'   => A13FRAMEWORK_CPT_PEOPLE_TAXONOMY,
			);

			/** @noinspection PhpInternalEntityUsedInspection */
			$terms = get_terms( $query_args );

			apollo13framework_make_post_grid_filter($terms, 'people-filter', $args['default_filter'], $args['all_filter']);
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

			if(!$ajax_call){
				?>
				<div class="bricks-frame people-bricks people-bricks-<?php echo esc_attr( $id ).' '. esc_attr( apollo13framework_people_list_look_classes($args['columns']) ); ?>">
				<div class="people-grid-container"<?php
					echo ' data-margin="' . esc_attr( $args['margin'] ) . '"';
				?>>
				<div class="grid-master"></div>
				<?php
			}

			while ( $query->have_posts() ) :
				//apollo13framework_people_list_item() produces escaped content
				echo apollo13framework_people_list_item($query, $displayed_in, $args['columns'], $args['max_width'], $args['margin']);
			endwhile;

			if ( ! $ajax_call ) { ?>
				</div>
				</div>
				<div class="clear"></div>
				<?php
				apollo13framework_people_list_individual_look($id, $args['max_width'], $args['margin']);
			}
		endif;
	}
}



if(!function_exists('apollo13framework_people_list_look_classes')) {
	/**
	 * Return classes for bricks container of people list
	 *
	 * @param int|null $columns number of columns in container
	 *
	 * @return string classes
	 */
	function apollo13framework_people_list_look_classes( $columns = null ) {
		$bricks_look_classes = ' variant-overlay cover-hover title-mid title-center texts-hover hover-effect-shift';
		$bricks_look_classes .= ' people-columns-' . $columns;

		return $bricks_look_classes;
	}
}



if(!function_exists('apollo13framework_people_list_item')) {
	/**
	 * Prints HTML for item or items(when query is passed) of people item
	 *
	 * @param WP_Query|null $query        Query with list of post. If not given, will use global $post
	 *
	 * @param string        $displayed_in where item is displayed
	 *
	 * @param bool|int      $columns
	 * @param int           $max_width
	 * @param int           $margin
	 *
	 * @return string HTML of items
	 *
	 */
	function apollo13framework_people_list_item( $query = null, $displayed_in = 'people-list', $columns = false, $max_width = 1920, $margin = 10 ) {
		global $apollo13framework_a13, $post;

		$people_list = $displayed_in === 'people-list';
		$shortcode = $displayed_in === 'shortcode';

		$number_of_posts = 1; //if it is WP Bakery post grid, then we don't have whole query
		if ( is_object( $query ) ) {
			$number_of_posts = $query->post_count;
		}

		$html = '';

		for ( $post_number = 0; $post_number < $number_of_posts; $post_number ++ ) {
			if ( is_object( $query ) ) {
				$query->the_post();
				$post_id = get_the_ID();
			} else {
				$post_id = $post->ID;
			}

			$category_string = '';
			$people_classes = '';

			//special thing when used in people list
			if ( $people_list || $shortcode ) {
				//get work categories
				$terms = wp_get_post_terms( $post_id, A13FRAMEWORK_CPT_PEOPLE_TAXONOMY, array( "fields" => "all" ) );

				//get all genres that item belongs to
				if ( count( $terms ) ) {
					foreach ( $terms as $term ) {
						$category_string .= ' data-category-' . esc_attr($term->term_id) . '="1"';
					}
				}

				//size of brick
				$brick_size = 1;//$apollo13framework_a13->get_meta( '_brick_ratio_x' );
				$people_classes = strlen( $brick_size ) ? ' w' . $brick_size : '';
			}

			$html .= '<div class="archive-item object-item' . esc_attr( $people_classes ) . '"' . $category_string/* escaped while preparing */ . ($people_list? ' id="people-' . esc_attr( $post_id ) . '"' : '').'>';

			//simple for people list or shortcode
			if ( $people_list || $shortcode ) {
				$html .= apollo13framework_make_people_image( $post_id, '', $columns, $max_width, $margin );
			} //fixed for other place
			else {
				//prepare image in proportion
				$image_width       = 800;/* 800 - not depending on current theme settings for people list */
				$brick_proportion  = 1/1;//$apollo13framework_a13->get_option( 'people_list_bricks_proportions_size' );
				$height_proportion = apollo13framework_calculate_height_proportion( $brick_proportion );
				$image_height      = $image_width * $height_proportion;

				$html .= apollo13framework_make_people_image( $post_id, array( $image_width, $image_height ) );
			}

			$cover_color = $apollo13framework_a13->get_meta( '_overlay_bg_color' );
			if ( $cover_color === '' || $cover_color === false || $cover_color === 'transparent' ) {
				//no color - default to CSS value
				$html .= '<div class="cover"></div>';
			} else {
				$html .= '<div class="cover" style="background-color:' . esc_attr( $cover_color ). ';"></div>';
			}


			$text_color = $apollo13framework_a13->get_meta( '_overlay_font_color' );
			if ( $text_color === '' || $text_color === false || $text_color === 'transparent' ) {
				//no color - default to CSS value
				$text_style = '';
			} else {
				$text_style = ' style="color:' . esc_attr( $text_color ). ';"';
			}

			$html .= '<div class="covering-image"></div>';

			$html .= '<div class="caption">';

			if ( post_password_required( $post_id ) ) {

				$html .= '<div class="texts_group"'.$text_style.'>';
				$html .= '<h2 class="post-title"'.$text_style.'>';
				$html .= '<span class="fa fa-lock"></span>' . esc_html__( 'This content is password protected', 'rife-free' );
				$html .= '</h2>';

				$html .= '<div class="excerpt"'.$text_style.'>';
				$html .= '<p>' . esc_html__( 'Click and enter your password to view content', 'rife-free' ) . '</p>';
				$html .= '</div>';
				$html .= '</div>';

			} else {

				$html .= '<div class="texts_group"'.$text_style.'>';

				//return taxonomy for people
				$html .= '<div class="subtitle">' . esc_html( $apollo13framework_a13->get_meta( '_subtitle' ) ) . '</div>';

				//title
				$html .= the_title( '<h2 class="post-title"'.$text_style.'>', '</h2>', false );

				$html .= '<div class="people-desc"'.$text_style.'>';
				$html .= get_the_content();
				$html .= '</div>';

				//social icons
				$all_meta    = get_post_meta( $post->ID );
				$socials_list = $apollo13framework_a13->get_social_icons_list('empty');
				foreach( $socials_list as $id=>$social){
					$socials_list[$id] = isset($all_meta['_'.$id])? $all_meta['_'.$id][0] : '';
				}
				$html .= apollo13framework_social_icons( $apollo13framework_a13->get_option( 'people_socials_color' ), $apollo13framework_a13->get_option( 'people_socials_color_hover' ), $socials_list );

				$html .= '</div>';

			}
			$html .= '</div>'; //.caption

			$html .= '</div>';
		}

		return $html;
	}
}



if(!function_exists('apollo13framework_people_list_individual_look')){
	/**
	 * Prepares CSS specially for each people list
	 */
	function apollo13framework_people_list_individual_look($id, $max_width, $margin){
		$css = '';

		$max_width        = (int) $max_width;
		$max_width        = esc_html( apollo13framework_make_css_rule( 'max-width', $max_width, '%spx' ) );
		$margin           = (int) $margin;
		$margin           = esc_html( $margin . 'px' );
		$calc_safe_margin = esc_html( $margin === '0px' ? '' : ' - ' . $margin );

		//space in case of different layout mode
		$item_bottom_gutter = wp_strip_all_tags( 'margin-bottom: ' . $margin . ';' );

		$selector_class   = wp_strip_all_tags( '.people-bricks-' . $id );

		$css .= '
'.$selector_class.'{
	'.$max_width.'
}
'.$selector_class.' .people-grid-container{
	margin-right: -'.$margin.';
}
.rtl '.$selector_class.' .people-grid-container{
	margin-right: 0;
	margin-left: -'.$margin.';
}
'.$selector_class.' .layout-fitRows .archive-item,
'.$selector_class.' .layout-masonry .archive-item{
    '.$item_bottom_gutter.'
}

/* 4 columns */
'.$selector_class.'.people-columns-4 .archive-item,
'.$selector_class.'.people-columns-4 .grid-master{
	width: calc(25%'.$calc_safe_margin.');
}

/* 3 columns */
'.$selector_class.'.people-columns-3 .archive-item,
'.$selector_class.'.people-columns-3 .grid-master{
	width: calc(33.3333333%'.$calc_safe_margin.');
}

/* 2 columns */
'.$selector_class.'.people-columns-2 .archive-item,
'.$selector_class.'.people-columns-2 .grid-master{
	width: calc(50%'.$calc_safe_margin.');
}

/* 100% width bricks */
'.$selector_class.'.people-columns-1 .grid-master,
'.$selector_class.'.people-columns-1 .archive-item{
	width: calc(100%'.$calc_safe_margin.');
}

@media only screen and (max-width: 1279px){
	/* 4 -> 3 columns */
	'.$selector_class.'.people-columns-4 .archive-item,
	'.$selector_class.'.people-columns-4 .grid-master{
		width: calc(33.3333333%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 800px){
	/* 4,3 -> 2 columns */
	'.$selector_class.'.people-columns-4 .grid-master,
	'.$selector_class.'.people-columns-4 .archive-item,
	'.$selector_class.'.people-columns-3 .grid-master,
	'.$selector_class.'.people-columns-3 .archive-item{
		width: calc(50%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 480px) {
	'.$selector_class.' .people-grid-container{
        margin-right: 0;
    }
    .rtl '.$selector_class.' .people-grid-container{
        margin-left: 0;
    }

	/* all bricks layouts -> 1 column */
	'.$selector_class.'.people-columns-4 .grid-master,
	'.$selector_class.'.people-columns-4 .archive-item,
	'.$selector_class.'.people-columns-3 .grid-master,
	'.$selector_class.'.people-columns-3 .archive-item,
	'.$selector_class.'.people-columns-2 .grid-master,
	'.$selector_class.'.people-columns-2 .archive-item,
	'.$selector_class.'.people-columns-1 .grid-master,
	'.$selector_class.'.people-columns-1 .archive-item{
		width: 100%;
	}
}';

		//if we have some CSS then add it
		if(strlen($css)){
			$css = apollo13framework_minify_css($css);

			// Elementor edit mode
			if ( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				//we need to print inline CSS this way, cause otherwise it will be enqueued in frame parent(wrong place)
				echo '<style type="text/css" media="all" id="a13-people-grid-'.esc_attr($id).'">'.$css.'</style>';
			}
			// not edit mode
			else {
				//print people grid inline CSS without attaching it to any style
				//credits to https://www.cssigniter.com/late-enqueue-inline-css-wordpress/
				wp_register_style( 'a13-people-grid-'.esc_attr($id), false );
				wp_enqueue_style( 'a13-people-grid-'.esc_attr($id) );
				wp_add_inline_style( 'a13-people-grid-'.esc_attr($id), $css );
			}
		}
	}
}

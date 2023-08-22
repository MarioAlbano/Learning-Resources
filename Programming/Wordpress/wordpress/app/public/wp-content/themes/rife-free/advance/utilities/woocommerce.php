<?php
/**
 * Functions that are connected to handling WooCommerce
 */


/**********************/
/***** BREADCRUMBS ****/
/**********************/

if( ! function_exists( 'apollo13framework_woocommerce_custom_breadcrumbs' ) ){
	/**
	 * remove breadcrumbs from shop page
	 */
	function apollo13framework_woocommerce_custom_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	}
}
add_filter('woocommerce_before_main_content','apollo13framework_woocommerce_custom_breadcrumbs');



if(!function_exists('apollo13framework_custom_breadcrumbs_trail_add_product_categories')){
	/**
	 * Add product categories to the "Product" breadcrumb in WooCommerce.
	 * Get breadcrumbs on product pages that read: Home > Shop > Product category > Product Name
	 *
	 * @param $trail
	 *
	 * @return array
	 */
	function apollo13framework_custom_breadcrumbs_trail_add_product_categories( $trail ) {
		if( ( get_post_type() === 'product' ) && is_singular() ){
			global $post;
			$taxonomy = 'product_cat';
			$terms    = get_the_terms( $post->ID, $taxonomy );
			$links    = array();
			if( $terms && ! is_wp_error( $terms ) ){
				$count = 0;
				foreach( $terms as $c ) {
					$count ++;
					$parents = apollo13framework_wc_get_term_parents( $c->term_id, $taxonomy, true, ', ', $c->name, array() );
					if( $parents != '' && ! is_wp_error( $parents ) ){
						$parents_arr = explode( ', ', $parents );
						foreach( $parents_arr as $p ) {
							if( $p != '' ){
								$links[] = $p;
							}
						}
					}
				}

				// Add the trail back on to the end.
				$trail_end = get_the_title( $post->ID );

				// Add the new links, and the original trail's end, back into the trail.
				array_splice( $trail, 2, count( $trail ) - 1, $links );
				$trail['trail_end'] = $trail_end;

				//remove any duplicate breadcrumbs
				$trail = array_unique( $trail );
			}
		}

		return $trail;
	}
}
add_filter( 'woo_breadcrumbs_trail', 'apollo13framework_custom_breadcrumbs_trail_add_product_categories', 20 );



if ( ! function_exists( 'apollo13framework_wc_get_term_parents' ) ) {
	/**
	 * Retrieve term parents with separator.
	 *
	 * @param int $id Term ID.
	 * @param string $taxonomy.
	 * @param bool $link        Optional, default is false. Whether to format with link.
	 * @param string $separator Optional, default is '/'. How to separate terms.
	 * @param bool $nice_name Optional, default is false. Whether to use nice name for display.
	 * @param array $visited    Optional. Already linked to terms to prevent duplicates.
	 *
	 * @return string
	 */
	function apollo13framework_wc_get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nice_name = false, $visited = array() ) {
		$chain = '';
		$parent = &get_term( $id, $taxonomy );
		if ( is_wp_error( $parent ) )
			return $parent;
		if ( $nice_name ) {
			$name = $parent->slug;
		} else {
			$name = $parent->name;
		}
		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= apollo13framework_wc_get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nice_name, $visited );
		}
		if ( $link ) {
			$chain .= '<a href="' . esc_url( get_term_link( $parent, $taxonomy ) ) . '" title="' .
			          /* translators: %s - parent term name */
			          esc_attr( sprintf( esc_html__( "View all posts in %s", 'rife-free' ), $parent->name ) )
			          . '">'.$parent->name.'</a>' . $separator;
		} else {
			$chain .= $name.$separator;
		}
		return $chain;
	}
}



if ( ! function_exists( 'apollo13framework_wp_change_breadcrumb_delimiter' ) ) {
	/**
	 * change breadcrumb delimiter
	 *
	 * @param $defaults
	 *
	 * @return mixed
	 */
	function apollo13framework_wp_change_breadcrumb_delimiter( $defaults ) {
		// Change the breadcrumb delimiter from '/' to '>'
		$defaults['delimiter'] = '<span class="sep">/</span>';
		return $defaults;
	}
}
add_filter( 'woocommerce_breadcrumb_defaults', 'apollo13framework_wp_change_breadcrumb_delimiter' );



/*************************/
/***** THEME WRAPPERS ****/
/*************************/

if(!function_exists('apollo13framework_woocommerce_theme_wrapper_start')){
	/**
	 * start html of WC templates
	 */
	function apollo13framework_woocommerce_theme_wrapper_start() {
		global $apollo13framework_a13;

		$lazy_load          = $apollo13framework_a13->get_option('shop_lazy_load') === 'on';
		$pagination_class   = $lazy_load && apollo13framework_is_woocommerce_products_list_page()? ' lazy-load-on' : '';
		$custom_thumbs      = $apollo13framework_a13->get_option('product_custom_thumbs') === 'on';
		$thumbnails_class   = '';

		if( $custom_thumbs ){
			add_filter( 'woocommerce_product_thumbnails_columns', 'apollo13framework_wc_single_product_thumbs_columns' );
			$thumbnails_class = ' theme-thumbs';
		}
		else{
			add_filter( 'woocommerce_gallery_thumbnail_size', function() {
				return 'thumbnail';
			} );
		}

        add_filter( 'woocommerce_show_page_title', '__return_false');
        apollo13framework_title_bar();
        ?>
	    <article id="content" class="clearfix">
	        <div class="content-limiter">
	            <div id="col-mask">
	                <div class="content-box<?php echo esc_attr($pagination_class.$thumbnails_class); ?>">
	                    <div class="formatter">
        <?php
    }
}
add_action('woocommerce_before_main_content', 'apollo13framework_woocommerce_theme_wrapper_start', 10);



if(!function_exists('apollo13framework_woocommerce_theme_wrapper_end')){
	/**
	 * end html of WC templates
	 */
	function apollo13framework_woocommerce_theme_wrapper_end() {
        ?>
                            <div class="clear"></div>
                        </div>
		            </div>
		            <?php get_sidebar(); ?>
		        </div>
			</div>
		</article>
    <?php
    }
}
add_action('woocommerce_after_main_content', 'apollo13framework_woocommerce_theme_wrapper_end', 10);



//tell WC how our content wrapper should look
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);




/******************************/
/***** GENERAL WOOCOMMERCE ****/
/******************************/



if(!function_exists('apollo13framework_is_woocommerce')){
	/**
	 * is current page one of WC
	 *
	 * @return bool
	 */
	function apollo13framework_is_woocommerce() {
        return ( is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_order_received_page() );
    }
}



if(!function_exists( 'apollo13framework_is_woocommerce_products_list_page' )){
	/**
	 * is current page one of WC pages without proper title
	 *
	 * @return bool
	 */
	function apollo13framework_is_woocommerce_products_list_page() {
        return ( is_shop() || is_product_taxonomy() );
    }
}



if(!function_exists('apollo13framework_is_woocommerce_sidebar_page')){
	/**
	 * is current page one of WC pages where sidebar is useful
	 *
	 * @return bool
	 */
	function apollo13framework_is_woocommerce_sidebar_page() {
        return ( is_woocommerce() );
    }
}



if(!function_exists('apollo13framework_is_product_new')){
	/**
	 * is current product new
	 *
	 * @return bool
	 */
	function apollo13framework_is_product_new() {
        global $product;
        return is_object_in_term( apollo13framework_wc_get_product_id($product), 'product_tag', 'new' );
    }
}



if(!function_exists('woocommerce_output_related_products')){
	/**
	 * Overwrite WooCommerce template function
	 *
	 * Function changes number of related products
	 */
	function woocommerce_output_related_products() {
		global $apollo13framework_a13;

		if( $apollo13framework_a13->get_option( 'product_related_products' ) === 'off' ){
			return;
		}

		$args = array(
			'posts_per_page' => 3,
			'columns'        => 3,
		);
		woocommerce_related_products( $args );
	}
}




/************************/
/***** PRODUCTS LIST ****/
/************************/

if(!function_exists('apollo13framework_wc_loop_second_image')){
	/**
	 * add second image, so it can be revealed on hover
	 */
	function apollo13framework_wc_loop_second_image() {
		/* @var $product WC_Product */
        global $product, $apollo13framework_a13;

		if($apollo13framework_a13->get_option( 'shop_products_second_image' ) === 'on') {
			//second thumb
			$attachment_ids   = $product->get_gallery_image_ids();
			$is_enough_images = sizeof( $attachment_ids ) > 0;

			if ( $attachment_ids && $is_enough_images ) {
				$image = wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' );
				if ( strlen( $image ) ) {
					echo '<span class="sec-img">' . wp_kses_post($image) . '</span>';
				}
			}
		}
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'apollo13framework_wc_loop_second_image', 10);



if(!function_exists( 'apollo13framework_wc_single_product_labels' )){
	/**
	 * add labels above to single product
	 */
	function apollo13framework_wc_single_product_labels() {
		/* @var $product WC_Product */
        global $product;

        $html = '';

        //labels
        //out of stock
        if(!$product->is_in_stock()){
            $html .= '<span class="ribbon out-of-stock"><em>'.esc_html__( 'Out of stock', 'rife-free' ).'</em></span>';
        }
        else{
            //sale
            if($product->is_on_sale()){
                $html .= '<span class="ribbon sale"><em>'.esc_html__( 'Sale', 'rife-free' ).'</em></span>';
            }
            //new
            if(apollo13framework_is_product_new()){
                $html .= '<span class="ribbon new"><em>'.esc_html__( 'New', 'rife-free' ).'</em></span>';
            }
        }

		if(strlen($html)){
			echo '<div class="product-labels">'.wp_kses_post($html).'</div>';
		}
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'apollo13framework_wc_single_product_labels', 11);



if(!function_exists( 'apollo13framework_wc_loop_single_product_categories' )){
	/**
	 * display categories of product
	 */
	function apollo13framework_wc_loop_single_product_categories() {
        global $product;

        //categories
		$terms = get_the_terms( apollo13framework_wc_get_product_id($product), 'product_cat' );
		if( sizeof( $terms ) && is_array($terms) ){
			echo '<span class="posted_in">';

			$temp = 1;
			foreach ( $terms as $term ) {
				if($temp > 1){
					echo '<span class="sep">/</span>';
				}
				echo esc_html($term->name);
				$temp++;
			}

			echo '</span>';
		}
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'apollo13framework_wc_loop_single_product_categories', 13);



if(!function_exists( 'apollo13framework_wc_loop_single_product_overlay' )){
	function apollo13framework_wc_loop_single_product_overlay() {
		global $apollo13framework_a13;
		if($apollo13framework_a13->get_option( 'shop_products_variant' ) === 'overlay'){
	        echo '<span class="overlay"></span>';
		}
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'apollo13framework_wc_loop_single_product_overlay', 11);


if(!function_exists( 'apollo13framework_wc_loop_non_hover_add_to_cart' )){
	/**
	 * Removes hooks, to display "Add to cart" button in the text if selected such in the options
	 *
	 * Output the result count text (Showing x - x of x results).
	 */
	function apollo13framework_wc_loop_non_hover_add_to_cart() {
		global $apollo13framework_a13;
		//add to cart button version
		$add_to_cart_version = $apollo13framework_a13->get_option( 'shop_add_to_cart', 'over' );
		if($apollo13framework_a13->get_option( 'shop_products_variant' ) === 'under' && $add_to_cart_version === 'in-text'){
			/* Move add to cart in prduct brick */
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );
		}
	}
}
add_action( 'woocommerce_before_shop_loop', 'apollo13framework_wc_loop_non_hover_add_to_cart', 20 );


add_action( 'woocommerce_before_subcategory_title', 'apollo13framework_wc_loop_single_product_overlay', 11);



if(!function_exists( 'apollo13framework_wc_loop_single_product_text_div' )){
	/**
	 * pack text content under thumbnail in div.product-details
	 */
	function apollo13framework_wc_loop_single_product_text_div() {
        echo '<div class="product-details">';
    }
	function apollo13framework_wc_loop_single_product_text_div_close() {
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'apollo13framework_wc_loop_single_product_text_div', 12);
add_action( 'woocommerce_after_shop_loop_item_title', 'apollo13framework_wc_loop_single_product_text_div_close', 21);
add_action( 'woocommerce_before_subcategory_title', 'apollo13framework_wc_loop_single_product_text_div', 12);
add_action( 'woocommerce_after_subcategory_title', 'apollo13framework_wc_loop_single_product_text_div_close', 21);



if (!function_exists('apollo13framework_wc_loop_shop_per_page')) {
	/**
	 * Change number or products per page
	 *
	 * @return int number of products
	 */
	function apollo13framework_wc_loop_shop_per_page() {
		global $apollo13framework_a13;
		return $apollo13framework_a13->get_option( 'shop_products_per_page');
	}
}
add_filter( 'loop_shop_per_page', 'apollo13framework_wc_loop_shop_per_page', 20 );



if( ! function_exists( 'apollo13framework_wc_loop_columns' ) ){
	/**
	 * Change number or products per row
	 *
	 * @return int number of columns
	 */
	function apollo13framework_wc_loop_columns() {
		global $apollo13framework_a13;

		return $apollo13framework_a13->get_option( 'shop_products_columns' );
	}
}
add_filter('loop_shop_columns', 'apollo13framework_wc_loop_columns');



if ( ! function_exists( 'woocommerce_result_count' ) ) {
	/**
	 * Overwrite WooCommerce template function
	 *
	 * Output the result count text (Showing x - x of x results).
	 */
	function woocommerce_result_count() {
		global $wp_query;

		if ( ! woocommerce_products_will_display() ){
			return;
		}
		echo '<span class="result-count">';
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$total    = $wp_query->found_posts;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		if ( 1 == $total ) {
			echo '1/1';
		} else {
			printf( '%1$d/%2$d', esc_html($last), esc_html($total) );
		}
		echo '</span>';
	}
}



if ( ! function_exists( 'woocommerce_pagination' ) ) {
	/**
	 * Overwrite WooCommerce template function
	 *
	 * Output the pagination.
	 */
	function woocommerce_pagination() {
		if ( ! woocommerce_products_will_display() ) {
			return;
		}

		//since WC 3.3.0
		if ( function_exists('wc_get_loop_prop') && wc_get_loop_prop( 'is_shortcode' ) ) {
			$base = esc_url_raw( add_query_arg( 'product-page', '%#%', false ) );
			$format = '?product-page = %#%';
		}
		else {
			$base   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
			$format = '';
		}

		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		// Set up paginated links.
		$links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => $base,
			'format'       => $format,
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );

		if ( $links ) {
			echo wp_kses_post( _navigation_markup( $links, 'woocommerce-pagination' ) );
		}
	}
}



//change pagination to default WordPress style
add_filter('woocommerce_pagination_args', 'apollo13framework_loop_pagination', 20);

//remove sale badge from loop
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );

//move number of results to different place
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );

//remove ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );




/*************************/
/***** SINGLE PRODUCT ****/
/*************************/

if ( ! function_exists( 'apollo13framework_wc_single_product_thumbs_columns' ) ) {
	/**
	 * One column of thumbnails in single product
	 *
	 * @return int columns
	 */
	function apollo13framework_wc_single_product_thumbs_columns(){
		return 1;
	}
}



if ( ! function_exists( 'apollo13framework_single_product_image_gallery_classes' ) ) {
	/**
	 * @param $classes - classes already added
	 *
	 * Add custom styling only if we have thumbnails
	 *
	 * @return array $classes
	 */
	function apollo13framework_single_product_image_gallery_classes($classes){
		global $product;
		if( sizeof( $product->get_gallery_image_ids() ) > 0){
			$classes[] = 'has-thumbnails';
		}
		return $classes;
	}
}
add_filter( 'woocommerce_single_product_image_gallery_classes', 'apollo13framework_single_product_image_gallery_classes' );



if ( ! function_exists( 'apollo13framework_wc_single_product_avatars' ) ) {
	/**
	 * Changes size of avatars in WooCommerce shop
	 *
	 * @return int width in px
	 */
	function apollo13framework_wc_single_product_avatars() {
		return 90;
	}
}
add_filter( 'woocommerce_review_gravatar_size', 'apollo13framework_wc_single_product_avatars' );



//product labels
add_action( 'woocommerce_product_thumbnails', 'apollo13framework_wc_single_product_labels', 12);

//remove sale badge
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

//move rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4 );




/***************/
/***** CART ****/
/***************/

if ( ! function_exists( 'apollo13framework_wc_header_add_to_cart_fragment' ) ) {
	/**
	 * update cart quantity in theme cart fragment
	 *
	 * @param $fragments
	 *
	 * @return mixed
	 */
	function apollo13framework_wc_header_add_to_cart_fragment( $fragments ){
		global $woocommerce;
		$number = $woocommerce->cart->cart_contents_count;
		$fragments['span#basket-items-count'] = '<span id="basket-items-count"'.($number > 0 ? '' : 'class="zero"' ).'>'.$number.'</span>';
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'apollo13framework_wc_header_add_to_cart_fragment');


/* do not hide mini cart on the checkout and on the cart pages */
add_filter( 'woocommerce_widget_cart_is_hidden', '__return_false', 40, 0 );


if( ! function_exists( 'apollo13framework_wc_min_cart_footer' ) ){
	/**
	 * Adds "go to shop" button when cart is empty
	 */
	function apollo13framework_wc_min_cart_footer() {
		if( WC()->cart->is_empty() ):
			?>
			<p class="buttons">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="button wc-forward"><?php esc_html_e( 'Go to shop', 'rife-free' ); ?></a>
			</p>
			<?php
		endif;
	}
}
add_action( 'woocommerce_after_mini_cart', 'apollo13framework_wc_min_cart_footer' );



//move cross sells in cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 11 );




/***************/
/*** CHECKOUT **/
/***************/

if ( ! function_exists( 'apollo13framework_wc_checkout_columns_open' ) ) {
	/**
	 * Puts Checkout parts in columns
	 */
	function apollo13framework_wc_checkout_columns_open($template_name){
		if($template_name === 'checkout/form-login.php'){
			echo '<div class="col-1">';
		}
		elseif($template_name === 'checkout/form-coupon.php'){
			echo '<div class="col-2">';
		}
	}


	function apollo13framework_wc_checkout_columns_close($template_name){
		if($template_name === 'checkout/form-login.php'){
			echo '</div>';
		}
		elseif($template_name === 'checkout/form-coupon.php'){
			echo '</div>';
		}
	}
}
add_action( 'woocommerce_before_template_part', 'apollo13framework_wc_checkout_columns_open', 9, 1 );
add_action( 'woocommerce_after_template_part', 'apollo13framework_wc_checkout_columns_close', 11, 1 );



if ( ! function_exists( 'apollo13framework_wc_checkout_notices_open' ) ) {
	/**
	 * Move notice on checkout page to second column to not make it too wide
	 */
	function apollo13framework_wc_checkout_notices_open(){
		echo '<div class="col2-set notices-forms">';
	}


	function apollo13framework_wc_checkout_notices_close(){
		echo '</div>';
	}
}
add_action( 'woocommerce_before_checkout_form', 'apollo13framework_wc_checkout_notices_open', 9 );
add_action( 'woocommerce_before_checkout_form', 'apollo13framework_wc_checkout_notices_close', 11 );




/***********************/
/*** NOT TO OVERRIDE  **/
/***********************/

/**
 * Returns Product ID dependant on available functions
 *
 * @return int product_id
 */
function apollo13framework_wc_get_product_id($product){
	return method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
}



/**
 * Prepares CSS from theme settings from Customizer
 *
 * @return string CSS
 */
function apollo13framework_woocommerce_css() {
	global $apollo13framework_a13;

	/*
	 *  shop buttons
	 */
	$button_shop_bg_color           = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_bg_color' ) );
	$button_shop_hover_bg_color     = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_bg_hover_color' ) );
	$button_shop_color              = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_color' ) );
	$button_shop_hover_color        = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_hover_color' ) );
	$button_shop_alt_bg_color       = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_alt_bg_color' ) );
	$button_shop_alt_hover_bg_color = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_alt_bg_hover_color' ) );
	$button_shop_alt_color          = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_alt_color' ) );
	$button_shop_alt_hover_color    = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'button_shop_alt_hover_color' ) );
	$button_shop_font_size          = apollo13framework_make_css_rule( 'font-size', $apollo13framework_a13->get_option( 'button_shop_font_size' ), '%spx' );
	$button_shop_weight             = apollo13framework_make_css_rule( 'font-weight', $apollo13framework_a13->get_option( 'button_shop_weight' ) );
	$button_shop_transform          = apollo13framework_make_css_rule( 'text-transform', $apollo13framework_a13->get_option( 'button_shop_transform' ) );
	$button_shop_padding            = $apollo13framework_a13->get_option( 'button_shop_padding' );
	$button_shop_padding_left       = isset( $button_shop_padding['padding-left'] ) ? $button_shop_padding['padding-left'] : '0px';
	$button_shop_padding_right      = isset( $button_shop_padding['padding-right'] ) ? $button_shop_padding['padding-right'] : '0px';


	/*
	 *  shop
	 */
	$shop_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'shop_title_bar_image' ), 'url(%s)' );
	$shop_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'shop_title_bar_image_fit' ) );
	$shop_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'shop_title_bar_bg_color' ) );
	$shop_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'shop_title_bar_title_color' ) );
	$shop_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'shop_title_bar_color_1' ) );
	$shop_title_bar_space_width = $apollo13framework_a13->get_option( 'shop_title_bar_space_width' ) . 'px';

	$shop_margin = $apollo13framework_a13->get_option( 'shop_brick_margin' ) . 'px';
//space in case of different layout mode
	$shop_layout_mode        = $apollo13framework_a13->get_option( 'shop_products_layout_mode' );
	$shop_item_bottom_gutter = '';
	if ( $shop_layout_mode === 'fitRows' ) {
		$shop_item_bottom_gutter = 'margin-bottom: ' . $shop_margin . ';';
	}

	$how_many_columns_on_mobile = (int)$apollo13framework_a13->get_option( 'shop_products_columns_on_mobile', '1' );

	if($how_many_columns_on_mobile === 2){
		$shop_mobile_columns = "
	.content-box ul.products{
	    margin-right: -$shop_margin;
	}
	.rtl .content-box ul.products{
	    margin-left: -$shop_margin;
	}
	/* 2 columns */
	.woocommerce-page #mid ul.products li.product,
	.woocommerce-page #mid ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin); /* we unify all possible options of bricks width */
	}
";
	}
	else{
		$shop_mobile_columns = "
	.content-box ul.products{
	    margin-right: 0;
	}
	.rtl .content-box ul.products{
	    margin-left: 0;
	}
	/* 1 column */
	.woocommerce-page #mid ul.products li.product,
	.woocommerce-page #mid ul.products .grid-master{
		width: 100%; /* we unify all possible options of bricks width */
	}
";
	}


	/*
	 *  shop no major pages
	 */
	$shop_nmp_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'shop_no_major_pages_title_bar_image' ), 'url(%s)' );
	$shop_nmp_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'shop_no_major_pages_title_bar_image_fit' ) );
	$shop_nmp_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'shop_no_major_pages_title_bar_bg_color' ) );
	$shop_nmp_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'shop_no_major_pages_title_bar_title_color' ) );
	$shop_nmp_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'shop_no_major_pages_title_bar_color_1' ) );
	$shop_nmp_title_bar_space_width = $apollo13framework_a13->get_option( 'shop_no_major_pages_title_bar_space_width' ) . 'px';


	/*
	 *  single product page
	 */
	$product_title_bar_image       = apollo13framework_make_css_rule( 'background-image', $apollo13framework_a13->get_option_media_url( 'product_title_bar_image' ), 'url(%s)' );
	$product_title_bar_image_fit   = apollo13framework_bg_fit_helper( $apollo13framework_a13->get_option( 'product_title_bar_image_fit' ) );
	$product_title_bar_bg_color    = apollo13framework_make_css_rule( 'background-color', $apollo13framework_a13->get_option_color_rgba( 'product_title_bar_bg_color' ) );
	$product_title_bar_title_color = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'product_title_bar_title_color' ) );
	$product_title_bar_color_1     = apollo13framework_make_css_rule( 'color', $apollo13framework_a13->get_option_color_rgba( 'product_title_bar_color_1' ) );
	$product_title_bar_space_width = $apollo13framework_a13->get_option( 'product_title_bar_space_width' ) . 'px';

	$css = "
/* ==================
   SHOP BUTTONS
   ==================*/
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce button.button:disabled,
.woocommerce button.button:disabled[disabled],
.woocommerce button.button.alt,
.woocommerce a.button.alt,
.woocommerce input.button.alt,
.wishlist_table .add_to_cart.button{
	$button_shop_bg_color
	$button_shop_color
	$button_shop_font_size
	$button_shop_weight
	$button_shop_transform
	padding-left: $button_shop_padding_left;
	padding-right: $button_shop_padding_right;
}
.woocommerce button.button.alt,
.woocommerce a.button.alt,
.woocommerce input.button.alt{
	$button_shop_alt_bg_color
	$button_shop_alt_color
}
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.wishlist_table .add_to_cart.button:hover{
	$button_shop_hover_bg_color
	$button_shop_hover_color
}
.woocommerce button.button.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce input.button.alt:hover{
	$button_shop_alt_hover_bg_color
	$button_shop_alt_hover_color
}


/* ==================
   SHOP PRODUCTS LIST
   ==================*/
.woocommerce-page .title-bar.outside{
    $shop_title_bar_image
    $shop_title_bar_image_fit
}
.woocommerce-page .title-bar.outside .overlay-color{
    $shop_title_bar_bg_color
    padding-top: $shop_title_bar_space_width;
    padding-bottom: $shop_title_bar_space_width;
}
.woocommerce-page .title-bar.outside .page-title,
.woocommerce-page .title-bar.outside h2{
    $shop_title_bar_title_color
}
.woocommerce-page .title-bar.outside .breadcrumbs,
.woocommerce-page .title-bar.outside .breadcrumbs a,
.woocommerce-page .title-bar.outside .breadcrumbs a:hover{
    $shop_title_bar_color_1
}

.content-box ul.products{
	margin-right: -$shop_margin;
}
.rtl .content-box ul.products{
    margin-right: 0;
    margin-left: -$shop_margin;
}
.woocommerce-page ul.products li.product{
	$shop_item_bottom_gutter
}

/* columns */
.woocommerce-page .shop-columns-4 ul.products li.product,
.woocommerce-page .shop-columns-4 ul.products .grid-master{
	width: 25%;
	width: calc(25% - $shop_margin);
}
.woocommerce-page .shop-columns-3 ul.products li.product,
.woocommerce-page .shop-columns-3 ul.products .grid-master{
	width: 33.3333333%;
	width: calc(33.3333333% - $shop_margin);
}
.woocommerce-page .shop-columns-2 ul.products li.product,
.woocommerce-page .shop-columns-2 ul.products .grid-master{
	width: 50%;
	width: 50%;
	width: calc(50% - $shop_margin);
}
.woocommerce-page .shop-columns-1 ul.products li.product,
.woocommerce-page .shop-columns-1 ul.products .grid-master{
	width: 100%;
}


/* sidebars */
.products-list .layout-full.with-sidebar .content-box,
.products-list .layout-full_fixed.with-sidebar .content-box,
.products-list .layout-full_padding.with-sidebar .content-box{
	margin-left: $shop_margin;
	width: 75%;
	width: calc(75% - $shop_margin);
}
.products-list .layout-full.right-sidebar .content-box,
.products-list .layout-full_fixed.right-sidebar .content-box,
.products-list .layout-full_padding.right-sidebar .content-box{
	margin-left: 0;
	margin-right: $shop_margin;
}

/* responsive rules */
@media only screen and (min-width: 1560px) {
	.products-list .layout-full.with-sidebar .content-box{
		width: calc(100% - 320px".($shop_margin === '0px'? '' : ' - '.$shop_margin)."); /* 320 sidebar*/
	}
}

@media only screen and (min-width: 1640px) {
	.products-list .layout-full_padding.with-sidebar .content-box{
		width: calc(100% - 320px".($shop_margin === '0px'? '' : ' - '.$shop_margin)."); /* 320 sidebar*/
	}
}

@media only screen and (max-width: 1400px) and (min-width: 1025px) {
	/* make sure that sidebar wont get too narrow */
	.products-list .layout-full_padding.with-sidebar .content-box{
		width: 70%;
		width: calc(70% - $shop_margin);
	}
}

@media only screen and (max-width: 1320px) and (min-width: 1025px) {
	/* make sure that sidebar wont get too narrow */
	.products-list .layout-full.with-sidebar .content-box{
		width: 70%;
		width: calc(70% - $shop_margin);
	}
}

@media only screen and (max-width: 1279px){
	/* fluid layout columns */

	/* 3 columns */
	.woocommerce-page .layout-fluid.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-fluid.shop-columns-4 ul.products .grid-master{
		width: 33.3333333%;
		width: calc(33.3333333% - $shop_margin);
	}

	/* 2 columns - when vertical header and sidebar are present */
	.header-vertical.woocommerce-page .layout-fluid.with-sidebar.shop-columns-4 ul.products li.product,
	.header-vertical.woocommerce-page .layout-fluid.with-sidebar.shop-columns-4 ul.products .grid-master,
	.header-vertical.woocommerce-page .layout-fluid.with-sidebar.shop-columns-3 ul.products li.product,
	.header-vertical.woocommerce-page .layout-fluid.with-sidebar.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}

	/* fixed layout columns */

	/* 3 columns - when vertical header and sidebar are present */
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-4 ul.products .grid-master{
		width: 33.3333333%;
		width: calc(33.3333333% - $shop_margin);
	}

	/* edge layout columns */

	/* 3 columns - when vertical header and sidebar are present */
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products .grid-master{
		width: 33.3333333%;
		width: calc(33.3333333% - $shop_margin);
	}
}

@media only screen and (max-width: 1080px) {
	/* fixed layout columns */

	/* 3 columns */
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-4 ul.products .grid-master{
		width: 33.3333333%;
		width: calc(33.3333333% - $shop_margin);
	}

	/* 2 columns - when vertical header and sidebar are present */
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-4 ul.products .grid-master,
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-3 ul.products li.product,
	.header-vertical.woocommerce-page .layout-fixed.layout-no-edge.with-sidebar.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}
}

@media only screen and (max-width: 1024px) {
	.products-list .layout-full.with-sidebar .content-box,
	.products-list .layout-full_fixed.with-sidebar .content-box,
	.products-list .layout-full_padding.with-sidebar .content-box{
		width: 70%;
		width: calc(70% - $shop_margin);
	}
}

@media only screen and (max-width: 1000px) {
	/* edge layout columns */

	/* 3 columns */
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products .grid-master{
		width: 33.3333333%;
		width: calc(33.3333333% - $shop_margin);
	}
}

@media only screen and (max-width: 800px){
	/* fluid layout columns */

	/* 2 columns */
	.woocommerce-page .layout-fluid.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-fluid.shop-columns-4 ul.products .grid-master,
	.woocommerce-page .layout-fluid.shop-columns-3 ul.products li.product,
	.woocommerce-page .layout-fluid.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}

	/* fixed layout columns */

	/* 2 columns */
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-4 ul.products .grid-master,
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-3 ul.products li.product,
	.woocommerce-page .layout-fixed.layout-no-edge.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}

	/* edge layout columns */

	/* 2 columns */
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products .grid-master,
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-3 ul.products li.product,
	.woocommerce-page .layout-edge.with-sidebar.shop-columns-3 ul.products .grid-master,
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products li.product,
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-4 ul.products .grid-master,
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-3 ul.products li.product,
	.header-vertical.woocommerce-page .layout-edge.with-sidebar.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}
}

@media only screen and (max-width: 768px) {
	.products-list .layout-full.with-sidebar .content-box,
	.products-list .layout-full_fixed.with-sidebar .content-box,
	.products-list .layout-full_padding.with-sidebar .content-box{
		width: auto;
		margin-left: 0;
		margin-right: 0;
	}
}

@media only screen and (max-width: 700px){
	/* edge layout columns */

	/* 2 columns */
	.woocommerce-page .layout-edge.shop-columns-4 ul.products li.product,
	.woocommerce-page .layout-edge.shop-columns-4 ul.products .grid-master,
	.woocommerce-page .layout-edge.shop-columns-3 ul.products li.product,
	.woocommerce-page .layout-edge.shop-columns-3 ul.products .grid-master{
		width: 50%;
		width: calc(50% - $shop_margin);
	}
}

@media only screen and (max-width: 480px) {
    $shop_mobile_columns
}


/* ==================
   SHOP NO MAJOR PAGES
   ==================*/
.woocommerce-no-major-page .title-bar.outside{
    $shop_nmp_title_bar_image
    $shop_nmp_title_bar_image_fit
}
.woocommerce-no-major-page .title-bar.outside .overlay-color{
    $shop_nmp_title_bar_bg_color
    padding-top: $shop_nmp_title_bar_space_width;
    padding-bottom: $shop_nmp_title_bar_space_width;
}
.woocommerce-no-major-page .title-bar.outside .page-title,
.woocommerce-no-major-page .title-bar.outside h2{
    $shop_nmp_title_bar_title_color
}
.woocommerce-no-major-page .title-bar.outside .breadcrumbs,
.woocommerce-no-major-page .title-bar.outside .breadcrumbs a,
.woocommerce-no-major-page .title-bar.outside .breadcrumbs a:hover{
    $shop_nmp_title_bar_color_1
}


/* ==================
   SINGLE PRODUCT
   ==================*/
.single-product .title-bar.outside{
    $product_title_bar_image
    $product_title_bar_image_fit
}
.single-product .title-bar.outside .overlay-color{
    $product_title_bar_bg_color
    padding-top: $product_title_bar_space_width;
    padding-bottom: $product_title_bar_space_width;
}
.single-product .title-bar.outside .page-title,
.single-product .title-bar.outside h2{
    $product_title_bar_title_color
}
.single-product .title-bar.outside .breadcrumbs,
.single-product .title-bar.outside .breadcrumbs a,
.single-product .title-bar.outside .breadcrumbs a:hover{
    $product_title_bar_color_1
}
";


	return $css;
}
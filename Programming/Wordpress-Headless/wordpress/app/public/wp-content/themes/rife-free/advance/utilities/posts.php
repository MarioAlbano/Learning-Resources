<?php
/**
 * Functions that are connected to handling posts content
 */

if(!function_exists( 'apollo13framework_get_post_meta_data' )){
    /**
     * Returns post meta data like date, author, comments number and categories
     *
     * @since 2.3.0
     */
    function apollo13framework_get_post_meta_data() {
        global $apollo13framework_a13;

        $types      = apollo13framework_what_page_type_is_it();
        $post       = $types['post'];//general type of page
        $post_list  = $types['blog_type'];//general type of page
        $page       = 'page' === get_post_type();//in loop type
        $return     = '';

        //when call was made for something else then post or blog, then lets treat it as blog
        //it will enable showing this module in Visual Composer in Post grid
        if(!$post && !$post_list){
            $post_list = true;
        }

	    //return date
        if(
            ($post && $apollo13framework_a13->get_option( 'post_date') === 'on')
            ||
            ($post_list && $apollo13framework_a13->get_option( 'blog_date') === 'on')
        ){
            $return .= apollo13framework_posted_on();
        }

	    //return updated date
        if(
            ($post && $apollo13framework_a13->get_option( 'post_date') === 'updated')
            ||
            ($post_list && $apollo13framework_a13->get_option( 'blog_date') === 'updated')
        ){
            $return .= esc_html__( 'Updated: ', 'rife-free' ).apollo13framework_modified_on();
        }

	    //return author
	    if( $page ){
            //no author for page post type
            $return  = '';
        }
        elseif(
		    ($post && $apollo13framework_a13->get_option( 'post_author') === 'on')
		    ||
		    ($post_list && $apollo13framework_a13->get_option( 'blog_author') === 'on')
	    ){
		    $return .= apollo13framework_posted_by_author();
	    }

        //return comments number
        if(
            ($post && $apollo13framework_a13->get_option( 'post_comments') === 'on')
            ||
            ($post_list && $apollo13framework_a13->get_option( 'blog_comments') === 'on')
        ){
            $return .= apollo13framework_post_comments();
        }

        //Categories
        if(
            ($post && $apollo13framework_a13->get_option( 'post_cats') === 'on')
            ||
            ($post_list && $apollo13framework_a13->get_option( 'blog_cats') === 'on')
        ){
            $categories = get_the_category_list(', ');
            if(strlen($categories)){
                //if there is already any content
                if(strlen($return)){
                    $return .= '<span class="separator"></span>';
                }

                $return .= '<div class="post-meta-categories">'.$categories.'</div>';
            }
        }

	    if(strlen($return)){
		    return '<div class="post-meta">'.$return.'</div>';
	    }

        return '';
    }
}


if(!function_exists( 'apollo13framework_post_meta_data' )){
    /**
     * Outputs post meta data like date, author, comments number and categories
     *
     * @since 2.3.0
     */
    function apollo13framework_post_meta_data() {
        echo apollo13framework_get_post_meta_data();
    }
}


if(!function_exists('apollo13framework_posted_on')){
	/**
	 * get HTML for date of post
     * @return string
     */
    function apollo13framework_posted_on() {
        return '<time class="entry-date published updated" datetime="'.esc_attr( get_the_date( 'c' ) ).'" itemprop="datePublished">'.get_the_date().'</time> ';
    }
}


if(!function_exists('apollo13framework_modified_on')){
	/**
	 * get HTML for date of post
     * @return string
     */
    function apollo13framework_modified_on() {
        return '<time class="entry-date updated" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'" itemprop="dateModified">'.get_the_modified_date().'</time> ';
    }
}


if(!function_exists('apollo13framework_posted_by_author')){
	/**
	 * Author of post
	 * @return string
	 */
	function apollo13framework_posted_by_author() {
        /** @noinspection HtmlUnknownAttribute */
        return
            /* translators: %s - author name */
			sprintf(  esc_html__( 'by %s ', 'rife-free' ),
                sprintf('<a class="vcard author" href="%1$s" title="%2$s" %4$s><span class="fn" %5$s>%3$s</span></a>',
				    esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )),
                    /* translators: %s - author name */
				    sprintf( esc_attr__( 'View all posts by %s', 'rife-free' ), get_the_author() ),
				    get_the_author(),
                    apollo13framework_get_schema_args('author'),
                    apollo13framework_get_schema_args('name')
                )
			).' ';//additional space in case someone removed it during translation
	}
}


if(!function_exists('apollo13framework_post_comments')){
	/**
	 * comments link
	 *
     * @return string HTML
     */
    function apollo13framework_post_comments() {
        $comment_number = get_comments_number();

        /** @noinspection HtmlUnknownAttribute */
        $schema =
'<span itemprop="interactionStatistic" itemscope itemtype="http://schema.org/InteractionCounter">
    <meta itemprop="interactionType" content="http://schema.org/CommentAction"/>
    <meta itemprop="userInteractionCount" content="'.esc_attr($comment_number).'" />
</span>';

        return '<a class="comments" href="' . esc_url(get_comments_link()) . '"><i class="fa fa-comment-o"></i> ' .$comment_number. '</a>'.$schema;
    }
}


if(!function_exists('apollo13framework_under_post_content')){
    function apollo13framework_under_post_content() {
        global $apollo13framework_a13;

        $types      = apollo13framework_what_page_type_is_it();
        $post       = $types['post'];
        $post_list  = $types['blog_type'];

        //when call was made for something else then post or blog, then lets treat it as blog
        //it will enable showing this module in Visual Composer in Post grid
        if(!$post && !$post_list){
            $post_list = true;
        }

        //links to other subpages
        wp_link_pages( array(
                'before' => '<div id="page-links"><span class="page-links-title">'. esc_html__( 'Pages: ', 'rife-free' ).'</span>',
                'after'  => '</div>'
	        )
        );

        //Tags under content
        if(
            ($post && $apollo13framework_a13->get_option( 'post_tags' ) === 'on')
            ||
            ($post_list && $apollo13framework_a13->get_option( 'blog_tags' ) === 'on')
        ){
            $tag_list = get_the_tag_list( '',' ' );
            if ( $tag_list ) {
                echo '<p class="under_content_tags">'.wp_kses_post( $tag_list ).'</p>';
            }
        }
    }
}


if(!function_exists('apollo13framework_author_info')){
	/**
     * Displays author info in posts(if enabled)
     */
    function apollo13framework_author_info() {
        global $apollo13framework_a13;

        $author_description =  get_the_author_meta( 'description' );

        if( ( strlen($author_description) > 0 ) && $apollo13framework_a13->get_option( 'post_author_info' ) === 'on'): ?>
            <div class="about-author comment"<?php apollo13framework_schema_args('author_box'); ?>>
                <div class="comment-body">
                    <?php $author_ID = get_the_author_meta( 'ID' );
                        echo '<a href="'.esc_url( get_author_posts_url($author_ID) ).'" class="avatar"'.apollo13framework_get_schema_args('url').'>'.get_avatar( $author_ID, 90 ).'</a>';
                        echo '<strong class="comment-author"><span class="author-name" '.apollo13framework_get_schema_args('name').'>'.get_the_author().'</span>';
                        $u_url = get_the_author_meta( 'user_url' );
                        if( ! empty( $u_url ) ){
                            echo '<a href="' . esc_url($u_url) . '" class="url">(' . esc_html( $u_url ) . ')</a>';
                        }
                        echo '</strong>';
                    ?>
                    <div class="comment-content">
                        <?php
                        echo wp_kses_post( $author_description );
                        ?>
                    </div>
                </div>
            </div>
        <?php endif;
    }
}


if(!function_exists('apollo13framework_posts_navigation')){
	/**
     * Displays navigation to next and previous post
     */
    function apollo13framework_posts_navigation() {
        global $apollo13framework_a13;

        if($apollo13framework_a13->get_option( 'post_navigation' ) === 'on'){
            //posts navigation
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            $is_next = is_object($next_post);
            $is_prev = is_object($prev_post);

            if($is_prev || $is_next){
                echo '<div class="posts-nav">';

                /**
                 * Sample usage to change size of images in post naviagtion
                add_filter( 'apollo13framework_post_navigation_image_size', function(){
                    return array(245,245);
                });
                 *
                 */
                //It seems that Jetpack is not takign "crop" instruction into consideration when moving images to its CDN. That is when below code would help
//                $image_sizes = apply_filters( 'apollo13framework_post_navigation_image_size', array( 'a13_navigation_image_size' ) );
                $image_sizes = apply_filters( 'apollo13framework_post_navigation_image_size', array( 245, 100 ) );

                if($is_prev){
                    $id = $prev_post->ID;
                    echo '<a href="'.esc_url( get_permalink($id) ).'" class="item prev">'
                         .'<span><i class="fa fa-long-arrow-'.( is_rtl() ? 'right' : 'left' ).'"></i> '.esc_html__( 'Previous article', 'rife-free' ).'</span>'
                         .'<span class="title">'.esc_html( $prev_post->post_title ).'</span>'
                         .'<span class="image">'.apollo13framework_make_post_image( $id, $image_sizes ).'</span>'
                         .'</a>';
                }
                if($is_next){
                    $id = $next_post->ID;
                    echo '<a href="'.esc_url( get_permalink($id) ).'" class="item next">'
                         .'<span>'.esc_html__( 'Next article', 'rife-free' ).' <i class="fa fa-long-arrow-'.( is_rtl() ? 'left' : 'right' ).'"></i></span>'
                         .'<span class="title">'.esc_html( $next_post->post_title ).'</span>'
                         .'<span class="image">'.apollo13framework_make_post_image( $id, $image_sizes ).'</span>'
                         .'</a>';
                }

                echo '</div>';
            }
        }
    }
}


if(!function_exists('apollo13framework_excerpt_length')){
    /**
     * Sets the post excerpt length to value from theme setting(N words).
     *
     * @param int $length number of words
     *
     * @return int number of words
     */
    function apollo13framework_excerpt_length($length) {
        $ajax_for_vc_grid = defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['action']) && ($_POST['action'] === 'vc_get_vc_grid_data');

        if ( is_admin() && !$ajax_for_vc_grid ) {
            return $length;
        }

        global $apollo13framework_a13;
        return (int) $apollo13framework_a13->get_option( 'blog_excerpt_length') ;
    }
}
add_filter( 'excerpt_length', 'apollo13framework_excerpt_length' );


if(!function_exists('apollo13framework_new_excerpt_more')){
    /**
     * This filter is used by wp_trim_excerpt() function.
     * By default it set to echo '[...]' more string at the end of the excerpt.
     *
     * @param string $link default link
     *
     * @return string HTML
     */
    function apollo13framework_new_excerpt_more($link) {
        $ajax_for_vc_grid = defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['action']) && ($_POST['action'] === 'vc_get_vc_grid_data');

        if ( is_admin() && !$ajax_for_vc_grid ) {
            return $link;
        }

        global $post, $apollo13framework_a13;
        if( $apollo13framework_a13->get_option( 'blog_read_more', 'on' ) === 'off' ){
            return '';
        }

        //no post(for example JSON call)
        if ( is_null($post) ) {
            return $link;
        }

        //return read more
        return '&hellip;
 <p> <a class="more-link" href="'. esc_url( get_permalink($post->ID) ) . '">'.esc_html__( 'Read more', 'rife-free' ).'</a></p>';
    }
}
add_filter( 'excerpt_more', 'apollo13framework_new_excerpt_more' );



if(!function_exists('apollo13framework_has_excerpt_read_more')){
	/**
	 * Adds read more when excerpt is provided by user
	 *
     * @return string HTML
     */
    function apollo13framework_has_excerpt_read_more($content) {
        global $post, $apollo13framework_a13;

        if( $apollo13framework_a13->get_option( 'blog_read_more', 'on' ) === 'on' && has_excerpt() ){
            $content .= '<p> <a class="more-link" href="'. esc_url( get_permalink($post->ID) ) . '">'.esc_html__( 'Read more', 'rife-free' ).'</a></p>';
        }

        return $content;
    }
}
add_filter( 'the_excerpt', 'apollo13framework_has_excerpt_read_more' );


if(!function_exists('apollo13framework_read_more_new_line')){
	/**
	 * Wraps read more in new paragraph so it will land in new line
	 *
	 * @param string $link current link in HTML
	 *
	 * @return string HTML
	 */
    function apollo13framework_read_more_new_line($link) {
        return '<p>'.$link.'</p>';
    }
}
add_filter( 'the_content_more_link', 'apollo13framework_read_more_new_line' );



if(!function_exists('apollo13framework_comments_navigation')){
	/**
     * Comments navigation
     */
    function apollo13framework_comments_navigation() {
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'rife-free' ); ?></h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'rife-free' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', wp_kses_post( $prev_link ) );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'rife-free' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', wp_kses_post( $next_link ) );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
}



if(!function_exists('apollo13framework_daoon_chat_post')){
    /**
     * Creates chat transcript from post content
     * Credits to http://hirizh.name/blog/styling-chat-transcript-for-custom-post-format/
     * @param string $content Current post content
     *
     * @return string
     */
    function apollo13framework_daoon_chat_post($content) {
        $chatoutput = "<div class=\"chat\">\n";
        $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);
        foreach($split as $haystack) {
            if (strpos($haystack, ":")) {
                $string = explode(":", trim($haystack), 2);
                $who = strip_tags(trim($string[0]));
                $what = strip_tags(trim($string[1]));
                $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                $chatoutput .= "<p><strong class=\"who\">$who:</strong> $what</p>\n";
            } else {
                $chatoutput .= $haystack . "\n";
            }
        }

        // print our new formated chat post
        $content = $chatoutput . "</div>\n";
        return $content;
    }
}



if(!function_exists('apollo13framework_display_items_from_query_post_list')) {
    /**
     * @param bool|WP_Query $query
     * @param array         $args
     */
    function apollo13framework_display_items_from_query_post_list($query = false, $args = array()){
        global $apollo13framework_a13;

        static $id = 0;
        $id++;

        if($query === false){
            global $wp_query;
            $query = $wp_query;
        }

        $default_args = array(
            'columns'         => $apollo13framework_a13->get_option( 'blog_brick_columns' ),
            'max_width'       => $apollo13framework_a13->get_option( 'blog_bricks_max_width' ),
            'margin'          => $apollo13framework_a13->get_option( 'blog_brick_margin' ),
            'filter'          => false,
            'default_filter'  => '__all',
            'all_filter'      => true,
            'display_post_id' => true,
        );

        $args = wp_parse_args($args, $default_args);

        /* show filter? */
        if($args['filter']){
            $query_args = array(
                'hide_empty' => true,
                'object_ids' => wp_list_pluck( $query->posts, 'ID' ),
                'taxonomy'   => 'category'
            );

            /** @noinspection PhpInternalEntityUsedInspection */
            $terms = get_terms( $query_args );

            apollo13framework_make_post_grid_filter($terms, 'posts-filter', $args['default_filter'], $args['all_filter']);
        }


        /* If there are no posts to display, such as an empty archive page */

        if ( ! $query->have_posts() ):
            ?>
            <div class="formatter">
                <div class="real-content empty-blog">
                    <?php
                    if( !is_search() ){
                        echo '<p>'.esc_html__( 'Apologies, but no results were found for the requested archive.', 'rife-free' ).'</p>';
                    }
                    get_template_part( 'no-content');
                    ?>
                </div>
            </div>
            <?php

        else:
            $ajax_call = isset( $_REQUEST['a13-ajax-get'] );
            $page_type = apollo13framework_what_page_type_is_it();
            $post_list_page = $page_type['blog_type'];

            $posts_classes = '';
            $posts_layout_class = $apollo13framework_a13->get_option( 'blog_post_look');
            $posts_classes .= ' posts_'.$posts_layout_class;
            $args['columns'] = ($posts_layout_class === 'horizontal') ? 1 : $args['columns'];
            $posts_classes .= ' posts-columns-'.$args['columns'];

            echo '<div class="bricks-frame posts-bricks posts-bricks-' . esc_attr( $id ) .' '. esc_attr( $posts_classes ) . '">';
            echo '<div class="posts-grid-container"';
            //lazy load on
            if($post_list_page){
                $lazy_load        = $apollo13framework_a13->get_option( 'blog_lazy_load' ) === 'on';
                $lazy_load_mode   = $apollo13framework_a13->get_option( 'blog_lazy_load_mode' );
                echo ' data-lazy-load="' . esc_attr( $lazy_load ) . '" data-lazy-load-mode="' . esc_attr( $lazy_load_mode ) . '"';
            }
            echo ' data-margin="' . esc_attr( $args['margin'] ) . '">';
            echo '<div class="grid-master"></div>';

            while ( $query->have_posts() ) : $query->the_post();
                $post_id = get_the_ID();

                //get post categories
                $terms = wp_get_post_categories($post_id, array("fields" => "all"));

                //we style different when some post formats are used
                $special_post_formats   = array('link', 'status', 'quote', 'chat');
                $post_format            = get_post_format();
                $is_special_post_format = (in_array($post_format, $special_post_formats));
                $post_classes           = $is_special_post_format? 'archive-item special-post-format' : 'archive-item';
                $link_it                = $is_special_post_format? false : true;

                //size of brick
                $brick_size = ($posts_layout_class === 'horizontal') ? 1 : $apollo13framework_a13->get_meta( '_brick_ratio_x' );
                $post_classes .= strlen( $brick_size ) ? ' w' . $brick_size : '';

                /* 3 echos for easier sniffs */
                echo '<div';
                echo $args['display_post_id']? ' id="post-'.esc_attr(get_the_ID()).'"' : '';
                echo ' class="'.esc_attr( join( ' ', get_post_class($post_classes) ) ).'"';
                //get all categories that item belongs to
                if( count( $terms ) ){
                    foreach($terms as $term) {
                        echo ' data-category-'.esc_attr( $term->term_id ).'="1"';
                    }
                }
                apollo13framework_schema_args('creative');
                echo '>';

                    if(post_password_required()){
                        apollo13framework_top_image_video($link_it, array_merge($args, array('page_type' => 'blog_type', 'post_grid' => true ) ) );
                        ?>
                        <div class="formatter">
                            <?php the_title('<h2 class="post-title entry-title"><a href="'. esc_url( get_permalink() ) . '"><span class="fa fa-lock"></span>', '</a></h2>'); ?>
                            <div class="real-content">
                                <p><?php esc_html_e( 'To view it please enter your password below', 'rife-free' ); ?></p>
                                <?php echo apollo13framework_password_form(); //escaped on creation  ?>
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        //classic layout of post
                        apollo13framework_top_image_video($link_it, array_merge($args, array('page_type' => 'blog_type', 'post_grid' => true ) ) );

                        get_template_part( 'content', get_post_format() );

                        if($posts_layout_class === 'horizontal') {
                            echo '<div class="clear"></div>';
                        }
                    }

            echo '</div>';

            endwhile;

            echo '</div></div>';
            if(!$ajax_call){
                apollo13framework_post_list_individual_look($id, $args);
            }
        endif;
    }
}


/**
 * Remove 'hentry' from post_class()
 * it is added manually in different container
 */
function apollo13framework_remove_hentry( $class ) {
    $class = array_diff( $class, array( 'hentry' ) );
    return $class;
}
add_filter( 'post_class', 'apollo13framework_remove_hentry' );



if ( ! function_exists( 'apollo13framework_next_posts_link_class' ) ) {
	/**
	 * Adding class for compatibility with Wp-paginate plugin + infinite scroll configuration
	 *
	 * @return string
	 */
	function apollo13framework_next_posts_link_class() {
		return 'class="next"';
	}
}

if ( ! function_exists( 'apollo13framework_prev_posts_link_class' ) ) {
	/**
	 * Adding class for compatibility with Wp-paginate plugin + infinite scroll configuration
	 *
	 * @return string
	 */
	function apollo13framework_prev_posts_link_class() {
		return 'class="prev"';
	}
}
add_filter( 'next_posts_link_attributes', 'apollo13framework_next_posts_link_class' );
add_filter( 'previous_posts_link_attributes', 'apollo13framework_prev_posts_link_class' );



if(!function_exists('apollo13framework_post_list_individual_look')){
    /**
     * Prepares CSS specially for each posts list
     *
     * @since 2.1.0
     *
     * @param $id int unique id for current posts list
     * @param $args array custom params for posts list
     */
    function apollo13framework_post_list_individual_look($id, $args){
        $css = '';

        $max_width        = (int) $args['max_width'];
        $max_width        = esc_html( apollo13framework_make_css_rule( 'max-width', $max_width, '%spx' ) );
        $margin           = (int) $args['margin'];
        $margin           = esc_html( $margin . 'px' );
        $calc_safe_margin = esc_html( $margin === '0px' ? '' : ' - ' . $margin );

        //space in case of different layout mode
        $item_bottom_gutter = wp_strip_all_tags( 'margin-bottom: ' . $margin . ';' );

        $selector_class   = wp_strip_all_tags( '.posts-bricks-' . $id );

        $css .= '
'.$selector_class.'{
	'.$max_width.'
}
'.$selector_class.' .posts-grid-container{
	margin-right: -'.$margin.';
}
.rtl '.$selector_class.' .posts-grid-container{
	margin-right: 0;
	margin-left: -'.$margin.';
}
'.$selector_class.' .layout-fitRows .archive-item,
'.$selector_class.' .layout-masonry .archive-item{
    '.$item_bottom_gutter.'
}

/* 4 columns */
'.$selector_class.'.posts-columns-4 .archive-item,
'.$selector_class.'.posts-columns-4 .grid-master{
	width: calc(25%'.$calc_safe_margin.');
}
'.$selector_class.'.posts-columns-4 .archive-item.w2{
	width: calc(50%'.$calc_safe_margin.');
}
'.$selector_class.'.posts-columns-4 .archive-item.w3{
	width: calc(75%'.$calc_safe_margin.');
}

/* 3 columns */
'.$selector_class.'.posts-columns-3 .archive-item,
'.$selector_class.'.posts-columns-3 .grid-master{
	width: calc(33.3333333%'.$calc_safe_margin.');
}
'.$selector_class.'.posts-columns-3 .archive-item.w2{
	width: calc(66.6666666%'.$calc_safe_margin.');
}

/* 2 columns */
'.$selector_class.'.posts-columns-2 .archive-item,
'.$selector_class.'.posts-columns-2 .grid-master{
	width: calc(50%'.$calc_safe_margin.');
}

/* 100% width bricks */
'.$selector_class.'.posts-columns-1 .grid-master,
'.$selector_class.'.posts-columns-1 .archive-item,
'.$selector_class.'.posts-columns-2 .archive-item.w2,
'.$selector_class.'.posts-columns-2 .archive-item.w3,
'.$selector_class.'.posts-columns-2 .archive-item.w4,
'.$selector_class.'.posts-columns-3 .archive-item.w3,
'.$selector_class.'.posts-columns-3 .archive-item.w4,
'.$selector_class.'.posts-columns-4 .archive-item.w4{
	width: calc(100%'.$calc_safe_margin.');
}

/* responsive rules */
@media only screen and (max-width: 1600px){
	/* 4 ->3 columns - when vertical header and sidebar are present */
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .grid-master{
		width: calc(33.3333333%'.$calc_safe_margin.');
	}
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item.w2{
		width: calc(66.6666666%'.$calc_safe_margin.');
	}
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item.w3{
		width: calc(100%'.$calc_safe_margin.');
	}
}
@media only screen and (max-width: 1279px){
	/* fluid layout columns */

	/* 4 -> 3 columns */
	'.$selector_class.'.posts-columns-4 .archive-item,
	'.$selector_class.'.posts-columns-4 .grid-master{
		width: calc(33.3333333%'.$calc_safe_margin.');
	}
	'.$selector_class.'.posts-columns-4 .archive-item.w2{
		width: calc(66.6666666%'.$calc_safe_margin.');
	}
	'.$selector_class.'.posts-columns-4 .archive-item.w3{
		width: calc(100%'.$calc_safe_margin.');
	}

	/* 4,3 -> 2 columns - when vertical header and sidebar are present */
	.header-vertical .layout-fluid.with-sidebar '.$selector_class.'.posts-columns-4 .grid-master,
	.header-vertical .layout-fluid.with-sidebar '.$selector_class.'.posts-columns-4 .archive-item,
	.header-vertical .layout-fluid.with-sidebar '.$selector_class.'.posts-columns-4 .archive-item.w2,
	.header-vertical .layout-fluid.with-sidebar '.$selector_class.'.posts-columns-3 .grid-master,
	.header-vertical .layout-fluid.with-sidebar '.$selector_class.'.posts-columns-3 .archive-item{
		width: calc(50%'.$calc_safe_margin.');
	}
	.header-vertical .layout-fluid.with-sidebar .posts-columns-4 .archive-item.w3,
	.header-vertical .layout-fluid.with-sidebar .posts-columns-3 .archive-item.w2{
		width: calc(100%'.$calc_safe_margin.');
	}

	/* 4,3 -> 2 columns - when vertical header and sidebar are present */
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .grid-master,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item.w2,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-3 .grid-master,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-3 .archive-item{
		width: calc(50%'.$calc_safe_margin.');
	}
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-4 .archive-item.w3,
	.header-vertical .with-sidebar '.$selector_class.'.posts-columns-3 .archive-item.w2{
		width: calc(100%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 800px){
	/* 4,3 -> 2 columns */
	#mid '.$selector_class.'.posts-columns-4 .archive-item,
	#mid '.$selector_class.'.posts-columns-4 .grid-master,
	#mid '.$selector_class.'.posts-columns-4 .archive-item.w2,
	#mid '.$selector_class.'.posts-columns-3 .archive-item,
	#mid '.$selector_class.'.posts-columns-3 .grid-master{
		width: calc(50%'.$calc_safe_margin.');
	}
	#mid '.$selector_class.'.posts-columns-4 .archive-item.w3,
	#mid '.$selector_class.'.posts-columns-3 .archive-item.w2{
		width: calc(100%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 480px) {
	'.$selector_class.' .posts-grid-container{
		margin-right: 0;
	}
	.rtl '.$selector_class.' .posts-grid-container{
        margin-left: 0;
    }

	/* all bricks layouts -> 1 column */
	#mid '.$selector_class.'.posts-columns-4 .grid-master,
	#mid '.$selector_class.'.posts-columns-4 .archive-item,
	#mid '.$selector_class.'.posts-columns-4 .archive-item.w2,
	#mid '.$selector_class.'.posts-columns-4 .archive-item.w3,
	#mid '.$selector_class.'.posts-columns-4 .archive-item.w4,
	#mid '.$selector_class.'.posts-columns-3 .grid-master,
	#mid '.$selector_class.'.posts-columns-3 .archive-item,
	#mid '.$selector_class.'.posts-columns-3 .archive-item.w2,
	#mid '.$selector_class.'.posts-columns-3 .archive-item.w3,
	#mid '.$selector_class.'.posts-columns-2 .grid-master,
	#mid '.$selector_class.'.posts-columns-2 .archive-item,
	#mid '.$selector_class.'.posts-columns-2 .archive-item.w2,
	#mid '.$selector_class.'.posts-columns-1 .grid-master,
	#mid '.$selector_class.'.posts-columns-1 .archive-item{
		width: 100%;
	}
}

/* sidebars work on blog or category/tag pages */
.posts-list .layout-full.with-sidebar .content-box,
.posts-list .layout-full_fixed.with-sidebar .content-box,
.posts-list .layout-full_padding.with-sidebar .content-box{
	margin-left: '.$margin.';
	width: calc(75%'.$calc_safe_margin.');
}

.posts-list .layout-full.right-sidebar .content-box,
.posts-list .layout-full_fixed.right-sidebar .content-box,
.posts-list .layout-full_padding.right-sidebar .content-box{
	margin-left: 0;
	margin-right: '.$margin.';
}

@media only screen and (min-width: 1560px) {
	.posts-list .layout-full.with-sidebar .content-box{
		width: calc(100% - 320px'.$calc_safe_margin.'); /* 320 sidebar*/
	}
}

@media only screen and (min-width: 1640px) {
	.posts-list .layout-full_padding.with-sidebar .content-box{
		width: calc(100% - 320px'.$calc_safe_margin.'); /* 320 sidebar*/
	}
}

@media only screen and (max-width: 1400px) and (min-width: 1025px) {
	/* make sure that sidebar wont get too narrow */
	.posts-list .layout-full_padding.with-sidebar .content-box{
		width: calc(70%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 1320px) and (min-width: 1025px) {
	/* make sure that sidebar wont get too narrow */
	.posts-list .layout-full.with-sidebar .content-box{
		width: calc(70%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 1024px) {
	.posts-list .layout-full.with-sidebar .content-box,
	.posts-list .layout-full_fixed.with-sidebar .content-box,
	.posts-list .layout-full_padding.with-sidebar .content-box{
		width: calc(70%'.$calc_safe_margin.');
	}
}

@media only screen and (max-width: 768px) {
	.posts-list .layout-full.with-sidebar .content-box,
	.posts-list .layout-full_fixed.with-sidebar .content-box,
	.posts-list .layout-full_padding.with-sidebar .content-box{
		width: auto;
		margin-left: 0;
		margin-right: 0;
	}
}';

        //if we have some CSS then add it
        if(strlen($css)){
            $css = apollo13framework_minify_css($css);

            // Elementor edit mode
            if ( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                //we need to print inline CSS this way, cause otherwise it will be enqueued in frame parent(wrong place)
                echo '<style type="text/css" media="all" id="a13-posts-grid-'.esc_attr($id).'">'.$css.'</style>';
            }
            // not edit mode
            else {
                //print posts grid inline CSS without attaching it to any style
                //credits to https://www.cssigniter.com/late-enqueue-inline-css-wordpress/
                wp_register_style( 'a13-posts-grid-'.esc_attr($id), false );
                wp_enqueue_style( 'a13-posts-grid-'.esc_attr($id) );
                wp_add_inline_style( 'a13-posts-grid-'.esc_attr($id), $css );
            }
        }
    }
}



if(!function_exists('apollo13framework_get_schema_args')){
    /**
     * Prepares schema.org arguments for elements
     *
     * @since 2.3.0
     *
     * @param $for  string - context of usage
     * @return      string - string of HTML attributes
     */
    function apollo13framework_get_schema_args( $for ){
        $prop = '';
        $scope = false;
        $type = '';

        $page_type = apollo13framework_what_page_type_is_it();

        if ( $for === 'body' ){
            if($page_type['blog_type'] && !$page_type['search']){
                $type = 'Blog';
            }
            elseif($page_type['search']){
                $type = 'SearchResultsPage';
            }
            else{
                $type = 'WebPage';
            }

            $scope = true;
        }
        elseif ( $for === 'creative' ){
            $scope = true;
            $type = 'CreativeWork';
        }
        elseif ( $for === 'header' ){
            $scope = true;
            $type = 'WPHeader';
        }
        elseif ( $for === 'footer' ){
            $scope = true;
            $type = 'WPFooter';
        }
        elseif ( $for === 'sidebar' ){
            $scope = true;
            $type = 'WPSideBar';
        }
        elseif ( $for === 'navigation' ){
            $scope = true;
            $type = 'SiteNavigationElement';
        }
        elseif ( $for === 'logo' ){
            $scope = true;
            $type = 'Organization';
        }
        elseif ( $for === 'logo_image' ){
            $prop = 'logo';
        }
        elseif ( $for === 'author_box' ){
            $prop = 'author';
            $scope = true;
            $type = 'Person';
        }
        elseif ( $for === 'author' ){
            $prop = 'author';
        }
        elseif ( $for === 'url' ){
            $prop = 'url';
        }
        elseif ( $for === 'name' ){
            $prop = 'name';
        }
        elseif ( $for === 'text' ){
            $prop = 'text';
        }
        elseif ( $for === 'headline' ){
            $prop = 'headline';
        }

        $attributes = array(
            'prop'  => $prop,
            'scope' => $scope,
            'type'  => $type
        );

        $attributes = apply_filters( 'apollo13framework_schema_args', $attributes, $for );
        /* SAMPLE USAGE */
        /*
        add_filter( 'apollo13framework_schema_args', function($args, $for){
                if($for == 'body'){
                    $args['type'] = 'Article';
                }

                return $args;
            },
            10, 2
        );
         *
        */


        $html_args = '';

        if( strlen( $attributes['prop'] ) ){
            $html_args .= ' itemprop="' . esc_attr( $attributes['prop'] ) . '"';
        }
        if( strlen( $attributes['type'] ) ){
            $html_args .= ' itemtype="https://schema.org/' . esc_attr( $attributes['type'] ) . '"';
        }
        if( $attributes['scope'] ){
            $html_args .= ' itemscope';
        }

        return $html_args;
    }
}


if(!function_exists('apollo13framework_schema_args')){
    /**
     * Outputs schema.org arguments for elements
     *
     * @since 2.3.0
     *
     * @param $for  string - context of usage
     * @return      string - string of HTML attributes
     */
    function apollo13framework_schema_args( $for ) {
        echo apollo13framework_get_schema_args( $for );
    }
}

if(!function_exists('apollo13framework_remove_wpseo')){
    /**
     * Removes Yoast SEO on some page that are password protected with the theme custom template
     *
     * @since 2.4.6
     *
     */
    function apollo13framework_remove_wpseo() {
        if( class_exists('WPSEO_Frontend') && post_password_required() ){
            global $wpseo_front;
            if( defined( $wpseo_front ) ){
                remove_action( 'wp_head', array( $wpseo_front, 'head' ), 1 );
            }
            else{
                $wp_thing = WPSEO_Frontend::get_instance();
                remove_action( 'wp_head', array( $wp_thing, 'head' ), 1 );
            }
        }
    }
}
add_action( 'template_redirect', 'apollo13framework_remove_wpseo' );
<?php
/**
 * Class A13FRAMEWORK_list_pages_walker
 * Used in Children Navigation Menu in sidebar
 */
class A13FRAMEWORK_list_pages_walker extends Walker_Page {
	/**
	 * @see   Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output       Passed by reference. Used to append additional content.
	 * @param object $page         Page data object.
	 * @param int    $depth        Depth of page. Used for padding.
	 * @param array  $args
	 * @param int    $current_page Page ID.
	 */
    function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

	    $link_before = $link_after = $date_format = '';
        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_post( $current_page );
            if ( in_array( $page->ID, $_current_page->ancestors ) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

        $output .= $indent . '<li class="' . $css_class . '"><a href="' . esc_url( get_permalink($page->ID) ) . '">'
            . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

        //$show_date & $link_before are from extract function running
        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

	        $output .= " " . mysql2date($date_format, $time);
        }
    }
}
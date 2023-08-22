<?php
/**
 * Class A13FRAMEWORK_menu_walker
 * Used in main menu
 */
class A13FRAMEWORK_menu_walker extends Walker_Nav_Menu {

	/**
	 * @see   Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string       $output Passed by reference. Used to append additional content.
	 * @param object       $item   Menu item data object.
	 * @param int          $depth  Depth of menu item. Used for padding.
	 * @param array|object $args
	 * @param int          $id     Menu item ID.
	 */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $apollo13framework_a13;

        static $mega_menu = false; //are we printing mega menu right now
        static $mega_menu_counter = 0; //we count columns of mega menu
        static $mm_columns = 1; //to remember how many columns this mega menu has
        static $displaying_html = false; //we don't display descendants if displaying html
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        //mega_menu

        if($depth === 0){
            $displaying_html = false; //reset
            if($item->a13_mega_menu === '1'){
                $mega_menu_counter = 0;
                $mega_menu = true;
                $mm_columns = $item->a13_mm_columns;
                $classes[] = 'mega-menu';
                $classes[] = 'mm_columns_'.$item->a13_mm_columns;
            }
            else{
                $mega_menu = false;
                $classes[] = 'normal-menu';
            }
        }
        if($depth === 1 && $mega_menu){
            if($mega_menu_counter % $mm_columns === 0){
                $classes[] = 'mm_new_row';
            }
            if($item->a13_mm_remove_item === '1'){
                $classes[] = 'mm_dont_show';
            }
            if(strlen($item->a13_mm_html)){
                $displaying_html = true;
                $classes[] = 'html_item';
            }
            else{
                $displaying_html = false;
            }

            $mega_menu_counter++;
        }

        //don't display descendants if displaying html
        if($depth > 1 && $displaying_html){
            //we print opening of list element cause WordPress will print close tag of this element anyway.
            $output .= '<li>';
            return;
        }

        //check if this element is a OnePage Navigation Pointer
        $is_nava = $item->object === 'nava';
        if( $is_nava ){
            $home_page_id = get_option('page_on_front');
            $frontpage = get_post( $home_page_id );

            if( !apollo13framework_is_no_property_page() ){
                global $post;
                $current_page_slug = $post->post_name;
            }
            else{
                $current_page_slug = '';
            }

            $nava_page_slug = get_post_meta( $item->object_id, 'a13_nava_page_slug', true );
            $nava_item_anchor = get_the_title( $item->object_id );
            $classes[] = 'a13_one_page';

            //it is on different page - absolute path
            if( $nava_page_slug != $current_page_slug ){
                //if nava leads to front-page
                if( $nava_page_slug == $frontpage->post_name ){
                    $url = get_home_url();
                }
                //it is on sub-page
                else{
                    $url = get_site_url(null, $nava_page_slug);
                }
                $item->url = $url.'/#'.$nava_item_anchor;
            }
            //it is on current page - just anchor
            else{
                $item->url = '#'.$nava_item_anchor;
            }
        }

        //checks if this element is parent element
        $is_parent    = (bool) array_search( 'menu-parent-item', $classes );
        $is_current_ancestor = false;
        $icon         = trim( $item->a13_item_icon );
        $dont_link    = $item->a13_unlinkable === '1';
        $name         = apply_filters( 'the_title', $item->title, $item->ID );
        $hover_effect = $apollo13framework_a13->get_option( 'menu_hover_effect' );
        $excluded_effect = in_array( $hover_effect, array('none','show_icon') );

        //check if it is vertical header and should sub-menu be open
        if( $apollo13framework_a13->get_option( 'header_type' ) === 'vertical' &&
            $apollo13framework_a13->get_option( 'submenu_active_open', 'off' ) === 'on' &&
            (bool) array_search( 'current-menu-ancestor', $classes ) )
        {
            $classes[] = 'to-open';
            $is_current_ancestor = true;
        }

        //if icon will be hiding on hover/active
        if( strlen($icon) && $hover_effect === 'show_icon' && $depth === 0){
            $classes[] = 'hidden-icon';
        }

        if($is_current_ancestor){
            $caret_class = 'fa-'.$apollo13framework_a13->get_option( $depth > 0 ? 'submenu_third_lvl_closer' : 'submenu_closer' );
        }
        else{
            $caret_class = 'fa-'.$apollo13framework_a13->get_option( $depth > 0 ? 'submenu_third_lvl_opener' : 'submenu_opener' );
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';


        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        if($displaying_html){
            $output .= $item->a13_mm_html;
            return;
        }

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= $dont_link? '<span class="title" tabindex="0">' : '<a'. $attributes .'>';
        $item_output .= ($excluded_effect && strlen($icon))? '<i class="fa fa-'.$icon.'"></i>' : '';

        $item_output .= ! $excluded_effect && $depth === 0 ? $args->link_before . '<em>' : $args->link_before;
        $item_output .= ( ( ! $excluded_effect && strlen( $icon ) ) ? '<i class="fa fa-' . $icon . '"></i>' : '' ) . trim( $name );
        $item_output .= ! $excluded_effect && $depth === 0 ? '</em>' . $args->link_after : $args->link_after;

        $item_output .= $dont_link? '</span>' : '</a>';
	    $item_output .= $is_parent? '<i tabindex="0" class="fa sub-mark '.$caret_class.'"></i>' : '';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
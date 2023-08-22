<?php
if(!function_exists( 'apollo13framework_is_sub_page' )){
	/**
	 * Check if current page is sub page
	 *
	 * @return bool|int ID of parent element, or false if it is not sub page
	 */
	function apollo13framework_is_sub_page() {
        global $post;                              // load details about this page

        if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
            return $post->post_parent;             // return the ID of the parent post

        } else {                                   // there is no parent so ...
            return false;                          // ... the answer to the question is false
        }
    }
}


if(!function_exists('apollo13framework_add_menu_parent_class')){
	/**
	 * Adds menu-parent-item class to parent elements in menu
	 *
	 * @param array $items menu items
	 *
	 * @return array
	 */
	function apollo13framework_add_menu_parent_class( $items ) {

        $parents = array();
        foreach ( $items as $item ) {
            if ( $item->menu_item_parent && strlen( (string)$item->menu_item_parent ) > 0 ) {
                $parents[] = (string)$item->menu_item_parent;
            }
        }

        foreach ( $items as $item ) {
            if ( in_array( (string)$item->ID, $parents, true ) ) {
                $item->classes[] = 'menu-parent-item';
            }
        }

        return $items;
    }
}
add_filter( 'wp_nav_menu_objects', 'apollo13framework_add_menu_parent_class' );


if(!function_exists('apollo13framework_page_menu')){
	/**
	 * Prints side menu for static pages that has parents or children
	 *
	 * @param bool|false $only_check if true then it wont print anything
	 *
	 * @return bool if menu have sub pages
	 */
	function apollo13framework_page_menu($only_check = false) {
        global $post;

        $there_is_menu = false;

        $has_children_args = array(
            'post_parent' => $post->ID,
            'post_status' => 'publish',
            'post_type' => 'any',
        );

        $list_pages_params = array(
            'child_of'      => $post->post_parent,
            'sort_column'   => 'menu_order',
            'depth'         => 0,
            'title_li'      => ''
        );

        if(apollo13framework_is_sub_page()){
            if($only_check){ return true; }
            $there_is_menu = true;
        }
        elseif(get_children( $has_children_args )){
            if($only_check){ return true; }
            $list_pages_params['child_of'] = $post->ID;
            $there_is_menu = true;
        }

        //display menu
        if($there_is_menu){
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/walkers/children-pages.php' ) );

            $list_pages_params['walker'] = new A13FRAMEWORK_list_pages_walker;

            echo '<div class="widget a13_page_menu widget_nav_menu">
                    <ul>';

            wp_list_pages($list_pages_params);

            echo '</ul>
                </div>';
        }
        return false;
    }
}
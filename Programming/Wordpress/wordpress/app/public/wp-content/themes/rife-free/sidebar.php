<?php
/**
 * The Sidebar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    global $apollo13framework_a13;

    //A13FRAMEWORK_NO_SIDEBARS - prevents displaying sidebar
	if( !defined('A13FRAMEWORK_NO_SIDEBARS') ){
        $sidebar = apollo13framework_has_active_sidebar();
        if($sidebar !== false){
	        $meta_id = false;
	        $shop_as_front_page = get_option( 'woocommerce_shop_page_id' ) === get_option( 'page_on_front' );
	        if(get_option('show_on_front') !== 'posts' && !$shop_as_front_page){
		        if(is_front_page()){
			        $meta_id = get_option( 'page_on_front' );
		        }
		        elseif(is_home()){
			        $meta_id = get_option( 'page_for_posts' );
		        }
	        }

            echo '<aside id="secondary" class="widget-area" role="complementary"'.apollo13framework_get_schema_args( 'sidebar' ).'>';

            //if has children nav and it is activated
            if(is_page() && !(is_front_page() && $shop_as_front_page)){
                $sidebar_meta = $apollo13framework_a13->get_meta('_widget_area', $meta_id);
                if(strrchr($sidebar_meta, 'nav') && apollo13framework_page_menu(true)){
                    apollo13framework_page_menu();
                }
                //for pages only if enabled
                if(strrchr($sidebar_meta, 'sidebar')){
                    dynamic_sidebar( $sidebar );
                }
            }
            //other then pages
            else{
                dynamic_sidebar( $sidebar );
            }

            echo '<div class="clear"></div>';
            echo '</aside>';
        }
    }
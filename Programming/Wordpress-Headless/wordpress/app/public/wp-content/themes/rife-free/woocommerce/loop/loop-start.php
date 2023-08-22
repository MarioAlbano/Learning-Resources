<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

/* Theme changes:
 * Added lazy load data parameters
 * Added grid master
 * */

global $apollo13framework_a13;
$product_variant = $apollo13framework_a13->get_option( 'shop_products_variant' );
$product_subvariant = $product_variant === 'under'? ('products_subvariant_'.$apollo13framework_a13->get_option( 'shop_products_subvariant' ) ) : '';
$add_to_cart_version = $apollo13framework_a13->get_option( 'shop_add_to_cart', 'over' );
$columns_class = function_exists('wc_get_loop_prop')? ' columns-'.wc_get_loop_prop( 'columns' ) : '';
$bonus_classes = 'products_variant_'.$product_variant.' '.$product_subvariant.$columns_class.' button_'.$add_to_cart_version;
$lazy_load       = $apollo13framework_a13->get_option( 'shop_lazy_load' ) === 'on';
$lazy_load_mode  = $apollo13framework_a13->get_option( 'shop_lazy_load_mode' );
echo '<ul class="products '.esc_attr($bonus_classes).'" data-lazy-load="' . esc_attr( $lazy_load ) . '" data-lazy-load-mode="' . esc_attr( $lazy_load_mode ) . '"' .'>';
$grid_master = true;
//don't add grid-master when we don't fire masonry for blocks list
if( function_exists('wc_get_loop_prop') ){
	$no_grid_names = array( 'up-sells', 'cross-sells', 'related' );
	if( wc_get_loop_prop( 'is_shortcode' ) ){
		$grid_master = false;
	}
	elseif( in_array(wc_get_loop_prop( 'name' ), $no_grid_names)){
		$grid_master = false;
	}
}
if($grid_master){
	echo '<li class="grid-master"></li>';
}

<?php
/**
 * Used in empty archives and no search results page to display some possible post, pages, albums to visit
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    global $wp_query, $post, $apollo13framework_a13;
?>

<p><span class="info-404"><?php
        /* translators: "Go back" link */
        printf( esc_html__('%s or use Site Map below:', 'rife-free' ), '<a href="javascript:history.go(-1)">'.esc_html__('Go back', 'rife-free').'</a>' ); ?></span></p>

<div class="left50">
    <?php
    if ( has_nav_menu( 'header-menu' ) ){
        echo '<h3>'.esc_html__( 'Main navigation', 'rife-free' ).'</h3>';
        wp_nav_menu( array(
                'container'       => false,
                'link_before'     => '',
                'link_after'      => '',
                'menu_class'      => 'styled in-site-map',
                'theme_location'  => 'header-menu' )
        );
    }
    ?>

    <h3><?php esc_html_e( 'Categories', 'rife-free' ); ?></h3>
    <ul class="styled">
        <?php wp_list_categories('title_li='); ?>
    </ul>
</div>

<div class="right50">
    <h3><?php esc_html_e( 'Pages', 'rife-free' ); ?></h3>
    <ul class="styled">
        <?php wp_list_pages('title_li='); ?>
    </ul>
    <?php
        $args = array(
            'posts_per_page'      => -1,
            'offset'              => -1,
            'post_type'           => A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        );

        //make query for albums
        $all_albums = new WP_Query( $args );

        if ($all_albums->have_posts()) :
            echo '<h3>'.esc_html__( 'Albums', 'rife-free' ).'</h3>';
            echo '<ul class="styled">';

            while ( $all_albums->have_posts() ) :
                $all_albums->the_post();
                echo '<li><a href="'. esc_url( get_permalink() ) . '">' . get_the_title() . '</a></li>';
            endwhile;

            echo '</ul>';

            wp_reset_postdata();
        endif;
    ?>
</div>

<div class="clear"></div>
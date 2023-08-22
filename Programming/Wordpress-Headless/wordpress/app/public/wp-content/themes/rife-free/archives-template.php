<?php
/**
 * Template Name: Archives
 * It is used to list archives of various types, like posts, pages, categories, tags
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

get_header(); ?>
<?php if ( have_posts() ) : the_post(); ?>

<?php apollo13framework_title_bar(); ?>

<article id="content" class="clearfix">
    <div class="content-limiter">
        <div id="col-mask">

            <div id="post-<?php the_ID(); ?>" <?php post_class('content-box'); ?>>
                <div class="formatter">
                    <?php apollo13framework_title_bar( 'inside' ); ?>
                    <div class="real-content">

                        <?php
                        //page content
                        the_content();

                        ?>
                        <div class="clear"></div>

                        <?php
                        wp_link_pages( array(
                                'before' => '<div id="page-links">'.esc_html__( 'Pages: ', 'rife-free' ),
                                'after'  => '</div>')
                        );
                        ?>

                        <div class="left50">
                            <h3><?php echo esc_html__( 'Latest 50 posts', 'rife-free' ); ?></h3>
                            <ul class="styled">
                            <?php
                                wp_get_archives(array(
                                'type'            => 'postbypost',
                                'limit'           => 50,
                                ));
                            ?>
                            </ul>
                        </div>

                        <div class="right50">
                            <h3><?php esc_html_e( 'By months', 'rife-free' ); ?></h3>
                            <ul class="styled">
                            <?php
                                wp_get_archives(array(
                                'type'            => 'monthly',
                                'show_post_count' => true,
                                ));
                            ?>
                            </ul>

                            <h3><?php echo esc_html__( 'Top 10 categories', 'rife-free'  ); ?></h3>
                            <ul class="styled">
                            <?php
                                wp_list_categories(array(
                                    'orderby'            => 'count',
                                    'order'              => 'DESC',
                                    'show_count'         => 1,
                                    'number'             => 10,
                                    'title_li'           => ''
                                ));
                            ?>
                            </ul>

                            <h3><?php echo esc_html__( 'Top 10 tags', 'rife-free'  ); ?></h3>
                            <ul class="styled">
                            <?php
                                $tags = get_tags(array(
                                    'orderby'            => 'count',
                                    'order'              => 'DESC',
                                    'number'             => 10,
                                    'title_li'           => ''
                                ));
                                foreach ($tags as $_tag){
                                    $tag_link = get_tag_link($_tag->term_id);
                                    echo '<li><a href="'.esc_url($tag_link).'" class="'.esc_attr($_tag->slug).'">'.esc_html($_tag->name).'</a> ('.esc_html($_tag->count).')</li>';
                                }
                            ?>
                            </ul>
                        </div>

                        <div class="clear"></div>

                    </div>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</article>

<?php endif; ?>

<?php get_footer(); ?>

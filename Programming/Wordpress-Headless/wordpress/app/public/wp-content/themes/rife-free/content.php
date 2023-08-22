<?php
/**
 * Template used for displaying content of post/page on archive page.
 * It is used only on page with posts list: blog, archive, search
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13framework_a13, $post;

?>

<div class="formatter">
    <div class="real-content<?php echo 'post' === get_post_type()? ' hentry' : ''; ?>">

        <?php
        apollo13framework_post_meta_data();

        the_title('<h2 class="post-title entry-title"'.apollo13framework_get_schema_args('headline').'><a href="'. esc_url(get_permalink()) . '"'.apollo13framework_get_schema_args('url').'>', '</a></h2>');
        ?>

        <div class="entry-summary"<?php apollo13framework_schema_args('text'); ?>>
        <?php
        $add_read_more = $apollo13framework_a13->get_option( 'blog_read_more', 'on' ) === 'on';

        if($apollo13framework_a13->get_option( 'blog_excerpt_type') == 'auto'){
            if(strpos($post->post_content, '<!--more-->')){
                the_content( $add_read_more ? esc_html__( 'Read more', 'rife-free' ) : '' );
            }
            else{
                the_excerpt();
            }
        }
        //manual post cutting
        else{
            the_content( $add_read_more ? esc_html__( 'Read more', 'rife-free' ) : '' );
        }
        ?>
        </div>

        <div class="clear"></div>

        <?php apollo13framework_under_post_content(); ?>
        
    </div>
</div>
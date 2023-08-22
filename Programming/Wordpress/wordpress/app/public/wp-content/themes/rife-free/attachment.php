<?php
/**
 * The template for displaying attachments.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

the_post();

get_header();
?>

<article id="content" class="clearfix">
    <div class="content-limiter">
        <div id="col-mask">

            <div id="post-<?php the_ID(); ?>" <?php post_class('content-box'); ?>>

                <div class="formatter">
                    <?php apollo13framework_title_bar( 'inside' ); ?>
                    <div class="real-content">

                        <?php
                        if ( wp_attachment_is_image() ){
                            echo '<p class="attachment">'.wp_get_attachment_image( get_the_ID(), 'large' ).'</p>';
                        }
                        else{
                            echo wp_kses_post(prepend_attachment(''));
                            the_content();
                        }
                        ?>


                        <div class="attachment-info">
                            <?php if ( ! empty( $post->post_parent ) ) : ?>
                            <span><a href="<?php
                                /* translators: %s - title of parent post */
                                echo esc_url(get_permalink( $post->post_parent )); ?>" title="<?php esc_attr( sprintf( esc_html__( 'Return to %s', 'rife-free' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
                                /* translators: %s - title of parent post */
                                printf(  esc_html__( 'Return to %s', 'rife-free' ), get_the_title( $post->post_parent ) );
                                ?></a></span>
                            <?php endif; ?>

                            <span><?php
                                /* translators: %1$s - author name in form of link */
                                printf(  esc_html__( 'By %1$s', 'rife-free' ),
                                    sprintf( '<a class="author" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                                        esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )),
                                        /* translators: %s - author name */
                                        sprintf( esc_attr__('View all posts by %s', 'rife-free' ), get_the_author() ),
                                        get_the_author()
                                    )
                                );
                                ?></span>

                            <span><?php
                                /* translators: %1$s - date */
                            printf( esc_html__( 'Published %1$s', 'rife-free' ),
                                sprintf( '<abbr class="published" title="%1$s">%2$s</abbr>',
                                    esc_attr( get_the_time() ),
                                    get_the_date()
                                )
                            );?></span>

                            <?php
                            if ( wp_attachment_is_image() ) {
                                $metadata = wp_get_attachment_metadata();
                                if( isset($metadata['width']) && isset($metadata['height']) ){
                                    echo ' <span>';
                                    /* translators: %s - size in pixels  */
                                    printf( esc_html__( 'Full size is %s pixels', 'rife-free' ),
                                        sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
                                            esc_url(wp_get_attachment_url()),
                                            esc_attr__( 'Link to full-size image', 'rife-free' ),
                                            esc_html($metadata['width']),
                                            esc_html($metadata['height'])
                                        )
                                    );
                                    echo '</span>';
                                }
                            }
                            ?>
                            <?php edit_post_link( esc_html__( 'Edit', 'rife-free' ), '' ); ?>
                        </div>


                        <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>
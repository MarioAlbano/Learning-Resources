<?php
/**
 * Template used for displaying content of "link" format posts on archive page.
 * It is used only on page with posts list: blog, archive, search
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

// The Regular Expression filter
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
$has_url =  false;

//uses post content as link, and title as link text
$content = get_the_content();

// Check if there is a url in the text
if(preg_match($reg_exUrl, $content, $url)) {
    $content = $url[0];
    $has_url = true;
}

$_link = $has_url ? $content : apply_filters( 'the_permalink', get_permalink() );

?>

<div class="formatter">
    <?php apollo13framework_post_meta_data(); ?>
    <h2 class="post-title"<?php apollo13framework_schema_args('headline'); ?>>
        <a href="<?php echo esc_url($_link); ?>"<?php apollo13framework_schema_args('url'); ?>><?php the_title(); ?><i class="post-format-link-icon fa fa-external-link"></i></a>
    </h2>
    <span class="cite-author"><?php echo esc_url($_link); ?></span>
</div>

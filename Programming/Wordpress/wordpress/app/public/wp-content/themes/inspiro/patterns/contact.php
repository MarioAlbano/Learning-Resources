<?php
/**
 * Title: Contact
 * Slug: wpzoom/contact
 * Description: 
 * Categories: inspiro-pages
 * Keywords: 
 * Viewport Width: 1280
 * Block Types: 
 * Post Types: 
 * Inserter: true
 * Custom Categories: Inspiro Pages
 */
register_block_pattern_category( 'inspiro-pages', [ 'label' => __( 'Inspiro Pages', 'inspiro' ), 'pm_custom' => true ] );
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"className":"is-style-default","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-default" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:spacer {"height":"51px"} -->
<div style="height:51px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
<div class="wp-block-columns" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"verticalAlignment":"top","width":"50%","style":{"spacing":{"padding":{"right":"7%"}}},"layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-top" style="padding-right:7%;flex-basis:50%"><!-- wp:paragraph {"style":{"color":{"text":"#0bb4aa"}}} -->
<p class="has-text-color" style="color:#0bb4aa">Let's Connect!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"max-48"} -->
<h2 class="wp-block-heading has-max-48-font-size">Ready to start your next project?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is some dummy copy. You’re not really supposed to read this dummy copy, it is just a place holder for people who <a href="#">need some type</a> to visualize what the actual copy might look like if it were real content.<br></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"50%","layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:50%"><!-- wp:html -->
<form action="#">

  <label for="name">Your Name</label>
  <input type="text" id="name" name="name">

  <label for="email">Your Email</label>
  <input type="text" id="email" name="email">

  <label for="phone">Phone</label>
  <input type="phone" id="phone" name="phone">
<br><br>
  <label for="message">Your Message</label>

  <textarea id="message" name="message" style="height:200px"></textarea>

  <input type="submit" value="Submit">

</form>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"51px"} -->
<div style="height:51px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:columns {"verticalAlignment":"center","align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"backgroundColor":"light-background"} -->
<div class="wp-block-columns alignfull are-vertically-aligned-center has-light-background-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"verticalAlignment":"center","width":"50%","className":"map-grayscale","layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-center map-grayscale" style="flex-basis:50%"><!-- wp:image {"id":7500,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/map2.png" alt="" class="wp-image-7500"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small","right":"var:preset|spacing|small","left":"2%"}}},"layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small);padding-left:2%;flex-basis:50%"><!-- wp:heading {"fontSize":"max-48"} -->
<h2 class="wp-block-heading has-max-48-font-size">Inspiro</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><strong>Address</strong></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>1500 Broadway, New York, NY 10036, United States</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><strong>Email</strong></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>office@example.com</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><strong>Phone</strong></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>509-394-2555</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"left","style":{"color":{"text":"#0bb4aa"}}} -->
<p class="has-text-align-left has-text-color" style="color:#0bb4aa">WHERE ARE WE LOCATED</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","fontSize":"max-48"} -->
<h2 class="wp-block-heading has-text-align-left has-max-48-font-size">Our Locations</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"2.5"}}} -->
<p style="line-height:2.5">Amsterdam<br>Munich<br>Brussels<br>Hong Kong<br>Barcelona</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"typography":{"lineHeight":"2.5"}}} -->
<p style="line-height:2.5">New York<br>Paris<br>San Francisco<br>Sydney<br>Tokyo</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":5640,"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/map.png" alt="" class="wp-image-5640"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator {"backgroundColor":"lightgrey","className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-lightgrey-color has-alpha-channel-opacity has-lightgrey-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","left":"0","bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:0"><!-- wp:column {"verticalAlignment":"center","width":"66.66%","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:heading -->
<h2 class="wp-block-heading">Thinking about joining our team?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Check out our open positions, or drop us a line, say hi.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","style":{"border":{"radius":"4px"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-background wp-element-button" style="border-radius:4px">View Job Openings</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"45px"} -->
<div style="height:45px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

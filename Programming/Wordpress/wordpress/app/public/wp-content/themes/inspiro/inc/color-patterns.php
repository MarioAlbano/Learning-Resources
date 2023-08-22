<?php
/**
 * Inspiro Lite: Color Patterns
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro 1.0.0
 */

/**
 * Generate the CSS for the current custom color scheme.
 */
function inspiro_custom_colors_css() {
	$hex = inspiro_get_theme_mod( 'colorscheme_hex' );
	$css = '
/**
 * Inspiro Lite: Color Patterns
 *
 * Colors are ordered from dark to light.
 */

a,
.colors-custom .entry-content a:focus,
.colors-custom .entry-content a:hover,
.colors-custom .entry-summary a:focus,
.colors-custom .entry-summary a:hover,
.colors-custom .comment-content a:focus,
.colors-custom .comment-content a:hover,
.colors-custom .widget a:focus,
.colors-custom .widget a:hover,
.colors-custom .site-footer .widget-area a:focus,
.colors-custom .site-footer .widget-area a:hover,
.colors-custom .posts-navigation a:focus,
.colors-custom .posts-navigation a:hover,
.colors-custom .comment-metadata a:focus,
.colors-custom .comment-metadata a:hover,
.colors-custom .comment-metadata a.comment-edit-link:focus,
.colors-custom .comment-metadata a.comment-edit-link:hover,
.colors-custom .comment-reply-link:focus,
.colors-custom .comment-reply-link:hover,
.colors-custom .widget_authors a:focus strong,
.colors-custom .widget_authors a:hover strong,
.colors-custom .entry-title a:focus,
.colors-custom .entry-title a:hover,
.colors-custom .page-links a:focus .page-number,
.colors-custom .page-links a:hover .page-number,
.colors-custom .entry-footer a:focus,
.colors-custom .entry-footer a:hover,
.colors-custom .entry-footer .tags-links a:focus,
.colors-custom .entry-footer .tags-links a:hover,
.colors-custom .logged-in-as a:focus,
.colors-custom .logged-in-as a:hover,
.colors-custom .edit-link a:focus,
.colors-custom .edit-link a:hover,
.colors-custom .site-info a:focus,
.colors-custom .site-info a:hover,
.colors-custom .widget .widget-title a:focus,
.colors-custom .widget .widget-title a:hover,
.colors-custom .widget ul li a:focus,
.colors-custom .widget ul li a:hover,
.colors-custom .entry-meta a:focus,
.colors-custom .entry-meta a:hover,
.colors-custom.blog .entry-meta a:hover,
.colors-custom.archive .entry-meta a:hover,
.colors-custom.search .entry-meta a:hover,
.colors-custom .comment-author .fn a:focus,
.colors-custom .comment-author .fn a:hover {
	color: ' . $hex . ';
}

.colors-custom.page .entry-cover-image .entry-header .entry-meta a:hover,
.colors-custom.single .entry-cover-image .entry-header .entry-meta a:hover {
	color: ' . $hex . ';
}

.colors-custom .entry-content .more-link:hover,
.colors-custom .entry-content .more-link:focus,
.colors-custom .entry-content .more_link:hover,
.colors-custom .entry-content .more_link:focus,
.colors-custom .entry-summary .more-link:hover,
.colors-custom .entry-summary .more-link:focus,
.colors-custom .entry-summary .more_link:hover,
.colors-custom .entry-summary .more_link:focus {
    color: ' . $hex . ';
    border-color: ' . $hex . ';
}

.colors-custom .btn-primary,
.colors-custom .side-nav .search-form .search-submit,
.colors-custom .site-footer .search-form .search-submit,
.colors-custom .btn:hover,
.colors-custom .side-nav .search-form .search-submit:hover,
.colors-custom .site-footer .search-form .search-submit:hover,
.colors-custom .infinite-scroll #infinite-handle span:hover,
.colors-custom div.wpforms-container-full .wpforms-form input[type=submit]:hover,
.colors-custom div.wpforms-container-full .wpforms-form button[type=submit]:hover,
.colors-custom div.wpforms-container-full .wpforms-form .wpforms-page-button:hover,
.colors-custom .search-form button.search-submit:hover,
.colors-custom input[type=button]:hover,
.colors-custom input[type=reset]:hover,
.colors-custom input[type=submit]:hover,
.colors-custom #respond #submit:hover,
.colors-custom.woocommerce #content input.button:hover,
.colors-custom.woocommerce #respond input#submit:hover,
.colors-custom.woocommerce button.button.alt:hover,
.colors-custom.woocommerce button.button:hover,
.colors-custom.woocommerce div.product form.cart .button:hover,
.colors-custom.woocommerce input.button:hover,
.colors-custom.woocommerce-page #main a.button:hover,
.colors-custom.woocommerce-page #main input.button:hover,
.colors-custom.woocommerce-page #respond input#submit:hover,
.colors-custom.woocommerce-page a.button:hover,
.colors-custom.woocommerce-page button.button:hover,
.colors-custom.woocommerce-page div.product form.cart .button:hover,
.colors-custom.woocommerce-page input.button:hover {
	color: ' . $hex . ';
	border-color: ' . $hex . ';
}

.colors-custom .wp-block-button:not(.is-style-outline) a:hover,
.colors-custom .wp-block-button.is-style-outline > .wp-block-button__link:not(.has-background):not(.has-text-color):hover,
.colors-custom .wp-block-button .wp-block-button__link.is-style-outline:not(.has-background):not(.has-text-color):hover {
    background-color: ' . $hex . ';
}
.colors-custom .wp-block-button:not(.is-style-outline) a:hover,
.colors-custom .wp-block-button.is-style-outline > .wp-block-button__link:not(.has-background):not(.has-text-color):hover,
.colors-custom .wp-block-button .wp-block-button__link.is-style-outline:not(.has-background):not(.has-text-color):hover,
.colors-custom input:focus,
.colors-custom textarea:focus {
	border-color: ' . $hex . ';
}

.colors-custom .navbar-nav > li > ul:before {
	border-bottom: 8px solid ' . $hex . ';
}

.colors-custom.single #jp-relatedposts .jp-relatedposts-items-visual h4.jp-relatedposts-post-title a:hover {
	color: ' . $hex . ';
}

.colors-custom .sticky .svg-icon-thumb-tack {
    fill: ' . $hex . ';
}

.colors-custom .side-nav .search-form .search-submit,
.colors-custom .side-nav .wp-block-search__button,
.colors-custom .site-footer .search-form .search-submit,
.colors-custom .site-footer .wp-block-search__button,
.colors-custom.woocommerce #content div.product p.price,
.colors-custom.woocommerce #content div.product span.price,
.colors-custom.woocommerce div.product p.price,
.colors-custom.woocommerce div.product span.price,
.colors-custom.woocommerce-page #content div.product p.price,
.colors-custom.woocommerce-page #content div.product span.price,
.colors-custom.woocommerce-page div.product p.price,
.colors-custom.woocommerce-page div.product span.price
.colors-custom.woocommerce ul.products li.product .price,
.colors-custom.woocommerce-page ul.products li.product .price
.colors-custom .comments-pagination .page-numbers.current,
.colors-custom .comments-pagination .page-numbers:not(.dots):hover,
.colors-custom .pagination .page-numbers.current,
.colors-custom .pagination .page-numbers:not(.dots):hover {
	color: ' . $hex . ';
}


.colors-custom .side-nav .search-form .search-submit,
.colors-custom .side-nav .wp-block-search__button,
.colors-custom .site-footer .search-form .search-submit,
.colors-custom .site-footer .wp-block-search__button,
.colors-custom .search-form input:focus,
.colors-custom .search-form button:focus {
    border-color: ' . $hex . ';
}

.colors-custom .side-nav .search-form .search-submit,
.colors-custom .side-nav .search-form .search-submit:hover {
    color: ' . $hex . ';
    border: 2px solid ' . $hex . ';
}

.colors-custom .section-footer .zoom-instagram-widget a.ig-b-v-24:hover {
    color: ' . $hex . ' !important;
}

.colors-custom .woocommerce-pagination .current,
.colors-custom .woocommerce-pagination .page-numbers:hover {
    color: ' . $hex . ' !important;
}

.colors-custom .custom-header-button:hover,
.colors-custom .button:hover {
    background-color: ' . $hex . ';
    border-color: ' . $hex . ';
}

@media (min-width: 64em) {
	.colors-custom .navbar-nav ul {
	    border-top: 2px solid ' . $hex . ';
	}
}

@media screen and (max-width: 64em){
    .colors-custom .navbar-nav>li.current-menu-item>a,
    .colors-custom .navbar-nav>li.current-menu-parent>a,
    .colors-custom .navbar-nav>li.current_page_item>a {
        color: ' . $hex . ';
    }
}';

	/**
	 * Filters Inspiro Lite custom colors CSS.
	 *
	 * @since Inspiro 1.0.0
	 *
	 * @param string $css        Base theme colors CSS.
	 * @param string $hex        The user's selected color HEX.
	 */
	return apply_filters( 'inspiro_custom_colors_css', $css, $hex );
}

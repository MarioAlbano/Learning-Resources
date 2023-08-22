<?php
/**
 * Template for displaying albums categories archive page.
 * It uses albums-list for doing all heavy work.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

//Here we inform template that we want to print out genre
define('A13FRAMEWORK_ALBUM_GENRE_TEMPLATE', true);
get_template_part( 'albums-list' );
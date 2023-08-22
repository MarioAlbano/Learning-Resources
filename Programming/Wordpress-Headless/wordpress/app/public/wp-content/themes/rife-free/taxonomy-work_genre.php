<?php
/**
 * Template for displaying works categories archive page.
 * It uses works-list for doing all heavy work.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

//Here we inform template that we want to print out genre
define('A13FRAMEWORK_WORK_GENRE_TEMPLATE', true);
get_template_part( 'works-list' );
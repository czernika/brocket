<?php
/**
 * App routes
 * Same logic here as for WPEmerge routes but instead of `\App::route()` we call `Route` facade with handy WordPress conditionals
 *
 * List of all WordPress conditionals and available router methods can be found here:
 *
 * @link https://codex.wordpress.org/Conditional_Tags
 * @link https://docs.wpemerge.com/#/framework/routing/methods
 *
 * @since 1.0.0
 * @package Brocooly
 */

use Brocooly\Support\Facades\Route;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * -------------------------------------------------------------------------
 * Front Page
 * -------------------------------------------------------------------------
 *
 * Handle requests on front page
 */
Route::is_front_page()->handle( 'PageController@front' );

/**
 * -------------------------------------------------------------------------
 * 404 Page
 * -------------------------------------------------------------------------
 *
 * If no routes were matched output the content of `content/404.twig` file
 * and set response status to 404
 */
Route::is_404()->handle( fn() => output( 'content.404' )->withStatus( 404 ) );

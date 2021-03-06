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
 * Default Pages
 * -------------------------------------------------------------------------
 *
 * If no routes were matched default one will be included
 * ! This line should be always at the end
 *
 * You should almost always avoid using `Route::all()`
 * when defining admin or ajax routes otherwise you will take over all custom admin pages
 * and/or AJAX requests (even ones created by third party plugins).
 *
 * @see https://docs.wpemerge.com/#/framework/routing/defining-routes?id=defining-routes
 * @since 1.8.4
 */
Route::all( 'PageController@all' );

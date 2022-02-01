<?php
/**
 * Default query params
 * Timber itself set few default queries you may override globally here
 * or in an appropriate query
 *
 * @see https://timber.github.io/docs/v2/guides/posts/#differences-from-wp-cores-get_posts
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.2.0
 */

return [

	/**
	 * --------------------------------------------------------------------------
	 * Posts per page limit
	 * --------------------------------------------------------------------------
	 *
	 * When you are getting all posts you may set `posts_per_page` query parameter as `-1`.
	 * It is not recommended way for performance reasons
	 * so we're set it to 300 while calling `all()` method of QueryBuilder.
	 *
	 * @since 1.4.2
	 * @var int
	 */
	'limit'    => 300,

	/**
	 * --------------------------------------------------------------------------
	 * Default query parameters
	 * --------------------------------------------------------------------------
	 *
	 * Same as for `WP_Query`. Used as a default query vars
	 *
	 * @var array
	 */
	'defaults' => [
		'posts_per_page' => get_option( 'posts_per_page' ), // phpcs:ignore WordPress.WP.PostsPerPage
	],

];

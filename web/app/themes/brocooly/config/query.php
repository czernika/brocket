<?php
/**
 * Default query params
 * Timber itself set few default queries you may override globally here
 * or in an appropriate query
 *
 * @see https://timber.github.io/docs/v2/guides/posts/#differences-from-wp-cores-get_posts
 *
 * @package Brocooly
 * @since 1.2.0
 */

return [

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

		/**
		 * --------------------------------------------------------------------------
		 * Posts per page limit
		 * --------------------------------------------------------------------------
		 *
		 * When you are getting all posts you may set `posts_per_page` query parameter as `-1`.
		 * It is not recommended way for performance reasons so we're set it to 300.
		 *
		 * @var int
		 */
		'posts_per_page' => 300, // phpcs:disable WordPress.WP.PostsPerPage
	],

];

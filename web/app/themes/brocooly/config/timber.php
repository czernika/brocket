<?php
/**
 * Return config options for Timber package
 *
 * @see https://timber.github.io/docs/guides/extending-timber/#adding-functionality-to-twig
 * @package Brocooly
 * @since 1.0.0
 */

return [

	/**
	 * --------------------------------------------------------------------------
	 * Views path
	 * --------------------------------------------------------------------------
	 *
	 * All your directories for view files should bу listed here.
	 * Relative path to a theme root folder.
	 *
	 * @var string|array
	 */
	'views' => 'resources/views',

	/**
	 * --------------------------------------------------------------------------
	 * Posts per page limit
	 * --------------------------------------------------------------------------
	 *
	 * When you are getting all posts you may set `posts_per_page` query parameter as -1.
	 * It is not recommended for performance reasons way so we're set it 300.
	 *
	 * This settings applied for `PostType::all()` etc.
	 *
	 * @var int
	 * @since 1.2.0
	 */
	'limit' => 300,

	/**
	 * --------------------------------------------------------------------------
	 * Set Timber cache or not
	 * --------------------------------------------------------------------------
	 *
	 * Where all your compiled cache files are stored.
	 * `apply` param is used to define cache files or not
	 * depends on environment type.
	 *
	 * @since 1.2.0
	 */
	'cache' => [

		/**
		 * Set cache or not
		 *
		 * @var bool
		 */
		'apply'    => WP_DEBUG,

		/**
		 * Cache location
		 *
		 * @var string
		 */
		'location' => BROCOOLY_THEME_PATH . 'storage/cache/',
	],

];

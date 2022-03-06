<?php
/**
 * Return config options for Timber package
 *
 * @see https://timber.github.io/docs/guides/extending-timber/#adding-functionality-to-twig
 * @package Brocooly
 * @subpackage Brocket
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
		'apply'    => isProduction(),

		/**
		 * View files cache location
		 *
		 * @var string
		 */
		'location' => BROCOOLY_THEME_STORAGE_PATH . '/cache/views',
	],

];

<?php
/**
 * Return config options for twig environment
 *
 * @see https://twig.symfony.com/doc/3.x/api.html
 * @package Brocooly
 * @since 1.2.0
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
	'views' => get_template_directory() . '/resources/views',

	/**
	 * --------------------------------------------------------------------------
	 * Cache path
	 * --------------------------------------------------------------------------
	 *
	 * Enable caching. If set to `false` cache will be disabled
	 *
	 * @var string|false
	 */
	'cache' => isProduction() ? get_template_directory() . '/storage/cache' : false,

	/**
	 * --------------------------------------------------------------------------
	 * Enable debugging
	 * --------------------------------------------------------------------------
	 *
	 * Enable debugging. Set to false in a production mode
	 *
	 * @var bool
	 */
	'debug' => ! isProduction(),

];

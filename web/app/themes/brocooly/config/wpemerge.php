<?php
/**
 * Return config options for WPEmerge package
 *
 * @see https://docs.wpemerge.com/#/framework/configuration
 * @package Brocooly
 * @since 1.0.0
 */

use Theme\Providers\ThemeServiceProvider;
use Brocooly\Providers\AppServiceProvider;
use Brocooly\Providers\ModelServiceProvider;

return [

	/**
	 * --------------------------------------------------------------------------
	 * App routes
	 * --------------------------------------------------------------------------
	 *
	 * Array of route group definitions and default attributes.
	 * All of these are optional so if we are not using
	 * a certain group of routes we can skip it.
	 * If we are not using routing at all we can skip
	 * the entire 'routes' option.
	 *
	 * @var array
	 */
	'routes'    => [
		'web' => [
			'definitions' => dirname( __DIR__ ) . '/routes/web.php',
			'attributes'  => [
				'namespace' => 'Theme\\Http\\Controllers\\',
			],
		],
	],

	/**
	 * --------------------------------------------------------------------------
	 * Service Providers
	 * --------------------------------------------------------------------------
	 *
	 * Array of service providers you wish to enable.
	 *
	 * @var array
	 */
	'providers' => [

		/**
		 * App Providers
		 */
		AppServiceProvider::class,
		ModelServiceProvider::class,

		/**
		 * Theme Providers
		 */
		ThemeServiceProvider::class,
	],
];

<?php
/**
 * Return config options for WPEmerge package
 *
 * @see https://docs.wpemerge.com/#/framework/configuration
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

use Brocooly\Providers\MailServiceProvider;
use Brocooly\Providers\CustomizerServiceProvider;

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
	'routes'     => [
		'web' => [
			'definitions' => BROCOOLY_THEME_PATH . 'routes/web.php',
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
	 * Do not change order of App Providers unless you sure
	 * what are you doing
	 *
	 * @var array
	 */
	'providers'  => [

		/**
		 * App or External Providers
		 */
		// CustomizerServiceProvider::class,
		// MailServiceProvider::class,

		/**
		 * Theme Providers
		 */

	],

	/**
	 * --------------------------------------------------------------------------
	 * Custom theme middleware classes
	 * --------------------------------------------------------------------------
	 *
	 * Array of service providers you wish to enable.
	 *
	 * @since 1.7.0
	 * @var array
	 */
	'middleware' => [],
];

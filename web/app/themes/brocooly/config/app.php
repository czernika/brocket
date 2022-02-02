<?php
/**
 * Application configuration file
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.5.0
 */

return [

	/**
	 * --------------------------------------------------------------------------
	 * Get application locale
	 * --------------------------------------------------------------------------
	 *
	 * Used for validator factory to receive correct message
	 * This locale should be the same as directories within `validation` folder
	 *
	 * If current locale is `ru_RU`, the path to validation rules file should be
	 * `languages/validation/ru_RU/validation.php`
	 *
	 * @var string
	 */
	'locale' => get_locale(),

	/**
	 * --------------------------------------------------------------------------
	 * Assets configuration
	 * --------------------------------------------------------------------------
	 *
	 * Define rules for assets, compiled by webpack. Regex defines which asset
	 * is a script and which one is a style within `mix-manifest.json`
	 * Matched values within styles array will be loaded via `wp_enqueue_style`
	 * Scripts will be loaded with `wp_enqueue_script()` in a footer
	 *
	 * Queue is an array of arrays of assets to be load conditionally
	 *
	 * @since 1.7.2
	 * @var array
	 */
	'assets' => [

		/**
		 * --------------------------------------------------------------------------
		 * Assets configuration
		 * --------------------------------------------------------------------------
		 *
		 * Load assets or not by default. Set to `false` of you wish register
		 * styles and scripts by your own
		 *
		 * @var array
		 */
		'autoload' => true,

		'styles'   => [
			'regex' => '/(\/css\/)[\w]+\.css$/',

			/**
			 * @example
			 * ```
			 * 'queue' => [
			 * 		[
			 * 			'key' => '/css/app.css' // same as within `mix-manifest.json`
			 * 			'condition' => 'is_front_page' // condition to load style
			 * 		],
			 * ],
			 *
			 * Extra keys are `version`, `media` and `deps` - same as for `wp_enqueue_style()`
			 * ```
			 */
			'queue' => [],
		],

		'scripts'  => [
			'regex' => '/(\/js\/)[\w]+\.js$/',

			/**
			 * @example
			 * ```
			 * Same as for styles but instead of `media` key there is `inFooter`
			 * ```
			 */
			'queue' => [],
		],

	],

];

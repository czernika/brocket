<?php
/**
 * Customizer options
 * Configuration, section and panels
 *
 * @link https://kirki.org
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

return [

	/**
	 * --------------------------------------------------------------------------
	 * Configuration object
	 * --------------------------------------------------------------------------
	 *
	 * Same as for `Kirki::add_config()`
	 *
	 * @see https://kirki.org/docs/setup/config/
	 * @var array
	 */
	'config'   => [
		'brocket_config',
		[
			'option_type' => 'theme_mod',
			'capability'  => 'manage_options',
		],
	],

	/**
	 * --------------------------------------------------------------------------
	 * List of customizer panels
	 * --------------------------------------------------------------------------
	 *
	 * Used to register panels
	 *
	 * @var array
	 */
	'panels'   => [],

	/**
	 * --------------------------------------------------------------------------
	 * List of customizer sections
	 * --------------------------------------------------------------------------
	 *
	 * Used to register sections
	 *
	 * @var array
	 */
	'sections' => [],

];

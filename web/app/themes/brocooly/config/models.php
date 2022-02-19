<?php
/**
 * Register custom theme post types and taxonomies
 * and give them support for metaboxes
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

use Theme\UI\Menus\PrimaryMenu;

return [

	/**
	 * --------------------------------------------------------------------------
	 * Post Types
	 * --------------------------------------------------------------------------
	 *
	 * Register post types classes here to be able register them
	 * or add metaboxes
	 *
	 * @var array
	 */
	'post_types' => [

		/**
		 * Custom post types
		 */

		/**
		 * WordPress post types
		 *
		 * Register them here
		 * if you wish to add metaboxes
		 */
	],

	/**
	 * --------------------------------------------------------------------------
	 * Taxonomies
	 * --------------------------------------------------------------------------
	 *
	 * Register taxonomies classes here to be able register them
	 * or add metaboxes
	 *
	 * @var array
	 */
	'taxonomies' => [

		/**
		 * Custom taxonomies
		 */

		/**
		 * WordPress taxonomies
		 *
		 * Register them here
		 * if you wish to add metaboxes
		 */
	],

	/**
	 * --------------------------------------------------------------------------
	 * Navigation menus
	 * --------------------------------------------------------------------------
	 *
	 * Register menus which may require metaboxes
	 *
	 * @var array
	 */
	'menus'      => [
		PrimaryMenu::class,
	],

];

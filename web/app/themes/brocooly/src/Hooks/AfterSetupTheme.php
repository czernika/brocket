<?php
/**
 * Runs after theme was setup
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.8.7
 */

declare(strict_types=1);

namespace Theme\Hooks;

use Brocooly\Hooks\Hookable;

class AfterSetupTheme implements Hookable
{
	public function init()
	{
		add_action( 'after_setup_theme', [ $this, 'afterSetupTheme' ] );
	}

	public function afterSetupTheme()
	{
		/**
		 * --------------------------------------------------------------------------
		 * Load theme text domain
		 * --------------------------------------------------------------------------
		 *
		 * Make theme multilingual
		 *
		 * @since 1.7.0
		 */
		load_theme_textdomain( 'brocooly', BROCOOLY_THEME_LANG_PATH );

		/**
		 * --------------------------------------------------------------------------
		 * Register Carbon Fields package
		 * --------------------------------------------------------------------------
		 *
		 * Register metaboxes for post types, theme widgets, options and more
		 * Uncomment this line to have access for metaboxes
		 *
		 * @link https://docs.carbonfields.net/quickstart.html
		 */
		// \Carbon_Fields\Carbon_Fields::boot();
	}
}

<?php
/**
 * Theme ServiceProvider
 * You may register here features related to theme
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme\Providers;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ThemeServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{

	}

	public function bootstrap( $container )
	{
		add_action( 'after_setup_theme', [ $this, 'afterSetupTheme' ] );
	}

	/**
	 * Boot Carbon Fields callback
	 *
	 * @return void
	 */
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

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

use Whoops\Handler\PrettyPageHandler;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ThemeServiceProvider implements ServiceProviderInterface
{
	public function register( $container ) {

		/**
		 * -------------------------------------------------------------------------
		 * Filp/whoops pretty errors handler
		 * -------------------------------------------------------------------------
		 *
		 * The way errors output will look. Out-of-the-box, filp/whoops package provides a pretty error interface that helps you debug your web projects
		 *
		 * List of available handlers here
		 *
		 * @link https://github.com/filp/whoops#available-handlers
		 */
		$container['brocooly.debugger.whoops.handler'] = fn( $c ) => new PrettyPageHandler();
	}

	public function bootstrap( $container ) {
		// ...
	}
}

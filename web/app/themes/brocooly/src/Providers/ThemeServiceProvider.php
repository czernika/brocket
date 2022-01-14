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
	}

	public function bootstrap( $container ) {
		// ...
	}
}

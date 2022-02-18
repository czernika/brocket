<?php
/**
 * Debug Service Provider
 *
 * Register and boot debugging features and packages
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Pimple\Container;
use HelloNico\Twig\DumpExtension;
use Whoops\Handler\PrettyPageHandler;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class DebugServiceProvider implements ServiceProviderInterface
{

	public function register( $container )
	{
		$container[ BROCOOLY_DEBUGGER_TWIG_KEY ] = fn( $c ) => new DumpExtension();

		/**
		 * Override WPEmerge PrettyPage Handler as it cause error
		 * "Undefined variable $prettify" with nasty error page
		 * We just removed custom resource path
		 *
		 * @since 1.4.3
		 */
		$container[ PrettyPageHandler::class ] = $container->extend(
			PrettyPageHandler::class,
			function( $debugger, $c ) {
				$handler = new PrettyPageHandler();
				$handler->addDataTableCallback( 'WP Emerge: Route', function ( $inspector ) use ( $c ) {
					return $c[ DebugDataProvider::class ]->route( $inspector );
				} );

				return $handler;
			}
		);
	}

	public function bootstrap( $container )
	{
		if ( ! isProduction() ) {
			$this->bootTwigDumper( $container );
		}
	}

	/**
	 * Register hellonico/twig-dumper extension
	 *
	 * @param Container $container
	 * @return void
	 */
	private function bootTwigDumper( Container $container )
	{
		add_filter(
			'timber/loader/twig',
			function ( $twig ) use ( $container ) {
				$twig->addExtension( $container[ BROCOOLY_DEBUGGER_TWIG_KEY ] );
				return $twig;
			}
		);
	}
}

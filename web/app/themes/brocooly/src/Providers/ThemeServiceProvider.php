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

use Twig\Environment;
use Brocooly\View\TwigEngine;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use HelloNico\Twig\DumpExtension;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ThemeServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{
		$container['brocooly.debugger.twig'] = fn( $c ) => new DumpExtension();

		$container['brocooly.views.engine'] = function ( $c ) {
			$loader = new FilesystemLoader( config( 'twig.views' ) );
			$twig   = new Environment(
				$loader,
				[
					'debug' => config( 'twig.debug' ),
					'cache' => config( 'twig.cache' ),
				],
			);

			$fn = $this->addFnFunction();
			$twig->addFunction( $fn );

			$twig->addExtension( $c['brocooly.debugger.twig'] );

			$twig = apply_filters( 'brocooly.twig.environment', $twig, $c );

			return new TwigEngine( $twig );
		};

		$container[ WPEMERGE_VIEW_ENGINE_KEY ] = function ( $c ) {
			return $c['brocooly.views.engine'];
		};
	}

	public function bootstrap( $container )
	{

	}

	private function addFnFunction()
	{
		return new TwigFunction(
			'fn',
			function( $functionName ) {
				$args = func_get_args();
				array_shift( $args );
				if ( is_string( $functionName ) ) {
					$functionName = trim( $functionName );
				}
				return call_user_func_array( $functionName, ( $args ) );
			}
		);
	}
}

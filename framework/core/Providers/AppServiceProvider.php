<?php
/**
 * App Service Provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Brocooly\Hooks\Hookable;
use Brocooly\Request\Request;
use Brocooly\Router\Blueprint;
use Illuminate\Filesystem\Filesystem;
use Brocooly\Support\Factories\ValidatorFactory;
use Brocooly\Support\Factories\CustomizerFactory;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{

		/**
		 * Extend WPEmerge routing with Facade
		 */
		$container->extend(
			WPEMERGE_ROUTING_ROUTE_BLUEPRINT_KEY,
			function( $blueprint, $c ) {
				return new Blueprint(
					$c[ WPEMERGE_ROUTING_ROUTER_KEY ],
					$c[ WPEMERGE_VIEW_SERVICE_KEY ],
				);
			}
		);

		/**
		 * Extend WPEmerge request object
		 *
		 * @since 1.5.0
		 */
		$container->extend(
			WPEMERGE_REQUEST_KEY,
			function( $request, $c ) {
				$appRequest = apply_filters( 'brocooly.request', Request::fromGlobals() );
				return $appRequest;
			}
		);

		/**
		 * Facades
		 *
		 * @since 1.5.0
		 */
		$container[ BROCOOLY_CUSTOMIZER_FACTORY_KEY ] = fn( $c ) => new CustomizerFactory();
		$container[ BROCOOLY_VALIDATOR_FACTORY_KEY ]  = fn( $c ) => new ValidatorFactory();
		$container[ BROCOOLY_FILE_FACTORY_KEY ]       = fn( $c ) => new Filesystem();
	}

	public function bootstrap( $container )
	{
		$this->extendTwig( $container );
		$this->initHooks( $container );
	}

	/**
	 * Extend Timber functionality
	 *
	 * @since 1.6.2
	 * @return void
	 */
	private function extendTwig( $container )
	{
		add_filter(
			'timber/twig',
			function( $twig ) use ( $container ) {
				$twig->addFunction( new \Timber\Twig_Function( 'asset', 'asset' ) );
				$twig->addFunction( new \Timber\Twig_Function( 'spritemap', 'spritemap' ) );
				$twig->addFunction( new \Timber\Twig_Function( 'mod', 'mod' ) );

				/**
				 * WordPress filters
				 */
				$twig->addFilter( new \Timber\Twig_Filter( 'antispambot', 'antispambot' ) );
				$twig->addFilter( new \Timber\Twig_Filter( 'zeroise', 'zeroise' ) );

				$twig = apply_filters( 'brocooly.twig', $twig, $container );
				return $twig;
			},
		);
	}

	/**
	 * Init theme hooks
	 *
	 * @since 1.8.7
	 * @return void
	 */
	private function initHooks( $container )
	{
		$hooks = apply_filters( 'brocooly.hooks', config( 'app.hooks', [] ), $container );

		foreach ( $hooks as $hook ) {
			$hookable = new $hook();
			if ( $hookable instanceof Hookable && method_exists( $hookable, 'init' ) ) {
				$hookable->init();
			}
		}
	}
}

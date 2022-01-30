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
		$container[ WPEMERGE_ROUTING_ROUTE_BLUEPRINT_KEY ] = $container->extend(
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
		$container[ WPEMERGE_REQUEST_KEY ] = $container->extend(
			WPEMERGE_REQUEST_KEY,
			function( $request, $c ) {
				return Request::fromGlobals();
			}
		);

		/**
		 * Facades
		 *
		 * @since 1.5.0
		 */
		$container['brocooly.customizer'] = fn( $c ) => new CustomizerFactory();
		$container['brocooly.validator']  = fn( $c ) => new ValidatorFactory();
		$container['brocooly.file']       = fn( $c ) => new Filesystem();
	}

	public function bootstrap($container)
	{
		$this->extendTwig();
	}

	/**
	 * Extend Timber functionality
	 *
	 * @since 1.6.2
	 * @return void
	 */
	private function extendTwig()
	{
		add_filter(
			'timber/twig',
			function( $twig ) {
				$twig->addFunction( new \Timber\Twig_Function( 'asset', 'asset' ) );

				return $twig;
			},
		);
	}
}

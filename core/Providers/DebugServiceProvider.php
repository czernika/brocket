<?php
/**
 *
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Pimple\Container;
use Brocooly\Support\Helper;
use HelloNico\Twig\DumpExtension;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class DebugServiceProvider implements ServiceProviderInterface
{

	public function register( $container )
	{
		$container['brocooly.debugger.twig'] = fn( $c ) => new DumpExtension();
	}

	public function bootstrap( $container )
	{
		if ( ! isProduction() ) {
			$this->bootWhoopsHandler( $container );
			$this->bootTwigDumper( $container );
		}
	}

	/**
	 * Register filp/whoops package for pretty errors
	 *
	 * @param Container $container
	 * @return void
	 */
	private function bootWhoopsHandler( Container $container )
	{
		if ( Helper::containerKeyExists( $container, 'brocooly.debugger.whoops.handler' ) ) {
			$whoops = new \Whoops\Run();
			$whoops->pushHandler(
				$container['brocooly.debugger.whoops.handler']
			);
			$whoops->register();
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
		if ( Helper::containerKeyExists( $container, 'brocooly.debugger.twig' ) ) {
			add_filter(
				'timber/loader/twig',
				function ( $twig ) use ( $container ) {
					$twig->addExtension( $container['brocooly.debugger.twig'] );
					return $twig;
				}
			);
		}
	}
}

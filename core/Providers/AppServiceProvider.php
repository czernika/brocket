<?php

declare(strict_types=1);

namespace Brocooly\Providers;

use Brocooly\Router\Blueprint;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface
{
	public function register( $container ) {
		$container[ WPEMERGE_ROUTING_ROUTE_BLUEPRINT_KEY ] = $container->extend(
			WPEMERGE_ROUTING_ROUTE_BLUEPRINT_KEY,
			function( $blueprint, $c ) {
				return new Blueprint(
					$c[ WPEMERGE_ROUTING_ROUTER_KEY ],
					$c[ WPEMERGE_VIEW_SERVICE_KEY ],
				);
			}
		);
	}

	public function bootstrap($container)
	{

	}
}

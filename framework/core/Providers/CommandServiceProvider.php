<?php
/**
 * Console Commands Service Provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.10.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Brocooly\Commands;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class CommandServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{
		$container[ BROCOOLY_CONSOLE_COMMANDS_KEY ] = new Commands();
	}

	public function bootstrap( $container )
	{
	}
}

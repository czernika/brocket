<?php
/**
 * Abstract Facade class
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Webmozart\Assert\Assert;

abstract class AbstractFacade
{

	public static function __callStatic( $name, $arguments )
	{
		Assert::methodExists( static::class, 'accessor', 'No accessor key was provided' );
		return call_user_func_array( [ static::accessor(), $name ], $arguments );
	}
}

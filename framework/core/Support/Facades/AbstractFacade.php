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
		return call_user_func_array( [ static::getAccessorObject(), $name ], $arguments );
	}

	/**
	 * Get accessor key
	 *
	 * @return mixed
	 */
	public static function getAccessor()
	{
		return static::accessor();
	}

	/**
	 * Get accessor key
	 *
	 * @return mixed
	 */
	public static function getAccessorObject()
	{
		$accessor = static::getAccessor();
		return is_string( $accessor ) ? app( $accessor ) : $accessor;
	}
}

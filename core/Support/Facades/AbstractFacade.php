<?php

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Webmozart\Assert\Assert;

abstract class AbstractFacade
{

	public static function __callStatic( $name, $arguments )
	{
		Assert::methodExists( static::class, 'accessor', 'No accessor key was provided' );

		Assert::object( static::accessor(), sprintf(
			'Accessor must be an object type, %s given',
			gettype( static::accessor() ),
		) );

		return call_user_func_array( [ static::accessor(), $name ], $arguments );
	}
}

<?php

declare(strict_types=1);

namespace Brocooly\Application;

use Illuminate\Support\Arr;

class Config
{

	private static bool $configWasSet = false;

	private static array $data;

	public static function set( string $configPath )
	{

		if ( static::$configWasSet ) {
			return;
		}

		static::$configWasSet = true;

		$configFiles = glob( $configPath );

		foreach ( $configFiles as $file ) {
			static::$data[ pathinfo( $file )['filename'] ] = require_once $file;
		}
	}

	public static function get( $key = null )
	{
		if ( $key ) {
			return Arr::get( static::$data, $key, null );
		}

		return static::$data;
	}
}

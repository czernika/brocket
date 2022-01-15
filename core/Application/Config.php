<?php
/**
 * Theme configuration object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Application;

use Illuminate\Support\Arr;

class Config
{

	/**
	 * Define if config was already set or not
	 *
	 * @var boolean
	 */
	private static bool $configWasSet = false;

	/**
	 * Config data
	 *
	 * @var array
	 */
	private static array $data;

	/**
	 * Set configuration data
	 *
	 * @param string $configPath
	 * @return void
	 */
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

	/**
	 * Get data from config
	 * or config itself
	 *
	 * @param string|null $key
	 * @return mixed
	 */
	public static function get( ?string $key = null )
	{
		if ( $key ) {
			return Arr::get( static::$data, $key, null );
		}

		return static::$data;
	}
}

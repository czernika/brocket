<?php
/**
 * Helper class
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support;

use Pimple\Container;
use Illuminate\Support\Str;

class Helper
{

	/**
	 * Correct the path to view files
	 * Changes dot notation into twig file (eg `path.to.file` = `path/to/file.twig`)
	 *
	 * @param array|string $view | view keys
	 * @return array
	 */
	public static function twigify( string|array $view ) : array
	{
		$views = array_map(
			fn( $v ) => Str::replace( '.', DIRECTORY_SEPARATOR, $v ) . '.twig',
			(array) $view,
		);

		return $views;
	}

	/**
	 * Define does key exists in container instance or not
	 *
	 * @param Container $container
	 * @param string    $key | container key to check if it exists
	 * @return bool
	 */
	public static function containerKeyExists( Container $container, string $key ) : bool
	{
		return (bool) $container[ $key ];
	}
}

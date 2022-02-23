<?php
/**
 * Helper class
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support;

use Theme\App;
use Timber\Timber;
use Brocooly\Assets\Assets;
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
	 * Get asset path by manifest key
	 *
	 * @param string $path
	 * @return string
	 */
	public static function asset( string $key ) : string
	{
		$asset = ( new Assets() )->asset( $key );

		if ( $asset ) {
			$publicFilePath = BROCOOLY_THEME_PUBLIC_URI . $asset;
			return $publicFilePath;
		}

		return BROCOOLY_THEME_RESOURCES_URI . $key;
	}

	/**
	 * Get app context
	 *
	 * @param array $ctx
	 * @since 1.9.2
	 * @return array
	 */
	public static function getAppContext( array $ctx ) : array
	{
		$timberCtx = Timber::context();
		$appCtx    = ( new App() )->context();
		return array_merge( $timberCtx, $appCtx, $ctx );
	}
}

<?php
/**
 * Helper functions
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

use Theme\App;
use Timber\Timber;
use Brocooly\Support\Helper;
use Brocooly\Application\Config;

if ( ! function_exists( 'dump' ) ) {

	/**
	 * Dump wrapper
	 *
	 * @param mixed $var
	 * @return void
	 */
	function dump( $var ) {
		echo '<pre></pre>';
		var_dump( $var ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
		echo '</pre>';
	}
}

if ( ! function_exists( 'dd' ) ) {

	/**
	 * Dump and die
	 *
	 * @param mixed $var
	 * @return void
	 */
	function dd( $var ) {
		dump( $var );
		die();
	}
}

if ( ! function_exists( 'isCurrentEnv' ) ) {

	/**
	 * Check current environment type
	 *
	 * @param string|array $env
	 * @return boolean
	 */
	function isCurrentEnv( string|array $env ) {
		return in_array( env( 'WP_ENV' ), (array) $env, true );
	}
}

if ( ! function_exists( 'isProduction' ) ) {

	/**
	 * Check if is current environment is set to `production`
	 *
	 * @return boolean
	 */
	function isProduction() {
		return isCurrentEnv( 'production' );
	}
}

if ( ! function_exists( 'config' ) ) {

	/**
	 * Get config key
	 *
	 * @param string|null $key
	 * @param mixed $default
	 * @since 1.7.4 added default value
	 * @return mixed
	 */
	function config( ?string $key = null, $default = null ) {
		$value = Config::get( $key );
		return $value ?? $default;
	}
}

if ( ! function_exists( 'app' ) ) {

	/**
	 * Get container object
	 *
	 * @param string|null $key
	 * @return mixed
	 */
	function app( ?string $key = null ) {
		$app = App::container();

		if ( $key ) {
			return $app[ $key ];
		}

		return $app;
	}
}

if ( ! function_exists( 'output' ) ) {

	/**
	 * Output twig file content
	 *
	 * @param string|array $view
	 * @param array $ctx
	 * @return object
	 */
	function output( string|array $view, array $ctx = [] ) {
		$ctx   = Helper::getAppContext( $ctx );
		$views = Helper::twigify( $view );
		return App::output( Timber::compile( $views, $ctx ) );
	}
}

if ( ! function_exists( 'asset' ) ) {

	/**
	 * Get asset path from manifest file
	 *
	 * @param string $filePath | value to check.
	 * @return string
	 */
	function asset( string $filePath ) {
		return Helper::asset( $filePath );
	}
}

if ( ! function_exists( 'env' ) ) {

	/**
	 * Get environment value
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	function env( string $key, $default = null ) {
		return Env\env( $key ) ?: $default;
	}
}

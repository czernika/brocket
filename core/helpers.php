<?php
/**
 * Helper functions
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

use Theme\Brocooly;
use Brocooly\Support\Helper;
use Brocooly\Application\Config;
use Brocooly\Application\Bootstrapper;

use function Env\env;

if ( ! function_exists( 'dump' ) ) {

	/**
	 * Dump wrapper
	 *
	 * @param mixed $var
	 * @return void
	 */
	function dump( $var ) {
		echo '<pre></pre>';
		var_dump( $var );
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
	 * @param string $env
	 * @return boolean
	 */
	function isCurrentEnv( string $env ) {
		return env( 'WP_ENV' ) === $env;
	}
}

if ( ! function_exists( 'isProduction' ) ) {

	/**
	 * Check if is current environment is set to `production`
	 *
	 * @return boolean
	 */
	function isProduction() {
		return env( 'WP_ENV' ) === 'production';
	}
}

if ( ! function_exists( 'config' ) ) {

	/**
	 * Get config key
	 *
	 * @param string|null $key
	 * @return mixed
	 */
	function config( ?string $key = null ) {
		return Config::get( $key );
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
		$app = Bootstrapper::getAppInstance();

		if ( $key ) {
			return $app->resolve( $key );
		}

		return $app;
	}
}

if ( ! function_exists( 'view' ) ) {

	/**
	 * Output twig file content
	 *
	 * @param string $view
	 * @param array $ctx
	 * @return string
	 */
	function view( string $view, array $ctx = [] ) {
		$view = Helper::twigify( $view );
		return Brocooly::view( $view )->with( $ctx );
	}
}

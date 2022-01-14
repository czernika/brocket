<?php

use Timber\Timber;
use Theme\Brocooly;
use Brocooly\Support\Helper;
use Brocooly\Application\Config;
use Brocooly\Application\Bootstrapper;

use function Env\env;

if ( ! function_exists( 'dump' ) ) {
	function dump( $var ) {
		echo '<pre></pre>';
		var_dump( $var );
		echo '</pre>';
	}
}

if ( ! function_exists( 'dd' ) ) {
	function dd( $var ) {
		dump( $var );
		die();
	}
}

if ( ! function_exists( 'isCurrentEnv' ) ) {
	function isCurrentEnv( string $env ) {
		return env( 'WP_ENV' ) === $env;
	}
}

if ( ! function_exists( 'isProduction' ) ) {
	function isProduction() {
		return env( 'WP_ENV' ) === 'production';
	}
}

if ( ! function_exists( 'config' ) ) {
	function config( ?string $key = null ) {
		return Config::get( $key );
	}
}

if ( ! function_exists( 'app' ) ) {
	function app( ?string $key = null ) {
		$app = Bootstrapper::getAppInstance();

		if ( $key ) {
			return $app->resolve( $key );
		}

		return $app;
	}
}

if ( ! function_exists( 'output' ) ) {
	function output( string|array $view, array $ctx = [] ) {
		$ctx   = array_merge( Timber::context(), $ctx );
		$views = Helper::twigify( $view );
		return Brocooly::output( Timber::compile( $views, $ctx ) );
	}
}

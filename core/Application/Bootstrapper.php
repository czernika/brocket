<?php
/**
 * Boot application
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Application;

use Timber\Timber;
use Theme\Brocooly;
use Brocooly\Support\Traits\HasAppTrait;

class Bootstrapper
{

	use HasAppTrait;

	/**
	 * Define if the app was booted or not
	 *
	 * @var boolean
	 */
	private bool $isBooted = false;

	/**
	 * Timber object
	 *
	 * @var Timber
	 */
	public Timber $timber;

	/**
	 * Init configuration object
	 *
	 * @param string $config
	 */
	public function __construct( Timber $timber, string $config )
	{
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		$this->timber = $timber;

		$this->init( $config );
	}

	/**
	 * Boot application
	 *
	 * @return void
	 */
	public function run()
	{
		if ( $this->isBooted ) {
			return;
		}

		$this->isBooted = true;

		$this->setAppInstance( Brocooly::make() );

		self::$app->bootstrap( config( 'wpemerge' ) );
	}

	/**
	 * Initialize configuration object
	 * and Timber resource directory
	 *
	 * @param string $config
	 * @return void
	 */
	private function init( string $config )
	{
		Config::set( $config );

		$this->timber::$dirname = config( 'timber.views' );
		$this->timber::$cache   = config( 'timber.cache.apply' );

		if ( true === config( 'timber.cache.apply' ) ) {
			$this->applyTimberCache();
		}
	}

	private function applyTimberCache() {
		add_filter(
			'timber/cache/location',
			function( $path ) {
				return config( 'timber.cache.location' );
			}
		);

		add_filter(
			'timber/twig/environment/options',
			function( $options ) {
				$options['cache'] = config( 'timber.cache.location' );
			return $options;
			}
		);
	}
}

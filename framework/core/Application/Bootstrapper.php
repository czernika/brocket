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
use Brocooly\Assets\Assets;
use Brocooly\Support\Traits\HasAppTrait;
use Brocooly\Providers\AppServiceProvider;
use Brocooly\Providers\ModelServiceProvider;
use Brocooly\Providers\DebugServiceProvider;

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
	 * @param Timber $timber
	 */
	public function __construct( Timber $timber )
	{
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		$this->timber = $timber;

		$this->setDefinitions();
	}

	/**
	 * Boot application
	 *
	 * @return void
	 */
	public function run() : void
	{
		if ( $this->isBooted ) {
			return;
		}

		$this->isBooted = true;

		$this->setAppInstance( Brocooly::make() );

		$config = array_merge_recursive(
			$this->getBaseAppProviders(),
			config( 'wpemerge' ),
		);

		self::$app->bootstrap( $config );

		if ( config( 'app.assets.autoload', true ) ) {
			$this->loadAssets();
		}
	}

	/**
	 * Initialize configuration object
	 * and Timber resource directory
	 *
	 * @param string $config
	 * @return void
	 */
	public function init( string $config ) : void
	{
		Config::set( $config );

		$this->timber::$dirname = config( 'timber.views', 'resources/views' );
		$this->timber::$cache   = config( 'timber.cache.apply' );

		if ( true === config( 'timber.cache.apply' ) ) {
			$this->applyTimberCache();
		}
	}

	/**
	 * Get base app providers
	 *
	 * @return array
	 */
	private function getBaseAppProviders() : array
	{
		return [
			'providers' => [
				DebugServiceProvider::class,
				AppServiceProvider::class,
				ModelServiceProvider::class,
			],
		];
	}

	/**
	 * Set Timber cache for twig templates
	 *
	 * @return void
	 */
	private function applyTimberCache() : void
	{
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

	/**
	 * Load assets from manifest file
	 *
	 * @return void
	 */
	private function loadAssets() : void
	{
		$assets = new Assets();
		$assets->loadAssets();
	}

	/**
	 * Set main theme constants
	 *
	 * @return void
	 */
	private function setDefinitions() : void
	{
		if ( ! defined( 'BROCOOLY_FRAMEWORK_PATH' ) ) {
			define( 'BROCOOLY_FRAMEWORK_PATH', dirname( __DIR__, 2 ) );
		}

		if ( ! defined( 'BROCOOLY_THEME_PATH' ) ) {
			define( 'BROCOOLY_THEME_PATH', trailingslashit( get_template_directory() ) );
		}

		if ( ! defined( 'BROCOOLY_THEME_URI' ) ) {
			define( 'BROCOOLY_THEME_URI', trailingslashit( get_template_directory_uri() ) );
		}

		/**
		 * Path where all i18n files are
		 *
		 * @since 1.5.0
		 */
		if ( ! defined( 'BROCOOLY_THEME_LANG_PATH' ) ) {
			define( 'BROCOOLY_THEME_LANG_PATH', BROCOOLY_THEME_PATH . 'languages' );
		}

		/**
		 * Public folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'BROCOOLY_THEME_PUBLIC_PATH' ) ) {
			define( 'BROCOOLY_THEME_PUBLIC_PATH', BROCOOLY_THEME_PATH . 'public' );
		}

		if ( ! defined( 'BROCOOLY_THEME_PUBLIC_URI' ) ) {
			define( 'BROCOOLY_THEME_PUBLIC_URI', BROCOOLY_THEME_URI . 'public' );
		}

		/**
		 * Resources folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'BROCOOLY_THEME_RESOURCES_PATH' ) ) {
			define( 'BROCOOLY_THEME_RESOURCES_PATH', BROCOOLY_THEME_PATH . 'resources' );
		}

		if ( ! defined( 'BROCOOLY_THEME_RESOURCES_URI' ) ) {
			define( 'BROCOOLY_THEME_RESOURCES_URI', BROCOOLY_THEME_URI . 'resources' );
		}
	}
}

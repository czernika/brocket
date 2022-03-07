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

use Theme\App;
use Timber\Timber;
use Brocooly\Assets\Assets;
use Brocooly\Support\Traits\HasAppTrait;
use Brocooly\Providers\AppServiceProvider;
use Brocooly\Providers\CommandServiceProvider;
use Brocooly\Providers\ModelServiceProvider;
use Brocooly\Providers\DebugServiceProvider;
use Theme\Providers\ThemeServiceProvider;

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
	 * Theme base path
	 *
	 * @var string
	 */
	private string $basePath;

	/**
	 * Theme base uri
	 *
	 * @var string
	 */
	private string $baseUri;

	/**
	 * Languages dir name
	 *
	 * @var string
	 */
	private string $langDir = 'languages';

	/**
	 * Public dir name
	 *
	 * @var string
	 */
	private string $publicDir = 'public';

	/**
	 * Resources dir name
	 *
	 * @var string
	 */
	private string $resourcesDir = 'resources';

	/**
	 * Storage dir name
	 *
	 * @var string
	 */
	private string $storageDir = 'storage';

	/**
	 * Routes dir name
	 *
	 * @var string
	 */
	private string $routesDir = 'routes';

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

		$this->setAppContainerKeys();
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

		$this->setAppInstance( App::make() );

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
	 * @param string $basePath
	 * @param string $baseUri
	 * @return void
	 */
	public function setBase( string $basePath, string $baseUri ) : void
	{
		$this->basePath = $basePath;
		$this->baseUri  = $baseUri;

		$this->setBasePath();

		Config::set(
			wp_normalize_path( $this->basePath . '/config/*.php' )
		);

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
				CommandServiceProvider::class,
				DebugServiceProvider::class,
				AppServiceProvider::class,
				ModelServiceProvider::class,

				/**
				 * @since 1.10.0
				 */
				ThemeServiceProvider::class,
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
	private function setBasePath() : void
	{
		if ( ! defined( 'BROCOOLY_FRAMEWORK_PATH' ) ) {
			define( 'BROCOOLY_FRAMEWORK_PATH', dirname( __DIR__, 2 ) );
		}

		if ( ! defined( 'BROCOOLY_THEME_PATH' ) ) {
			define( 'BROCOOLY_THEME_PATH',  $this->basePath );
		}

		if ( ! defined( 'BROCOOLY_THEME_URI' ) ) {
			define( 'BROCOOLY_THEME_URI', $this->baseUri );
		}

		/**
		 * Path where all i18n files are
		 *
		 * @since 1.5.0
		 */
		if ( ! defined( 'BROCOOLY_THEME_LANG_PATH' ) ) {
			define( 'BROCOOLY_THEME_LANG_PATH', BROCOOLY_THEME_PATH . $this->langDir );
		}

		/**
		 * Public folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'BROCOOLY_THEME_PUBLIC_PATH' ) ) {
			define( 'BROCOOLY_THEME_PUBLIC_PATH', BROCOOLY_THEME_PATH . $this->publicDir );
		}

		if ( ! defined( 'BROCOOLY_THEME_PUBLIC_URI' ) ) {
			define( 'BROCOOLY_THEME_PUBLIC_URI', BROCOOLY_THEME_URI . $this->publicDir );
		}

		/**
		 * Resources folder
		 *
		 * @since 1.7.3
		 */
		if ( ! defined( 'BROCOOLY_THEME_RESOURCES_PATH' ) ) {
			define( 'BROCOOLY_THEME_RESOURCES_PATH', BROCOOLY_THEME_PATH . $this->resourcesDir );
		}

		if ( ! defined( 'BROCOOLY_THEME_RESOURCES_URI' ) ) {
			define( 'BROCOOLY_THEME_RESOURCES_URI', BROCOOLY_THEME_URI . $this->resourcesDir );
		}

		/**
		 * Storage folder
		 *
		 * @since 1.10.0
		 */
		if ( ! defined( 'BROCOOLY_THEME_STORAGE_PATH' ) ) {
			define( 'BROCOOLY_THEME_STORAGE_PATH', BROCOOLY_THEME_PATH . $this->storageDir );
		}

		if ( ! defined( 'BROCOOLY_THEME_CACHED_CONFIG_FILE' ) ) {
			define( 'BROCOOLY_THEME_CACHED_CONFIG_FILE', BROCOOLY_THEME_STORAGE_PATH . '/cache/config.php' );
		}

		/**
		 * Routes folder
		 *
		 * @since 1.12.1
		 */
		if ( ! defined( 'BROCOOLY_THEME_ROUTES_PATH' ) ) {
			define( 'BROCOOLY_THEME_ROUTES_PATH', BROCOOLY_THEME_PATH . $this->routesDir );
		}
	}

	/**
	 * Set application keys
	 *
	 * @since 1.12.2
	 * @return void
	 */
	private function setAppContainerKeys()
	{
		/**
		 * Container keys
		 *
		 * @since 1.10.0
		 */
		if ( ! defined( 'BROCOOLY_CONSOLE_COMMANDS_KEY' ) ) {
			define( 'BROCOOLY_CONSOLE_COMMANDS_KEY', 'brocooly.console.commands' );
		}

		if ( ! defined( 'BROCOOLY_DEBUGGER_TWIG_KEY' ) ) {
			define( 'BROCOOLY_DEBUGGER_TWIG_KEY', 'brocooly.debugger.twig' );
		}

		if ( ! defined( 'BROCOOLY_MAIL_FACTORY_KEY' ) ) {
			define( 'BROCOOLY_MAIL_FACTORY_KEY', 'brocooly.mail' );
		}

		if ( ! defined( 'BROCOOLY_CUSTOMIZER_FACTORY_KEY' ) ) {
			define( 'BROCOOLY_CUSTOMIZER_FACTORY_KEY', 'brocooly.customizer' );
		}

		if ( ! defined( 'BROCOOLY_VALIDATOR_FACTORY_KEY' ) ) {
			define( 'BROCOOLY_VALIDATOR_FACTORY_KEY', 'brocooly.validator' );
		}

		if ( ! defined( 'BROCOOLY_FILE_FACTORY_KEY' ) ) {
			define( 'BROCOOLY_FILE_FACTORY_KEY', 'brocooly.file' );
		}
	}
}

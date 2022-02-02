<?php
/**
 * Handle app assets files
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.6.0
 */

declare(strict_types=1);

namespace Brocooly\Assets;

use Illuminate\Support\Str;
use Brocooly\Support\Facades\File;

class Assets
{

	/**
	 * Public folder name
	 *
	 * @var string
	 */
	private string $publicDir = 'public';

	/**
	 * Manifest file
	 *
	 * @var string
	 */
	private string $manifest = 'mix-manifest.json';

	/**
	 * Assets array
	 *
	 * @var array
	 */
	private array $assets = [];

	/**
	 * Styles array
	 *
	 * @var array
	 */
	private array $styles = [];

	/**
	 * Scripts array
	 *
	 * @var array
	 */
	private array $scripts = [];

	/**
	 * Manifest file
	 *
	 * @var string
	 */
	private string $manifestFile;

	public function __construct( string $publicDir = 'public', string $manifest = 'mix-manifest.json' )
	{
		$this->publicDir = $publicDir;
		$this->manifest  = $manifest;

		$this->manifestFile = wp_normalize_path( BROCOOLY_THEME_PATH . $this->publicDir . DIRECTORY_SEPARATOR . $this->manifest );

		if ( File::exists( $this->manifestFile ) ) {
			$this->assets  = (array) json_decode( File::get( $this->manifestFile ) );
			$this->styles = $this->defineStyles();
			$this->scripts = $this->defineScripts();
		}
	}

	/**
	 * Autoload assets
	 *
	 * @return void
	 */
	public function loadAssets()
	{
		add_action(
			'wp_enqueue_scripts',
			function() {
				foreach ( $this->styles as $key => $style ) {
					if ( call_user_func( $style->condition ) ) {
						wp_enqueue_style(
							$style->name ?? $this->setAssetName( $key ),
							$this->setAssetSource( $style->public ),
							$style->deps,
							$style->version ?? $this->setAssetVersion( $style->public ),
							$style->media,
						);
					}
				}

				foreach ( $this->scripts as $key => $script ) {
					if ( call_user_func( $script->condition ) ) {
						wp_enqueue_script(
							$script->name ?? $this->setAssetName( $key ),
							$this->setAssetSource( $script->public ),
							$script->deps,
							$script->version ?? $this->setAssetVersion( $script->public ),
							$script->inFooter,
						);
					}
				}
			}
		);
	}

	/**
	 * Define styles to be loaded
	 *
	 * @return array
	 */
	private function defineStyles()
	{
		return $this->getAssetByRegex( config( 'app.assets.styles.regex' ) )
			->map( function( $public, $resource ) {

				if ( config( 'app.assets.styles.queue' ) ) {
					foreach ( config( 'app.assets.styles.queue' ) as $style ) {
						if ( $resource === $style['key'] ) {
							return new Style( $resource, $public, $style );
						}
					}
				}

				return new Style( $resource, $public );
			} )
			->toArray();
	}

	/**
	 * Define scripts to be loaded
	 *
	 * @return array
	 */
	private function defineScripts()
	{
		return $this->getAssetByRegex( config( 'app.assets.scripts.regex' ) )
			->map( function( $public, $resource ) {

				if ( config( 'app.assets.scripts.queue' ) ) {
					foreach ( config( 'app.assets.scripts.queue' ) as $script ) {
						if ( $resource === $script['key'] ) {
							return new Script( $resource, $public, $script );
						}
					}
				}

				return new Script( $resource, $public );
			} )
			->toArray();
	}

	/**
	 * Get styles list
	 *
	 * @return array
	 */
	public function getStyles()
	{
		return $this->styles;
	}

	/**
	 * Get scripts list
	 *
	 * @return array
	 */
	public function getScripts()
	{
		return $this->scripts;
	}

	/**
	 * Get assets list
	 *
	 * @return array
	 */
	public function getAssets()
	{
		return $this->assets;
	}

	/**
	 * Set asset name
	 *
	 * @param string $file
	 * @return string
	 */
	private function setAssetName( string $file )
	{
		return 'brocket-' . Str::afterLast( $file, '/' );
	}

	/**
	 * Set asset source
	 *
	 * @param string $file
	 * @return string
	 */
	private function setAssetSource( string $file )
	{
		return BROCOOLY_THEME_URI . $this->publicDir . $file;
	}

	/**
	 * Set asset version
	 *
	 * @param string $file
	 * @return string
	 */
	private function setAssetVersion( string $file )
	{
		return filemtime( BROCOOLY_THEME_PATH . $this->publicDir . $file );
	}

	/**
	 * Gt specific assets by extension
	 *
	 * @param string $ext
	 */
	protected function getAssetByRegex( string $regexp )
	{
		$assets = collect( $this->assets )
			->filter(
				fn( $resource, $public ) => preg_match( $regexp, $public, $matches ),
			);

		return $assets;
	}

	/**
	 * Get single asset
	 *
	 * @param string $key | file name according to manifest.
	 * @return string
	 */
	public function asset( string $key ) {
		if ( file_exists( $this->manifestFile ) ) {
			return array_key_exists( $key, $this->assets ) ? $this->assets[ $key ] : null;
		}

		return null;
	}
}

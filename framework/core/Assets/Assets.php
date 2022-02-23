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

use Brocooly\Support\Facades\File;

class Assets
{

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

	public function __construct()
	{
		$this->manifest = config( 'app.assets.manifest', 'mix-manifest.json' );

		$this->manifestFile = wp_normalize_path(
			BROCOOLY_THEME_PUBLIC_PATH . DIRECTORY_SEPARATOR . $this->manifest
		);

		$this->assets  = $this->setAssets();
		$this->styles  = $this->defineStyles();
		$this->scripts = $this->defineScripts();
	}

	/**
	 * Get theme assets
	 *
	 * @return array
	 */
	private function setAssets() : array
	{
		if ( File::exists( $this->manifestFile ) ) {
			return (array) json_decode( File::get( $this->manifestFile ) );
		}

		return [];
	}

	/**
	 * Define styles to be loaded
	 *
	 * @return array
	 */
	private function defineStyles() : array
	{
		return $this->getAssetByRegex( config( 'app.assets.styles.regex', '/(\/css\/)[\w]+\.css$/' ) )
			->map( function( $public, $resource ) {

				foreach ( config( 'app.assets.styles.queue', [] ) as $style ) {
					if ( $resource === $style['key'] ) {
						return new Style( $resource, $public, $style );
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
	private function defineScripts() : array
	{
		return $this->getAssetByRegex( config( 'app.assets.scripts.regex', '/(\/js\/)[\w]+\.js$/' ) )
			->map( function( $public, $resource ) {

				foreach ( config( 'app.assets.scripts.queue', [] ) as $script ) {
					if ( $resource === $script['key'] ) {
						return new Script( $resource, $public, $script );
					}
				}

				return new Script( $resource, $public );
			} )
			->toArray();
	}

	/**
	 * Autoload assets
	 *
	 * @return void
	 */
	public function loadAssets() : void
	{
		add_action(
			'wp_enqueue_scripts',
			function() {
				foreach ( $this->getStyles() as $key => $style ) {
					if ( call_user_func( $style->getCondition() ) ) {
						wp_enqueue_style(
							...$style->getProperties()
						);
					}
				}

				foreach ( $this->getScripts() as $key => $script ) {
					if ( call_user_func( $script->getCondition() ) ) {
						wp_enqueue_script(
							...$script->getProperties()
						);
					}
				}

				/**
				 * Scripts localization
				 *
				 * @since 1.12.0
				 */
				foreach ( config( 'app.assets.scripts.localize', [] ) as $localize ) {
					wp_localize_script( ...$localize );
				}
			}
		);
	}

	/**
	 * Get styles list
	 *
	 * @return array
	 */
	public function getStyles() : array
	{
		return $this->styles;
	}

	/**
	 * Get scripts list
	 *
	 * @return array
	 */
	public function getScripts() : array
	{
		return $this->scripts;
	}

	/**
	 * Get assets list
	 *
	 * @return array
	 */
	public function getAssets() : array
	{
		return $this->assets;
	}

	/**
	 * Gt specific assets by extension
	 *
	 * @param string $ext
	 * @return \Illuminate\Support\Collection
	 */
	private function getAssetByRegex( string $regexp ) : \Illuminate\Support\Collection
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
	 * @return string|null
	 */
	public function asset( string $key ) : string|null
	{
		if ( File::exists( $this->manifestFile ) ) {
			$assets = $this->getAssets();
			return array_key_exists( $key, $assets ) ?
				$assets[ $key ] :
				null;
		}

		return null;
	}
}

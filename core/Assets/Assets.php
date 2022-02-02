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
		$this->manifest = config( 'app.assets.manifest' ) ?? 'mix-manifest.json';

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
	private function setAssets()
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
	 * Autoload assets
	 *
	 * @return void
	 */
	public function loadAssets()
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
			}
		);
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
	 * Gt specific assets by extension
	 *
	 * @param string $ext
	 */
	private function getAssetByRegex( string $regexp )
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
		if ( File::exists( $this->manifestFile ) ) {
			$assets = $this->getAssets();
			return array_key_exists( $key, $assets ) ?
				$assets[ $key ] :
				null;
		}

		return null;
	}
}

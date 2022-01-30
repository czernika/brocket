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
			$this->styles  = $this->getAssetByExtension( 'css' );
			$this->scripts = $this->getAssetByExtension( 'js' );
		}
	}

	/**
	 * Autoload assets
	 *
	 * @param boolean $load
	 * @return void
	 */
	public function loadAssets( bool $load = true )
	{
		if ( $load ) {
			add_action(
				'wp_enqueue_scripts',
				function() {
					foreach ( $this->styles as $resource => $public ) {
						wp_enqueue_style(
							$this->setAssetName( $resource ),
							$this->setAssetSource( $public ),
							[],
							$this->setAssetVersion( $public ),
							'all',
						);
					}

					foreach ( $this->scripts as $resource => $public ) {
						wp_enqueue_script(
							$this->setAssetName( $resource ),
							$this->setAssetSource( $public ),
							[],
							$this->setAssetVersion( $public ),
							true,
						);
					}
				}
			);
		}
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
	 * @return void
	 */
	protected function getAssetByExtension( string $ext )
	{
		$styles = collect( $this->assets )->filter(
			fn( $resource, $publicFile ) => Str::startsWith(
					pathinfo( BROCOOLY_THEME_PATH . $this->publicDir . $publicFile )['extension'],
					$ext,
				)
			)
			->toArray();

		return $styles;
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

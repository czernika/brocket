<?php
/**
 * Helps with assets naming
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.3
 */

declare(strict_types=1);

namespace Brocooly\Assets;

use Illuminate\Support\Str;

trait SetAssetsPropertiesTrait
{

	/**
	 * Asset prefix
	 *
	 * @var string
	 */
	private string $prefix = 'brocket-';

	/**
	 * Asset handle
	 *
	 * @var string|null
	 */
	private ?string $name = null;

	/**
	 * Resource key
	 *
	 * @var string
	 */
	private string $resource;

	/**
	 * Public key
	 *
	 * @var string
	 */
	private string $public;

	/**
	 * Source file
	 *
	 * @var string
	 */
	private string $src;

	/**
	 * Asset dependencies
	 *
	 * @var array
	 */
	private array $deps = [];

	/**
	 * Asset version
	 *
	 * @var string|int|null
	 */
	private string|int|null $version = null;

	/**
	 * Condition to load asset
	 * By default it is `true` - load everywhere
	 *
	 * @var string|array|null
	 */
	private string|array|null $condition = '__return_true';

	public function __construct( $resource, $public, ?array $extra = null )
	{
		$this->resource = $resource;
		$this->public   = $public;

		$this->name     = $this->setAssetName( $this->resource );
		$this->src      = $this->setAssetSource( $this->public );
		$this->version  = $this->setAssetVersion( $this->public );

		if ( $extra ) {
			$this->setProperties( $extra );
		}
	}

	/**
	 * Set asset properties
	 *
	 * @param array $extra
	 * @return void
	 */
	private function setProperties( array $extra ) : void
	{
		foreach( $extra as $key => $value ) {
			$this->$key = $value;
		}
	}

	/**
	 * Get condition
	 *
	 * @return string|array
	 */
	public function getCondition() : string|array
	{
		return $this->condition;
	}

	/**
	 * Set asset name
	 * Between last '/' (file name) and '.' (extension)
	 *
	 * @param string $file
	 * @return string
	 */
	protected function setAssetName( string $file ) : string
	{
		return $this->prefix . Str::beforeLast( Str::afterLast( $file, '/' ), '.' );
	}

	/**
	 * Set asset source
	 *
	 * @param string $file
	 * @return string
	 */
	protected function setAssetSource( string $file ) : string
	{
		return BROCOOLY_THEME_PUBLIC_URI . $file;
	}

	/**
	 * Set asset version
	 *
	 * @param string $file
	 * @return int|null
	 */
	protected function setAssetVersion( string $file ) : int|null
	{
		if ( file_exists( BROCOOLY_THEME_PUBLIC_PATH . $file ) ) {
			return filemtime( BROCOOLY_THEME_PUBLIC_PATH . $file );
		}

		return null;
	}
}

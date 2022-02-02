<?php
/**
 * Create Script object ot be loaded
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.2
 */

declare(strict_types=1);

namespace Brocooly\Assets;

class Script
{

	/**
	 * Script handle
	 *
	 * @var string|null
	 */
	public ?string $name = null;

	/**
	 * Resource key
	 *
	 * @var string
	 */
	public string $resource;

	/**
	 * Public key
	 *
	 * @var string
	 */
	public string $public;

	/**
	 * Script dependencies
	 *
	 * @var array
	 */
	public array $deps = [];

	/**
	 * Script version
	 *
	 * @var string|null
	 */
	public ?string $version = null;

	/**
	 * Load script on footer or not
	 *
	 * @var boolean
	 */
	public bool $inFooter = true;

	/**
	 * Condition to load script
	 *
	 * @var string|array|null
	 */
	public string|array|null $condition = '__return_true';

	public function __construct( $resource, $public, ?array $extra = null )
	{
		$this->resource = $resource;
		$this->public = $public;

		if ( $extra ) {
			$this->setProperties( $extra );
		}
	}

	/**
	 * Set style properties
	 *
	 * @param array $extra
	 * @return void
	 */
	private function setProperties( array $extra )
	{
		$this->name = $extra['name'] ?? null;
		$this->deps = $extra['deps'] ?? [];
		$this->version = $extra['version'] ?? null;
		$this->inFooter = $extra['inFooter'] ?? true;
		$this->condition = $extra['condition'] ?? '__return_true';
	}
}

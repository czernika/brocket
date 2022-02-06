<?php
/**
 * Create style object ot be loaded
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.2
 */

declare(strict_types=1);

namespace Brocooly\Assets;

class Style
{
	use SetAssetsPropertiesTrait;

	/**
	 * Style media
	 *
	 * @var string
	 */
	private string $media = 'all';

	/**
	 * Get enqueue properties
	 *
	 * @since 1.7.3
	 * @return array
	 */
	public function getProperties() : array
	{
		return [
			$this->name,
			$this->src,
			$this->deps,
			$this->version,
			$this->media,
		];
	}
}

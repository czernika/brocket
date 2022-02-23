<?php
/**
 * Base menu object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Brocooly\UI;

use Timber\Menu as TimberMenu;

class Menu
{

	/**
	 * Timber menu object
	 *
	 * @var TimberMenu|null
	 */
	public TimberMenu|null $menu = null;

	/**
	 * Menu location
	 *
	 * @var string
	 */
	const LOCATION = 'primary';

	public function __construct( array $params = [] )
	{
		$this->menu = new TimberMenu( static::LOCATION, $params );
	}

	/**
	 * Menu label
	 *
	 * @return string
	 */
	public function label() : string
	{
		throw new \Exception( 'Menu requires label' );
	}
}

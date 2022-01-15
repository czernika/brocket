<?php
/**
 * Route facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Theme\Brocooly;

class Route extends AbstractFacade
{
	protected static function accessor()
	{
		return Brocooly::route();
	}
}

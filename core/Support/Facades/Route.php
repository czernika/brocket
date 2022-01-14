<?php

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

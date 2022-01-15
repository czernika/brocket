<?php
/**
 * \Illuminate\Filesystem\Filesystem facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Illuminate\Filesystem\Filesystem;

class File extends AbstractFacade
{
	protected static function accessor()
	{
		return new Filesystem();
	}
}

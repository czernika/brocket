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

class File extends AbstractFacade
{
	protected static function accessor()
	{
		return 'brocooly.file';
	}
}

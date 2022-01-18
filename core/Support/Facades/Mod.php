<?php
/**
 * Kirki Framework customizer facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Brocooly\Customizer\CustomizerFactory;

class Mod extends AbstractFacade
{
	protected static function accessor()
	{
		return new CustomizerFactory();
	}
}

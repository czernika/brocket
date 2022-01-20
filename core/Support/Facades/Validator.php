<?php
/**
 * Validator facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.5.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Brocooly\Support\Factories\ValidatorFactory;

class Validator extends AbstractFacade
{
	protected static function accessor()
	{
		return new ValidatorFactory();
	}
}

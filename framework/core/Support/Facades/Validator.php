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

class Validator extends AbstractFacade
{
	protected static function accessor()
	{
		return BROCOOLY_VALIDATOR_FACTORY_KEY;
	}
}

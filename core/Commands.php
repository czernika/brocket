<?php
/**
 * Console commands loader
 * Returns an array of all available commands
 *
 * @package Brocooly-core
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly;

use Brocooly\Console\MakeProvider;
use Brocooly\Console\MakeController;
use Brocooly\Console\MakeModelTaxonomy;
use Brocooly\Console\MakeModelPostType;

class Commands
{
	/**
	 * Array of available console commands
	 *
	 * @var array
	 */
	private static array $commands = [
		MakeController::class,
		MakeProvider::class,
		MakeModelPostType::class,
		MakeModelTaxonomy::class,
	];

	/**
	 * Get all console commands list
	 *
	 * @return array
	 */
	public static function get() {
		return static::$commands;
	}
}
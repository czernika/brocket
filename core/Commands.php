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

use Brocooly\Console\ClearCache;
use Brocooly\Console\MakeProvider;
use Brocooly\Console\MakeController;
use Brocooly\Console\MakeCustomizerPanel;
use Brocooly\Console\MakeCustomizerSection;
use Brocooly\Console\MakeMiddleware;
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
		MakeMiddleware::class,
		MakeModelPostType::class,
		MakeModelTaxonomy::class,
		MakeCustomizerPanel::class,
		MakeCustomizerSection::class,
		ClearCache::class,
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

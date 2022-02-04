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

use Brocooly\Console\MakeMail;
use Brocooly\Console\ClearCache;
use Brocooly\Console\GenerateSalts;
use Brocooly\Console\MakeProvider;
use Brocooly\Console\MakeMiddleware;
use Brocooly\Console\MakeController;
use Brocooly\Console\MakeModelTaxonomy;
use Brocooly\Console\MakeModelPostType;
use Brocooly\Console\MakeCustomizerPanel;
use Brocooly\Console\MakeCustomizerSection;
use Brocooly\Console\MakeRequest;
use Brocooly\Console\MakeRule;

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
		MakeMail::class,
		MakeModelPostType::class,
		MakeModelTaxonomy::class,
		MakeCustomizerPanel::class,
		MakeCustomizerSection::class,
		MakeRequest::class,
		MakeRule::class,
		ClearCache::class,
		GenerateSalts::class,
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

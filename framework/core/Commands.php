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

use Brocooly\Console\Support\ClearCache;
use Brocooly\Console\Support\GenerateSalts;
use Brocooly\Console\Vendors\CopyTestsVendor;
use Brocooly\Console\Vendors\CopyDockerVendor;
use Brocooly\Console\Files\MakeMail;
use Brocooly\Console\Files\MakeHook;
use Brocooly\Console\Files\MakeRule;
use Brocooly\Console\Files\MakeRequest;
use Brocooly\Console\Files\MakeProvider;
use Brocooly\Console\Files\MakeController;
use Brocooly\Console\Files\MakeMiddleware;
use Brocooly\Console\Files\MakeModelTaxonomy;
use Brocooly\Console\Files\MakeModelPostType;
use Brocooly\Console\Files\MakeCustomizerPanel;
use Brocooly\Console\Files\MakeCustomizerSection;

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
		MakeHook::class,
		ClearCache::class,
		GenerateSalts::class,
		CopyDockerVendor::class,
		CopyTestsVendor::class,
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

<?php
/**
 * Main theme object
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme;

use Theme\UI\Menus\PrimaryMenu;
use WPEmerge\Application\ApplicationTrait;

/** @mixin \WPEmerge\Application\ApplicationMixin */
class Brocooly
{
	use ApplicationTrait;

	/**
	 * -------------------------------------------------------------------------
	 * Theme global context
	 * -------------------------------------------------------------------------
	 *
	 * Will be available on every view template when calling `output` helper
	 *
	 * @since 1.7.2
	 */
	public function context()
	{
		$context = [

			/**
			 * Primary navigation menu
			 *
			 * Menu object will be available under menu property
			 * @example {{ primary.menu }}
			 * @since 1.11.0
			 */
			'primary' => new PrimaryMenu(),
		];

		return $context;
	}
}

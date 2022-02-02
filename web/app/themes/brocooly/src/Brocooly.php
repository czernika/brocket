<?php
/**
 * Main theme object
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme;

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
		$context = [];

		return $context;
	}
}

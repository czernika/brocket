<?php

/**
 * When not using `theme.json` file
 * WordPress still set 4 transients for global styles
 * which causes performance hit on a first load so we disable it
 *
 * @see https://wordpress.org/support/topic/disable-default-theme-json/
 * @since 1.10.0
 * @package Brocooly
 */

declare(strict_types=1);

namespace Theme\Hooks;

use Brocooly\Hooks\Hookable;

class DisableTransient implements Hookable
{
	public function init()
	{
		$theme = get_stylesheet();
		add_filter( "pre_transient_global_styles_{$theme}", '__return_true', 10 );
	}
}

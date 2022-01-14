<?php
/**
 *
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme\Http\Controllers;

class PageController
{
	public function front() {
		return output( 'content.front-page' );
	}

	public function notFound() {
		return output( 'content.404' );
	}
}

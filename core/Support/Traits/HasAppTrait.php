<?php

declare(strict_types=1);

namespace Brocooly\Support\Traits;

trait HasAppTrait
{

	private static $app = null;

	public static function getAppInstance() {
		return self::$app;
	}

	public static function setAppInstance( $app ) {
		self::$app = $app;
	}
}

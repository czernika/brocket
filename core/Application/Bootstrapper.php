<?php

declare(strict_types=1);

namespace Brocooly\Application;

use Theme\App;
use Timber\Timber;
use Brocooly\Support\Traits\HasAppTrait;
use Theme\Brocooly;

class Bootstrapper
{

	use HasAppTrait;

	private bool $isBooted = false;

	/**
	 * Init configuration object
	 *
	 * @param string $config
	 */
	public function __construct( string $config ) {
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		$this->init( $config );
	}

	public function run() {
		if ( $this->isBooted ) {
			return;
		}

		$this->isBooted = true;

		$this->setAppInstance( Brocooly::make() );

		self::$app->bootstrap( config( 'wpemerge' ) );
	}

	private function init( string $config ) {
		Config::set( $config );
		Timber::$dirname = config( 'timber.views' );
	}
}

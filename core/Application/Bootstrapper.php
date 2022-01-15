<?php
/**
 * Boot application
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Application;

use Theme\Brocooly;
use Brocooly\Support\Traits\HasAppTrait;

class Bootstrapper
{

	use HasAppTrait;

	/**
	 * Define if the app was booted or not
	 *
	 * @var boolean
	 */
	private bool $isBooted = false;

	/**
	 * Init configuration object
	 *
	 * @param string $config
	 */
	public function __construct( string $config )
	{
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}

		$this->init( $config );
	}

	/**
	 * Boot application
	 *
	 * @return void
	 */
	public function run()
	{
		if ( $this->isBooted ) {
			return;
		}

		$this->isBooted = true;

		$this->setAppInstance( Brocooly::make() );

		self::$app->bootstrap( config( 'wpemerge' ) );
	}

	/**
	 * Initialize configuration object
	 *
	 * @param string $config
	 * @return void
	 */
	private function init( string $config )
	{
		Config::set( $config );
	}
}

<?php
/**
 * Execute script after core was installed
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Framework\Core\Console\Composer;

use Brocooly\Support\Facades\File;

class PostInstall
{
	public static function execute()
	{
		File::copy( BROCOOLY_APP_PATH . '/.env.example', BROCOOLY_APP_PATH . '/.env' );
		File::copy( BROCOOLY_FRAMEWORK_PATH . 'stubs/wp-cli.local.yml', BROCOOLY_APP_PATH . '/wp-cli.local.yml' );
	}
}

<?php
/**
 * Since it is a WordPress theme, the core itself already have been initialized
 * So here we are just boot Framework itself and creating application instance
 *
 * @package Brocooly
 * @since 1.0.0
 */

use Timber\Timber;
use Brocooly\Assets\Assets;
use Brocooly\Application\Bootstrapper;

/**
 * -------------------------------------------------------------------------
 * Initialize main app instances
 * -------------------------------------------------------------------------
 *
 * It creates application instance and defines configuration object globally available
 * Requires Timber library to init its constants
 *
 * @since 1.2.0
 */
$app = new Bootstrapper(
	new Timber(),
	wp_normalize_path( get_template_directory() . '/config/*.php' ),
);

/**
 * -------------------------------------------------------------------------
 * Run Forest run!
 * -------------------------------------------------------------------------
 *
 * Boot defined application instance
 */
$app->run();

/**
 * -------------------------------------------------------------------------
 * Define theme assets like styles and scripts
 * -------------------------------------------------------------------------
 *
 * With a help of `laravel-mix` package
 * If you change params here make sure it is ok with webpack configuration
 *
 * @since 1.6.0
 */
$assets = new Assets();

/**
 * -------------------------------------------------------------------------
 * Autoload theme assets
 * -------------------------------------------------------------------------
 *
 * If param set to false, no assets will be autoloaded.
 * In a production mode it is sometimes a good idea to handle assets manually
 * where they are required
 *
 * @since 1.6.0
 */
$assets->loadAssets( ! isProduction() );

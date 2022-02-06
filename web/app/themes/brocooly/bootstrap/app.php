<?php
/**
 * Since it is a WordPress theme, the core itself already have been initialized
 * So here we are just boot Framework itself and creating application instance
 *
 * @package Brocooly
 * @since 1.0.0
 */

use Timber\Timber;
use Brocooly\Application\Bootstrapper;

/**
 * -------------------------------------------------------------------------
 * Initialize main app instances
 * -------------------------------------------------------------------------
 *
 * It creates application instance and defines constants globally available
 * Requires Timber library to init its constants
 *
 * @since 1.2.0
 */
$app = new Bootstrapper(
	new Timber(),
);

/**
 * -------------------------------------------------------------------------
 * Initialize configuration object and Timber library
 * -------------------------------------------------------------------------
 *
 * It creates configuration instance and defines
 *
 * @since 1.8.4
 */
$app->init(
	wp_normalize_path( BROCOOLY_THEME_PATH . 'config/*.php' ),
);

/**
 * -------------------------------------------------------------------------
 * Run Forest run!
 * -------------------------------------------------------------------------
 *
 * Boot defined application instance
 */
$app->run();

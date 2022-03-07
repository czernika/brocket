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
 * Set base theme path and uri
 * -------------------------------------------------------------------------
 *
 * It creates configuration instance and defines base path, app constants
 *
 * @since 1.12.2
 */
$app->setBase(
	trailingslashit( get_template_directory() ),
	trailingslashit( get_template_directory_uri() ),
);

/**
 * -------------------------------------------------------------------------
 * Run Forest run!
 * -------------------------------------------------------------------------
 *
 * Boot defined application instance
 */
$app->run();

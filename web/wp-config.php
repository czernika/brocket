<?php
/**
 * NOTE: Do not edit this file. Edit the config files found in the config/ dir instead.
 * This file is required in the root directory so WordPress can find it.
 * WP is hardcoded to look in its own directory or one directory up for wp-config.php.
 *
 * @package Brocooly
 * @since 1.0.0
 */

/**
 * --------------------------------------------------------------------------
 * Include vendor files
 * --------------------------------------------------------------------------
 *
 * ! Brocooly STRONGLY requires Composer to be installed.
 * If it's not go to and install.
 *
 * @link https://getcomposer.org/
 */
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

/**
 * --------------------------------------------------------------------------
 * Include app environment configuration
 * --------------------------------------------------------------------------
 *
 * This file will define which environment parameters to load
 */
require_once dirname( __DIR__ ) . '/config/application.php';

/**
 * --------------------------------------------------------------------------
 * Boot WordPress
 * --------------------------------------------------------------------------
 */
require_once ABSPATH . 'wp-settings.php';

/**
 * --------------------------------------------------------------------------
 * Ensure compatible version of PHP is used
 * --------------------------------------------------------------------------
 *
 * Minimum required version is 8.0.
 */
$brocooly_min_php_version = '8.0';
if ( version_compare( $brocooly_min_php_version, phpversion(), '>=' ) ) {
	wp_die(
		/* translators: 1 - minimum required PHP version, 2 - current PHP version. */
		sprintf(
			/* html */
			'<h1>Brocooly Framework requires PHP version %1$s or greater!</h1><p>Invalid PHP version! Please update it. Your current version is: <strong>%2$s</strong></p>',
			esc_html( $brocooly_min_php_version ),
			esc_html( phpversion() ),
		),
	);
}

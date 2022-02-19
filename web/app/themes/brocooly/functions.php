<?php
/**
 * Brocooly Framework - developer-friendly framework
 * heavily inspired by Laravel and based on Timber and WPEmerge solutions
 * for WordPress themes development with Bedrock folder structure
 *
 * @package Brocooly
 * @author Ihar Aliakseyenka <aliha.devs@gmail.com>
 * @since 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * Boot application
 * -------------------------------------------------------------------------
 *
 * Include bootstrap files directly
 */
require_once __DIR__ . '/bootstrap/app.php';

/**
 * -------------------------------------------------------------------------
 * Include Kirki Framework
 * -------------------------------------------------------------------------
 *
 * If your theme requires theme options
 * you may include this file
 */
if ( ! class_exists( \Kirki\Compatibility\Kirki::class ) ) {
	require_once WP_CONTENT_DIR . '/vendor/aristath/kirki/kirki.php';
}

/**
 * -------------------------------------------------------------------------
 * Disable WordPress core update notification
 * -------------------------------------------------------------------------
 *
 * Since 1.11.0 we downgraded to WP 5.7.5 (with 5.8.3 security release included)
 * as it is has no new features like blog themes etc.
 * Downgrading has increased speed of website
 * and reduced amount of extra queries to database
 *
 * Remove this lines and update core version via `composer update` command
 * if you wish use latest release
 *
 * @since 1.11.0
 */
add_filter(
	'pre_site_transient_update_core',
	'__return_false'
);

/**
 * ==========================================================================
 * Stop line - you may place your code AFTER this block
 * ==========================================================================
 *
 * All you custom functions may be placed here as it is still WordPress installation.
 *
 * ! But Brocooly Framework recommends you NOT to do that
 * and handle logic inside theme source directories.
 *
 * Happy coding!
 */

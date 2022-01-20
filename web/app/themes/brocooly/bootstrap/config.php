<?php
/**
 * Define theme config keys and constants
 *
 * @package Brocooly
 * @since 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * Define theme constants
 * -------------------------------------------------------------------------
 *
 * ! This constants should not be changed
 */
if ( ! defined( 'BROCOOLY_THEME_PATH' ) ) {
	define( 'BROCOOLY_THEME_PATH', trailingslashit( get_template_directory() ) );
}

if ( ! defined( 'BROCOOLY_THEME_URI' ) ) {
	define( 'BROCOOLY_THEME_URI', trailingslashit( get_template_directory_uri() ) );
}

/**
 * Path where all i18n files are
 *
 * @since 1.5.0
 */
if ( ! defined( 'BROCOOLY_THEME_LANG_PATH' ) ) {
	define( 'BROCOOLY_THEME_LANG_PATH', BROCOOLY_THEME_PATH . 'languages' );
}

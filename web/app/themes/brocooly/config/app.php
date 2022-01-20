<?php
/**
 * Application main configuration file
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.5.0
 */

return [

	/**
	 * --------------------------------------------------------------------------
	 * Get application locale
	 * --------------------------------------------------------------------------
	 *
	 * Used for validator factory to receive correct message
	 * This locale should be the same as directories within `validation` folder
	 *
	 * If current locale is `ru_RU`, the path to validation rules file should be
	 * `languages/validation/ru_RU/validation.php`
	 *
	 * @var string
	 */
	'locale' => get_locale(),

];

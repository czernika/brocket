<?php
/**
 * Mailer configuration
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

return [

	/**
	 * -------------------------------------------------------------------------
	 * Default mailer
	 * -------------------------------------------------------------------------
	 *
	 * Your application will use this default mailer to send emails
	 *
	 * @var string
	 */
	'default' => env( 'MAIL_MAILER', 'wordpress' ),

	/**
	 * -------------------------------------------------------------------------
	 * List of all available mailers
	 * -------------------------------------------------------------------------
	 *
	 * Here you may specify all of the mailers used by application.
	 * WordPress by default includes PHPMailer library
	 * so we're use it via 'phpmailer_init' WordPress hook.
	 *
	 * @var array
	 */
	'mailers' => [

		/**
		 * Use default `wp_mail()` function
		 *
		 * @link https://developer.wordpress.org/reference/functions/wp_mail/
		 */
		'wordpress' => [
			'transport' => 'wordpress',
		],

		/**
		 * Mailhog for Dev environment
		 * WebUI will be available under http://0.0.0.0:8025
		 *
		 * @link https://github.com/mailhog/MailHog
		 */
		'mailhog'   => [
			'transport' => 'mailhog',
			'host'      => '127.0.0.1',
			'port'      => 1025,
		],

		/**
		 * SMTP settings added within `phpmailer_init` hook
		 *
		 * @link https://developer.wordpress.org/reference/hooks/phpmailer_init/
		 */
		'mailtrap'  => [
			'transport'  => 'smtp',
			'host'       => env( 'MAIL_HOST', 'smtp.mailtrap.io' ),
			'port'       => env( 'MAIL_PORT', 2525 ),
			'username'   => env( 'MAIL_USERNAME' ),
			'password'   => env( 'MAIL_PASSWORD' ),
			'encryption' => env( 'MAIL_ENCRYPTION', 'tls' ),
		],

		'google'    => [
			'transport'  => 'smtp',
			'host'       => env( 'MAIL_HOST', 'smtp.googlemail.com' ),
			'port'       => env( 'MAIL_PORT', 465 ),
			'username'   => env( 'MAIL_USERNAME' ),
			'password'   => env( 'MAIL_PASSWORD' ),
			'encryption' => env( 'MAIL_ENCRYPTION', 'tls' ),
		],

		'yandex'    => [
			'transport'  => 'smtp',
			'host'       => env( 'MAIL_HOST', 'smtp.yandex.ru' ),
			'port'       => env( 'MAIL_PORT', 587 ),
			'username'   => env( 'MAIL_USERNAME' ),
			'password'   => env( 'MAIL_PASSWORD' ),
			'encryption' => env( 'MAIL_ENCRYPTION', 'ssl' ),
		],

	],

	/**
	 * -------------------------------------------------------------------------
	 * Specify sender information
	 * -------------------------------------------------------------------------
	 *
	 * Like name and email address (like <no-reply>)
	 *
	 * @var array
	 */
	'from'    => [
		'name'    => env( 'MAIL_FROM_NAME', get_bloginfo( 'name' ) ),
		'address' => env( 'MAIL_FROM_ADDRESS', get_option( 'admin_email' ) ),
	],

	/**
	 * -------------------------------------------------------------------------
	 * Mail content type
	 * -------------------------------------------------------------------------
	 *
	 * Default to "text/html" as it is most common use
	 * Alternatively set "text/plain" to pass text only
	 *
	 * @var string
	 */
	'type'    => 'text/html',

];

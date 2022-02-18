<?php
/**
 * \Brocooly\Mail\Mailer facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

/**
 * @method static $this to( string|array $mailTo )
 * @method static $this subject( string $subject )
 * @method static $this message( string $message )
 * @method static $this template( string|array $template, array $ctx = [] )
 * @method static $this headers( $headers = '' )
 * @method static $this attachments( $attachments = [] )
 * @method static $this mailable( $mailer )
 * @method static $this send()
 *
 * @see \Brocooly\Mail\Mailer
 */
class Mail extends AbstractFacade
{
	protected static function accessor()
	{
		return BROCOOLY_MAIL_FACTORY_KEY;
	}
}

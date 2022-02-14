<?php
/**
 * Mailable trait
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Mail;

use Timber\Timber;
use Brocooly\Support\Helper;

trait MailableTrait
{

	/**
	 * Recipient email
	 *
	 * @var string|array|null
	 */
	public string|array|null $mailTo = null;

	/**
	 * Mail subject
	 *
	 * @var string|null
	 */
	public ?string $subject = null;

	/**
	 * Message text
	 *
	 * @var string|null
	 */
	public ?string $message = null;

	/**
	 * Mail headers
	 *
	 * @var string|array|null
	 */
	public string|array|null $headers = '';

	/**
	 * Mail attachments
	 *
	 * @var array
	 */
	public array|null $attachments = [];

	/**
	 * Send email to recipient
	 *
	 * @param string|array $mailTo | email (or array of emails) to send to
	 * @return $this
	 */
	public function to( string|array $mailTo )
	{
		$this->mailTo = $mailTo;
		return $this;
	}

	/**
	 * Set email subject
	 *
	 * @param string $subject | email subject.
	 * @return $this
	 */
	public function subject( string $subject )
	{
		$this->subject = $subject;
		return $this;
	}

	/**
	 * Set plain text message
	 *
	 * @param string $message | message to send
	 * @return $this
	 */
	public function message( string $message )
	{
		$this->message = $message;
		return $this;
	}

	/**
	 * Send a template message
	 *
	 * @param string|array $template
	 * @param array $ctx
	 * @return $this
	 */
	public function template( string|array $template, array $ctx = [] )
	{
		$ctx           = Helper::getAppContext( $ctx );
		$views         = Helper::twigify( $template );
		$this->message = Timber::compile( $views, $ctx );
		return $this;
	}

	/**
	 * Set email header
	 *
	 * @param string|array $headers
	 * @return $this
	 */
	public function headers( $headers = '' )
	{
		$this->headers = $headers;
		return $this;
	}

	/**
	 * Set email attachments
	 *
	 * @param array $attachments | array of attachments
	 * @return $this
	 */
	public function attachments( $attachments = [] )
	{
		$this->attachments = $attachments;
		return $this;
	}
}

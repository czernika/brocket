<?php
/**
 * Mailer class
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Mail;

use Webmozart\Assert\Assert;

class Mailer
{

	use MailableTrait;

	/**
	 * Set mailable object
	 *
	 * @param object $mailer | mailer class
	 * @return void
	 */
	public function mailable( Mailable $mailer )
	{
		$mailer->build();

		$this->mailTo      = $this->mailTo ?? $mailer->mailTo;
		$this->subject     = $this->subject ?? $mailer->subject;
		$this->message     = $this->message ?? $mailer->message;
		$this->headers     = $this->headers ?? $mailer->headers;
		$this->attachments = $this->attachments ?? $mailer->attachments;

		return $this->send();
	}

	/**
	 * Send email
	 *
	 * @return void
	 */
	public function send()
	{
		Assert::notNull( $this->mailTo, 'Mail recipient is not specified' );
		Assert::notNull( $this->subject, 'Mail subject is not specified' );
		Assert::notNull( $this->message, 'Mail has no message' );

		return wp_mail(
			$this->mailTo,
			$this->subject,
			$this->message,
			$this->headers,
			$this->attachments,
		);
	}
}

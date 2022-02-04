<?php
/**
 * Mailable abstract class
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Mail;

abstract class Mailable
{
	use MailableTrait;

	abstract public function build();
}

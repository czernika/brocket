<?php
/**
 * Mailer Service Provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use Brocooly\Mail\Mailer;
use PHPMailer\PHPMailer\PHPMailer;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class MailServiceProvider implements ServiceProviderInterface
{

	/**
	 * Array of information about sender
	 *
	 * @var array
	 */
	private array $mailFrom = [];

	/**
	 * Name of sender
	 *
	 * @var string
	 */
	private string $mailFromName;

	/**
	 * Address of sender
	 *
	 * @var string
	 */
	private string $mailFromAddress;

	/**
	 * Selected mailer key
	 *
	 * @var string
	 */
	private array $mailer = [];

	/**
	 * Default mailer key
	 *
	 * @var string
	 */
	private string $defaultMailer = 'wordpress';

	/**
	 * Mailer transport
	 *
	 * @var string
	 */
	private string $transport = 'wordpress';

	/**
	 * Mail type
	 *
	 * @var string
	 */
	private string $mailType = 'text/html';

	public function __construct()
	{
		$this->mailFrom        = config( 'mail.from', [] );
		$this->mailFromName    = $this->mailFrom['name'];
		$this->mailFromAddress = $this->mailFrom['address'];

		$this->defaultMailer = config( 'mail.default' );
		$this->mailer        = config( 'mail.mailers' )[ $this->defaultMailer ];
		$this->transport     = $this->mailer['transport'];

		$this->mailType = config( 'mail.type', 'text/html' );
	}

	public function register( $container )
	{
		$container[ BROCOOLY_MAIL_FACTORY_KEY ] = fn( $c ) => new Mailer();
	}

	public function bootstrap( $container )
	{
		if ( 'smtp' === $this->transport ) {
			add_action( 'phpmailer_init', [ $this, 'setSMTPCredentials' ] );
		}

		if ( 'mailhog' === $this->transport ) {
			add_action( 'phpmailer_init', [ $this, 'setMailHogCredentials' ] );
		}

		add_action( 'wp_mail_content_type', [ $this, 'setContentType' ] );
		add_filter( 'wp_mail_from', [ $this, 'setMailFromAddress' ] );
		add_filter( 'wp_mail_from_name', [ $this, 'setMailFromName' ] );
	}

	/**
	 * Set SMTP credentials if needed
	 *
	 * @param PHPMailer $mailer
	 * @return PHPMailer
	 */
	public function setSMTPCredentials( PHPMailer $mailer )
	{
		$mailer->IsSMTP();
		$mailer->SMTPAutoTLS = false;

		$mailer->SMTPAuth   = true;
		$mailer->SMTPSecure = $this->mailer['encryption'];

		$mailer->Host     = $this->mailer['host'];
		$mailer->Port     = $this->mailer['port'];
		$mailer->Username = $this->mailer['username'];
		$mailer->Password = $this->mailer['password'];

		return $mailer;
	}

	/**
	 * Set SMTP credentials for Mailhog
	 *
	 * @param PHPMailer $mailer
	 * @return PHPMailer
	 */
	public function setMailHogCredentials( PHPMailer $mailer )
	{
		$mailer->IsSMTP();
		$mailer->SMTPAuth = false;

		$mailer->Host = $this->mailer['host'];
		$mailer->Port = $this->mailer['port'];

		return $mailer;
	}

	/**
	 * Set content type of an email
	 *
	 * @param string $contentType
	 * @return string
	 */
	public function setContentType( string $contentType )
	{
		return $this->setMailCredentials( $this->mailType, $contentType );
	}

	/**
	 * Set mail from address
	 *
	 * @param string $from
	 * @return string
	 */
	public function setMailFromAddress( string $from )
	{
		return $this->setMailCredentials( $this->mailFromAddress, $from );
	}

	/**
	 * Set mail from name
	 *
	 * @param string $from
	 * @return string
	 */
	public function setMailFromName( string $from )
	{
		return $this->setMailCredentials( $this->mailFromName, $from );
	}

	/**
	 * Set some mail credentials like `from`
	 *
	 * @param string $value
	 * @param string $default
	 * @return void
	 */
	private function setMailCredentials( string $value, string $default )
	{
		if ( $value ) {
			return $value;
		}

		return $default;
	}
}

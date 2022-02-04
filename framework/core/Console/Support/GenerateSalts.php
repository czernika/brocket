<?php
/**
 * Generate WordPress salts
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.6
 */

declare(strict_types=1);

namespace Brocooly\Console\Support;

use Brocooly\Support\Facades\File;
use Brocooly\Console\SymfonyStyleTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSalts extends Command
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'salts:generate';

	private array $keys = [
		'AUTH_KEY',
		'SECURE_AUTH_KEY',
		'LOGGED_IN_KEY',
		'NONCE_KEY',
		'AUTH_SALT',
		'SECURE_AUTH_SALT',
		'LOGGED_IN_SALT',
		'NONCE_SALT',
	];

	/**
	 * Allow execution in production mode or not
	 *
	 * @return boolean
	 */
	public function notAllowedInProduction() : bool
	{
		return true;
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$this->io->info( 'Starting salts generation' );

		$envFile = BROCOOLY_APP_PATH . DIRECTORY_SEPARATOR . '.env';

		if ( ! File::exists( $envFile ) ) {
			$this->io->warning( 'File ' . $envFile . ' does not exists' );
			return CreateClassCommand::FAILURE;
		}

		try {
			$replace = File::get( $envFile );
			foreach( $this->keys as $salt ) {
				$generated = $salt . '=\'' . wp_generate_password( 64, true, true ) . '\'';
				$regex   = '/\b' . $salt . '=(.*)/';
				$replace = preg_replace( $regex, $generated, $replace );
			}
			File::put( $envFile, $replace );
		} catch ( \Throwable $th ) {
			$this->io->error( $th->getMessage() );
		}

		$this->io->success( 'Salts has been successfully generated' );
		return Command::SUCCESS;
	}

}

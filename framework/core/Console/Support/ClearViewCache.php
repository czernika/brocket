<?php
/**
 * Clear folder with all cached view files
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.2.1
 */

declare(strict_types=1);

namespace Brocooly\Console\Support;

use Brocooly\Console\SymfonyStyleTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearViewCache extends Command
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'view:clear';

	/**
	 * Allow execution in production mode or not
	 *
	 * @return boolean
	 */
	public function notAllowedInProduction() : bool
	{
		return false;
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {
		$loader = new \Timber\Loader();

		try {
			$loader->clear_cache_twig();
			$loader->clear_cache_timber();
		} catch ( \Throwable $th ) {
			$this->io->error( $th->getMessage() );
		}

		$this->io->success( 'Cache was successfully flushed' );
		return Command::SUCCESS;
	}

}

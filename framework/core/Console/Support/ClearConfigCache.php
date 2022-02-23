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
use Brocooly\Support\Facades\File;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearConfigCache extends Command
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'config:clear';

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

		File::delete( BROCOOLY_THEME_CACHED_CONFIG_FILE );

		$this->io->success( 'Configuration file was cleared' );
		return Command::SUCCESS;
	}

}

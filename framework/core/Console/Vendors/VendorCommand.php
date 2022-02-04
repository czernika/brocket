<?php
/**
 * Copy files and directories
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.8
 */

declare(strict_types=1);

namespace Brocooly\Console\Vendors;

use Brocooly\Support\Facades\File;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VendorCommand extends Command
{

	/**
	 * Stubs directory
	 *
	 * @var string
	 */
	protected string $stubs = BROCOOLY_FRAMEWORK_PATH . '/stubs/';

	/**
	 * Where files should be put
	 *
	 * @var string
	 */
	protected string $to = BROCOOLY_APP_PATH;

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
		File::copyDirectory( $this->stubs . $this->from, $this->to );

		$this->io->success( 'Vendor files published' );
		return Command::SUCCESS;
	}
}

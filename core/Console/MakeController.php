<?php
/**
 * Create controller
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeController extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:controller';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Http\Controllers';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Http/Controllers';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'controller',
				InputArgument::REQUIRED,
				'Controller name',
			)
			->addOption(
				'construct',
				'c',
				InputOption::VALUE_NONE,
				'Add construct method',
			)
			->addOption(
				'resource',
				'r',
				InputOption::VALUE_NONE,
				'Create controller and both methods for index and single requests',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$io = new SymfonyStyle( $input, $output );

		$name = $input->getArgument( 'controller' );

		$options = [ 'resource', 'construct' ];
		foreach ( $options as $option ) {
			$this->$option = $input->getOption( $option );
		}

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			[
				$this->className . " - custom theme controller\n",
			]
		);

		$class = $this->generateClassCap();

		$this->generateMethods( $class );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$io->success( 'Controller ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function generateMethods( $class )
	{
		if ( $this->construct ) {
			$this->createMethod( $class );
		}

		if ( $this->resource ) {
			$this->createMethod( $class, 'index' );
			$this->createMethod( $class, 'single' );
		}
	}

}

<?php
/**
 * Create controller
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WPEmerge\Middleware\HasControllerMiddlewareTrait;
use WPEmerge\Middleware\HasControllerMiddlewareInterface;

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
				InputArgument::OPTIONAL,
				'Controller name',
			)
			->addOption(
				'construct',
				'c',
				InputOption::VALUE_NONE,
				'Add construct method',
			)
			->addOption(
				'middleware',
				'm',
				InputOption::VALUE_NONE,
				'Add middleware',
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
		$name = $input->getArgument( 'controller' );

		$options = [ 'resource', 'construct', 'middleware' ];
		foreach ( $options as $option ) {
			$this->$option = $input->getOption( $option );
		}

		$name = $this->askName( $name, 'Controller name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme controller\n",
		);

		$class = $this->generateClassCap();

		$this->generateMethods( $class );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Controller ' . $name . ' was successfully created' );
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

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$class = $namespace->addClass( $this->className );

		/**
		 * @since 1.7.0
		 */
		if ( $this->middleware ) {
			$namespace->addUse( HasControllerMiddlewareInterface::class );
			$namespace->addUse( HasControllerMiddlewareTrait::class );

			$class->addImplement( HasControllerMiddlewareInterface::class );
			$class->addTrait( HasControllerMiddlewareTrait::class );

			$this->createMethod( $class, '__construct', "\$this->middleware( 'mymiddleware' );" );
		}

		return $class;
	}

}

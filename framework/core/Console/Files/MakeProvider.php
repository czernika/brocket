<?php
/**
 * Create provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class MakeProvider extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:provider';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Providers';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Providers';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'provider',
				InputArgument::OPTIONAL,
				'Provider name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'provider' );

		$name = $this->askName( $name, 'Provider name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme service provider\n",
			"! Register this class inside `config/wpemerge.php` file to have effect\n",
		);

		$class = $this->generateClassCap();

		$this->createProviderMethod( $class, 'register' );
		$this->createProviderMethod( $class, 'bootstrap' );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Provider ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( ServiceProviderInterface::class );

		$class = $namespace->addClass( $this->className );
		$class->addImplement( ServiceProviderInterface::class );

		return $class;
	}

	private function createProviderMethod( $class, string $method )
	{
		$method = $this->createMethod(
			$class,
			$method,
		);

		$method->addParameter( 'container' );
	}

}

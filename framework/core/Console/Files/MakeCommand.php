<?php
/**
 * Create provider
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.10.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Illuminate\Support\Str;
use Brocooly\Console\SymfonyStyleTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:command';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Commands';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Commands';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'console_command',
				InputArgument::OPTIONAL,
				'Command name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'console_command' );

		$name = $this->askName( $name, 'Command name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme command\n",
		);

		$class = $this->generateClassCap();

		$this->generateExecMethod( $class );
		$this->generateConfigureMethod( $class );
		$this->generateDefaultNameProperty( $class, $name );

		$class->addProperty( 'defaultName', Str::snake( $name ) )
			->setProtected()
			->setStatic()
			->addComment( "Name of the command\n" )
			->addComment( '@var string' );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Console command ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Command::class );
		$namespace->addUse( InputInterface::class );
		$namespace->addUse( OutputInterface::class );
		$namespace->addUse( SymfonyStyleTrait::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( Command::class );
		$class->addTrait( SymfonyStyleTrait ::class );

		return $class;
	}

	private function generateExecMethod( $class )
	{
		$exec = $this->createMethod( $class, 'execute' );
		$exec
			->setProtected()
			->setReturnType('int');

		$exec
			->addParameter( 'input' )
			->setType( InputInterface::class );

		$exec
			->addParameter( 'output' )
			->setType( OutputInterface::class );
	}

	private function generateConfigureMethod( $class )
	{
		$config = $this->createMethod( $class, 'configure' );
		$config
			->setProtected()
			->setReturnType('void');
	}

	private function generateDefaultNameProperty( $class, $name )
	{
		$class->addProperty( 'defaultName', Str::snake( $name ) )
			->setProtected()
			->setStatic()
			->addComment( "Name of the command\n" )
			->addComment( '@var string' );
	}

}

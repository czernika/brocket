<?php
/**
 * Create mailable instance
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Brocooly\Mail\Mailable;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMail extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:mail';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Mail';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Mail';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'mail',
				InputArgument::OPTIONAL,
				'Mailable name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'mail' );

		$name = $this->askName( $name, 'Mailable name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme mailable\n",
		);

		$class = $this->generateClassCap();

		$this->createMethod( $class );
		$this->createMethod( $class, 'build' );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Mailable ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Mailable::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( Mailable::class );

		return $class;
	}

}

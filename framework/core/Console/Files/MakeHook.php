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

use Brocooly\Hooks\Hookable;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeHook extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:hook';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Hooks';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Hooks';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'hook',
				InputArgument::OPTIONAL,
				'Hook name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'hook' );

		$name = $this->askName( $name, 'Hook name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme hook\n",
		);

		$class = $this->generateClassCap();

		$this->createMethod( $class, 'init' );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Hook ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Hookable::class );

		$class = $namespace->addClass( $this->className );
		$class->addImplement( Hookable::class );

		return $class;
	}

}

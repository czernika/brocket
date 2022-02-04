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

use WPEmerge\Requests\RequestInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMiddleware extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:middleware';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\Http\Middleware';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'Http/Middleware';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'middleware',
				InputArgument::OPTIONAL,
				'Middleware name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'middleware' );

		$name = $this->askName( $name, 'Mailable name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme middleware\n",
			"! Register this class inside `config/wpemerge.php` file to have effect\n",
		);

		$class = $this->generateClassCap();

		$this->createHandleMethod( $class, 'handle' );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Middleware ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( RequestInterface::class );

		$class = $namespace->addClass( $this->className );

		return $class;
	}

	private function createHandleMethod( $class, string $method )
	{
		$method = $this->createMethod(
			$class,
			$method,
"//...
return \$next( \$request );
"
		);

		$request = $method->addParameter( 'request' );
		$request->setType( RequestInterface::class );
		$method->addParameter( 'next' );
	}

}

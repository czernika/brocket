<?php
/**
 * Create theme template
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.9.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeTemplate extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:ui:template';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme\UI\Templates';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = 'UI/Templates';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'template',
				InputArgument::OPTIONAL,
				'Template name',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'template' );
		$name = $this->askName( $name, 'Template name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . " - custom theme template\n",
			"! Register this class within model's `\$templates` property\n",
		);

		$class = $this->generateClassCap();

		$this->createSlugConstant( $class );
		$this->createLabelMethod( $class );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Template ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function createSlugConstant( $class )
	{
		$slugConstant = $class->addConstant( 'SLUG', $this->snakeCaseClassName );
		$slugConstant->addComment( "Template slug\n" )
						->addComment( '@var string|array' );
	}

	private function createLabelMethod( $class )
	{
		$templateLabel = Str::headline( $this->className );
		$templateMethod = $this->createMethod(
			$class,
			'label',
"return __( '$templateLabel', 'brocooly' );"
		);
		$templateMethod
			->addComment( "Template label\n" )
			->addComment( '@return string' )
			->setReturnType( 'string' );
	}

}

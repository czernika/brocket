<?php
/**
 * Create customizer panel
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCustomizerPanel extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:customizer:panel';

	/**
	 * @inheritDoc
	 */
	protected string $rootNamespace = 'Theme\Customizer\Panels';

	/**
	 * @inheritDoc
	 */
	protected string $themeFileFolder = 'Customizer/Panels';

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this->addArgument(
			'panel',
			InputArgument::OPTIONAL,
			'Customizer panel name',
		);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'panel' );

		$name = $this->askName( $name, 'Customizer panel name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . ' - custom customizer panel',
			"! Register this class inside `config/customizer.php` file to have effect\n",
			'@see https://kirki.org/docs/setup/panels-sections/',
		);

		$class = $this->generateClassCap();

		$this->createPanelIdConstant( $class );
		$this->createArgsMethod( $class );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Customizer panel ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function createArgsMethod( $class )
	{
		$panelName = Str::headline( $this->className );
		$method    = $this->createMethod(
			$class,
			'args',
"return esc_html__( '{$panelName}', 'brocooly' );"
		);

		$method
			->addComment( "Panel settings\n" )
			->addComment( 'Create panel for customizer sections' )
			->addComment( "Same array as arguments for `\Kirki\Panel()` class or string if only title required\n" )
			->addComment( '@return array|string' )
			->setReturnType( 'array|string' );
	}

	private function createPanelIdConstant( $class )
	{
		$constant = $class->addConstant( 'PANEL_ID', $this->snakeCaseClassName );
		$constant->addComment( 'Panel id' )
						->addComment( "Same as `id` setting for `\Kirki\Panel()` class\n" )
						->addComment( '@var string' );
	}

}

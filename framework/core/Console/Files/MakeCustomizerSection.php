<?php
/**
 * Create customizer section
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Illuminate\Support\Str;
use Brocooly\Support\Facades\Mod;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCustomizerSection extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:customizer:section';

	/**
	 * @inheritDoc
	 */
	protected string $rootNamespace = 'Theme\Customizer\Sections';

	/**
	 * @inheritDoc
	 */
	protected string $themeFileFolder = 'Customizer/Sections';

	/**
	 * Section name
	 *
	 * @var string
	 */
	private string $sectionName = '';

	/**
	 * Panel name
	 *
	 * @var string|null
	 */
	private ?string $panel = null;

	/**
	 * Panel name in human-readable format
	 *
	 * @var string|null
	 */
	private ?string $panelName = null;

	/**
	 * Panel namespace
	 *
	 * @var string|null
	 */
	private ?string $panelNamespace = null;

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'section',
				InputArgument::OPTIONAL,
				'Customizer section name',
			)
			->addOption(
				'panel',
				null,
				InputOption::VALUE_REQUIRED,
				'Set panel class as section\'s parent. Pass relative class name to Theme\\Customizer\\Panels',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name        = $input->getArgument( 'section' );
		$this->panel = $input->getOption( 'panel' );

		$name = $this->askName( $name, 'Customizer section name' );

		$this->defineDataByArgument( $name );
		$this->sectionName = Str::headline( $this->className );

		if ( $this->panel ) {
			$this->panelName      = Str::afterLast( $this->panel, '/' );
			$this->panelNamespace = 'Theme\\Customizer\\Panels\\' . Str::replace( '/', '\\', $this->panel );
		}

		$this->generateClassComments(
			$this->className . ' - custom customizer section',
			"! Register this class inside `config/customizer.php` file to have effect\n",
			'@see https://kirki.org/docs/setup/panels-sections/',
		);

		$class = $this->generateClassCap();

		$this->createSectionIdConstant( $class );
		$this->createArgsMethod( $class );
		$this->createFieldsMethod( $class );

		if ( $this->panel && ! class_exists( $this->panelNamespace ) ) {
			$this->io->warning( 'Model class ' . $this->panelNamespace . ' doesn\'t exists' );
		}

		$this->createFile( $this->file );

		$this->io->success( 'Customizer section ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function createArgsMethodContent()
	{
		if ( ! $this->panel ) {
			return "return esc_html__( '{$this->sectionName}', 'brocooly' );";
		}

		return "return [
	'title' => esc_html__( '{$this->sectionName}', 'brocooly' ),
	'panel' => {$this->panelName}::PANEL_ID,
];";
	}

	private function createArgsMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'args', $this->createArgsMethodContent() );

		$optionsMethod
			->addComment( "Section settings\n" )
			->addComment( "Same array as arguments for `\Kirki\Section()` class or string if only title required\n" )
			->addComment( '@return array|string' )
			->setReturnType( 'array|string' );
	}

	private function createFieldsMethodContent()
	{
		return "return [
	// Mod::text( 'example_setting', esc_html__( 'Example setting', 'brocooly' ) ),
];";
	}

	private function createFieldsMethod( $class )
	{
		$controlsMethod = $this->createMethod( $class, 'fields', $this->createFieldsMethodContent() );

		$controlsMethod
			->addComment( "Section controls\n" )
			->addComment( '@see https://kirki.org/docs/controls/' )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createSectionIdConstant( $class )
	{
		$sectionConstant = $class->addConstant( 'SECTION_ID', $this->snakeCaseClassName );
		$sectionConstant->addComment( 'Section id' )
						->addComment( "Same as `id` setting for `\Kirki\Section()` class\n" )
						->addComment( '@var string' );
	}

	/**
	 * @return object
	 */
	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Mod::class );

		if ( $this->panel ) {
			$namespace->addUse( 'Theme\\Customizer\\Panels\\' . Str::replace( '/', '\\', $this->panel ) );
		}

		$class = $namespace->addClass( $this->className );

		return $class;
	}

}

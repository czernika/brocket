<?php
/**
 * Create post type
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Brocooly\UI\Menu;
use Illuminate\Support\Str;
use Brocooly\Support\Traits\HasMetaboxes;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMenu extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:ui:menu';

	/**
	 * @inheritDoc
	 */
	protected string $rootNamespace = 'Theme\UI\Menus';

	/**
	 * @inheritDoc
	 */
	protected string $themeFileFolder = 'UI/Menus';

	/**
	 * Define if this model has metaboxes
	 *
	 * @var boolean
	 */
	private $meta = false;

	/**
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this
			->addArgument(
				'menu',
				InputArgument::OPTIONAL,
				'Menu name',
			)
			->addOption(
				'meta',
				'm',
				InputOption::VALUE_NONE,
				'Does this menu has metaboxes or not?',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name       = $input->getArgument( 'menu' );
		$this->meta = $input->getOption( 'meta' );

		$name = $this->askName( $name, 'Menu name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . ' - custom navigation menu',
			"! Register this class inside `config/models.php` file to have effect\n",
		);

		$class = $this->generateClassCap();

		$this->createLocationConstant( $class );
		$this->createLabelMethod( $class );

		/**
		 * @since 1.4.1
		 */
		if ( $this->meta ) {
			$this->createMethod( $class, 'metaboxes' );
		}

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$this->io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$this->io->success( 'Custom navigation menu ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function createLabelMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'label', $this->createLabelMethodContent() );

		$optionsMethod
			->setPublic()
			->addComment( "Menu label\n" )
			->addComment( '@return string' )
			->setReturnType( 'string' );
	}

	private function createLabelMethodContent()
	{
		$location = Str::headline( $this->className );
		return "return esc_html__( '{$location}', 'brocooly' );";
	}

	private function createLocationConstant( $class )
	{
		$postTypeConstant = $class->addConstant( 'LOCATION', $this->snakeCaseClassName );
		$postTypeConstant->addComment( "Menu location slug\n" )
						->addComment( '@var string' );
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Menu::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( Menu::class );

		if ( $this->meta ) {
			$class->addTrait( HasMetaboxes::class );
			$namespace->addUse( HasMetaboxes::class );
		}

		return $class;
	}

}

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

use Illuminate\Support\Str;
use Brocooly\Models\PostType;
use Brocooly\Support\Traits\HasMetaboxes;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Brocooly\Support\Traits\Registerable;

class MakeModelPostType extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:model:post_type';

	/**
	 * @inheritDoc
	 */
	protected string $rootNamespace = 'Theme\Models';

	/**
	 * @inheritDoc
	 */
	protected string $themeFileFolder = 'Models';

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
				'post_type',
				InputArgument::OPTIONAL,
				'Create custom post type',
			)
			->addOption(
				'meta',
				'm',
				InputOption::VALUE_NONE,
				'Does this post type has metaboxes or not?',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name       = $input->getArgument( 'post_type' );
		$this->meta = $input->getOption( 'meta' );

		$name = $this->askName( $name, 'Post type name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . ' - custom post type',
			"! Register this class inside `config/models.php` file to have effect\n",
			"! It is recommended to flush permalinks\n",
		);

		$class = $this->generateClassCap();

		$this->createPostTypeConstant( $class );

		$this->createArgsMethod( $class );
		$this->createLabelsMethod( $class );
		$this->createNamesMethod( $class );

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

		$this->io->success( 'Custom post type ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	private function createArgsMethodContent()
	{
		$postTypeLabel = Str::headline( $this->className );

		return "return [
	'public'              => true,
	'exclude_from_search' => false,
	'show_in_rest'        => false,
	'menu_icon'           => null,
	'menu_position'       => 10,
	'supports'            => [ 'title', 'editor' ],
	'enter_title_here'    => esc_html__( 'New {$postTypeLabel} title', 'brocooly' ),
	// 'admin_cols'       => [],
	// 'admin_filters'    => [],
];";
	}

	private function createLabelsMethodContent()
	{
		$postTypeLabel       = Str::headline( $this->className );
		$pluralPostTypeLabel = Str::plural( $postTypeLabel );

		return "return [
	'name'           => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'all_items'      => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'singular_name'  => esc_html__( '{$postTypeLabel}', 'brocooly' ),
	'name_admin_bar' => esc_html__( '{$postTypeLabel}', 'brocooly' ),
	'menu_name'      => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'add_new'        => esc_html__( 'Add {$postTypeLabel}', 'brocooly' ),
	'new_item'       => esc_html__( 'New {$postTypeLabel}', 'brocooly' ),
	'add_new_item'   => esc_html__( 'Add new {$postTypeLabel}', 'brocooly' ),
	'search_items'   => esc_html__( 'Find {$postTypeLabel}', 'brocooly' ),
	'edit_item'      => esc_html__( 'Edit {$postTypeLabel}', 'brocooly' ),
	'view_item'      => esc_html__( 'View {$postTypeLabel}', 'brocooly' ),
];";
	}

	private function createNamesMethodContent()
	{
		$postTypeLabel       = Str::headline( $this->className );
		$pluralPostTypeLabel = Str::plural( $postTypeLabel );

		return "return [
	'singular' => esc_html__( '{$postTypeLabel}', 'brocooly' ),
	'plural'   => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'slug'     => static::POST_TYPE,
];";
	}

	private function createArgsMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'args', $this->createArgsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Post type register options' )
			->addComment( "Same as for `register_extended_post_type()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createLabelsMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'labels', $this->createLabelsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Post type labels' )
			->addComment( "Same as `labels` key within arguments\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createNamesMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'names', $this->createNamesMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Post type names' )
			->addComment( "Same as `names` array for `register_extended_post_type()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createPostTypeConstant( $class )
	{
		$postTypeConstant = $class->addConstant( 'POST_TYPE', $this->snakeCaseClassName );
		$postTypeConstant->addComment( "Post type slug\n" )
						->addComment( '@var string' );
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( PostType::class );
		$namespace->addUse( Registerable::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( PostType::class );
		$class->addTrait( Registerable::class );

		if ( $this->meta ) {
			$class->addTrait( HasMetaboxes::class );
			$namespace->addUse( HasMetaboxes::class );
		}

		return $class;
	}

}

<?php
/**
 * Create taxonomy
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Theme\Models\WP\Post;
use Illuminate\Support\Str;
use Brocooly\Models\Taxonomy;
use Nette\PhpGenerator\Literal;
use Brocooly\Support\Traits\HasMetaboxes;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Brocooly\Support\Traits\Registerable;

class MakeModelTaxonomy extends CreateClassCommand
{
	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'new:model:taxonomy';

	/**
	 * @inheritDoc
	 */
	protected string $rootNamespace = 'Theme\Models';

	/**
	 * @inheritDoc
	 */
	protected string $themeFileFolder = 'Models';

	/**
	 * Post types attached to taxonomy
	 *
	 * @var string|array
	 */
	private string|array $postTypes;

	/**
	 * Post type name defined by user
	 *
	 * @var string|null
	 */
	private ?string $postType = null;

	/**
	 * Post type class name defined by user
	 *
	 * @var string|null
	 */
	private ?string $postTypeClassName = null;

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
				'taxonomy',
				InputArgument::OPTIONAL,
				'Create custom taxonomy',
			)
			->addOption(
				'meta',
				'm',
				InputOption::VALUE_NONE,
				'Does this taxonomy has metaboxes or not?',
			)
			->addOption(
				'post_type',
				'p',
				InputOption::VALUE_OPTIONAL,
				'Link to post type',
			);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) : int
	{
		$name = $input->getArgument( 'taxonomy' );

		$this->postType = $input->getOption( 'post_type' );
		$this->meta     = $input->getOption( 'meta' );

		$name = $this->askName( $name, 'Taxonomy name' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			$this->className . ' - custom taxonomy',
			"! Register this class inside `config/wpemerge.php` file to have effect\n",
			"! It is recommended to flush permalinks\n",
		);

		$class = $this->generateClassCap();

		if ( $this->postTypeClassName && ! class_exists( $this->postTypeClassName ) ) {
			$this->io->warning( 'Model class ' . $this->postTypeClassName . ' doesn\'t exists' );
		}

		$this->createTaxonomyConstant( $class );

		$this->createArgsMethod( $class );
		$this->createLabelsMethod( $class );
		$this->createNamesMethod( $class );

		$this->createPostTypesProperty( $class );

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

		$this->io->success( 'Custom taxonomy ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap()
	{
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Taxonomy::class );
		$namespace->addUse( Registerable::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( Taxonomy::class );
		$class->addTrait( Registerable::class );

		if ( null === $this->postType ) {
			$this->postTypes = [ new Literal( 'Post::POST_TYPE' ) ];
			$namespace->addUse( Post::class );
		} else {
			$postTypeSlug            = Str::of( $this->postType )->after( '/' ) . '::POST_TYPE';
			$this->postTypes         = [ new Literal( $postTypeSlug ) ];
			$this->postTypeClassName = 'Theme\Models\\' . Str::replace( '/', '\\', $this->postType );
			$namespace->addUse( $this->postTypeClassName );
		}

		if ( $this->meta ) {
			$class->addTrait( HasMetaboxes::class );
			$namespace->addUse( HasMetaboxes::class );
		}

		return $class;
	}

	private function createPostTypesProperty( $class )
	{
		$class->addProperty( 'postTypes', $this->postTypes )
			->setProtected()
			->setType( 'array|string' )
			->addComment( 'Post type related to this taxonomy' )
			->addComment( "Same as for `register_extended_taxonomy()`\n" )
			->addComment( '@var array|string' );
	}

	private function createArgsMethodContent()
	{
		return "return [
	'public'            => true,
	'show_in_menu'      => true,
	'show_ui'           => true,
	'hierarchical'      => true, // false for tags.
	'show_in_rest'      => false,
	'show_admin_column' => true,
	// 'meta_box'       => 'radio', // Use radio buttons in the meta box for this taxonomy on the post editing screen.
	// 'admin_cols'     => [],
];";
	}

	private function createLabelsMethodContent()
	{
		$taxonomyLabel       = Str::headline( $this->className );
		$pluralTaxonomyLabel = Str::plural( $taxonomyLabel );

		return "return [
	'name'              => esc_html__( '{$pluralTaxonomyLabel}', 'brocooly' ),
	'all_items'         => esc_html__( 'All {$pluralTaxonomyLabel}', 'brocooly' ),
	'singular_name'     => esc_html__( '{$taxonomyLabel}', 'brocooly' ),
	'menu_name'         => esc_html__( '{$taxonomyLabel}', 'brocooly' ),
	'parent_item'       => esc_html__( 'Parent {$taxonomyLabel}', 'brocooly' ),
	'parent_item_colon' => esc_html__( 'Parent {$taxonomyLabel}', 'brocooly' ),
	'search_items'      => esc_html__( 'Find {$taxonomyLabel}', 'brocooly' ),
	'add_new_item'      => esc_html__( 'Add {$taxonomyLabel}', 'brocooly' ),
	'add_new'           => esc_html__( 'Add new {$taxonomyLabel}', 'brocooly' ),
];";
	}

	private function createNamesMethodContent()
	{
		$postTypeLabel       = Str::headline( $this->className );
		$pluralPostTypeLabel = Str::plural( $postTypeLabel );

		return "return [
	'singular' => esc_html__( '{$postTypeLabel}', 'brocooly' ),
	'plural'   => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'slug'     => static::TAXONOMY,
];";
	}

	private function createArgsMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'args', $this->createArgsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomy options' )
			->addComment( "Same as for `register_extended_taxonomy()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createLabelsMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'labels', $this->createLabelsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomy labels' )
			->addComment( "Same as `labels` key within arguments\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createNamesMethod( $class )
	{
		$optionsMethod = $this->createMethod( $class, 'names', $this->createNamesMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomy names' )
			->addComment( "Same as `names` array for `register_extended_taxonomy()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createTaxonomyConstant( $class )
	{
		$taxonomyConstant = $class->addConstant( 'TAXONOMY', $this->snakeCaseClassName );
		$taxonomyConstant->addComment( "Taxonomy slug\n" )
						->addComment( '@var string' );
	}
}

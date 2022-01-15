<?php
/**
 * Create taxonomy
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console;

use Theme\Models\WP\Post;
use Illuminate\Support\Str;
use Brocooly\Models\Taxonomy;
use Nette\PhpGenerator\Literal;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Brocooly\Support\Traits\RequiresRegistrationTrait;

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
	 * @var array
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
	 * @inheritDoc
	 */
	protected function configure(): void
	{
		$this->addArgument(
				'taxonomy',
				InputArgument::REQUIRED,
				'Create custom taxonomy',
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
		$io = new SymfonyStyle( $input, $output );

		$name = $input->getArgument( 'taxonomy' );

		$this->postType = $input->getOption( 'post_type' );

		$this->defineDataByArgument( $name );

		$this->generateClassComments(
			[
				$this->className . ' - custom taxonomy',
				"! Register this class inside `config/wpemerge.php` file to have effect\n",
				"! It is recommended to flush permalinks\n",
			]
		);

		$class = $this->generateClassCap();

		if ( $this->postTypeClassName && ! class_exists( $this->postTypeClassName ) ) {
			$io->warning( 'Model class ' . $this->postTypeClassName . ' doesn\'t exists' );
		}

		$this->createTaxonomyConstant( $class );

		$this->createArgsMethod( $class );
		$this->createLabelsMethod( $class );
		$this->createNamesMethod( $class );

		$this->createPostTypesProperty( $class );

		$exists = $this->createFile( $this->file );
		if ( $exists ) {
			$io->warning( 'File ' . $exists . ' already exists' );
			return CreateClassCommand::FAILURE;
		}

		$io->success( 'Custom taxonomy ' . $name . ' was successfully created' );
		return CreateClassCommand::SUCCESS;
	}

	protected function generateClassCap() {
		$namespace = $this->file->addNamespace( $this->rootNamespace );
		$namespace->addUse( Taxonomy::class );
		$namespace->addUse( RequiresRegistrationTrait::class );

		$class = $namespace->addClass( $this->className );
		$class->addExtend( Taxonomy::class );
		$class->addTrait( RequiresRegistrationTrait::class );

		if ( null === $this->postType ) {
			$this->postTypes = [ new Literal( 'Post::POST_TYPE' ) ];
			$namespace->addUse( Post::class );
		} else {
			$postTypeSlug            = Str::of( $this->postType )->after( '/' ) . '::POST_TYPE';
			$this->postTypes         = [ new Literal( $postTypeSlug ) ];
			$this->postTypeClassName = 'Theme\Models\\' . Str::replace( '/', '\\', $this->postType );
			$namespace->addUse( $this->postTypeClassName );
		}

		return $class;
	}

	private function createPostTypesProperty( $class ) {
		$class->addProperty( 'postTypes', $this->postTypes )
			->setProtected()
			->addComment( 'Post type related to this taxonomy' )
			->addComment( "Same as for `register_extended_taxonomy()`\n" )
			->addComment( '@var array|string' );
	}

	private function createArgsMethodContent() {
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

	private function createLabelsMethodContent() {
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

	private function createNamesMethodContent() {
		$postTypeLabel       = Str::headline( $this->className );
		$pluralPostTypeLabel = Str::plural( $postTypeLabel );

		return "return [
	'singular' => esc_html__( '{$postTypeLabel}', 'brocooly' ),
	'plural'   => esc_html__( '{$pluralPostTypeLabel}', 'brocooly' ),
	'slug'     => static::TAXONOMY,
];";
	}

	private function createArgsMethod( $class ) {
		$optionsMethod = $this->createMethod( $class, 'args', $this->createArgsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomyregister options' )
			->addComment( "Same as for `register_extended_taxonomy()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createLabelsMethod( $class ) {
		$optionsMethod = $this->createMethod( $class, 'labels', $this->createLabelsMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomy labels' )
			->addComment( "Same as `labels` key within arguments\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createNamesMethod( $class ) {
		$optionsMethod = $this->createMethod( $class, 'names', $this->createNamesMethodContent() );

		$optionsMethod
			->setProtected()
			->addComment( 'Taxonomy names' )
			->addComment( "Same as `names` array for `register_extended_taxonomy()`\n" )
			->addComment( '@return array' )
			->setReturnType( 'array' );
	}

	private function createTaxonomyConstant( $class ) {
		$taxonomyConstant = $class->addConstant( 'TAXONOMY', $this->snakeCaseClassName );
		$taxonomyConstant->addComment( "Taxonomy slug\n" )
						->addComment( '@var string' );
	}

	private function createWebUrlProperty( $class ) {
		$class->addProperty( 'webUrl', $this->snakeCaseClassName )
				->setType( 'string' )
				->setPublic()
				->addComment( 'Web URL' )
				->addComment( "Publicly accessible name\n" )
				->addComment( '@var string' );
	}


}

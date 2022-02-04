<?php
/**
 * Generate file
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Console\Files;

use Illuminate\Support\Str;
use Nette\PhpGenerator\PhpFile;
use Brocooly\Support\Facades\File;
use Brocooly\Console\SymfonyStyleTrait;
use Symfony\Component\Console\Command\Command;

class CreateClassCommand extends Command
{

	use SymfonyStyleTrait;

	/**
	 * Root path
	 *
	 * @var string
	 */
	protected string $root = BROCOOLY_THEME_PATH . '/src/';

	/**
	 * Generated class root namespace (its own namespace excluded)
	 *
	 * @var string
	 */
	protected string $rootNamespace = 'Theme';

	/**
	 * Under which path will be created file
	 *
	 * @var string
	 */
	protected string $themeFileFolder = '';

	/**
	 * Extra path to a themeFileFolder defined by user input
	 *
	 * @var string
	 */
	protected string $folderPath = '';

	/**
	 * Class name (no namespace)
	 *
	 * @var string
	 */
	protected string $className = '';

	/**
	 * Class name in snake_case format
	 *
	 * @var string
	 */
	protected string $snakeCaseClassName = '';

	/**
	 * File instance
	 *
	 * @var PhpFile|null
	 */
	public $file = null;

	public function __construct() {
		$this->file = new PhpFile();

		parent::__construct();
	}

	/**
	 * Allow execution in production mode or not
	 *
	 * @return boolean
	 */
	public function notAllowedInProduction() : bool
	{
		return false;
	}

	/**
	 * Define main class data by passed argument
	 *
	 * @param string $argument | passed argument name
	 * @return void
	 */
	protected function defineDataByArgument( string $argument )
	{
		$namespaces               = explode( '/', $argument );
		$origin                   = count( $namespaces );
		$this->className          = Str::afterLast( $argument, '/' );
		$this->snakeCaseClassName = Str::snake( $this->className );

		if ( $origin > 1 ) {
			unset( $namespaces[ $origin - 1 ] );
			$this->rootNamespace .= '\\' . implode( '\\', $namespaces );
			$this->folderPath    .= '/' . implode( '/', $namespaces );
		}
	}

	/**
	 * Add comments to a class file
	 *
	 * @param array $comments | comments to add.
	 * @return object
	 */
	protected function generateClassCap()
	{
		// Generate class namespace.
		$namespace = $this->file?->addNamespace( $this->rootNamespace );
		$class     = $namespace->addClass( $this->className );

		return $class;
	}

	/**
	 * Add comments to a class file
	 *
	 * @param $comments | comments to add.
	 * @return void
	 */
	protected function generateClassComments( ...$comments )
	{
		foreach ( $comments as $comment ) {
			$this->file?->addComment( $comment );
		}

		$this->file?->addComment( '@package Brocooly' );
		$this->file?->setStrictTypes();
	}

	/**
	 * Create class method
	 *
	 * @param object $class | PHP Nette class object.
	 * @param string $name | method name.
	 * @param string $body | method content (body).
	 * @return object
	 */
	protected function createMethod( $class, $name = '__construct', $body = '//...' )
	{
		$method = $class->addMethod( $name );
		$method->setBody( $body );
		return $method;
	}

	/**
	 * Generate file
	 *
	 * @param object $file | PHP Nette file object.
	 * @param string $ext | file extension.
	 * @return true
	 */
	protected function createFile( $file, string $ext = '.php' )
	{
		$folder = $this->root . $this->themeFileFolder . $this->folderPath;
		File::ensureDirectoryExists( $folder );

		$filename = $folder . '/' . $this->className . $ext;

		if ( File::exists( $filename ) ) {
			return $this->className . $ext;
		}

		File::put( $filename, $file );

		return false;
	}

	/**
	 * Ask Question if the name missed
	 *
	 * @param string|null $name
	 * @param string $question
	 * @return string
	 */
	protected function askName( ?string $name, string $question )
	{
		if ( null === $name ) {
			$name = $this->io->ask( $question );
		}

		return $name;
	}
}

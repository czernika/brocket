<?php
/**
 * Validate request
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.5.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Factories;

use Illuminate\Validation;
use Illuminate\Translation;
use Illuminate\Filesystem\Filesystem;

class ValidatorFactory
{

	/**
	 * Laravel validator object
	 *
	 * @var \Illuminate\Validation\Factory
	 */
	private \Illuminate\Validation\Factory $factory;

	/**
	 * Lang dir where all files are located
	 *
	 * @var string
	 */
	private string $langDir = BROCOOLY_THEME_LANG_PATH;

	/**
	 * Validator group
	 *
	 * @var string
	 */
	private string $group = 'validation';

	/**
	 * Validator namespace
	 *
	 * @var string
	 */
	private string $namespace = 'lang';

	/**
	 * Translation locale
	 *
	 * @var string
	 */
	private string $locale = 'en_US';

    public function __construct()
    {
		$this->langDir = BROCOOLY_THEME_LANG_PATH . DIRECTORY_SEPARATOR . $this->group;
		$this->locale  = config( 'app.locale', get_locale() );

        $this->factory = new Validation\Factory(
            $this->loadTranslator()
        );
    }

	protected function loadTranslator()
    {
        $loader = new Translation\FileLoader(
			new Filesystem(),
			$this->langDir,
		);
		$loader->addNamespace( $this->namespace, $this->langDir );
		$loader->load( $this->locale, $this->group, $this->namespace );
		$factory = new Translation\Translator( $loader, $this->locale );

		return $factory;
    }

	public function __call( $method, $args )
    {
        return call_user_func_array( [ $this->factory, $method ], $args );
    }
}

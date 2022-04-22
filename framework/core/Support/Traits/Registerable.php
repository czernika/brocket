<?php
/**
 * Used in models which requires to be registered
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Traits;

trait Registerable
{

	/**
	 * Register arguments
	 *
	 * @var array
	 */
	protected array $args = [];

	/**
	 * Register names
	 * such as Singular, Plural forms and slug
	 *
	 * @link https://github.com/johnbillion/extended-cpts
	 * @var array
	 */
	protected array $names = [];

	/**
	 * Labels argument
	 *
	 * @var array
	 */
	protected array $labels = [];

	/**
	 * Init registration params
	 *
	 * @return void
	 */
	public function register()
	{
		$this->args   = $this->args();
		$this->names  = $this->names();
		$this->labels = $this->labels();

		if ( ! empty( $this->labels ) ) {
			$this->args['labels'] = $this->labels;
		}
	}

	/**
	 * Get arguments
	 *
	 * @return void
	 */
	public function getArgs() : array
	{
		return $this->args;
	}

	/**
	 * Get names
	 *
	 * @return array
	 */
	public function getNames() : array
	{
		return $this->names;
	}

	/**
	 * Set names
	 *
	 * @return array
	 */
	protected function names() : array
	{
		return [];
	}

	/**
	 * Set labels
	 *
	 * @return array
	 */
	protected function labels() : array
	{
		return [];
	}

	/**
	 * Set arguments
	 *
	 * @return array
	 */
	protected function args() : array
	{
		return [];
	}
}

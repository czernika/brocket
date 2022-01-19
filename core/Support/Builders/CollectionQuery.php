<?php
/**
 * Collection query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait CollectionQuery
{
	/**
	 * Retrieve posts
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function collect()
	{
		$this->collection = collect( $this->getPosts() );
		return $this->collection;
	}

	/**
	 * Get any \Illuminate\Support\Collection method
	 *
	 * TODO add list of available methods
	 * @param string $method
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call( $method, $arguments )
	{
		return $this->collect()?->$method( ...$arguments );
	}
}

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
	 * Get first post
	 *
	 * @return object|null
	 */
	public function first()
	{
		return $this->collect()?->first();
	}

	/**
	 * Get last post
	 *
	 * @return object|null
	 */
	public function last()
	{
		return $this->collect()?->last();
	}
}

<?php

declare(strict_types=1);

namespace Brocooly\Support\Builders;

class QueryBuilder
{

	/**
	 * Query params
	 *
	 * @var array
	 */
	protected array $query = [];

	/**
	 * Posts per page
	 *
	 * @var integer
	 */
	protected int $postsPerPage = 10;

	/**
	 * Retrieved posts class map
	 *
	 * @var string
	 */
	protected string $classMap = 'Timber\Post';

	/**
	 * Posts collection
	 *
	 * @var \Illuminate\Support\Collection|null
	 */
	public \Illuminate\Support\Collection|null $collection = null;

	/**
	 * Set custom query
	 *
	 * @param array $query
	 * @return self
	 */
	public function query( array $query ) : self
	{
		$this->query = array_merge( $query, $this->query );
		return $this;
	}

	/**
	 * Retrieve all posts
	 *
	 * @return array|boolean|null
	 */
	public function all()
	{
		$this->query['posts_per_page'] = 500; // TODO make config for this option
		return $this->get();
	}

	/**
	 * Retrieve posts
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function collect()
	{
		$this->collection = collect( Timber::get_posts( $this->query, $this->classMap ) );
		return $this->collection;
	}

	/**
	 * Retrieve posts
	 *
	 * @return array
	 */
	public function get()
	{
		return $this->collect()?->toArray();
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

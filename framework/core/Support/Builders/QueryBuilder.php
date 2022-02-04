<?php
/**
 * Base query builder object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.1
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Timber;

class QueryBuilder
{

	use AuthorQuery, MetaQuery, ConditionalQuery, PaginationQuery, StatusQuery, DateQuery, SortQuery, SearchQuery, CollectionQuery;

	/**
	 * Query params
	 *
	 * @var array
	 */
	protected array $query = [];

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
	 * Get posts query
	 *
	 * @return array|boolean|null
	 */
	protected function getPosts()
	{
		return new \Timber\PostQuery( $this->query, $this->classMap );
	}

	/**
	 * Retrieve all posts
	 *
	 * @return array|boolean|null
	 */
	public function all()
	{
		$this->query['posts_per_page'] = config( 'query.limit', 300 );
		$this->query['nopaging']       = true;
		return $this->getPosts();
	}

	/**
	 * Retrieve posts
	 *
	 * @return array
	 */
	public function get()
	{
		return $this->getPosts();
	}

	/**
	 * Set custom query
	 *
	 * @param array $query
	 * @return self
	 */
	public function query( array $query ) : self
	{
		$this->query = wp_parse_args( $query, $this->query );
		return $this;
	}

	/**
	 * Add given posts into query
	 *
	 * @param array $postsIn
	 * @return self
	 */
	public function with( array $postsIn ) : self
	{
		$this->query['post__in'] = $postsIn;
		return $this;
	}

	/**
	 * Get posts except given
	 *
	 * @param array $postsIn
	 * @return self
	 */
	public function except( array $postsIn ) : self
	{
		$this->query['post__not_in'] = $postsIn;
		return $this;
	}

	/**
	 * Get posts except current object
	 *
	 * @return self
	 */
	public function exceptCurrent() : self
	{
		return $this->except( [ get_queried_object_id() ] );
	}
}

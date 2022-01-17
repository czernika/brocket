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

	public function __construct( string $classMap )
	{
		$this->classMap = $classMap;
		$this->query    = config( 'query.defaults' ) ?? [];
	}

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
	 * Set posts per page param
	 *
	 * @param integer|null $postsPerPage
	 * @return self
	 */
	public function paginate( ?int $postsPerPage = null ) : self
	{
		if ( $postsPerPage ) {
			$this->query['posts_per_page'] = $postsPerPage;
		}
		return $this;
	}

	/**
	 * Set any single query param
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function where( string $key, $value ) : self
	{
		$this->query[ $key ] = $value;
		return $this;
	}

	/**
	 * Get posts with special statuses
	 *
	 * @param string|array $status
	 * @return self
	 */
	public function withStatus( string|array $status ) : self
	{
		$this->query['post_status'] = $status;
		return $this;
	}

	/**
	 * Get all posts with drafts
	 *
	 * @return self
	 */
	public function withDrafts() : self
	{
		$this->query['post_status'] = array_merge( $this->query['post_status'], [ 'draft' ] );
		return $this;
	}

	/**
	 * Get all posts with trashed
	 *
	 * @return self
	 */
	public function withTrashed() : self
	{
		$this->query['post_status'] = array_merge( $this->query['post_status'], [ 'trash' ] );
		return $this;
	}

	/**
	 * Retrieve all posts
	 *
	 * @return array|boolean|null
	 */
	public function all()
	{
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

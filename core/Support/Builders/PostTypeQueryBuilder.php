<?php
/**
 * PostType query builder object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Post;
use Timber\Timber;

class PostTypeQueryBuilder
{

	/**
	 * Query params
	 *
	 * @var array
	 */
	protected array $query = [];

	/**
	 * Post type name for the query
	 *
	 * @var string
	 */
	protected string $postType = 'post';

	/**
	 * Retrieved posts class map
	 *
	 * @var string
	 */
	protected string $classMap = 'Timber\Post';

	/**
	 * Posts per page
	 *
	 * @var integer
	 */
	protected int $postsPerPage = 10;

	public function __construct( string $postType, string $classMap )
	{
		$this->postType     = $postType;
		$this->classMap     = $classMap;
		$this->postsPerPage = 10; // TODO add config option.

		$this->setQuery();
	}

	/**
	 * Set basic query params
	 *
	 * @return void
	 */
	protected function setQuery() : void
	{
		$this->query['post_type']      = $this->postType;
		$this->query['posts_per_page'] = $this->postsPerPage;
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
			$this->postsPerPage = $postsPerPage;
		}
		$this->query['posts_per_page'] = $this->postsPerPage;
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
	 * Retrieve all posts
	 *
	 * @return array|boolean|null
	 */
	public function all() : array|bool|null
	{
		$this->query['posts_per_page'] = 500; // TODO make config for this option
		return $this->get();
	}

	/**
	 * Retrieve posts
	 *
	 * @return array|boolean|null
	 */
	public function get() : array|bool|null
	{
		return Timber::get_posts( $this->query, $this->classMap );
	}

	/**
	 * Get single post
	 *
	 * @param mixed $query
	 * @return Post|boolean
	 */
	protected function getPost( $query = false ) : Post|bool
	{
		return Timber::get_post( $query, $this->classMap );
	}

	/**
	 * Get first post
	 *
	 * @return Post|boolean
	 */
	public function first() : Post|bool
	{
		$collection = $this->get();
		return head( $collection );
	}

	/**
	 * Get last post
	 *
	 * @return Post|boolean
	 */
	public function last() : Post|bool
	{
		$collection = $this->get();
		return end( $collection );
	}

	/**
	 * Get current post object
	 *
	 * @return Post|boolean
	 */
	public function current() : Post|bool
	{
		return $this->getPost( get_queried_object_id() );
	}

	/**
	 * Get post by id
	 *
	 * @param integer $id
	 * @return Post|boolean
	 */
	public function id( int $id ) : Post|bool
	{
		return $this->getPost( $id );
	}
}

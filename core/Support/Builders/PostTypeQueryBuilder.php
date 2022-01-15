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

class PostTypeQueryBuilder extends QueryBuilder
{

	/**
	 * Post type name for the query
	 *
	 * @var string
	 */
	protected string $postType = 'post';

	/**
	 * Posts collection
	 */
	public $collection;

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
		$this->query['post_status']    = [ 'publish' ];
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
	 * Get single post
	 *
	 * @param int $id
	 * @return object|null
	 */
	protected function getPost( int $id )
	{
		$object = $this->classMap;
		$post   = get_post( $id );

		if ( $post ) {
			return new $object( $post );
		}

		return null;
	}

	/**
	 * Get current post object
	 *
	 * @return object|null
	 */
	public function current()
	{
		return $this->getPost( get_queried_object_id() );
	}

	/**
	 * Get post by id
	 *
	 * @param integer $id
	 * @return object|null
	 */
	public function id( int $id )
	{
		return $this->getPost( $id );
	}
}

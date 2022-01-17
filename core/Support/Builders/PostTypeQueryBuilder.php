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

class PostTypeQueryBuilder extends QueryBuilder
{

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

	public function __construct( string $postType, string $classMap )
	{
		$this->postType = $postType;

		parent::__construct( $classMap );

		$this->setQuery();
	}

	/**
	 * Set basic query params
	 *
	 * @return void
	 */
	protected function setQuery() : void
	{
		$this->query['post_type']   = $this->postType;
		$this->query['post_status'] = [ 'publish' ];
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

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

use Illuminate\Support\Str;

class PostTypeQueryBuilder extends QueryBuilder
{

	use PostQuery;

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
		$this->classMap = $classMap;
		$this->query    = config( 'query.defaults', [] );

		$this->setQuery();
	}

	/**
	 * Set basic query paramss
	 *
	 * @return void
	 */
	protected function setQuery() : void
	{
		$this->query['post_type']   = $this->postType;
		$this->query['post_status'] = [ 'publish' ];

		if ( property_exists( app( $this->postType ), 'postsPerPage' ) ) {
			$postType = app( $this->postType );
			$postType = new $postType();
			$this->query['posts_per_page'] = $postType->getPostsPerPage();
		}
	}


	public function scope( string $method, array $arguments )
	{
		$name = 'scope' . Str::ucfirst( $method );

		$postType = app( $this->postType );
		$postType = new $postType();

		/** @var \Timber\PostQuery */
		$query = $postType->$name( $this, ...$arguments );

		return $this->query( $query->query );
	}
}

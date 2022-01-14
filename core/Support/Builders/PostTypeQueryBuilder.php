<?php

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Post;
use Timber\Timber;

class PostTypeQueryBuilder
{

	protected array $query = [];

	protected string $postType = 'post';

	protected string $classMap = 'Timber\Post';

	protected int $postsPerPage = 10;

	public function __construct( string $postType, string $classMap )
	{
		$this->postType     = $postType;
		$this->classMap     = $classMap;
		$this->postsPerPage = 10; // TODO add config option.

		$this->setQuery();
	}

	protected function setQuery() : void
	{
		$this->query['post_type']      = $this->postType;
		$this->query['posts_per_page'] = $this->postsPerPage;
	}

	public function query( array $query ) : self
	{
		$this->query = array_merge( $query, $this->query );
		return $this;
	}

	public function paginate( ?int $postsPerPage = null ) : self
	{
		if ( $postsPerPage ) {
			$this->postsPerPage = $postsPerPage;
		}
		$this->query['posts_per_page'] = $this->postsPerPage;
		return $this;
	}

	public function where( string $key, $value ) : self
	{
		$this->query[ $key ] = $value;
		return $this;
	}

	public function all() : array|bool|null
	{
		return $this->get();
	}

	public function get() : array|bool|null
	{
		return Timber::get_posts( $this->query, $this->classMap );
	}

	protected function getPost( $query = false ) : Post|bool
	{
		return Timber::get_post( $query, $this->classMap );
	}

	public function first() : Post|bool
	{
		$collection = $this->get();
		return head( $collection );
	}

	public function last() : Post|bool
	{
		$collection = $this->get();
		return end( $collection );
	}

	public function current() : Post|bool
	{
		return $this->getPost();
	}

	public function id( int $id ) : Post|bool
	{
		return $this->getPost( $id );
	}
}

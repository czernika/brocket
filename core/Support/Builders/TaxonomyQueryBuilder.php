<?php

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Timber;

class TaxonomyQueryBuilder
{
	protected array $query = [];

	protected string $taxonomy = 'category';

	protected string $classMap = 'Timber\Post';

	protected int $postsPerPage = 10;

	public function __construct( string $taxonomy, string $classMap )
	{
		$this->taxonomy     = $taxonomy;
		$this->classMap     = $classMap;
		$this->postsPerPage = 10; // TODO add config option.

		$this->setQuery();
	}

	protected function setQuery() : void
	{
		$this->query['posts_per_page'] = $this->postsPerPage;
		$this->query['tax_query']      = [];
	}

	public function term( string $field, $terms, string $operator = 'IN' )
	{
		$taxQuery = [
			'taxonomy' => $this->taxonomy,
			'field'    => $field,
			'terms'    => $terms,
			'operator' => $operator,
		];
		array_push( $this->query['tax_query'], $taxQuery );
		return $this;
	}

	public function termId( $terms, string $operator = 'IN' )
	{
		$this->term( 'id', $terms, $operator );
		return $this;
	}

	public function termName( $terms, string $operator = 'IN' )
	{
		$this->term( 'name', $terms, $operator );
		return $this;
	}

	public function termSlug( $terms, string $operator = 'IN' )
	{
		$this->term( 'slug', $terms, $operator );
		return $this;
	}

	public function relation( string $relation = 'AND' )
	{
		$this->query['tax_query']['relation'] = $relation;
		return $this;
	}

	public function and()
	{
		$this->query['tax_query']['relation'] = 'AND';
		return $this;
	}

	public function or()
	{
		$this->query['tax_query']['relation'] = 'OR';
		return $this;
	}

	public function query( array $query )
	{
		$this->query['tax_query'] = $query;
		return $this;
	}

	public function get() : array|bool|null
	{
		return Timber::get_posts( $this->query, $this->classMap );
	}

	public function terms( $args = null, $maybe = [] ) : array|bool|null
	{
		return Timber::get_terms( $args, $maybe, $this->classMap );
	}
}

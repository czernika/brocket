<?php
/**
 * Taxonomy query builder object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

class TaxonomyQueryBuilder extends QueryBuilder
{

	/**
	 * Taxonomy name for the query
	 *
	 * @var string
	 */
	protected string $taxonomy = 'category';

	/**
	 * Retrieved posts class map
	 *
	 * @var string
	 */
	protected string $classMap = 'WP_Term';

	public function __construct( string $taxonomy, string $classMap )
	{
		$this->taxonomy     = $taxonomy;
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
		$this->query['posts_per_page'] = $this->postsPerPage;
		$this->query['tax_query']      = [];
	}

	/**
	 * Set term clause
	 *
	 * @param string $field
	 * @param string|array $terms
	 * @param string $operator
	 * @return self
	 */
	public function term( string $field, $terms, string $operator = 'IN' ) : self
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

	/**
	 * Set term clause by id
	 *
	 * @param string|array $terms
	 * @param string $operator
	 * @return self
	 */
	public function termId( $terms, string $operator = 'IN' ) : self
	{
		$this->term( 'id', $terms, $operator );
		return $this;
	}

	/**
	 * Set term clause by name
	 *
	 * @param string|array $terms
	 * @param string $operator
	 * @return self
	 */
	public function termName( $terms, string $operator = 'IN' ) : self
	{
		$this->term( 'name', $terms, $operator );
		return $this;
	}

	/**
	 * Set term clause by slug
	 *
	 * @param string|array $terms
	 * @param string $operator
	 * @return self
	 */
	public function termSlug( $terms, string $operator = 'IN' ) : self
	{
		$this->term( 'slug', $terms, $operator );
		return $this;
	}

	/**
	 * Set term clause relation
	 *
	 * @param string $relation
	 * @return self
	 */
	public function relation( string $relation = 'AND' ) : self
	{
		$this->query['tax_query']['relation'] = $relation;
		return $this;
	}

	/**
	 * Set `AND` term clause relation
	 *
	 * @return self
	 */
	public function and() : self
	{
		$this->query['tax_query']['relation'] = 'AND';
		return $this;
	}

	/**
	 * Set `OR` term clause relation
	 *
	 * @return self
	 */
	public function or() : self
	{
		$this->query['tax_query']['relation'] = 'OR';
		return $this;
	}

	/**
	 * Set any tax query
	 *
	 * @param array $query
	 * @return self
	 */
	public function taxQuery( array $query ) : self
	{
		$this->query['tax_query'] = $query;
		return $this;
	}
}

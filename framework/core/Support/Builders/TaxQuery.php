<?php
/**
 * Taxonomy query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait TaxQuery
{
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
	 * @since 1.4.2
	 * @param string $relation
	 * @return self
	 */
	public function taxRelation( string $relation = 'AND' ) : self
	{
		$this->query['tax_query']['relation'] = $relation;
		return $this;
	}

	/**
	 * Set `AND` term clause relation
	 *
	 * @since 1.4.2
	 * @return self
	 */
	public function andTax() : self
	{
		return $this->taxRelation( 'AND' );
	}

	/**
	 * Set `OR` term clause relation
	 *
	 * @since 1.4.2
	 * @return self
	 */
	public function orTax() : self
	{
		return $this->taxRelation( 'OR' );
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

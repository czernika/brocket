<?php
/**
 * Meta query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait MetaQuery
{

	/**
	 * Set meta query argument
	 *
	 * @param array $query
	 * @return self
	 */
	public function meta( array $query ) : self
	{
		$this->query['meta_query'][] = $query;
		return $this;
	}

	/**
	 * Set whole meta query
	 *
	 * @param array $metaQuery
	 * @return self
	 */
	public function metaQuery( array $metaQuery ) : self
	{
		$this->query['meta_query'] = $metaQuery;
		return $this;
	}

	/**
	 * Find posts by meta key and value
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function whereMeta( string $key, $value ) : self
	{
		$metaQuery   = [
			'meta_key'   => $key,
			'meta_value' => $value,
		];
		$this->query = wp_parse_args( $metaQuery, $this->query );
		return $this;
	}

	/**
	 * Find posts which has some meta key
	 * no matter value
	 *
	 * @param string $key
	 * @return self
	 */
	public function whereMetaKey( string $key ) : self
	{
		$this->query['meta_key'] = $key;
		return $this;
	}

	/**
	 * Find posts which has some meta value
	 * No matter key
	 *
	 * @param mixed $value
	 * @return self
	 */
	public function whereMetaValue( $value ) : self
	{
		$this->query['meta_value'] = $value;
		return $this;
	}

	/**
	 * Set meta clause relation
	 *
	 * @param string $relation
	 * @return self
	 */
	public function metaRelation( string $relation = 'AND' ) : self
	{
		$this->query['meta_query']['relation'] = $relation;
		return $this;
	}

	/**
	 * Set `AND` meta clause relation
	 *
	 * @return self
	 */
	public function andMeta() : self
	{
		return $this->metaRelation( 'AND' );
	}

	/**
	 * Set `OR` meta clause relation
	 *
	 * @return self
	 */
	public function orMeta() : self
	{
		return $this->metaRelation( 'OR' );
	}
}

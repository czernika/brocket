<?php
/**
 * Sort query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait SortQuery
{
	/**
	 * Sort query
	 *
	 * @param string $order | order type.
	 * @param string $orderby | order by.
	 * @return self
	 */
	public function sort( string $order, string $orderby )
	{
		$sortQuery   = [
			'order'   => $order,
			'orderby' => $orderby,
		];
		$this->query = wp_parse_args( $sortQuery, $this->query );

		return $this;
	}

	/**
	 * Set ascending order
	 *
	 * @param string $orderby | orderby key.
	 * @return self
	 */
	public function asc( string $orderby = 'ID' )
	{
		$sortQuery   = [ 'order' => 'ASC', 'orderby' => $orderby ];
		$this->query = wp_parse_args( $sortQuery, $this->query );

		return $this;
	}

	/**
	 * Set descending order
	 *
	 * @param string $orderby | orderby key.
	 * @return self
	 */
	public function desc( string $orderby = 'ID' )
	{
		$sortQuery   = [ 'order' => 'DESC', 'orderby' => $orderby ];
		$this->query = wp_parse_args( $sortQuery, $this->query );

		return $this;
	}

	/**
	 * Set sorting custom query
	 *
	 * @param string $orderby
	 * @return self
	 */
	public function orderBy( array $sortQuery )
	{
		$this->query['orderby'] = $sortQuery;
		return $this;
	}

}

<?php
/**
 * Date query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait DateQuery
{
	/**
	 * Date query AFTER date
	 *
	 * @param $date | date after.
	 * @return self
	 */
	public function after( $date )
	{
		$dateQuery  = [
			'date_query' => [
				'after' => $date,
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Date query BEFORE date
	 *
	 * @param $date | date before.
	 * @return self
	 */
	public function before( $date )
	{
		$dateQuery           = [
			'date_query' => [
				'before' => $date,
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Date query BETWEEN date
	 *
	 * @param $before | date before.
	 * @param $after | date after.
	 * @return self
	 */
	public function between( $after, $before )
	{
		$dateQuery  = [
			'date_query' => [
				[ 'before' => $before ],
				[ 'after'  => $after ],
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Custom date query
	 *
	 * @param $dateQuery
	 * @return self
	 */
	public function whereDate( $dateQuery )
	{
		$this->query = wp_parse_args( [ 'date_query' => $dateQuery ], $this->query );
		return $this;
	}

	/**
	 * Get posts for current day
	 *
	 * @return self
	 */
	public function daily()
	{
		$dateQuery  = [
			'date_query' => [
				[ 'year' => date( 'Y' ) ],
				[ 'day'  => date( 'z' ) ],
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Get posts for current week
	 *
	 * @return self
	 */
	public function weekly()
	{
		$dateQuery  = [
			'date_query' => [
				[ 'year' => date( 'Y' ) ],
				[ 'week' => date( 'W' ) ],
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Get posts for current month
	 *
	 * @return self
	 */
	public function monthly()
	{
		$dateQuery  = [
			'date_query' => [
				[ 'year'  => date( 'Y' ) ],
				[ 'month' => date( 'm' ) ],
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}

	/**
	 * Get posts for current year
	 *
	 * @return self
	 */
	public function yearly()
	{
		$dateQuery  = [
			'date_query' => [
				[ 'year'  => date( 'Y' ) ],
			],
		];
		$this->query = wp_parse_args( $dateQuery, $this->query );

		return $this;
	}
}

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
}
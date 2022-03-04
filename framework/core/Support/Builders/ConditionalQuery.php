<?php
/**
 * Conditional query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait ConditionalQuery
{

	/**
	 * Set any single query param
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function where( string $key, $value ) : self
	{
		$this->query[ $key ] = $value;
		return $this;
	}

	/**
	 * Pass extra params to a query
	 * if condition is true
	 *
	 * @param $condition
	 * @param $callback
	 * @param $else
	 * @return $this
	 */
	public function when( bool $condition, $callback, $else = false )
	{
		if ( ( is_callable( $condition ) || is_bool( $condition ) ) && $condition ) {
			$query = call_user_func_array( $callback, [ $this ] );
			$this->query = wp_parse_args( $this->query, $query->query );
		}

		if ( $else && is_callable( $else ) && ! $condition ) {
			$query = call_user_func_array( $else, [ $this ] );
			$this->query = wp_parse_args( $this->query, $query->query );
		}

		return $this;
	}

	/**
	 * Pass extra params to a query
	 * if condition is true
	 *
	 * @param $condition
	 * @param $callback
	 * @param $else
	 * @since 1.9.3
	 * @return $this
	 */
	public function ifElse( bool $condition, $if, $else )
	{
		return $this->when( $condition, $if, $else );
	}
}

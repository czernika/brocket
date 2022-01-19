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
	 * @return $this
	 */
	public function when( $condition, $callback )
	{
		if ( ( is_callable( $condition ) || is_bool( $condition ) ) && $condition ) {
			$query = call_user_func_array( $callback, [ $this ] );
			$this->query = wp_parse_args( $this->query, $query->query );
		}

		return $this;
	}
}

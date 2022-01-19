<?php
/**
 * Search query
 * Set specific search query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait SearchQuery
{

	/**
	 * Find posts by search key
	 *
	 * @param string  $key | search phrase.
	 * @param boolean $exact | exact or not.
	 * @param boolean $sentence | consider full key phrase or not.
	 * @return self
	 */
	public function search( string $key, bool $exact = false, bool $sentence = false )
	{
		$searchQuery = [
			's'        => $key,
			'exact'    => $exact,
			'sentence' => $sentence,
		];
		$this->query = wp_parse_args( $searchQuery, $this->query );

		return $this;
	}
}

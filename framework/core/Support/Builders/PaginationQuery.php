<?php
/**
 * Pagination query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait PaginationQuery
{
	/**
	 * Set posts per page param
	 *
	 * @param integer|string|null $postsPerPage
	 * @return self
	 */
	public function paginate( ?int $postsPerPage = null ) : self
	{
		if ( $postsPerPage ) {
			$this->query['posts_per_page'] = $postsPerPage;
		}

		if ( ! array_key_exists( 'paged', $this->query ) ) {
			$this->query['paged'] = absint( max( 1, get_query_var( 'paged' ) ) );
		}

		return $this;
	}

	/**
	 * Set pagination offset
	 *
	 * @since 1.4.2
	 * @param integer|string $offset
	 * @return self
	 */
	public function offset( int|string $offset ) : self
	{
		$this->query['offset'] = $offset;
		return $this;
	}

	/**
	 * Set paged query param
	 *
	 * @since 1.4.2
	 * @param integer|string $paged
	 * @return self
	 */
	public function paged( int|string $paged ) : self
	{
		$this->query['paged'] = $paged;
		return $this;
	}
}



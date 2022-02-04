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
	 * @param integer|null $postsPerPage
	 * @return self
	 */
	public function paginate( ?int $postsPerPage = null ) : self
	{
		if ( $postsPerPage ) {
			$this->query['posts_per_page'] = $postsPerPage;
			$this->query['paged']          = max( 1, get_query_var( 'paged' ) );
		}
		return $this;
	}

	/**
	 * Set pagination offset
	 *
	 * @since 1.4.2
	 * @param integer $offset
	 * @return self
	 */
	public function offset( int $offset ) : self
	{
		$this->query['offset'] = $offset;
		return $this;
	}

	/**
	 * Set paged query param
	 *
	 * @since 1.4.2
	 * @param integer $paged
	 * @return self
	 */
	public function paged( int $paged ) : self
	{
		$this->query['paged'] = $paged;
		return $this;
	}
}

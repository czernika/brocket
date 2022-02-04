<?php
/**
 * Post query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Timber;

trait PostQuery
{

	/**
	 * Get single post
	 *
	 * @param mixed $query
	 * @return object|boolean
	 */
	protected function getPost( $query = false ) : object|bool
	{
		return Timber::get_post( $query, $this->classMap );
	}

	/**
	 * Get current post object
	 *
	 * @return object|boolean
	 */
	public function current() : object|bool
	{
		return $this->getPost( get_queried_object_id() );
	}

	/**
	 * Get post by id
	 *
	 * @param integer $id
	 * @return object|boolean
	 */
	public function id( int $id ) : object|bool
	{
		return $this->getPost( $id );
	}
}

<?php
/**
 * Status query
 * Set `post_status` query param
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait StatusQuery
{
	/**
	 * Get posts with special statuses
	 *
	 * @since 1.4.2
	 * @param string|array $status
	 * @return self
	 */
	public function whereStatus( string|array $status ) : self
	{
		$this->query['post_status'] = $status;
		return $this;
	}

	/**
	 * Get all posts with published
	 *
	 * @since 1.4.2
	 * @param string|array $status
	 * @return self
	 */
	public function withStatus( string|array $status ) : self
	{
		$this->query['post_status'] = wp_parse_args( $this->query['post_status'], (array) $status );
		return $this;
	}

	/**
	 * Get all posts with drafts
	 *
	 * @return self
	 */
	public function withDrafts() : self
	{
		$this->query['post_status'] = wp_parse_args( $this->query['post_status'], [ 'draft' ] );
		return $this;
	}

	/**
	 * Get all posts with trashed
	 *
	 * @return self
	 */
	public function withTrashed() : self
	{
		$this->query['post_status'] = wp_parse_args( $this->query['post_status'], [ 'trash' ] );
		return $this;
	}

	/**
	 * Get all posts with future
	 *
	 * @return self
	 */
	public function withFuture() : self
	{
		$this->query['post_status'] = wp_parse_args( $this->query['post_status'], [ 'future' ] );
		return $this;
	}

	/**
	 * Get only future posts
	 *
	 * @since 1.4.2
	 * @return self
	 */
	public function drafts() : self
	{
		$this->query['post_status'] = 'draft';
		return $this;
	}

	/**
	 * Get only future posts
	 *
	 * @since 1.4.2
	 * @return self
	 */
	public function trashed() : self
	{
		$this->query['post_status'] = 'trash';
		return $this;
	}

	/**
	 * Get only future posts
	 *
	 * @since 1.4.2
	 * @return self
	 */
	public function future() : self
	{
		$this->query['post_status'] = 'future';
		return $this;
	}
}

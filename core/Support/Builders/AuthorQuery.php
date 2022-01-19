<?php
/**
 * Author query
 * Set query data related to post authors
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

trait AuthorQuery
{

   /**
	 * Author query
	 *
	 * @param integer|string|array $author
	 * @return self
	 */
	public function whereAuthor( $author )
	{
		if ( is_array( $author ) ) {
			$authorQuery = [ 'author__in' => $author ];
		} elseif ( is_string( $author ) ) {
			$authorQuery = [ 'author_name' => $author ];
		} else {
			$authorQuery = [ 'author' => $author ];
		}

		$this->query = wp_parse_args( $authorQuery, $this->query );

		return $this;
	}

	/**
	 * Get author posts by id
	 *
	 * @since 1.4.2
	 * @param integer $id
	 * @return self
	 */
	public function whereAuthorId( int $id ) : self
	{
		$this->query['author'] = $id;
		return $this;
	}

	/**
	 * Get author posts by name
	 *
	 * @since 1.4.2
	 * @param string $name
	 * @return self
	 */
	public function whereAuthorName( string $name ) : self
	{
		$this->query['author_name'] = $name;
		return $this;
	}

	/**
	 * Get posts by given authors
	 *
	 * @since 1.4.2
	 * @param array $authors
	 * @return self
	 */
	public function whereAuthors( array $authors ) : self
	{
		$this->query['author__in'] = $authors;
		return $this;
	}

	/**
	 * Get posts except for given authors
	 *
	 * @since 1.4.2
	 * @param array $authors
	 * @return self
	 */
	public function exceptAuthors( array $authors ) : self
	{
		$this->query['author__not_in'] = $authors;
		return $this;
	}
}

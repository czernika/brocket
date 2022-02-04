<?php
/**
 * Taxonomy query builder object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

class TaxonomyQueryBuilder extends QueryBuilder
{

	use TaxQuery, TermsQuery;

	/**
	 * Taxonomy name for the query
	 *
	 * @var string
	 */
	protected string $taxonomy = 'category';

	/**
	 * Retrieved posts class map
	 *
	 * @var string
	 */
	protected string $classMap = 'Timber\Post';

	public function __construct( string $taxonomy, string $classMap )
	{
		$this->taxonomy = $taxonomy;
		$this->classMap = $classMap;
		$this->query    = config( 'query.defaults', [] );

		$this->setQuery();
	}

	/**
	 * Set basic query params
	 *
	 * @return void
	 */
	protected function setQuery() : void
	{
		$this->query['tax_query']   = [];
		$this->query['post_status'] = [ 'publish' ];
	}

	/**
	 * Rewrite default classmap
	 *
	 * @param string $classMap
	 * @return self
	 */
	public function returnAs( string $classMap )
	{
		$this->classMap = $classMap;
		return $this;
	}
}

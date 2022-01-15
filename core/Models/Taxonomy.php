<?php
/**
 * Taxonomy model object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Models;

use Timber\Term;
use Brocooly\Support\Builders\TaxonomyQueryBuilder;

/**
 * @method static self query( array $query )
 * @method static self term( string $field, $terms, string $operator = 'IN' )
 * @method static self termId( $terms, string $operator = 'IN' )
 * @method static self termName( $terms, string $operator = 'IN' )
 * @method static self termSlug( $terms, string $operator = 'IN' )
 * @method static self relation( string $relation = 'AND' )
 * @method static self and()
 * @method static self or()
 * @method static self taxQuery( array $query )
 *
 * @method static array|null all()
 * @method static array|null get()
 * @method static \Illuminate\Support\Collection collect()
 *
 * @method static object|null first()
 * @method static object|null last()
 *
 * @method static mixed terms( $args = null, array $maybe = [] )
 */
class Taxonomy extends Term
{

	/**
	 * Taxonomy name
	 *
	 * @var string
	 */
	const TAXONOMY = 'category';

	/**
	 * Post types attached to taxonomy
	 *
	 * @var string|array
	 */
	protected string|array $postTypes = 'post';

	/**
	 * Build query to retrieve posts
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return void
	 */
	public static function __callStatic( string $name, array $arguments )
	{
		$builder = new TaxonomyQueryBuilder( static::TAXONOMY, static::class );
		return call_user_func_array( [ $builder, $name ], $arguments );
	}

	/**
	 * Get taxonomy post types
	 *
	 * @return string|array
	 */
	public function getPostTypes()
	{
		return $this->postTypes;
	}
}

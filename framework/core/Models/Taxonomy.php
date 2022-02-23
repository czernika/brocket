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
 * @method static self term( string $field, $terms, string $operator = 'IN' )
 * @method static self termId( $terms, string $operator = 'IN' )
 * @method static self termName( $terms, string $operator = 'IN' )
 * @method static self termSlug( $terms, string $operator = 'IN' )
 * @method static self taxRelation( string $relation = 'AND' )
 * @method static self andTax()
 * @method static self orTax()
 * @method static self taxQuery( array $query )
 * @method static array|null terms( $args = null, array $maybe = [] )
 * @method static self returnAs( string $classMap )
 *
 * @method static self whereAuthor( $author )
 * @method static self whereAuthorId( int $id )
 * @method static self whereAuthorName( string $name )
 * @method static self whereAuthors( array $authors )
 * @method static self exceptAuthors( array $authors )
 *
 * @method static self where( string $key, $value )
 * @method static self when( $condition, $callback )
 *
 * @method static self after( $date )
 * @method static self before( $date )
 * @method static self between( $after, $before )
 * @method static self whereDate( $dateQuery )
 *
 * @method static self meta( array $query )
 * @method static self metaQuery( array $metaQuery )
 * @method static self whereMeta( string $key, $value )
 * @method static self whereMetaKey( string $key )
 * @method static self whereMetaValue( $value )
 * @method static self metaRelation( string $relation = 'AND' )
 * @method static self andMeta()
 * @method static self orMeta()
 *
 * @method static self paginate( ?int $postsPerPage = null )
 * @method static self offset( int $offset )
 * @method static self paged( int $paged )
 *
 * @method static self search( string $key, bool $exact = false, bool $sentence = false )
 *
 * @method static self sort( string $order, string $orderby )
 * @method static self asc( string $orderby = 'ID' )
 * @method static self desc( string $orderby = 'ID' )
 * @method static self orderBy( array $sortQuery )
 *
 * @method static self whereStatus( string|array $status )
 * @method static self withStatus( string|array $status )
 * @method static self withDrafts()
 * @method static self withTrashed()
 * @method static self withFuture()
 * @method static self drafts()
 * @method static self trashed()
 * @method static self future()
 *
 * @method static \Timber\PostQuery all()
 * @method static \Timber\PostQuery get()
 * @method static self query( array $query )
 * @method static self with( array $postsIn )
 * @method static self except( array $postsIn )
 * @method static self exceptCurrent()
 *
 * @method static \Illuminate\Support\Collection collect()
 * @method static object|null first()
 * @method static object|null last()
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

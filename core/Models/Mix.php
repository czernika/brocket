<?php
/**
 * Experimental mixed post types class
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Models;

use Brocooly\Support\Builders\PostTypeQueryBuilder;

/**
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
 * @method static array all()
 * @method static array get()
 * @method static self query( array $query )
 *
 * @method static \Illuminate\Support\Collection collect()
 * @method static object|null first()
 * @method static object|null last()
 */
class Mix
{
	/**
	 * Build query to retrieve mixed posts
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return void
	 */
	public static function __callStatic( string $name, array $arguments )
	{
		$builder = new PostTypeQueryBuilder( $arguments[0], 'Timber\Post' );
		return call_user_func_array( [ $builder, $name ], array_shift( $arguments ) );
	}
}

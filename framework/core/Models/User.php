<?php
/**
 * User object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Brocooly\Models;

use Brocooly\Support\Builders\UserQueryBuilder;
use Timber\User as TimberUser;

/**
 * @method static self roles()
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
 * @method static self sort( string $order, string $orderby )
 * @method static self asc( string $orderby = 'ID' )
 * @method static self desc( string $orderby = 'ID' )
 * @method static self orderBy( array $sortQuery )
 *
 * @method static iterable get()
 * @method static iterable all()
 */
class User extends TimberUser
{

	protected const ROLE = '';

	/**
	 * Get current user
	 *
	 * @return void
	 */
	public static function current()
	{
		return new static( get_current_user_id() );
	}

	/**
	 * Build query to users
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return void
	 */
	public static function __callStatic( string $name, array $arguments )
	{
		$builder = new UserQueryBuilder( static::ROLE, static::class );
		return call_user_func_array( [ $builder, $name ], $arguments );
	}
}

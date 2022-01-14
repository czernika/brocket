<?php

declare(strict_types=1);

namespace Brocooly\Models;

use Timber\Post;
use Brocooly\Support\Builders\PostTypeQueryBuilder;

/**
 * @method static self query( array $query )
 * @method static self paginate( ?int $postsPerPage = null )
 * @method static self where( string $key, $value )
 * @method static array|bool|null all()
 * @method static array|bool|null get()
 * @method static object current()
 * @method static object id( int $id )
 * @method static object first()
 * @method static object last()
 */
class PostType extends Post
{
	const POST_TYPE = 'post';

	public static function __callStatic( $name, $arguments ) {
		$builder = new PostTypeQueryBuilder( static::POST_TYPE, static::class );
		return call_user_func_array( [ $builder, $name ], $arguments );
	}
}

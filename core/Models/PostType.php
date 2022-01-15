<?php
/**
 * PostType model object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Models;

use Timber\Post;
use Brocooly\Support\Builders\PostTypeQueryBuilder;

/**
 * @method static self query( array $query )
 * @method static self paginate( ?int $postsPerPage = null )
 * @method static self where( string $key, $value )
 * @method static self withStatus( string|array $status )
 * @method static self withDrafts()
 * @method static self withTrashed()
 *
 * @method static array|null all()
 * @method static array|null get()
 * @method static \Illuminate\Support\Collection collect()
 *
 * @method static object|null current()
 * @method static object|null id( int $id )
 * @method static object|null first()
 * @method static object|null last()
 */
class PostType extends Post
{

	/**
	 * Post type name
	 *
	 * @var string
	 */
	const POST_TYPE = 'post';

	/**
	 * Build query to retrieve posts
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return void
	 */
	public static function __callStatic( string $name, array $arguments )
	{
		$builder = new PostTypeQueryBuilder( static::POST_TYPE, static::class );
		return call_user_func_array( [ $builder, $name ], $arguments );
	}
}

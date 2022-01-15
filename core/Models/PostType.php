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
class PostType
{

	/**
	 * Post type name
	 *
	 * @var string
	 */
	const POST_TYPE = 'post';

	/**
	 * Post type id
	 *
	 * @var integer
	 */
	public int $id = 0;

	/**
	 * Related post object
	 *
	 * @var \WP_Post
	 */
	public \WP_Post $wpPost;

	/**
	 * Post type title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * Post type link
	 *
	 * @var string
	 */
	public string|false $link = false;

	public function __construct( $wpPost )
	{
		$this->wpPost = $wpPost;
		$this->id     = $wpPost->ID;

		$this->setTitle();
		$this->setLink();
	}

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

	/**
	 * Get post type title
	 *
	 * @return string
	 */
	public function title()
	{
		return $this->title;
	}

	/**
	 * Set post type title
	 *
	 * @return void
	 */
	protected function setTitle()
	{
		$this->title = get_the_title( $this->id );
	}

	/**
	 * Get post type link
	 *
	 * @return void
	 */
	public function link()
	{
		return $this->link;
	}

	/**
	 * Set post type link
	 *
	 * @return void
	 */
	protected function setLink()
	{
		$this->link = get_permalink( $this->id );
	}
}

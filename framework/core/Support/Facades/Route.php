<?php
/**
 * WPEmerge App\route() facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Theme\App;

/**
 * @method static $this is_404()
 * @method static $this is_archive()
 * @method static $this is_attachment( $attachment = '' )
 * @method static $this is_author( $author = '' )
 * @method static $this is_category( $category = '' )
 * @method static $this is_date()
 * @method static $this is_day()
 * @method static $this is_front_page()
 * @method static $this is_home()
 * @method static $this is_month()
 * @method static $this is_page( $page = '' )
 * @method static $this is_page_template( $template = '' )
 * @method static $this is_paged()
 * @method static $this is_post_type_archive( $post_types = '' )
 * @method static $this is_privacy_policy()
 * @method static $this is_search()
 * @method static $this is_single()
 * @method static $this is_singular( $post_types = '' )
 * @method static $this is_sticky()
 * @method static $this is_tag( $tag = '' )
 * @method static $this is_tax( $taxonomy = '', $term = '' )
 * @method static $this is_time()
 * @method static $this is_year()
 *
 * @method static $this get()
 * @method static $this post()
 * @method static $this put()
 * @method static $this patch()
 * @method static $this delete()
 * @method static $this options()
 * @method static $this any()
 * @method static $this methods( $methods )
 * @method static $this url( $url, $where = [] )
 * @method static $this where( $condition )
 * @method static $this middleware( $middleware )
 * @method static $this setNamespace( $namespace )
 * @method static $this query( $query )
 * @method static $this name( $name )
 * @method static void group( $routes )
 * @method static void handle( $handler = '' )
 * @method static void view( $views )
 * @method static void output( $views, $ctx = [] )
 * @method static void all( $handler = '' )
 */
class Route extends AbstractFacade
{
	protected static function accessor()
	{
		return App::route();
	}
}

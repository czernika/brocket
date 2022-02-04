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

use Theme\Brocooly;

/**
 * @method static object is_404()
 * @method static object is_archive()
 * @method static object is_attachment( $attachment = '' )
 * @method static object is_author( $author = '' )
 * @method static object is_category( $category = '' )
 * @method static object is_date()
 * @method static object is_day()
 * @method static object is_front_page()
 * @method static object is_home()
 * @method static object is_month()
 * @method static object is_page( $page = '' )
 * @method static object is_page_template( $template = '' )
 * @method static object is_paged()
 * @method static object is_post_type_archive( $post_types = '' )
 * @method static object is_privacy_policy()
 * @method static object is_search()
 * @method static object is_single()
 * @method static object is_singular( $post_types = '' )
 * @method static object is_sticky()
 * @method static object is_tag( $tag = '' )
 * @method static object is_tax( $taxonomy = '', $term = '' )
 * @method static object is_time()
 * @method static object is_year()
 */
class Route extends AbstractFacade
{
	protected static function accessor()
	{
		return Brocooly::route();
	}
}

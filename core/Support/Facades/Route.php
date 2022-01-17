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
 * @method static void is_404()
 * @method static void is_archive()
 * @method static void is_attachment()
 * @method static void is_author()
 * @method static void is_category()
 * @method static void is_date()
 * @method static void is_day()
 * @method static void is_front_page()
 * @method static void is_home()
 * @method static void is_month()
 * @method static void is_page()
 * @method static void is_paged()
 * @method static void is_post_type_archive()
 * @method static void is_privacy_policy()
 * @method static void is_search()
 * @method static void is_single()
 * @method static void is_singular()
 * @method static void is_sticky()
 * @method static void is_tag()
 * @method static void is_tax()
 * @method static void is_time()
 * @method static void is_year()
 */
class Route extends AbstractFacade
{
	protected static function accessor()
	{
		return Brocooly::route();
	}
}

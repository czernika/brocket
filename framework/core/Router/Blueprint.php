<?php
/**
 * Extend WPEmerge Routing with conditional tags
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Brocooly\Router;

use Illuminate\Support\Str;
use WPEmerge\Routing\RouteBlueprint;

class Blueprint extends RouteBlueprint
{

	/**
	 * Allowed WordPress conditional tags
	 *
	 * @var string[]
	 */
	private array $allowedConditionals = [
		'is_404',
		'is_archive',
		'is_attachment',
		'is_author',
		'is_category',
		'is_date',
		'is_day',
		'is_front_page',
		'is_home',
		'is_month',
		'is_page',
		'is_page_template',
		'is_paged',
		'is_post_type_archive',
		'is_privacy_policy',
		'is_search',
		'is_single',
		'is_singular',
		'is_sticky',
		'is_tag',
		'is_tax',
		'is_time',
		'is_year',
	];

	public function __call( $name, $arguments )
	{
		$snake = Str::snake( $name );
		if ( in_array( $snake, $this->allowedConditionals, true ) ) {
			return $this->get()->where( $snake, ...$arguments );
		}

		throw new \InvalidArgumentException( sprintf( 'Method `%s()` is not allowed WordPress conditional tag', $snake ) );
	}

	/**
	 * Handle ajax requests
	 *
	 * @param string $action
	 * @param string|array $methods
	 * @param boolean $private
	 * @param boolean $public
	 * @return void
	 */
	public function ajax( string $action, string|array $methods = 'POST', bool $private = true, bool $public = false )
	{
		return $this->methods( (array) $methods )->where( 'ajax', $action, $private, $public );
	}

	/**
	 * Get simple output
	 *
	 * @param array|string $views
	 * @param array $ctx
	 * @return void
	 */
	public function output( array|string $views, array $ctx = [] )
	{
		return $this->handle( fn() => output( $views, $ctx ) );
	}
}

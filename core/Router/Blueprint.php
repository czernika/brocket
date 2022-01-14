<?php

declare(strict_types=1);

namespace Brocooly\Router;

use WPEmerge\Routing\RouteBlueprint;
use Illuminate\Support\Str;

class Blueprint extends RouteBlueprint
{

	private array $allowedConditionals = [
		'is_404',
		'is_archive',
		'is_attachment',
		'is_author',
		'is_category',
		'is_comment_feed',
		'is_customize_preview',
		'is_date',
		'is_day',
		'is_embed',
		'is_feed',
		'is_front_page',
		'is_home',
		'is_month',
		'is_page',
		'is_page_template',
		'is_paged',
		'is_post_type_archive',
		'is_preview',
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

	public function __call( $name, $arguments ) {
		$snake = Str::snake( $name );
		if ( in_array( $snake, $this->allowedConditionals, true ) ) {
			return $this->get()->where( $snake, ...$arguments );
		}

		throw new \Exception( sprintf( 'Method `%s()` is not WordPress conditional tag', $snake ) );
	}
}

<?php

/**
 * Product - custom post type
 * ! Register this class inside `config/models.php` file to have effect
 *
 * ! It is recommended to flush permalinks
 *
 * @package Brocooly
 */

declare(strict_types=1);

namespace Theme\Models;

use Brocooly\Models\PostType;
use Brocooly\Support\Traits\RequiresRegistrationTrait;

class Product extends PostType
{
	use RequiresRegistrationTrait;

	/**
	 * Post type slug
	 *
	 * @var string
	 */
	public const POST_TYPE = 'product';

	/**
	 * Post type register options
	 * Same as for `register_extended_post_type()`
	 *
	 * @return array
	 */
	protected function args(): array
	{
		return [
			'public'              => true,
			'exclude_from_search' => false,
			'show_in_rest'        => false,
			'menu_icon'           => null,
			'menu_position'       => 10,
			'supports'            => [ 'title', 'editor' ],
			'enter_title_here'    => esc_html__( 'New Product title', 'brocooly' ),
			// 'admin_cols'       => [],
			// 'admin_filters'    => [],
		];
	}


	/**
	 * Post type labels
	 * Same as `labels` key within arguments
	 *
	 * @return array
	 */
	protected function labels(): array
	{
		return [
			'name'           => esc_html__( 'Products', 'brocooly' ),
			'all_items'      => esc_html__( 'Products', 'brocooly' ),
			'singular_name'  => esc_html__( 'Product', 'brocooly' ),
			'name_admin_bar' => esc_html__( 'Product', 'brocooly' ),
			'menu_name'      => esc_html__( 'Products', 'brocooly' ),
			'add_new'        => esc_html__( 'Add Product', 'brocooly' ),
			'new_item'       => esc_html__( 'New Product', 'brocooly' ),
			'add_new_item'   => esc_html__( 'Add new Product', 'brocooly' ),
			'search_items'   => esc_html__( 'Find Product', 'brocooly' ),
			'edit_item'      => esc_html__( 'Edit Product', 'brocooly' ),
			'view_item'      => esc_html__( 'View Product', 'brocooly' ),
		];
	}


	/**
	 * Post type names
	 * Same as `names` array for `register_extended_post_type()`
	 *
	 * @return array
	 */
	protected function names(): array
	{
		return [
			'singular' => esc_html__( 'Product', 'brocooly' ),
			'plural'   => esc_html__( 'Products', 'brocooly' ),
			'slug'     => static::POST_TYPE,
		];
	}
}

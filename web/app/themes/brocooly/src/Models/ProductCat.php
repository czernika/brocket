<?php

/**
 * ProductCat - custom taxonomy
 * ! Register this class inside `config/wpemerge.php` file to have effect
 *
 * ! It is recommended to flush permalinks
 *
 * @package Brocooly
 */

declare(strict_types=1);

namespace Theme\Models;

use Brocooly\Models\Taxonomy;
use Brocooly\Support\Traits\RequiresRegistrationTrait;

class ProductCat extends Taxonomy
{
	use RequiresRegistrationTrait;

	/**
	 * Taxonomy slug
	 *
	 * @var string
	 */
	public const TAXONOMY = 'product_cat';

	/**
	 * Post type related to this taxonomy
	 * Same as for `register_extended_taxonomy()`
	 *
	 * @var array|string
	 */
	protected static $postTypes = 'Product::POST_TYPE';


	/**
	 * Taxonomyregister options
	 * Same as for `register_extended_taxonomy()`
	 *
	 * @return array
	 */
	protected function args(): array
	{
		return [
			'public'            => true,
			'show_in_menu'      => true,
			'show_ui'           => true,
			'hierarchical'      => true, // false for tags.
			'show_in_rest'      => false,
			'show_admin_column' => true,
			// 'meta_box'       => 'radio', // Use radio buttons in the meta box for this taxonomy on the post editing screen.
			// 'admin_cols'     => [],
		];
	}


	/**
	 * Taxonomy labels
	 * Same as `labels` key within arguments
	 *
	 * @return array
	 */
	protected function labels(): array
	{
		return [
			'name'              => esc_html__( 'Product Cats', 'brocooly' ),
			'all_items'         => esc_html__( 'All Product Cats', 'brocooly' ),
			'singular_name'     => esc_html__( 'Product Cat', 'brocooly' ),
			'menu_name'         => esc_html__( 'Product Cat', 'brocooly' ),
			'parent_item'       => esc_html__( 'Parent Product Cat', 'brocooly' ),
			'parent_item_colon' => esc_html__( 'Parent Product Cat', 'brocooly' ),
			'search_items'      => esc_html__( 'Find Product Cat', 'brocooly' ),
			'add_new_item'      => esc_html__( 'Add Product Cat', 'brocooly' ),
			'add_new'           => esc_html__( 'Add new Product Cat', 'brocooly' ),
		];
	}


	/**
	 * Taxonomy names
	 * Same as `names` array for `register_extended_taxonomy()`
	 *
	 * @return array
	 */
	protected function names(): array
	{
		return [
			'singular' => esc_html__( 'Product Cat', 'brocooly' ),
			'plural'   => esc_html__( 'Product Cats', 'brocooly' ),
			'slug'     => static::TAXONOMY,
		];
	}
}

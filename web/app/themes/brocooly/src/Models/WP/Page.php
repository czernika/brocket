<?php
/**
 * Default WordPress Page model
 *
 * @package Brocooly
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Theme\Models\WP;

use Brocooly\Models\PostType;

class Page extends PostType
{

	/**
	 * Post type name
	 *
	 * @var string
	 */
	const POST_TYPE = 'page';
}

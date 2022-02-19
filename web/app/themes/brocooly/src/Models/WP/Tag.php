<?php
/**
 * Tag model
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Theme\Models\WP;

use Brocooly\Models\Taxonomy;

class Tag extends Taxonomy
{
	/**
	 * Taxonomy name
	 *
	 * @var string
	 */
	const TAXONOMY = 'post_tag';
}

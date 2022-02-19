<?php
/**
 * Primary navigation menu object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Theme\UI\Menus;

use Brocooly\UI\Menu;

class PrimaryMenu extends Menu
{
	public function label() : string
	{
		return esc_html__( 'Primary menu', 'brocooly' );
	}
}

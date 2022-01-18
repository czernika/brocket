<?php
/**
 * Kirki Framework customizer facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Brocooly\Customizer\CustomizerFactory;

/**
 * @method static array background()
 * @method static array code()
 * @method static array checkbox()
 * @method static array color()
 * @method static array color_palette()
 * @method static array custom()
 * @method static array dashicons()
 * @method static array date()
 * @method static array dimension()
 * @method static array dimensions()
 * @method static array dropdown_pages()
 * @method static array editor()
 * @method static array fontawesome()
 * @method static array generic()
 * @method static array image()
 * @method static array multicheck()
 * @method static array multicolor()
 * @method static array number()
 * @method static array preset()
 * @method static array radio()
 * @method static array radio_buttonset()
 * @method static array radio_image()
 * @method static array repeater()
 * @method static array select()
 * @method static array slider()
 * @method static array sortable()
 * @method static array switch()
 * @method static array text()
 * @method static array textarea()
 * @method static array toggle()
 * @method static array typography()
 * @method static array upload()
 * @method static array url()
 */
class Mod extends AbstractFacade
{
	protected static function accessor()
	{
		return new CustomizerFactory();
	}
}

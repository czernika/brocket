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

/**
 * @method static array background( $id, $options )
 * @method static array code( $id, $options )
 * @method static array checkbox( $id, $options )
 * @method static array color( $id, $options )
 * @method static array color_palette( $id, $options )
 * @method static array custom( $id, $options )
 * @method static array dashicons( $id, $options )
 * @method static array date( $id, $options )
 * @method static array dimension( $id, $options )
 * @method static array dimensions( $id, $options )
 * @method static array dropdown_pages( $id, $options )
 * @method static array editor( $id, $options )
 * @method static array fontawesome( $id, $options )
 * @method static array generic( $id, $options )
 * @method static array image( $id, $options )
 * @method static array multicheck( $id, $options )
 * @method static array multicolor( $id, $options )
 * @method static array number( $id, $options )
 * @method static array preset( $id, $options )
 * @method static array radio( $id, $options )
 * @method static array radio_buttonset( $id, $options )
 * @method static array radio_image( $id, $options )
 * @method static array repeater( $id, $options )
 * @method static array select( $id, $options )
 * @method static array slider( $id, $options )
 * @method static array sortable( $id, $options )
 * @method static array switch( $id, $options )
 * @method static array text( $id, $options )
 * @method static array textarea( $id, $options )
 * @method static array toggle( $id, $options )
 * @method static array typography( $id, $options )
 * @method static array upload( $id, $options )
 * @method static array url( $id, $options )
 */
class Mod extends AbstractFacade
{
	protected static function accessor()
	{
		return BROCOOLY_CUSTOMIZER_FACTORY_KEY;
	}
}

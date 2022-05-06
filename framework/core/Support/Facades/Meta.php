<?php
/**
 * WPEmerge App\route() facade
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.3.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Facades;

use Carbon_Fields\Field;
use Webmozart\Assert\Assert;

/**
 * @method static \Carbon_Fields\Field\Field association( $id, $title )
 * @method static \Carbon_Fields\Field\Field checkbox( $id, $title )
 * @method static \Carbon_Fields\Field\Field color( $id, $title )
 * @method static \Carbon_Fields\Field\Field complex( $id, $title )
 * @method static \Carbon_Fields\Field\Field date( $id, $title )
 * @method static \Carbon_Fields\Field\Field date_time( $id, $title )
 * @method static \Carbon_Fields\Field\Field file( $id, $title )
 * @method static \Carbon_Fields\Field\Field footer_scripts( $id, $title )
 * @method static \Carbon_Fields\Field\Field gravity_form( $id, $title )
 * @method static \Carbon_Fields\Field\Field header_scripts( $id, $title )
 * @method static \Carbon_Fields\Field\Field hidden( $id, $title )
 * @method static \Carbon_Fields\Field\Field html( $id, $title )
 * @method static \Carbon_Fields\Field\Field image( $id, $title )
 * @method static \Carbon_Fields\Field\Field map( $id, $title )
 * @method static \Carbon_Fields\Field\Field media_gallery( $id, $title )
 * @method static \Carbon_Fields\Field\Field multiselect( $id, $title )
 * @method static \Carbon_Fields\Field\Field oembed( $id, $title )
 * @method static \Carbon_Fields\Field\Field radio( $id, $title )
 * @method static \Carbon_Fields\Field\Field radio_image( $id, $title )
 * @method static \Carbon_Fields\Field\Field rich_text( $id, $title )
 * @method static \Carbon_Fields\Field\Field select( $id, $title )
 * @method static \Carbon_Fields\Field\Field separator( $id, $title )
 * @method static \Carbon_Fields\Field\Field set( $id, $title )
 * @method static \Carbon_Fields\Field\Field text( $id, $title )
 * @method static \Carbon_Fields\Field\Field textarea( $id, $title )
 * @method static \Carbon_Fields\Field\Field time( $id, $title )
 */
class Meta
{
	public static function __callStatic( $name, $arguments )
	{
		Assert::notSame( $name, 'sidebar', 'Sidebar meta field is not supported!' );
		return Field::make( $name, ...$arguments );
	}
}

<?php
/**
 * Strategy class
 * Define which Kirki Field instantiate depends on method
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Factories;

use Kirki\Field\Checkbox;
use Kirki\Field\Background;
use Kirki\Field\Checkbox_Switch;
use Kirki\Field\Checkbox_Toggle;
use Kirki\Field\Code;
use Kirki\Field\Color;
use Kirki\Field\Color_Palette;
use Kirki\Field\Custom;
use Kirki\Field\Dashicons;
use Kirki\Field\Date;
use Kirki\Field\Dimension;
use Kirki\Field\Dimensions;
use Kirki\Field\Dropdown_Pages;
use Kirki\Field\Editor;
use Kirki\Field\FontAwesome;
use Kirki\Field\Generic;
use Kirki\Field\Image;
use Kirki\Field\Multicheck;
use Kirki\Field\Multicolor;
use Kirki\Field\Number;
use Kirki\Field\Preset;
use Kirki\Field\Radio;
use Kirki\Field\Radio_Buttonset;
use Kirki\Field\Radio_Image;
use Kirki\Field\Repeater;
use Kirki\Field\Select;
use Kirki\Field\Slider;
use Kirki\Field\Sortable;
use Kirki\Field\Text;
use Kirki\Field\Textarea;
use Kirki\Field\Typography;
use Kirki\Field\Upload;
use Kirki\Field\URL;

class CustomizerFactory
{

	/**
	 * List of allowed methods
	 *
	 * @var array
	 */
	private $methods = [
		'background'      => Background::class,
		'code'            => Code::class,
		'checkbox'        => Checkbox::class,
		'color'           => Color::class,
		'color_palette'   => Color_Palette::class,
		'custom'          => Custom::class,
		'dashicons'       => Dashicons::class,
		'date'            => Date::class,
		'dimension'       => Dimension::class,
		'dimensions'      => Dimensions::class,
		'dropdown_pages'  => Dropdown_Pages::class,
		'editor'          => Editor::class,
		'fontawesome'     => FontAwesome::class,
		'generic'         => Generic::class,
		'image'           => Image::class,
		'multicheck'      => Multicheck::class,
		'multicolor'      => Multicolor::class,
		'number'          => Number::class,
		'preset'          => Preset::class,
		'radio'           => Radio::class,
		'radio_buttonset' => Radio_Buttonset::class,
		'radio_image'     => Radio_Image::class,
		'repeater'        => Repeater::class,
		'select'          => Select::class,
		'slider'          => Slider::class,
		'sortable'        => Sortable::class,
		'switch'          => Checkbox_Switch::class,
		'text'            => Text::class,
		'textarea'        => Textarea::class,
		'toggle'          => Checkbox_Toggle::class,
		'typography'      => Typography::class,
		'upload'          => Upload::class,
		'url'             => URL::class,
	];

	/**
	 * Kirki Field arguments
	 *
	 * @var array
	 */
	private array $args = [];

	public function __call( $name, $arguments )
	{
		if ( ! in_array( $name, array_keys( $this->methods ), true ) ) {
			return;
		}

		[ $id, $options ] = $arguments;

		if ( is_string( $options ) ) {
			$options = [ 'label' => $options ];
		}

		$this->args['options']             = $options;
		$this->args['options']['settings'] = $id;
		$this->args['field']               = $this->methods[ $name ];

		return $this->args;
	}
}

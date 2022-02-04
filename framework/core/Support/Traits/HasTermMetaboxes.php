<?php
/**
 * Simple metaboxes trait for Taxonomies
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.3.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Traits;

use Carbon_Fields\Container;

trait HasTermMetaboxes
{
	abstract public function metaboxes();

	protected function setContainer( string $id, string $title )
	{
		return Container::make( $id, $title )
			->where( 'term_taxonomy', '=', static::TAXONOMY );
	}

	protected function setContainerWithFields( string $id, string $title, array $fields )
	{
		return $this->setContainer( $id, $title )
			->add_fields( $fields );
	}
}

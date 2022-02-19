<?php
/**
 * Simple metaboxes trait
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Brocooly\Support\Traits;

use Theme\Models\WP\User;
use Carbon_Fields\Container;
use Theme\Models\WP\Comment;
use Brocooly\Models\Taxonomy;
use Brocooly\Models\PostType;
use Brocooly\UI\Menu;

trait HasMetaboxes
{

	protected string $containerType = 'post_meta';

	abstract public function metaboxes();

	/**
	 * Get container instance
	 *
	 * @param string $id
	 * @param string $title
	 * @return object
	 */
	protected function initContainer( string $id, string $title )
	{
		if ( $this instanceof Taxonomy ) {
			$this->containerType = 'term_meta';
		}

		if ( $this instanceof User ) {
			$this->containerType = 'user_meta';
		}

		if ( $this instanceof Comment ) {
			$this->containerType = 'comment_meta';
		}

		if ( $this instanceof Menu ) {
			$this->containerType = 'nav_menu_item';
		}

		return Container::make( $this->containerType, $id, $title );
	}

	/**
	 * Set container instance
	 *
	 * @param string $id
	 * @param string $title
	 * @return object
	 */
	protected function setContainer( string $id, string $title )
	{
		$container = $this->initContainer( $id, $title );

		if ( $this instanceof Taxonomy ) {
			$container->where( 'term_taxonomy', '=', static::TAXONOMY );
		}

		if ( $this instanceof PostType ) {
			$container->where( 'post_type', '=', static::POST_TYPE );
		}

		return $container;
	}

	/**
	 * Set container with metaboxes
	 *
	 * @param string $id
	 * @param string $title
	 * @param array $fields
	 * @return void
	 */
	protected function setContainerWithFields( string $id, string $title, array $fields )
	{
		return $this->setContainer( $id, $title )
			->add_fields( $fields );
	}

	/**
	 * Set tabbed container with metaboxes
	 *
	 * @param string $id
	 * @param string $title
	 * @param array $tabs
	 * @return void
	 */
	protected function setContainerWithTabs( string $id, string $title, array $tabs )
	{
		$container = $this->setContainer( $id, $title );

		foreach ( $tabs as $tab ) {
			$container->add_tab( ...$tab );
		}

		return $container;
	}
}

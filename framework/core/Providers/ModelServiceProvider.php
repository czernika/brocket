<?php
/**
 * Register post types and taxonomies
 * Handle model behavior here
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Brocooly\Providers;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ModelServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{
		foreach ( config( 'models.post_types', [] ) as $class ) {
			$container[ $class::POST_TYPE ] = $container->factory(
				function( $c ) use ( $class ) {
					return new $class();
				}
			);
		}

		foreach ( config( 'models.taxonomies', [] ) as $class ) {
			$container[ $class::TAXONOMY ] = $container->factory(
				function( $c ) use ( $class ) {
					return new $class();
				}
			);
		}
	}

	public function bootstrap($container)
	{
		foreach ( config( 'models.taxonomies', [] ) as $class ) {
			$this->registerTaxonomy( $container[ $class::TAXONOMY ] );
		}

		foreach ( config( 'models.post_types', [] ) as $class ) {
			$this->registerPostType( $container[ $class::POST_TYPE ] );
		}
	}

	/**
	 * Register custom post types
	 *
	 * @param object $postType
	 * @return void
	 */
	private function registerPostType( $postType ) {
		$name = $postType::POST_TYPE;

		if ( method_exists( $postType, 'register' ) ) {
			$postType->register();

			add_action(
				'init',
				function() use ( $postType, $name ) {
					register_extended_post_type(
						$name,
						$postType->getArgs(),
						$postType->getNames(),
					);
				}
			);
		}

		if ( method_exists( $postType, 'metaboxes' ) ) {
			add_action(
				'carbon_fields_register_fields',
				function() use ( $postType ) {
					$postType->metaboxes();
				},
			);
		}

		/**
		 * Create template for this post type
		 */
		if ( property_exists( $postType, 'templates' ) ) {
			add_filter(
				"theme_${name}_templates",
				function ( $post_templates, $theme, $post, $post_type ) use ( $postType ) {
					foreach ( (array) $postType->templates as $template ) {
						$tpl = new $template();
						$post_templates[ $tpl::SLUG ] = $tpl->label();
					}
					return $post_templates;
				},
				10,
				4,
			);
		}
	}

	/**
	 * Register custom taxonomy
	 *
	 * @param object $postType
	 * @return void
	 */
	private function registerTaxonomy( $taxonomy ) {
		if ( method_exists( $taxonomy, 'register' ) ) {

			$taxonomy->register();

			add_action(
				'init',
				function() use ( $taxonomy ) {
					register_extended_taxonomy(
						$taxonomy::TAXONOMY,
						$taxonomy->getPostTypes(),
						$taxonomy->getArgs(),
						$taxonomy->getNames(),
					);
				}
			);
		}

		if ( method_exists( $taxonomy, 'metaboxes' ) ) {
			add_action(
				'carbon_fields_register_fields',
				function() use ( $taxonomy ) {
					$taxonomy->metaboxes();
				},
			);
		}
	}
}

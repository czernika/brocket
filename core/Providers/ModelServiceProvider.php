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
		foreach ( config( 'models.post_types' ) as $class ) {
			$container[ $class::POST_TYPE ] = $container->factory(
				function( $c ) use ( $class ) {
					return new $class();
				}
			);
		}

		foreach ( config( 'models.taxonomies' ) as $class ) {
			$container[ $class::TAXONOMY ] = $container->factory(
				function( $c ) use ( $class ) {
					return new $class();
				}
			);
		}
	}

	public function bootstrap($container)
	{
		foreach ( config( 'models.taxonomies' ) as $class ) {
			$this->registerTaxonomy( $container[ $class::TAXONOMY ] );
		}

		foreach ( config( 'models.post_types' ) as $class ) {
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
		if ( method_exists( $postType, 'register' ) ) {

			$postType->register();

			add_action(
				'init',
				function() use ( $postType ) {
					register_extended_post_type(
						$postType::POST_TYPE,
						$postType->getArgs(),
						$postType->getNames(),
					);
				}
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
	}
}

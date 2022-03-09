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

use Theme\Models\WP\User;
use Theme\Models\WP\Comment;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ModelServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{
		foreach ( config( 'models.post_types', [] ) as $class ) {
			$container[ $class::POST_TYPE ] = $class;
		}

		foreach ( config( 'models.taxonomies', [] ) as $class ) {
			$container[ $class::TAXONOMY ] = $class;
		}

		$container['user'] = User::class;
	}

	public function bootstrap($container)
	{
		foreach ( config( 'models.taxonomies', [] ) as $class ) {
			$this->registerTaxonomy( $container[ $class::TAXONOMY ] );
		}

		foreach ( config( 'models.post_types', [] ) as $class ) {
			$this->registerPostType( $container[ $class::POST_TYPE ] );
		}

		foreach ( config( 'models.menus', [] ) as $class ) {
			$this->registerNavMenu( new $class() );
		}

		$this->registerModelMetaboxes( $container['user'] );
	}

	/**
	 * Register custom post types
	 *
	 * @param object $postType
	 * @return void
	 */
	private function registerPostType( $postType )
	{
		$name = $postType::POST_TYPE;

		if ( method_exists( $postType, 'register' ) ) {
			$postType = new $postType();
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

		$this->registerModelMetaboxes( $postType );

		/**
		 * Create template for this post type
		 */
		if ( property_exists( $postType, 'templates' ) ) {
			$postType = new $postType();
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
	private function registerTaxonomy( $taxonomy )
	{
		if ( method_exists( $taxonomy, 'register' ) ) {
			$taxonomy = new $taxonomy();
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

		$this->registerModelMetaboxes( $taxonomy );
	}

	/**
	 * Register navigation menu
	 *
	 * @param object $menu
	 * @return void
	 */
	private function registerNavMenu( $menu )
	{
		add_action(
			'after_setup_theme',
			function() use ( $menu ) {
				register_nav_menu( $menu::LOCATION, $menu->label() );
			}
		);

		$this->registerModelMetaboxes( $menu );
	}

	/**
	 * Register metaboxes for model
	 *
	 * @param object $model
	 * @return void
	 */
	private function registerModelMetaboxes( $model )
	{
		if ( method_exists( $model, 'metaboxes' ) ) {
			$model = new $model();
			add_action(
				'carbon_fields_register_fields',
				function() use ( $model ) {
					$model->metaboxes();
				},
			);
		}
	}
}

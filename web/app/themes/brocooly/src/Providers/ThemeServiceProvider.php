<?php
/**
 * Theme ServiceProvider
 * You may register here features related to theme
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme\Providers;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class ThemeServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{

	}

	public function bootstrap( $container )
	{
		add_action( 'after_setup_theme', [ $this, 'afterSetupTheme' ] );
		add_action( 'init', [ $this, 'init' ] );

		add_action( 'body_class', [ $this, 'bodyClass' ] );

		/**
		 * --------------------------------------------------------------------------
		 * Filters the output of the XHTML generator tag for display.
		 * --------------------------------------------------------------------------
		 *
		 * Return empty string instead of generator to hide WordPress version
		 *
		 * @link https://developer.wordpress.org/reference/hooks/the_generator/
		 * @since 1.8.6
		 */
		add_filter( 'the_generator', '__return_empty_string' );
	}

	/**
	 * Boot Carbon Fields callback
	 *
	 * @return void
	 */
	public function afterSetupTheme()
	{
		/**
		 * --------------------------------------------------------------------------
		 * Load theme text domain
		 * --------------------------------------------------------------------------
		 *
		 * Make theme multilingual
		 *
		 * @since 1.7.0
		 */
		load_theme_textdomain( 'brocooly', BROCOOLY_THEME_LANG_PATH );

		/**
		 * --------------------------------------------------------------------------
		 * Register Carbon Fields package
		 * --------------------------------------------------------------------------
		 *
		 * Register metaboxes for post types, theme widgets, options and more
		 * Uncomment this line to have access for metaboxes
		 *
		 * @link https://docs.carbonfields.net/quickstart.html
		 */
		// \Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Init hook
	 *
	 * @return void
	 */
	public function init()
	{
		$this->disableEmoji();
	}

	/**
	 * Disable emoji on site
	 *
	 * @return void
	 */
	private function disableEmoji()
	{
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		add_filter( 'emoji_svg_url', '__return_false' );
	}

	/**
	 * Add classes to body
	 * Will be available with {{ body_class }}
	 *
	 * Note that the filter function must return the array of classes
	 * after it is finished processing, or all of the classes will be cleared
	 * and could seriously impact the visual state of a user’s site.
	 *
	 * @param array $classes
	 * @return array
	 */
	public function bodyClass( array $classes ) {

		$include = [
			'is-iphone'            => $GLOBALS['is_iphone'],
			'is-chrome'            => $GLOBALS['is_chrome'],
			'is-safari'            => $GLOBALS['is_safari'],
			'is-ns4'               => $GLOBALS['is_NS4'],
			'is-opera'             => $GLOBALS['is_opera'],
			'is-mac-ie'            => $GLOBALS['is_macIE'],
			'is-win-ie'            => $GLOBALS['is_winIE'],
			'is-firefox'           => $GLOBALS['is_gecko'],
			'is-lynx'              => $GLOBALS['is_lynx'],
			'is-ie'                => $GLOBALS['is_IE'],
			'is-edge'              => $GLOBALS['is_edge'],
			'is-archive'           => is_archive(),
			'is-post_type_archive' => is_post_type_archive(),
			'is-attachment'        => is_attachment(),
			'is-author'            => is_author(),
			'is-category'          => is_category(),
			'is-tag'               => is_tag(),
			'is-tax'               => is_tax(),
			'is-date'              => is_date(),
			'is-day'               => is_day(),
			'is-feed'              => is_feed(),
			'is-comment-feed'      => is_comment_feed(),
			'is-front-page'        => is_front_page(),
			'is-home'              => is_home(),
			'is-privacy-policy'    => is_privacy_policy(),
			'is-month'             => is_month(),
			'is-page'              => is_page(),
			'is-paged'             => is_paged(),
			'is-preview'           => is_preview(),
			'is-robots'            => is_robots(),
			'is-search'            => is_search(),
			'is-single'            => is_single(),
			'is-singular'          => is_singular(),
			'is-time'              => is_time(),
			'is-trackback'         => is_trackback(),
			'is-year'              => is_year(),
			'is-404'               => is_404(),
			'is-embed'             => is_embed(),
			'is-mobile'            => wp_is_mobile(),
			'is-desktop'           => ! wp_is_mobile(),
			'has-blocks'           => function_exists( 'has_blocks' ) && has_blocks(),
		];

		/**
		 * Sidebars
		 */
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			$include[ "is-sidebar-{$sidebar['id']}" ] = is_active_sidebar( $sidebar['id'] );
		}

		foreach ( $include as $class => $do_include ) {
			if ( $do_include ) {
				$classes[ $class ] = $class;
			}
		}

		return $classes;
	}
}

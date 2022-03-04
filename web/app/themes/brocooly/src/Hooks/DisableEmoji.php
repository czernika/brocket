<?php
/**
 * Disable emoji
 *
 * @since 1.10.0
 * @package Brocooly
 */

declare(strict_types=1);

namespace Theme\Hooks;

use Brocooly\Hooks\Hookable;

class DisableEmoji implements Hookable
{
	public function init()
	{
		add_action( 'init', [ $this, 'disableEmoji' ] );
	}

	public function disableEmoji()
	{
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		add_filter( 'tiny_mce_plugins', [ $this, 'disableEmojiFromTinyMCE' ] );

		add_filter( 'emoji_svg_url', '__return_false' );
	}

	public function disableEmojiFromTinyMCE( $plugins )
	{
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, [ 'wpemoji' ] );
		}

		return [];
	}
}

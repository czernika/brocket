<?php
/**
 * Page controller
 * Handles page requests
 *
 * @package Brocooly
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Theme\Http\Controllers;

class PageController
{

	/**
	 * Get content of front page
	 *
	 * @return void
	 */
	public function front()
	{
		return output( 'content.front-page' );
	}

	/**
	 * Get content of default pages
	 *
	 * @return void
	 */
	public function all()
	{
		$responseCode = http_response_code();

		$error = [
			'status' => $responseCode,
			'text'   => match ( $responseCode ) {
				200     => __( 'Please provide appropriate template for this request', 'brocooly' ),
				404     => __( 'Page was not found', 'brocooly' ),
				500     => __( 'Server error', 'brocooly' ),
				default => __( 'There has been a critical error on this website', 'brocooly' ),
			},
		];
		return output( 'content.error', compact( 'error' ) )->withStatus( $responseCode );
	}
}

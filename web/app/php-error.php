<?php
/**
 * Error page
 * Handle any error response here
 *
 * @package Brocooly
 * @since 1.8.4
 */

use Timber\Timber;

$context = Timber::context();

$responseCode = http_response_code();

$context['error'] = [
	'status' => $responseCode,
	'text'   => match ( $responseCode ) {
		default => __( 'There has been a critical error on this website.' ),
	},
];

Timber::render( 'content/error.twig', $context );

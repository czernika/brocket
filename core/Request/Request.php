<?php
/**
 * Request object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.5.0
 */

declare(strict_types=1);

namespace Brocooly\Request;

use Brocooly\Support\Facades\Validator;
use WPEmerge\Requests\Request as WPEmergeRequest;

class Request extends WPEmergeRequest
{

	/**
	 * {@inheritDoc}
	 * @return static
	 */
	public static function fromGlobals() {
		$request = parent::fromGlobals();
		$new = new static(
			$request->getMethod(),
			$request->getUri(),
			$request->getHeaders(),
			$request->getBody(),
			$request->getProtocolVersion(),
			$request->getServerParams()
		);

		return $new
			->withCookieParams( $_COOKIE )
			->withQueryParams( $_GET )
			->withParsedBody( $_POST )
			->withUploadedFiles( static::normalizeFiles( $_FILES ) );
	}

	/**
	 * Validate request
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return \Illuminate\Validation\Validator
	 */
	public function validate( array $rules, ?array $body = null )
	{
		if ( ! $body ) {
			$body = match( $this->getMethod() ) {
				'POST' => $this->getParsedBody(),
				'GET'  => $this->getQueryParams(),
			};
		}

		$validator = Validator::make( $body, $rules );
		return $validator;
	}

	/**
	 * Get validated data no matter what
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return array
	 */
	public function validated( array $rules, ?array $body = null ) : array
	{
		return $this->validate( $rules, $body )->validated();
	}

	/**
	 * Get validated data or false
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return array|false
	 */
	public function validatedOrFalse( array $rules, ?array $body = null ) : array|false
	{
		$validator = $this->validate( $rules, $body );

		if ( $validator->passes() ) {
			return $validator->validated();
		}

		return false;
	}

	/**
	 * Get validated data or an array of errors
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return array|\Illuminate\Support\MessageBag
	 */
	public function validatedOrErrorsBag( array $rules, ?array $body = null ) : array|\Illuminate\Support\MessageBag
	{
		$validator = $this->validate( $rules, $body );

		if ( $validator->passes() ) {
			return $validator->validated();
		}

		return $validator->errors();
	}

	/**
	 * Get validated data or an array of errors
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return array
	 */
	public function validatedOrErrors( array $rules, ?array $body = null )
	{
		$validator = $this->validate( $rules, $body );

		if ( $validator->passes() ) {
			return $validator->validated();
		}

		return $validator->errors()->all();
	}

	/**
	 * Get validated data or first error message
	 *
	 * @param array $rules
	 * @param array|null $body
	 * @return array|string
	 */
	public function validatedOrError( array $rules, ?array $body = null ) : array|string
	{
		$validator = $this->validate( $rules, $body );

		if ( $validator->passes() ) {
			return $validator->validated();
		}

		return $validator->errors()->first();
	}
}

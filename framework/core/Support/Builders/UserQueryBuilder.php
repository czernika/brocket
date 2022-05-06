<?php

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Theme\Models\WP\User;

class UserQueryBuilder
{
	use SortQuery, MetaQuery;

	/**
	 * Query params
	 *
	 * @var array
	 */
	protected array $query = [];

	/**
	 * User classmap
	 *
	 * @var string
	 */
	protected $classmap;

	public function __construct( string|array $roles, string $classmap )
	{
		$this->query['role'] = $roles;
		$this->classmap = $classmap;
	}

	public function roles( string|array $roles )
	{
		$this->query['role'] = $roles;
		return $this;
	}

	public function query( array $query )
	{
		$this->query = wp_parse_args( $query, $this->query );
		return $this;
	}

	public function all()
	{
		return $this->get();
	}

	public function get()
	{
		return collect( get_users( $this->query ) )->map( function( $user ) {
			$userObj = $this->classmap;
			return new $userObj( $user );
		} );
	}
}

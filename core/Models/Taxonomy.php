<?php

declare(strict_types=1);

namespace Brocooly\Models;

use Timber\Term;
use Brocooly\Support\Builders\TaxonomyQueryBuilder;

class Taxonomy extends Term
{
	const TAXONOMY = 'category';

	protected string|array $postTypes = 'post';

	public static function __callStatic( $name, $arguments )
	{
		$builder = new TaxonomyQueryBuilder( static::TAXONOMY, static::class );
		return call_user_func_array( [ $builder, $name ], $arguments );
	}

	public function getPostTypes()
	{
		return $this->postTypes;
	}
}

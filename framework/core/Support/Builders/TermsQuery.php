<?php
/**
 * Terms query
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Brocooly\Support\Builders;

use Timber\Timber;

trait TermsQuery
{

	/**
	 * Get terms
	 *
	 * @param string|array|null $args
	 * @param array $maybe
	 * @return mixed
	 */
	public function terms( $args = null, array $maybe = [] ) : mixed
	{
		$args['taxonomy'] = $this->classMap::TAXONOMY;
		return Timber::get_terms( $args, $maybe, $this->classMap );
	}
}

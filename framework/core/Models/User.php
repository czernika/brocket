<?php
/**
 * User object
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.11.0
 */

declare(strict_types=1);

namespace Brocooly\Models;

use Timber\User as TimberUser;

class User extends TimberUser
{

	public static function current()
	{
		return new static( get_current_user_id() );
	}
}

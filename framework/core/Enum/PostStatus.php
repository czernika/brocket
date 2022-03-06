<?php
/**
 * Default WordPress post statuses
 *
 * @link https://wordpress.org/support/article/post-status/
 *
 * @since 1.12.2
 * @subpackage Brocket
 * @package Brocooly
 */

declare(strict_types=1);

namespace Framework\Core\Enum;

class PostStatus
{

	/**
	 * Viewable by everyone
	 */
	const PUBLISHED = 'publish';

	/**
	 * Scheduled to be published in a future date
	 */
	const FUTURE = 'future';

	/**
	 * Incomplete post viewable by anyone with proper user role
	 */
	const DRAFT = 'draft';

	/**
	 * Awaiting a user with the publish_posts capability
	 * (typically a user assigned the Editor role) to publish
	 */
	const PENDING = 'pending';

	/**
	 * Viewable only to WordPress users at Administrator level
	 */
	const PRIVATE = 'private';

	/**
	 * Posts in the Trash are assigned the trash status
	 */
	const TRASHED = 'trash';

	/**
	 * Revisions that WordPress saves automatically while you are editing
	 */
	const AUTO = 'auto-draft';

	/**
	 * Used with a child post (such as Attachments and Revisions)
	 * to determine the actual status from the parent post
	 */
	const INHERIT = 'inherit';

	/**
	 * Get all post types
	 *
	 * @return array
	 */
	public static function all() : array
	{
		return [
			static::PUBLISHED,
			static::FUTURE,
			static::DRAFT,
			static::PENDING,
			static::PRIVATE,
			static::TRASHED,
			static::AUTO,
			static::INHERIT,
		];
	}
}

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

namespace Brocooly\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static PostStatus PUBLISHED()
 * @method static PostStatus FUTURE()
 * @method static PostStatus DRAFT()
 * @method static PostStatus PENDING()
 * @method static PostStatus PRIVATE()
 * @method static PostStatus TRASHED()
 * @method static PostStatus AUTO()
 * @method static PostStatus INHERIT()
 */
final class PostStatus extends Enum
{

	/**
	 * Viewable by everyone
	 */
	private const PUBLISHED = 'publish';

	/**
	 * Scheduled to be published in a future date
	 */
	private const FUTURE = 'future';

	/**
	 * Incomplete post viewable by anyone with proper user role
	 */
	private const DRAFT = 'draft';

	/**
	 * Awaiting a user with the publish_posts capability
	 * (typically a user assigned the Editor role) to publish
	 */
	private const PENDING = 'pending';

	/**
	 * Viewable only to WordPress users at Administrator level
	 */
	private const PRIVATE = 'private';

	/**
	 * Posts in the Trash are assigned the trash status
	 */
	private const TRASHED = 'trash';

	/**
	 * Revisions that WordPress saves automatically while you are editing
	 */
	private const AUTO = 'auto-draft';

	/**
	 * Used with a child post (such as Attachments and Revisions)
	 * to determine the actual status from the parent post
	 */
	private const INHERIT = 'inherit';
}

<?php
/**
 * Copy `mix` files
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.8
 */

declare(strict_types=1);

namespace Brocooly\Console\Vendors;

use Brocooly\Console\SymfonyStyleTrait;

class CopyMixVendor extends VendorCommand
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'vendor:mix';

	/**
	 * Directory within `stubs folder`
	 *
	 * @var string
	 */
	protected string $from = 'mix';
}

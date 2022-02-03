<?php
/**
 * Trait to use SymfonyStyle in an input/output
 *
 * @package Brocooly
 * @subpackage Brocket
 * @since 1.7.4
 */


declare(strict_types=1);

namespace Brocooly\Console;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait SymfonyStyleTrait
{
	/**
	 * Symfony Style
	 *
	 * @var SymfonyStyle
	 */
	protected SymfonyStyle $io;

	protected function initialize( InputInterface $input, OutputInterface $output)
    {
		$this->io = new SymfonyStyle( $input, $output );
    }
}

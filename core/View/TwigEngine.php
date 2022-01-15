<?php

declare(strict_types=1);

namespace Brocooly\View;

use WPEmerge\View\ViewEngineInterface;

class TwigEngine implements ViewEngineInterface
{

	private $twig;

	public function __construct( $twig )
	{
		$this->twig = $twig;
	}

	public function make( $views )
	{
		foreach ( $views as $view ) {
			// return $this->twig->load( $view );
			return ( new TwigView() )
					->setName( $view )
					->setTwigView( $this->twig->load( $view ) );
		}
	}

	public function exists( $view )
	{
		return true;
	}

	public function canonical( $view )
	{
		return true;
	}

	private function render( $view, $context = [] )
	{
		return $this->twig->render( $view, $context );
	}
}
